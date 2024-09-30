<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoomRates;

class Rates extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rates = [
            '1' => [
                ['Hourly', '650'],
                ['4 Hours', '1750'],
                ['Daily (12 Hours)', '3000'],
                ['Weekly', '6000'],
                ['Monthly', '16500'],
            ],
            '2' => [
                ['Hourly', '400'],
                ['4 Hours', '1200'],
                ['Daily (12 Hours)', '2200'],
                ['Weekly', '3800'],
                ['Monthly', '13500'],
            ],
            '3' => [
                ['Hourly', '550'],
                ['4 Hours', '1550'],
                ['Daily (12 Hours)', '2600'],
                ['Weekly', '5300'],
                ['Monthly', '15500'],
            ],
            '4' => [
                ['Hourly', '1030'],
                ['4 Hours', '2850'],
                ['Daily (12 Hours)', '4900'],
                ['Weekly', '9800'],
                ['Monthly', '30000'],
            ],
            '5'=> [
                ['Hourly', '800'],
                ['4 Hours', '2200'],
                ['Daily (12 Hours)', '3800'],
                ['Weekly', '7500'],
                ['Monthly', '23000'],
            ],
            '0'=> [
                ['Hourly(Educational Sector)', '50'],
                ['3 Hours(Educational Sector)', '140'],
                ['6 Hours(Educational Sector)', '240'],
                ['Day Pass(Educational Sector)', '320'],
                ['Hourly', '80'],
                ['3 Hours', '200'],
                ['6 Hours', '300'],
                ['Day Pass', '400'],
            ]
        ];

        foreach($rates as $key => $value){
            foreach($value as $val){
                $saveRates = new RoomRates();
                $saveRates->room_id = $key;
                $saveRates->rp_rate_description = $val[0];
                $saveRates->rp_price = $val[1];
                $saveRates->save();
            }
        }
    }
}
