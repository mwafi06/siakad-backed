<?php
use \Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('module')->insert(array(
            [
                'module_category_id' => '1',
                'parent_id' => '0',
                'mod_name' => 'Home',
                'mod_alias' => 'home',
                'mod_icon' => 'fas fa-tachometer-alt',
                'permalink' => '/',
                'mod_order'  => '1',
                'created_at'=> Carbon::now()
            ],
            [
                'module_category_id' => '2',
                'parent_id' => '0',
                'mod_name' => 'Employee',
                'mod_alias' => 'employee',
                'mod_icon' => 'fas fa-users',
                'permalink' => '',
                'mod_order'  => '2',
                'created_at'=> Carbon::now()
            ],
            [
                'module_category_id' => '2',
                'parent_id' => '2',
                'mod_name' => 'Employee',
                'mod_alias' => 'employee',
                'mod_icon' => '',
                'permalink' => '/employee',
                'mod_order'  => '3',
                'created_at'=> Carbon::now()
            ],
            [
                'module_category_id' => '2',
                'parent_id' => '2',
                'mod_name' => 'Employee Group',
                'mod_alias' => 'employee-group',
                'mod_icon' => '',
                'permalink' => '/employee-group',
                'mod_order'  => '4',
                'created_at'=> Carbon::now()
            ],

        ));
    }
}
