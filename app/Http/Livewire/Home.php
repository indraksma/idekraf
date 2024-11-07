<?php

namespace App\Http\Livewire;

use App\Models\JenisUsaha;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Usaha;

class Home extends Component
{
    public function render()
    {
        $slide1 = Setting::where('name', 'slider_1')->first();
        $slide2 = Setting::where('name', 'slider_2')->first();
        $slide3 = Setting::where('name', 'slider_3')->first();
        $kategoris = Kategori::all();
        $total_usaha = Usaha::where('isVerified', true)->count();
        $total_produk = Produk::all()->count();
        $jenis_usaha = JenisUsaha::all()->count();
        $jenis_usahas = JenisUsaha::all();
        $direktori_baru = Usaha::where('isVerified', true)->orderBy('created_at', 'DESC')->limit(4)->get();
        return view('livewire.home', compact(['kategoris', 'total_usaha', 'total_produk', 'jenis_usaha', 'jenis_usahas', 'direktori_baru', 'slide1', 'slide2', 'slide3']))->extends('layouts.home');
    }
}
