<?php

namespace Database\Seeders;

use App\Models\Administrator;
use App\Models\Setting;
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
         Administrator::factory(1)->create();

         Setting::query()->insert([
             ['key' =>'guestbook', 'value' => \json_encode(['content' => '','can_comment' => true])],
             ['key' =>'site', 'value' => \json_encode([])],
         ]);
    }
}
