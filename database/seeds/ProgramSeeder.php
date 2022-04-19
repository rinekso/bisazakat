<?php

use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Program::insert([
            [
                'category_id' => 1,
                'title' => 'Zakat Penghasilan',
                'slug' => str_slug('Zakat Penghasilan')
            ],
            [
                'category_id' => 1,
                'title' => 'Zakat Perdagangan',
                'slug' => str_slug('Zakat Perdagangan')
            ],
            [
                'category_id' => 1,
                'title' => 'Zakat Investasi',
                'slug' => str_slug('Zakat Investasi')
            ],

        ]);

        \App\Models\Program::insert(
            [
                'category_id' => 2,
                'title' => 'Main Program',
                'slug' => str_slug('Main Program'),
                'description' => 'Main program placeholder',
                'is_main_program' => 1
            ]
        );
    }
}
