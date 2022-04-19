<?php

namespace App\Http\Controllers\Admin;

use App\Mail\TransactionConfirmed;
use App\Models\Payment;
use App\Models\ProofOfPayment;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class TransactionController extends Controller
{

    public function index()
    {
        $transactions = Transaction::get();
        $user = User::role('donatur')->get();

        return view('admin.transactions.index', compact('transactions', 'user'));
    }

    public function show(Transaction $transaction)
    {
        $payment = $transaction->payment()->first();
        return view('admin.transactions.show', compact('transaction', 'payment'));
    }

    public function setConfirmation(Transaction $transaction, Request $request)
    {
        $confirmationResult = $request->post('confirmation');
        $amount = $request->post('amount');
        $program = $transaction->program;
        $payment = $transaction->payment;
        $proofOfPayment = $transaction->proofOfTransfer;


        switch ($confirmationResult) {

            /**
             * Konfirmasi Berhasil
             * Set status transaksi ke SUCCESS
             * Dan masukkan hasil transaksi ke table payments
             */
            case 1:
                $transaction->update([
                    'status' => $confirmationResult,
                    'amount' => $amount,
                ]);

                $transaction->payment->update([
                    'verifier_id' => auth()->user()->user_id,
                    'is_manual_checked' => 1,
                    'status' => Payment::SETTLED,
                    'confirmed_at' => now(),
                    'amount' => $amount
                ]);


                $program->update([
                    'fund_accumulation' => $program->fund_accumulation + $transaction->amount
                ]);


                Mail::to($transaction->user->email)
                    ->queue(new TransactionConfirmed($transaction));

                break;

            /**
             * Batalkan Konfirmasi
             * Set status transaksi ke PENDING atau set status payment ke EXPIRED jika telah melampaui jatuh tempo
             */
            case 0:


                if ($transaction->status == 1) {
                    $program->update([
                        'fund_accumulation' => $program->fund_accumulation - $transaction->amount
                    ]);
                }

                /**
                 * Set status payment ke FAILED jika transaksi sudah melampaui jatuh tempo
                 */
                if ($transaction->is_expired) {
                    $confirmationResult = Transaction::EXPIRED;
                    $payment->update([
                        'status' => Payment::FAILED
                    ]);
                }

                $transaction->status = $confirmationResult;
                $payment->update([
                    'status' => Payment::PENDING,
                ]);

                if ($proofOfPayment) {
                    $proofOfPayment->delete();
                }

                $transaction->update([
                    'proof_of_payment_id' => null
                ]);

                $transaction->save();
                break;


        }

        return redirect()->route('admin.transactions.show', $transaction->transaction_uuid);
    }


    /**
     * Upload proof of payment/ proof of transfer
     */

    public function doUploadProofOfPayment(User $user, Transaction $transaction, Request $request)
    {
        $image = $request->file('bukti');

        $imageName = time()."-".$transaction->transaction_uuid.".".$image->getClientOriginalExtension();

        $proofOfPayment = ProofOfPayment::create(['image' => $image->storeAs('images', $imageName)]);


        $transaction->proof_of_payment_id = $proofOfPayment->proof_of_payment_id;
        $transaction->save();

        return redirect()->route('admin.transactions.show', $transaction->transaction_uuid);
    }
}
