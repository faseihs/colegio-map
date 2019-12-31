<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \Spatie\Permission\Models\Role::create([
           'name'=>"Super Admin",
            "guard_name"=>"web"
        ]);
        \Spatie\Permission\Models\Role::create([
            'name'=>"Admin",
            "guard_name"=>"web"
        ]);
        \Spatie\Permission\Models\Role::create([
            'name'=>"Employee",
            "guard_name"=>"web"
        ]);
    }
}
