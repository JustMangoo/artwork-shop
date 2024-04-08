<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear the roles table first
        DB::table('categories')->delete();

        // Define the roles to seed
        $categories = [
            ['name' => 'Printets'],
            ['name' => 'Kokdarbi'],
            ['name' => 'Originals'],
        ];

        // Insert the roles into the roles table
        DB::table('categories')->insert($categories);
    }
}
