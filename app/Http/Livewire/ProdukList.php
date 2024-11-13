<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Produk;

class ProdukList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshProdukList' => '$refresh'];
    public $kat_id, $ju_id, $search_term;

    public function render()
    {
        if ($this->kat_id != 0 || $this->ju_id != 0) {
            if ($this->kat_id == 0) {
                $produk = Produk::select('produks.id', 'usahas.nama_usaha', 'produks.nama_produk', 'produks.harga', 'produks.foto')->join('usahas', 'produks.usaha_id', '=', 'usahas.id')->where('nama_produk', 'like', '%' . $this->search_term . '%')->where('jenis_usaha_id', $this->ju_id)->where('isVerified', TRUE)->orderBy('produks.created_at', 'ASC')->paginate(15);
            } else if ($this->ju_id == 0) {
                $produk = Produk::select('produks.id', 'usahas.nama_usaha', 'produks.nama_produk', 'produks.harga', 'produks.foto')->join('usahas', 'produks.usaha_id', '=', 'usahas.id')->where('nama_produk', 'like', '%' . $this->search_term . '%')->where('kategori_id', $this->kat_id)->where('isVerified', TRUE)->orderBy('produks.created_at', 'ASC')->paginate(15);
            } else {
                $produk = Produk::select('produks.id', 'usahas.nama_usaha', 'produks.nama_produk', 'produks.harga', 'produks.foto')->join('usahas', 'produks.usaha_id', '=', 'usahas.id')->where('nama_produk', 'like', '%' . $this->search_term . '%')->where('kategori_id', $this->kat_id)->where('jenis_usaha_id', $this->ju_id)->where('isVerified', TRUE)->orderBy('produks.created_at', 'ASC')->paginate(15);
            }
        } else {
            $produk = Produk::select('produks.id', 'usahas.nama_usaha', 'produks.nama_produk', 'produks.harga', 'produks.foto')->join('usahas', 'produks.usaha_id', '=', 'usahas.id')->where('produks.nama_produk', 'like', '%' . $this->search_term . '%')->where('usahas.isVerified', TRUE)->orderBy('produks.created_at', 'ASC')->paginate(15);
        }
        $searchTerm = $this->search_term;
        return view('livewire.produk-list', compact(['produk', 'searchTerm']));
    }
}
