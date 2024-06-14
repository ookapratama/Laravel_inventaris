<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usr = [
            [
                'name' => 'Administrator',
                'username' => 'admin',
                // 'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'role' => 'admin',
            ],
            // [
            //     'name' => 'guru1',
            //     'username' => '1111',
            //     // 'email' => 'superadmin@gmail.com',
            //     'password' => bcrypt('123'),
            //     'role' => 1,
            // ],
            // [
            //     'name' => 'guru2',
            //     'username' => '2222',
            //     // 'email' => 'superadmin@gmail.com',
            //     'password' => bcrypt('123'),
            //     'role' => 1,
            // ],
        ];

        foreach ($usr as $v) {
            User::create([
                'name' => $v['name'],
                'username' => $v['username'],
                // 'email' => $v['email'],
                'password' => $v['password'],
                'role' => $v['role'],
            ]);
        };
    }
}
