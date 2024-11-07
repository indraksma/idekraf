<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'slider_1',
            'value' => 'idekraf-banner.jpg',
        ]);
        Setting::create([
            'name' => 'slider_2',
            'value' => 'idekraf-banner-2.jpg',
        ]);
        Setting::create([
            'name' => 'slider_3',
            'value' => NULL,
        ]);
    }
}
