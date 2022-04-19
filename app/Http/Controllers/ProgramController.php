<?php

namespace App\Http\Controllers;

use App\Mail\TransactionCreated;
use App\Models\Payment;
use App\Models\Program;
use App\Models\ProgramProgress;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class ProgramController extends Controller
{
    public function getProgramDonasi()
    {
        $programs = Program::orderBy('created_at', 'DESC')->paginate(6);

        return view('frontend.program', compact('programs'));
    }

    public function show($id)
    {
        $program = Program::find($id);
        // return $program->donator;
        return view('frontend.detail', compact('program'));
    }

    public function kontribusi(Program $program, Request $request)
    {


        return view('frontend.nominal', compact('program'));
    }

    public function setNominal(Program $program, Request $request)
    {
        $request->session()->put('nominal-'.$program->program_id, $request->post('nominal'));

        return redirect()->route('programs.kontribusi.user', $program->program_id);
    }

    public function userInfo(Program $program)
    {
        return view('frontend.pembayaran', compact('program'));
    }

    public function createTransaction(Program $program, Request $request)
    {
        $programId = $program->program_id;
        $nominal = str_replace(',', '',session('nominal-'.$programId));

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
            'user_id' => $user->user_id,
            'full_name' => $user->getFullName(),
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'amount' => $finalAmount,
            'status' => Transaction::PENDING,
            'hide_credential' => $hideCredential,
            'expired_at' => $expiredAt
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
                'status' => Transaction::EXPIRED
            ]);

        $request->session()->forget('nominal-'.$programId);

        Mail::to($user->email)
            ->queue(new TransactionCreated($transaction));

        return redirect()->route('programs.kontribusi.getsummary', [$programId, $transaction->transaction_uuid]);
    }

    public function createTransactionWithoutLogin(Program $program, Request $request)
    {
        $programId = $program->program_id;
        $nominal = str_replace(',', '',session('nominal-'.$programId));

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
            'expired_at' => $expiredAt
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
                'status' => Transaction::EXPIRED
            ]);

        $request->session()->forget('nominal-'.$programId);

        Mail::to($request->post('email'))
            ->queue(new TransactionCreated($transaction));

        return redirect()->route('programs.kontribusi.getsummary', [$programId, $transaction->transaction_uuid]);
    }


    public function getSummary(Program $program, Transaction $transaction, Request $request)
    {
        return view('frontend.ringkasan', compact('program', 'transaction'));
    }


}
