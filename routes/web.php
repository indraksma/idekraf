<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', App\Http\Livewire\Home::class);
Route::get('home', App\Http\Livewire\Home::class)->name('home');

Route::middleware(['auth', 'role:admin|user'])->group(function () {
    Route::get('admin', App\Http\Livewire\Admin\Dashboard::class)->name('admin');
    Route::get('admin/usaha', App\Http\Livewire\Admin\Usaha::class)->name('admin.usaha');
    Route::get('admin/produk', App\Http\Livewire\Admin\Produk::class)->name('admin.produk');
    Route::get('admin/changepass', App\Http\Livewire\Admin\ChangePassword::class)->name('admin.chpass');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/user', App\Http\Livewire\Admin\User::class)->name('admin.user');
    Route::get('admin/verusaha', App\Http\Livewire\Admin\VerUsaha::class)->name('admin.verusaha');
    Route::get('admin/setting', App\Http\Livewire\Admin\Setting::class)->name('admin.setting');
});
