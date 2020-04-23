<?php

use App\Charity;
use Illuminate\Database\Seeder;

class CharitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $charities = [
            [
                'name' => 'Mayo Clinic/Foundation'
            ],
            [
                'name' => 'Feeding America'
            ],
            [
                'name' => 'Catholic Charities USA'
            ],
            [
                'name' => 'Red Cross'
            ],
            [
                'name' => 'Feed the Children'
            ],
        ];

        foreach($charities as $charity) {
            Charity::create($charity);
        }
    }
}
