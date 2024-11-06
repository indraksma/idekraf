<?php

namespace App\Http\Livewire\Admin;

use App\Models\JenisUsaha as ModelsJenisUsaha;
use Livewire\Component;
use Livewire\WithPagination;

class JenisUsaha extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshJenis' => '$refresh'];

    public function render()
    {
        return view('livewire.admin.jenis-usaha', [
            'ju' => ModelsJenisUsaha::paginate(10),
        ]);
    }
}
