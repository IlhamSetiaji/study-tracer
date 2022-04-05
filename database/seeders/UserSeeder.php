<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Admin',
                'email' => 'admin@test.test',
                'password' => Hash::make('password'),
                'status' => 'ACTIVE',
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@test.test',
                'password' => Hash::make('password'),
                'status' => 'ACTIVE',
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@test.test',
                'password' => Hash::make('password'),
                'status' => 'ACTIVE',
            ],
            [
                'name' => 'Alumni',
                'email' => 'alumni@test.test',
                'password' => Hash::make('password'),
                'status' => 'ACTIVE',
            ],
        ])->each(function($users){
            $user = User::create($users);
            if($user->id == 1)
            {
                $user->assignRole('admin');
            }elseif($user->id == 2)
            {
                $user->assignRole('guru');
            }elseif($user->id == 3)
            {
                $user->assignRole('siswa');
            }elseif($user->id == 4)
            {
                $user->assignRole('alumni');
            }
        });
    }
}
