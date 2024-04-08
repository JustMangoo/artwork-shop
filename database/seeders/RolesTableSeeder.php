<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the roles table first
        DB::table('roles')->delete();

        // Define the roles to seed
        $roles = [
            ['name' => 'customer'],
            ['name' => 'admin'],
            ['name' => 'moderator'],
        ];

        // Insert the roles into the roles table
        DB::table('roles')->insert($roles);
    }
}
