<?php

namespace App\Http\Livewire\Admin;

use App\Models\JenisUsaha;
use App\Models\Kategori;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Setting extends Component
{
    use LivewireAlert;
    protected $listeners = ['refresh' => '$refresh', 'editKategori' => 'editKategori', 'editJenis' => 'editJenis', 'deleteId' => 'deleteId'];
    public $kategoriMode, $jenisMode, $icon, $kategori, $jenis_usaha, $modalTitle, $kategori_id, $jenis_usaha_id, $delete_id;

    public function render()
    {
        return view('livewire.admin.setting')->extends('layouts.app');
    }

    public function addKategori()
    {
        $this->modalTitle = 'Tambah Kategori';
        $this->kategoriMode = TRUE;
        $this->reset('jenisMode');
    }

    public function editKategori($id)
    {
        $this->modalTitle = 'Ubah Data Kategori';
        $this->kategoriMode = TRUE;
        $this->reset('jenisMode');
        $data = Kategori::find($id);
        $this->kategori_id = $data->id;
        $this->kategori = $data->nama_kategori;
        $this->icon = $data->icon;
    }

    public function editJenis($id)
    {
        $this->modalTitle = 'Ubah Data Jenis Usaha';
        $this->jenisMode = TRUE;
        $this->reset('kategoriMode');
        $data = JenisUsaha::find($id);
        $this->jenis_usaha_id = $data->id;
        $this->jenis_usaha = $data->jenis_usaha;
        $this->icon = $data->icon;
    }

    public function addJenis()
    {
        $this->modalTitle = 'Tambah Jenis Usaha';
        $this->jenisMode = TRUE;
        $this->reset('kategoriMode');
    }

    public function store()
    {
        if ($this->kategoriMode) {
            $data = Kategori::updateOrCreate(['id' => $this->kategori_id], [
                'nama_kategori' => $this->kategori,
                'icon' => $this->icon,
            ]);
        }
        if ($this->jenisMode) {
            $data = JenisUsaha::updateOrCreate(['id' => $this->jenis_usaha_id], [
                'jenis_usaha' => $this->jenis_usaha,
                'icon' => $this->icon,
            ]);
        }

        $this->alert('success', ($this->kategori_id || $this->jenis_usaha_id) ? 'Data updated successfully.' : 'Data created successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        $this->resetForm();
        $this->emit('refreshKategori');
        $this->emit('refreshJenis');
        $this->dispatchBrowserEvent('closeModalSetting');
    }

    public function resetForm()
    {
        $this->reset(['kategoriMode', 'jenisMode', 'icon', 'kategori', 'jenis_usaha', 'modalTitle', 'kategori_id', 'jenis_usaha_id', 'delete_id']);
    }

    public function deleteId($id, $type)
    {
        $this->delete_id = $id;
        if ($type == 1) {
            $this->kategoriMode = TRUE;
        } else if ($type == 2) {
            $this->jenisMode = TRUE;
        }
    }

    public function destroy()
    {
        if ($this->kategoriMode) {
            $data = Kategori::find($this->delete_id);
            $data->delete();
        }
        if ($this->jenisMode) {
            $data = JenisUsaha::find($this->delete_id);
            $data->delete();
        }

        $this->alert('success', 'Data deleted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->emit('refreshKategori');
        $this->emit('refreshJenis');
        $this->dispatchBrowserEvent('closeModalDelete');
    }
}
