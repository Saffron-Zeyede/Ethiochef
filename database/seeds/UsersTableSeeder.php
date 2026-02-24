<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'badcoder@gmail.com')->first();

        if (!$user){

            User::create([
                'name' => 'Ethiochef User',
                'email' => 'ethiochef@gmail.com',
                'password' => Hash::make('etchfpass')
            ]);
        }

        $user2 = User::create([
            'name' => 'User 2',
            'email' => 'abebegietaneh@gmail.com',
            'password' => Hash::make('Ps@etchf22')
        ]);
    }

}
