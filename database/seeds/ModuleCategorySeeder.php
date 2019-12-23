<?php
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class ModuleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('module_category')->insert(array(
            [
                'name' => 'Dashboard',
                'order' => '1',
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Account',
                'order' => '2',
                'created_at' => Carbon::now()
            ]
        ));
    }
}
