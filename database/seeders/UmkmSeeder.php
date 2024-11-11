<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kriteria::create([
            'name' => 'Mikro',
            'min' => '0',
            'max' => '1000000000'
        ]);
        Kriteria::create([
            'name' => 'Kecil',
            'min' => '1000000001',
            'max' => '5000000000'
        ]);
        Kriteria::create([
            'name' => 'Menengah',
            'min' => '5000000001',
            'max' => '10000000000'
        ]);
    }
}
