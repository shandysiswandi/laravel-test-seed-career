<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::truncate();
        Company::create([
            'id' => 1,
            'name' => "Tokopedia",
            'address' => 'Jakarta'
        ]);

        Company::create([
            'id' => 2,
            'name' => "Bukalapak",
            'address' => 'Jakarta'
        ]);
    }
}
