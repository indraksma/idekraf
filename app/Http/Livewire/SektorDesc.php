<?php

namespace App\Http\Livewire;

use App\Models\JenisUsaha;
use Livewire\Component;

class SektorDesc extends Component
{
    public $jenis_usaha_id;

    public function render()
    {
        $sektor = JenisUsaha::where('id', $this->jenis_usaha_id)->first();
        return view('livewire.sektor-desc', compact(['sektor']));
    }
}
