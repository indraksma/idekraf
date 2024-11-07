<?php

namespace App\Http\Livewire\Admin;

use App\Models\Produk as ModelsProduk;
use App\Models\Usaha;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Storage;

class Produk extends Component
{
    use LivewireAlert, WithFileUploads;
    protected $listeners = ['editProduk' => 'editProduk', 'deleteId' => 'deleteId', 'detailProduk' => 'detailProduk'];
    public $produk_id, $delete_id, $nama_produk, $harga, $foto_produk, $tipe_produk, $deskripsi_produk, $ekspor, $editMode, $nama_usaha, $fileProduk, $usaha_id;
    public $detailMode = false;
    public function render()
    {
        if (Auth::user()->hasRole('user')) {
            $countusaha = Usaha::where('user_id', Auth::user()->id)->count();
            if ($countusaha == 0) {
                $cekverifikasi = 0;
            } else {
                $usaha = Usaha::where('user_id', Auth::user()->id)->first();
                if ($usaha->isVerified) {
                    $cekverifikasi = 1;
                } else {
                    $cekverifikasi = 2;
                }
            }
        } else {
            $cekverifikasi = 1;
        }
        return view('livewire.admin.produk', compact('cekverifikasi'))->extends('layouts.app');
    }

    public function addProduk()
    {
        $this->reset(['editMode', 'produk_id']);
        $usaha = Usaha::where('user_id', Auth::user()->id)->first();
        $this->usaha_id = $usaha->id;
        $this->nama_usaha = $usaha->nama_usaha;
    }

    public function detailProduk($id)
    {
        $this->detailMode = TRUE;
        $produk = ModelsProduk::find($id);
        $this->usaha_id = $produk->usaha_id;
        $this->nama_usaha = $produk->usaha->nama_usaha;
        $this->nama_produk = $produk->nama_produk;
        $this->tipe_produk = $produk->tipe_produk;
        $this->fileProduk = $produk->foto;
        $this->deskripsi_produk = $produk->deskripsi;
        $this->ekspor = $produk->ekspor;
        $this->harga = $produk->harga;
    }

    public function editProduk($id)
    {
        $this->produk_id = $id;
        $this->editMode = TRUE;
        $produk = ModelsProduk::find($id);
        $this->usaha_id = $produk->usaha_id;
        $this->nama_usaha = $produk->usaha->nama_usaha;
        $this->nama_produk = $produk->nama_produk;
        $this->tipe_produk = $produk->tipe_produk;
        $this->fileProduk = $produk->foto;
        $this->deskripsi_produk = $produk->deskripsi;
        $this->ekspor = $produk->ekspor;
        $this->harga = $produk->harga;
    }

    public function resetForm()
    {
        $this->reset(['nama_produk', 'tipe_produk', 'foto_produk', 'deskripsi_produk', 'harga', 'ekspor', 'delete_id', 'editMode', 'nama_usaha', 'fileProduk', 'produk_id']);
        $this->ekspor = '';
        $this->detailMode = false;
    }

    public function store()
    {
        if ($this->foto_produk != NULL) {
            if ($this->editMode === TRUE) {
                $produk = ModelsProduk::find($this->produk_id);
                if (Storage::disk('local')->exists('img/' . $produk->foto)) {
                    Storage::disk('local')->delete('img/' . $produk->foto);
                }
            }
            $this->validate([
                'foto_produk' => 'required|image|max:1024',
            ]);
            $filename = 'p' . md5($this->foto_produk . microtime()) . '.' . $this->foto_produk->extension();
            $this->foto_produk->storeAs('img', $filename);
        } else {
            if ($this->editMode === TRUE) {
                $produk = ModelsProduk::find($this->produk_id);
                $filename = $produk->foto;
            } else {
                $filename = 'default_produk.jpg';
            }
        }
        $produks = ModelsProduk::updateOrCreate(['id' => $this->produk_id], [
            'usaha_id' => $this->usaha_id,
            'nama_produk' => $this->nama_produk,
            'tipe_produk' => $this->tipe_produk,
            'deskripsi' => $this->deskripsi_produk,
            'foto' => $filename,
            'ekspor' => $this->ekspor,
            'harga' => $this->harga,
        ]);

        $this->alert('success', 'Data updated successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->emit('refreshProdukTable');
        $this->dispatchBrowserEvent('closeModalProduk');
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
    }

    public function destroy()
    {
        $produk = ModelsProduk::find($this->delete_id);
        $produk->delete();

        $this->alert('success', 'Data deleted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->emit('refreshProdukTable');
        $this->dispatchBrowserEvent('closeModalDelete');
    }
}
