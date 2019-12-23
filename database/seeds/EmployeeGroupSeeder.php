<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmployeeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee_group')->insert([
            'name'  => 'Super User',
            'create'  => '1,3,4',
            'read'  => '1,3,4',
            'update'  => '1,3,4',
            'delete'  => '1,3,4',
            'created_at'=> Carbon::now()
        ]);
    }
}
