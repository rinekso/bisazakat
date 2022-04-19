<?php

namespace App\Http\Controllers;

use App\Mail\TransactionCreated;
use App\Models\Payment;
use App\Models\Program;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class ZakatController extends Controller {
    public function setNominalZakat(Request $request) {
        $this->validate($request, [
            'nominal' => 'required',
            'jenis_zakat' => 'required',
        ]);

        if ($request->nominal == 0) {
            return redirect()->back()->with('warning', 'Zakat kamu belum memenuhi nisab.');
        }

        $program_id = 0;
        switch ($request->post('jenis_zakat')) {
        case "penghasilan":
            $program_id = 1;
            break;
        case "perdagangan":
            $program_id = 2;
            break;
        case "investasi":
            $program_id = 3;
            break;
        }

        $request->session()->put('nominal-' . $program_id, $request->post('nominal'));

        return redirect()->route('zakat.transaction.user.info', compact('program_id'));
    }

    public function userInfo(Program $program) {
        return view('frontend.pembayaran-zakat', compact('program'));
    }

    public function createTransaction(Program $program, Request $request) {
        $programId = $program->program_id;
        $nominal = str_replace(',', '', session('nominal-' . $programId));

        $lastDigitUniqueCode = ((DB::table('transactions')->max('transaction_id') + 1) % 1000);
        $lastDigitUniqueCodePadded = str_pad($lastDigitUniqueCode, 3, 0, STR_PAD_LEFT);
        $finalAmount = $nominal + $lastDigitUniqueCode;
        $hideCredential = ($request->has('hide_credential')) ? 1 : 0;
        $user = auth()->user();

        // Todo: change value with variable from settings
        $expiredAt = Carbon::now()->addHour(23)->format('Y-m-d H:i:s');

        $transaction = Transaction::create([
            'transaction_uuid' => (string) Uuid::generate(),
            'last_digit_unique_code' => $lastDigitUniqueCodePadded,
            'program_id' => $program->program_id,
            'user_id' => auth()->user()->user_id,
            'full_name' => auth()->user()->getFullName(),
            'email' => auth()->user()->email,
            'phone_number' => auth()->user()->phone_number,
            'amount' => $finalAmount,
            'status' => Transaction::PENDING,
            'hide_credential' => $hideCredential,
            'expired_at' => $expiredAt,
        ]);

        // TODO: change payment type dynamically

        $payment = Payment::create([
            'payment_uuid' => (string) Uuid::generate(),
            'transaction_uuid' => $transaction->transaction_uuid,
            'verifier_id' => 0,
            'payment_type' => 1, // Bank Transfer
            'amount' => $finalAmount,
            'is_manual_checked' => 0,
            'status' => Payment::PENDING,
        ]);

        // Set status field value to 2 for expired transaction slot
        $expiredTransactions = Transaction::where('expired_at', '<', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('proof_of_payment_id', null)
            ->update([
                'status' => Transaction::EXPIRED,
            ]);

        Mail::to($user->email)
            ->queue(new TransactionCreated($transaction));

        $request->session()->forget('nominal-' . $programId);

        return redirect()->route('zakat.transaction.summary', [$programId, $transaction->transaction_uuid]);
    }

    public function createTransactionWithoutLogin(Program $program, Request $request) {
        $programId = $program->program_id;
        $nominal = str_replace(',', '', session('nominal-' . $programId));

        $lastDigitUniqueCode = ((DB::table('transactions')->max('transaction_id') + 1) % 1000);
        $lastDigitUniqueCodePadded = str_pad($lastDigitUniqueCode, 3, 0, STR_PAD_LEFT);
        $finalAmount = $nominal + $lastDigitUniqueCode;
        $hideCredential = ($request->has('hide_credential')) ? 1 : 0;

        // Todo: change value with variable from settings
        $expiredAt = Carbon::now()->addHour(23)->format('Y-m-d H:i:s');

        $transaction = Transaction::create([
            'transaction_uuid' => (string) Uuid::generate(),
            'last_digit_unique_code' => $lastDigitUniqueCodePadded,
            'program_id' => $program->program_id,
            'user_id' => 0,
            'full_name' => $request->post('full_name'),
            'email' => $request->post('email'),
            'phone_number' => $request->post('phone_number'),
            'amount' => $finalAmount,
            'status' => Transaction::PENDING,
            'hide_credential' => $hideCredential,
            'expired_at' => $expiredAt,
        ]);

        // TODO: change payment type dynamically

        $payment = Payment::create([
            'payment_uuid' => (string) Uuid::generate(),
            'transaction_uuid' => $transaction->transaction_uuid,
            'verifier_id' => 0,
            'payment_type' => 1, // Bank Transfer
            'amount' => $finalAmount,
            'is_manual_checked' => 0,
            'status' => Payment::PENDING,
        ]);

        // Set status field value to 2 for expired transaction slot
        $expiredTransactions = Transaction::where('expired_at', '<', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('proof_of_payment_id', null)
            ->update([
                'status' => Transaction::EXPIRED,
            ]);

        $request->session()->forget('nominal-' . $programId);

        Mail::to($request->post('email'))
            ->queue(new TransactionCreated($transaction));

        return redirect()->route('zakat.transaction.summary', [$programId, $transaction->transaction_uuid]);
    }

    public function getSummary(Program $program, Transaction $transaction, Request $request) {
        return view('frontend.ringkasan', compact('program', 'transaction'));
    }

}
