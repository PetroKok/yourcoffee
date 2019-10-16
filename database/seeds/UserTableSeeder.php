<?php
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
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
        		'email' => 'admin@qwe.qwe',
    	  	],
    	  	[
    	  		'name' => 'Moder Anna',
        		'role' => 'waiter',
        		'email' => 'waiter@qwe.qwe',
    	  	],
    	  	[
    	  		'name' => 'Сook Nick',
        		'role' => 'cook',
        		'email' => 'cook@qwe.qwe',
    	  	],
    	  	[
    	  		'name' => 'Customer',
        		'role' => 'customer',
        		'email' => 'qwe@qwe.qwe',
    	  	],
    	  ];
        foreach ($users as $user) {
        	User::create([
        		'name' => $user['name'],
                'role' => $user['role'],
        		'email' => $user['email'],
        		'email_verified_at' => Carbon::now(),
        		'password' => Hash::make('qweqweqwe')
        	]);
        }
    }
}
