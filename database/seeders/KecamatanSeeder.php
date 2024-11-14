<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kecamatan::create([
            'kecamatan' => 'Banjarmangu'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Banjarnegara'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Batur'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Bawang'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Kalibening'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Karangkobar'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Madukara'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Mandiraja'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Pagedongan'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Pagentan'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Pandanarum'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Pejawaran'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Punggelan'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Purwanegara'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Purwareja Klampok'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Rakit'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Sigaluh'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Susukan'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Wanadadi'
        ]);
        Kecamatan::create([
            'kecamatan' => 'Wanayasa'
        ]);
    }
}
