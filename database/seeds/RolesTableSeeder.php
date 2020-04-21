<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Company',
            ],
            [
                'id'    => 3,
                'title' => 'Blog Writer',
            ],
        ];

        Role::insert($roles);

    }
}
