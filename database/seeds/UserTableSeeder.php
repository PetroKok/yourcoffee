<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class   UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin John',
                'role' => 'admin',
                'email' => 'admin@gmail.com',
            ],
            [
                'name' => 'Moder Anna',
                'role' => 'waiter',
                'email' => 'waiter@gmail.com',
            ],
            [
                'name' => 'Сook Nick',
                'role' => 'cook',
                'email' => 'cook@gmail.com',
            ],
            [
                'name' => 'Customer',
                'role' => 'customer',
                'email' => 'qwe@gmail.com',
            ],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'role' => $user['role'],
                'email' => $user['email'],
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('password')
            ]);
        }
    }
}
