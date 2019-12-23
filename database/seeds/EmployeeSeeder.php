<?php
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employee')->insert([
            'guid'      => '1',
            'nip'       => '0000000000',
            'full_name' => 'superadmin',
            'username'  => 'superadmin',
            'password'  => 'PABRxqYE/l0bfxTIFiY=',
            'created_at'=> Carbon::now()
        ]);
    }
}
