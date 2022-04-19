<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use Illuminate\Console\Command;

class ChangeExpiredTransactionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExpiredTransactions:inspect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change expired transaction status, compare the expired_at field with current time, and change status code if it is less than now';

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
        $now = now();
        return \App\Models\Transaction::where('expired_at', '<', $now)
            ->where('status', '!=', Transaction::SUCCESS)
            ->update([
                'status' => Transaction::EXPIRED
            ]);
    }
}
