<?php

namespace App\Http\Livewire;

use App\Models\Kategori;
use Livewire\Component;
use App\Models\Usaha;
use Livewire\WithPagination;

class EkrafList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshEkrafList' => '$refresh'];
    public $kat_id, $ju_id, $search_term;

    public function render()
    {
        if ($this->kat_id != 0 || $this->ju_id != 0) {
            if ($this->kat_id == 0) {
                $ekraf = Usaha::where('nama_usaha', 'like', '%' . $this->search_term . '%')->where('jenis_usaha_id', $this->ju_id)->where('isVerified', TRUE)->orderBy('created_at', 'ASC')->paginate(12);
            } else if ($this->ju_id == 0) {
                $ekraf = Usaha::where('nama_usaha', 'like', '%' . $this->search_term . '%')->where('kategori_id', $this->kat_id)->where('isVerified', TRUE)->orderBy('created_at', 'ASC')->paginate(12);
            } else {
                $ekraf = Usaha::where('nama_usaha', 'like', '%' . $this->search_term . '%')->where('kategori_id', $this->kat_id)->where('jenis_usaha_id', $this->ju_id)->where('isVerified', TRUE)->orderBy('created_at', 'ASC')->paginate(12);
            }
        } else {
            $ekraf = Usaha::where('nama_usaha', 'like', '%' . $this->search_term . '%')->where('isVerified', TRUE)->orderBy('created_at', 'ASC')->paginate(12);
        }
        $searchTerm = $this->search_term;
        return view('livewire.ekraf-list', compact(['ekraf', 'searchTerm']));
    }
}
