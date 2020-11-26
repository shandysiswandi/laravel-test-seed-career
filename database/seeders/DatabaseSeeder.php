<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CompanySeeder::class);
        $this->call(CompanyBudgetSeeder::class);
        $this->call(UserSeeder::class);
    }
}
