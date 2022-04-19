<?php

use Illuminate\Database\Seeder;

class CoASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CoA::insert([
            [
                'coa_number' => 1001,
                'bank_account' => '1002 123 123',
                'title' => 'Zakat',
                'is_active' => 1,
                'bank_name' => 'BCA',
                'email' => 'support1@bisazakat.pw'
            ],
            [
                'coa_number' => 1002,
                'bank_account' => '1002 123 124',
                'title' => 'Donasi',
                'is_active' => 1,
                'bank_name' => 'BCA',
                'email' => 'support1@bisazakat.pw'
            ]
        ]);
    }
}
