<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'uk' => [
                    'title' => 'Бургери'
                ],
                'ru' => [
                    'title' => 'Бургерьі'
                ],
                'position' => 1,
                'image' => 'burger.jpg'
            ],
            [
                'uk' => [
                    'title' => 'Курчата'
                ],
                'ru' => [
                    'title' => 'Курьі'
                ],
                'position' => 1,
                'image' => 'chicken.jpg'
            ],
            [
                'uk' => [
                    'title' => 'Роли'
                ],
                'ru' => [
                    'title' => 'Рольі'
                ],
                'position' => 1,
                'image' => 'rolls.jpg'
            ],
            [
                'uk' => [
                    'title' => 'Снеки'
                ],
                'ru' => [
                    'title' => 'Снеки'
                ],
                'position' => 1,
                'image' => 'snaks.jpg'
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
