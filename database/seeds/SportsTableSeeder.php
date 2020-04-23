<?php

use App\Sport;
use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sports = [
            [
                'name' => 'Basketball'
            ],
            [
                'name' => 'American Football'
            ],
            [
                'name' => 'Soccer'
            ],
            [
                'name' => 'Baseball'
            ],
            [
                'name' => 'Ice Hockey'
            ],
        ];

        foreach($sports as $sport) {
            Sport::create($sport);
        }
    }
}
