<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kategori as ModelsKategori;
use Livewire\Component;
// use Livewire\WithPagination;

class Kategori extends Component
{
    // use WithPagination;
    // protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshKategori' => '$refresh'];

    public function render()
    {
        return view('livewire.admin.kategori', [
            'kategoris' => ModelsKategori::all(),
        ]);
    }
}
