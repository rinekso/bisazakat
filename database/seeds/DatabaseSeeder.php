<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissions::class);
        $this->call(users::class);
        $this->call(CoASeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProgramSeeder::class);
    }
}
