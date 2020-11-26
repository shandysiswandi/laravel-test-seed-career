<?php

namespace Database\Seeders;

use App\Models\CompanyBudget;
use Illuminate\Database\Seeder;

class CompanyBudgetSeeder extends Seeder
{
    public function run()
    {
        CompanyBudget::truncate();
        CompanyBudget::create([
            'company_id' => 1,
            'amount' => 20000.99
        ]);

        CompanyBudget::create([
            'company_id' => 2,
            'amount' => 15000.89
        ]);
    }
}
