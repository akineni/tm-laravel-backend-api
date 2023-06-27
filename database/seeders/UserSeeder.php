<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Eniola Akinlonu',
                'email' => 'akinlonueniola@gmail.com',
                'created_at' => now()
            ],
            [
                'name' => 'akineni',
                'email' => 'akineni03@gmail.com',
                'created_at' => now()
            ],
            [
                'name' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'created_at' => now()
            ]
        ]);
    }
}
