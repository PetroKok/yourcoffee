<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'ru' => [
                    'name' => 'Стебник'
                ],
                'uk' => [
                    'name' => 'Стебник'
                ]
            ],
            [
                'ru' => [
                    'name' => 'Трускавець'
                ],
                'uk' => [
                    'name' => 'Трускавець'
                ]
            ],
            [
                'ru' => [
                    'name' => 'Дрогобич'
                ],
                'uk' => [
                    'name' => 'Дрогобич'
                ]
            ],
            [
                'ru' => [
                    'name' => 'Борислав'
                ],
                'uk' => [
                    'name' => 'Борислав'
                ]
            ],
            [
                'ru' => [
                    'name' => 'Доброгостів'
                ],
                'uk' => [
                    'name' => 'Доброгостів'
                ]
            ],
        ];

        foreach ($cities as $city){
            \App\Models\City::create($city);
        }

    }
}
