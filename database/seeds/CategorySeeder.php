<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::insert([
            [
                'coa_number' => 1001,
                'name'  => 'Zakat',
                'description' => 'Kategori Zakat'
            ],
            [
                'coa_number' => 1002,
                'name'  => 'Donasi',
                'description' => 'Kategori Donasi'
            ]
        ]);
    }
}
