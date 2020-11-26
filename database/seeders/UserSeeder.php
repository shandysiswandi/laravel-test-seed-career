<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'company_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@gmail.com',
            'account' => '12345678',
        ]);

        User::create([
            'company_id' => 1,
            'first_name' => 'Jeni',
            'last_name' => 'Doe',
            'email' => 'jeni.doe@gmail.com',
            'account' => '87654321',
        ]);

        User::create([
            'company_id' => 2,
            'first_name' => 'Marl',
            'last_name' => 'Marcus',
            'email' => 'marl.marcus@gmail.com',
            'account' => '12348765',
        ]);

        User::create([
            'company_id' => 2,
            'first_name' => 'Carl',
            'last_name' => 'Marcus',
            'email' => 'carl.marcus@gmail.com',
            'account' => '87651234',
        ]);
    }
}
