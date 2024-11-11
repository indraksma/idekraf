<?php

namespace Database\Seeders;

use App\Models\JenisUsaha;
use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roleadmin = Role::create(['name' => 'admin']);
        $roleuser = Role::create(['name' => 'user']);
        User::create([
            'name'      => 'Admin',
            'email'     => 'admin@mail.com',
            'no_hp'     => '081234567890',
            'password'  => Hash::make('admin123'),
        ])->assignRole($roleadmin);
        User::create([
            'name'      => 'User',
            'email'     => 'user@mail.com',
            'no_hp'     => '081234567891',
            'password'  => Hash::make('user123'),
        ])->assignRole($roleuser);
        JenisUsaha::create(
            [
                'jenis_usaha'   => 'Kuliner',
                'icon'          => 'fas fa-utensils'
            ],
            [
                'jenis_usaha'   => 'Fashion',
                'icon'          => 'fas fa-tshirt'
            ],
            [
                'jenis_usaha'   => 'Penerbitan',
                'icon'          => 'fas fa-book'
            ],
            [
                'jenis_usaha'   => 'Kriya',
                'icon'          => 'fas fa-paper-plane'
            ],
            [
                'jenis_usaha'   => 'Televisi & Radio',
                'icon'          => 'fas fa-tv'
            ],
            [
                'jenis_usaha'   => 'Arsitektur',
                'icon'          => 'fas fa-building'
            ]
        );
        Kategori::create(
            [
                'nama_kategori' => 'Pelaku Bisnis',
                'icon' => 'fas fa-user'
            ],
            [
                'nama_kategori' => 'Komunitas Bisnis',
                'icon' => 'fas fa-users'
            ],
            [
                'nama_kategori' => 'Usaha / Bisnis',
                'icon' => 'fas fa-store-alt'
            ],
            [
                'nama_kategori' => 'Lembaga Pendidikan',
                'icon' => 'fas fa-school'
            ]
        );
        $this->call([
            SettingSeeder::class,
            OpdSeeder::class,
            UmkmSeeder::class,
        ]);
    }
}
