<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use App\Models\Usaha;
use Livewire\Component;
use Livewire\WithPagination;

class ProdukDetail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $produk_id;

    public function mount($id)
    {
        $this->produk_id = $id;
    }

    public function render()
    {
        $produk = Produk::where('id', $this->produk_id)->first();
        $ekraf = Usaha::where('id', $produk->usaha_id)->first();
        return view('livewire.produk-detail', compact(['ekraf', 'produk']))->extends('layouts.home');
    }
}
