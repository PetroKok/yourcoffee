<?php

use App\Models\Locale;
use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = ['uk', 'ru'];

        foreach ($locales as $key => $locale) {
            \App\Models\Locale::create([
                'locale' => $locale,
                'name' => $locale,
                'is_primary' => $key ? 0 : 1,
            ]);
        }
        config(['translatable.locales' => Locale::all()->pluck('locale')->toArray() ?? []]);
    }
}
