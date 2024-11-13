<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Usaha;
use App\Models\JenisUsaha;
use App\Models\Kategori;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Produk extends Component
{
    use LivewireAlert;
    public $radio_kategori, $radio_jenis, $semua_usaha, $search;
    public $jenis_usaha_id, $kategori_id;

    protected $queryString = ['jenis_usaha_id', 'kategori_id'];

    public function mount()
    {
        if ($this->jenis_usaha_id) {
            $this->radio_jenis = $this->jenis_usaha_id;
        } else {
            $this->radio_jenis = 0;
        }
        if ($this->kategori_id) {
            $this->radio_kategori = $this->kategori_id;
        } else {
            $this->radio_kategori = 0;
        }
        $this->semua_usaha = Usaha::all()->count();
    }

    public function render()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        $jenis_usahas = JenisUsaha::orderBy('jenis_usaha')->get();
        return view('livewire.produk', compact(['kategoris', 'jenis_usahas']))->extends('layouts.home');
    }

    public function updatedRadioJenis($val)
    {
        $this->jenis_usaha_id = $val;
    }

    public function updatedRadioKategori($val)
    {
        $this->kategori_id = $val;
    }
}
