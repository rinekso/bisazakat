<?php

namespace App\Console\Commands;

use App\Mail\TransactionConfirmed;
use App\Models\Payment;
use Illuminate\Console\Command;
use Webklex\IMAP\Facades\Client;
use Illuminate\Support\Facades\Mail;

class CheckTransactionEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TransactionEmails:inspect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse email body and get unique code to verify user transaction for BCA Bank';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $oClient = Client::account('default');
        $oClient->connect();
        $oFolder = $oClient->getFolder('INBOX');
        $aMessage = $oFolder->searchMessages([['UNSEEN']]);

        $rawMessages = collect($aMessage)->flatten()->map(function ($message) {
            return collect($message)->get('bodies')['text']->content;
        })->filter(function ($value, $key) {
            return str_contains($value, ['Nominal', 'BCA', 'Jumlah', 'BRI']);
        });

        $res = collect();
        collect($rawMessages)->filter(function ($value) use ($res) {
            $re = '/(?<=Nominal  :  )(.*)(?=  No. Referensi)/s';
            preg_match($re, $value, $matches);
            if (isset($matches[0]))
                $res->push($matches[0]);

            $re2 = '/(?<=Jumlah :)(.*)(?=Tanggal)/s';
            preg_match($re2, $value, $matches2);
            if (isset($matches2[0]))
                $res->push($matches2[0]);
        });

        $result = $res->map(function ($value) {
            $value = trim($value);
            $value = str_replace('.', '', $value);
            $re = '/\d+/s';

            preg_match_all($re, $value, $matches);
            return [
                'amount' => $matches[0][0],
                'unique_code' => substr($matches[0][0], strlen($matches[0][0]) - 3, 3),
            ];
        });

        foreach ($result as $r) {
        //dd($r['unique_code']);

            $transaction = \App\Models\Transaction::where('last_digit_unique_code', $r['unique_code'])
                ->where('expired_at', '>', now())
                ->first();

            if ($transaction) {

                $transaction->update([
                    'status' => 1,
                ]);

                $transaction->payment->update([
                    'is_manual_checked' => 0,
                    'status' => Payment::SETTLED,
                    'confirmed_at' => now(),
                ]);

                $transaction->program->update([
                    'fund_accumulation' => $transaction->program->fund_accumulation + $transaction->amount,
                ]);

                Mail::to($transaction->user->email)
                    ->queue(new TransactionConfirmed($transaction));

            }
        }
    }
}
