<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $ceo = Staff::create(['name' => 'CEO']);

        $manager1 = Staff::create(['name' => 'Manager 1', 'manager_id' => $ceo->id]);
        $manager2 = Staff::create(['name' => 'Manager 2', 'manager_id' => $ceo->id]);

        Staff::create(['name' => 'Employee 1', 'manager_id' => $manager1->id]);
        Staff::create(['name' => 'Employee 2', 'manager_id' => $manager1->id]);
        Staff::create(['name' => 'Employee 3', 'manager_id' => $manager2->id]);
    }
}
