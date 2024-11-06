<?php

namespace App\Http\Livewire\Admin;

use App\Models\Usaha;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class VerUsaha extends Component
{
    use LivewireAlert;
    protected $listeners = ['refresh' => '$refresh'];
    public $usaha_id, $delete_id, $nama_usaha, $nama_kategori, $nama_jenis, $name, $no_hp, $email, $website, $link_maps, $alamat, $deskripsi, $filelogo;
    public $detailMode = false;

    public function render()
    {
        $data = Usaha::where('isVerified', 0)->get();
        return view('livewire.admin.ver-usaha', ['data' => $data])->extends('layouts.app');
    }

    public function resetForm()
    {
        $this->detailMode = false;
        $this->reset(['usaha_id', 'delete_id', 'nama_usaha', 'nama_kategori', 'nama_jenis', 'name', 'no_hp', 'email', 'website', 'link_maps', 'alamat', 'deskripsi', 'filelogo']);
    }

    public function detailUsaha($id)
    {
        $this->detailMode = true;
        $ekraf = Usaha::where('id', $id)->first();
        $this->nama_usaha = $ekraf->nama_usaha;
        $this->alamat = $ekraf->alamat;
        $this->deskripsi = $ekraf->deskripsi;
        $this->website = $ekraf->website;
        $this->link_maps = $ekraf->link_maps;
        $this->nama_kategori = $ekraf->kategori->nama_kategori;
        $this->nama_jenis = $ekraf->jenis_usaha->jenis_usaha;
        $this->filelogo = $ekraf->logo;
        $this->name = $ekraf->user->name;
        $this->no_hp = $ekraf->user->no_hp;
        $this->email = $ekraf->user->email;
    }

    public function verifikasi($id)
    {
        $ekraf = Usaha::find($id);
        $ekraf->isVerified = 1;
        $ekraf->update();

        $this->alert('success', 'Data verified successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->emit('refresh');
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
    }

    public function destroy()
    {
        $usaha = Usaha::find($this->delete_id);
        $usaha->delete();

        $this->alert('success', 'Data deleted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->emit('refresh');
        $this->dispatchBrowserEvent('closeModalDelete');
    }
}
