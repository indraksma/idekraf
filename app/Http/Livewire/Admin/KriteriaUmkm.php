<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kriteria;
use Livewire\Component;

class KriteriaUmkm extends Component
{
    protected $listeners = ['refreshKriteria' => '$refresh'];

    public function render()
    {
        $kriterias = Kriteria::all();
        return view('livewire.admin.kriteria-umkm', compact('kriterias'));
    }
}
