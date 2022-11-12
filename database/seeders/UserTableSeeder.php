<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::truncate();
        $users = array(
            array(
            'name' => "Super Admin",
            'email' => "superadmin@abcd.com",
            'phone' => "9840010192",
            'password' => bcrypt('superadmin123'),
            'address' => 'Bagar, Pokhara',
        ),
            array(
                'name' => "Admin",
                'email' => "admin@abcd.com",
                'phone' => "9840010192",
                'password' => bcrypt('admin123'),
                'address' => 'Putalisadak, Kathmandu',
            ),
            array(
                'name' => "User1",
                'email' => "user@abcd.com",
                'phone' => "9840010192",
                'password' => bcrypt('user123'),
                'address' => 'Matepani-12, Pokhara',
            ),
        );
        foreach($users as $user_data){
            if( User::where('email', $user_data['email'])->count() <= 0){
                $user = new User;
                $user->fill($user_data);
                $user->save();
            }
        }
    }
}
