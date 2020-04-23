<?php

use App\Region;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'name' => 'New York'
            ],
            [
                'name' => 'Los Angeles'
            ],
            [
                'name' => 'Chicago'
            ],
            [
                'name' => 'Houston'
            ],
            [
                'name' => 'Phoenix'
            ],
        ];

        foreach($regions as $region) {
            Region::create($region);
        }
    }
}
