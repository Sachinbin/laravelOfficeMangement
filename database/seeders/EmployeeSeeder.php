<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Company;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $company = Company::first();

        $manager = Employee::create([
            'name'=>'Rahul Sharma',
            'email'=>'rahul@example.com',
            'phone'=>'9876543210',
            'company_id'=>$company->id,
            'position'=>'Head',
            'country'=>'India',
            'state'=>'Maharashtra',
            'city'=>'Mumbai'
        ]);

        Employee::create([
            'name'=>'Priya Singh',
            'email'=>'priya@example.com',
            'phone'=>'9123456780',
            'company_id'=>$company->id,
            'manager_id'=>$manager->id,
            'position'=>'Developer',
            'country'=>'India',
            'state'=>'Maharashtra',
            'city'=>'Mumbai'
        ]);
    }
}
