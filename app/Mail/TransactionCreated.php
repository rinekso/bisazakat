<?php

namespace App\Mail;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionCreated extends Mailable
{
    use Queueable, SerializesModels;


    public $nama, $nominal, $program, $expired, $rekening;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->nama = $transaction->full_name;
        $this->nominal = $transaction->rupiah;
        $this->program = $transaction->program->title;
        $this->expired = Carbon::parse($transaction->expired_at)->format('d M Y, H:i');
        $this->rekening = $transaction->program->category->coa->bank_account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support1@bisazakat.pw', 'Bisazakat')
            ->subject("Segera transfer pembayaran Anda sebesar $this->nominal untuk program $this->program")
            ->markdown('emails.transactions.created');
    }
}
