<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'sport_create',
            ],
            [
                'id'    => '18',
                'title' => 'sport_edit',
            ],
            [
                'id'    => '19',
                'title' => 'sport_show',
            ],
            [
                'id'    => '20',
                'title' => 'sport_delete',
            ],
            [
                'id'    => '21',
                'title' => 'sport_access',
            ],
            [
                'id'    => '22',
                'title' => 'region_create',
            ],
            [
                'id'    => '23',
                'title' => 'region_edit',
            ],
            [
                'id'    => '24',
                'title' => 'region_show',
            ],
            [
                'id'    => '25',
                'title' => 'region_delete',
            ],
            [
                'id'    => '26',
                'title' => 'region_access',
            ],
            [
                'id'    => '27',
                'title' => 'charity_create',
            ],
            [
                'id'    => '28',
                'title' => 'charity_edit',
            ],
            [
                'id'    => '29',
                'title' => 'charity_show',
            ],
            [
                'id'    => '30',
                'title' => 'charity_delete',
            ],
            [
                'id'    => '31',
                'title' => 'charity_access',
            ],
            [
                'id'    => '32',
                'title' => 'event_create',
            ],
            [
                'id'    => '33',
                'title' => 'event_edit',
            ],
            [
                'id'    => '34',
                'title' => 'event_show',
            ],
            [
                'id'    => '35',
                'title' => 'event_delete',
            ],
            [
                'id'    => '36',
                'title' => 'event_access',
            ],
            [
                'id'    => '37',
                'title' => 'post_create',
            ],
            [
                'id'    => '38',
                'title' => 'post_edit',
            ],
            [
                'id'    => '39',
                'title' => 'post_show',
            ],
            [
                'id'    => '40',
                'title' => 'post_delete',
            ],
            [
                'id'    => '41',
                'title' => 'post_access',
            ],
            [
                'id'    => '42',
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);

    }
}
