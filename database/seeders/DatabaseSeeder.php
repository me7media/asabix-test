<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

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
