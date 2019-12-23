<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(EmployeeGroupSeeder::class);
         $this->call(EmployeeSeeder::class);
         $this->call(ModuleCategorySeeder::class);
         $this->call(ModuleSeeder::class);
    }
}
