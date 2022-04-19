<?php

use App\Admin;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('id_ID');

        /*
         * Database Seeding untuk akun super-admin
         * Default password: 'rahasia'
         */

        $superAdmin = Admin::create([
            'first_name' => 'Admin',
            'last_name' => 'Super',
            'email' => 'admin@bisazakat.com',
            'password' => 'rahasia'
        ]);

        $superAdmin->assignRole('super-admin');

        $admin2 = Admin::create([
            'first_name' => 'Admin',
            'last_name' => 'Regular',
            'email' => 'admin2@bisazakat.com',
            'password' => 'rahasia'
        ]);

        $admin2->assignRole('admin');

        $admin3 = Admin::create([
            'first_name' => 'Admin',
            'last_name' => 'Regular',
            'email' => 'admin3@bisazakat.com',
            'password' => 'rahasia'
        ]);

        $admin3->assignRole('admin');

        /*
         * Database Seeding untuk akun donatur
         * Default password: 'rahasia'
         */

        for($i = 1; $i <= 3 ; $i++) {
            $donatur = User::create([
                'first_name' => $faker->firstName('male'),
                'last_name' => $faker->lastName,
                'gender' => 'male',
                'email' => 'donatur'.$i.'@bisazakat.com',
                'password' => 'rahasia',
                'address' => $faker->address(),
                'phone_number' => $faker->phoneNumber(),
                'birth_place' => $faker->city,
                'birth_date' => $faker->date()
            ]);

            $donatur->assignRole('donatur');
        }

        for($i = 4; $i <= 7 ; $i++) {
            $donatur = User::create([
                'first_name' => $faker->firstName('female'),
                'last_name' => $faker->lastName,
                'gender' => 'female',
                'email' => 'donatur'.$i.'@bisazakat.com',
                'password' => 'rahasia',
                'address' => $faker->address(),
                'phone_number' => $faker->phoneNumber(),
                'birth_place' => $faker->city,
                'birth_date' => $faker->date()
            ]);

            $donatur->assignRole('donatur');
        }
    }
}
