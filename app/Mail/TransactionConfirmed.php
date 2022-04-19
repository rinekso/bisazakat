<?php

namespace App\Mail;

use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $nama, $nominal, $program, $expired, $rekening, $transaction;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->nama = $transaction->user->getFullName();
        $this->transaction = $transaction;
        $this->program = $transaction->program->title;
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
            ->subject("Transaksi telah kami verifikasi")
            ->markdown('emails.transactions.confirmed');
    }
}
