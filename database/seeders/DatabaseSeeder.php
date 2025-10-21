<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Book;
use App\Models\User;
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
        User::create([
            'fullname' => 'Admin User',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'role' => 'admin',
        ]);

        Book::factory(20)->create();
    }
}
