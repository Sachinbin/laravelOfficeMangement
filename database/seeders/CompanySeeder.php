<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run()
    {
        Company::factory()->create(['name'=>'Acme Corp','location'=>'Mumbai']);
        Company::factory()->create(['name'=>'Globex','location'=>'Delhi']);
        Company::factory()->create(['name'=>'Innotech','location'=>'Bengaluru']);
    }
}
