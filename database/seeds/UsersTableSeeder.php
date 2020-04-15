<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$7ZqYDrsotaZK8IhmYV8TWuQ6v.Yk2gieQ.pRB8w9zguTrvma48MWK',
                'remember_token' => null,
            ],
        ];

        User::insert($users);

    }
}
