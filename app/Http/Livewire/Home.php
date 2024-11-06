<?php

namespace App\Http\Livewire;

use App\Models\JenisUsaha;
use App\Models\Kategori;
use App\Models\Produk;
use Livewire\Component;
use App\Models\Usaha;

class Home extends Component
{
    public function render()
    {
        $kategoris = Kategori::all();
        $total_usaha = Usaha::where('isVerified', true)->count();
        $total_produk = Produk::all()->count();
        $jenis_usaha = JenisUsaha::all()->count();
        $jenis_usahas = JenisUsaha::all();
        $direktori_baru = Usaha::where('isVerified', true)->orderBy('created_at', 'DESC')->limit(4)->get();
        return view('livewire.home', compact(['kategoris', 'total_usaha', 'total_produk', 'jenis_usaha', 'jenis_usahas', 'direktori_baru']))->extends('layouts.home');
    }
}
