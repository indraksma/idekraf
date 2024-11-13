<?php

namespace App\Http\Livewire;

use App\Models\Produk;
use App\Models\Usaha;
use Livewire\Component;
use Livewire\WithPagination;

class EkrafDetail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $usaha_id;

    public function mount($id)
    {
        $this->usaha_id = $id;
    }

    public function render()
    {
        $ekraf = Usaha::where('id', $this->usaha_id)->first();
        $produk = Produk::where('usaha_id', $ekraf->id)->paginate(6);
        return view('livewire.ekraf-detail', compact(['ekraf', 'produk']))->extends('layouts.home');
    }
}
