<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'),
            'role' => 'admin'
        ]);
        DB::table('kategoris')->insert([
            'name' => 'fiksi',

        ]);

        
    }
}
