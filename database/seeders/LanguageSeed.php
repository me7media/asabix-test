<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Language::create([
            'locale' => 'UA',
            'prefix' => 'ua',
        ]);
        \App\Models\Language::create([
            'locale' => 'RU',
            'prefix' => 'ru',
        ]);
        \App\Models\Language::create([
            'locale' => 'EN',
            'prefix' => 'en',
        ]);
    }
}
