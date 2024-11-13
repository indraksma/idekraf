<?php

namespace App\Http\Livewire\Admin;

use App\Models\JenisUsaha;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\User;
use App\Models\Setting as ModelsSetting;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Setting extends Component
{
    use LivewireAlert, WithFileUploads;
    protected $listeners = ['refresh' => '$refresh', 'editKategori' => 'editKategori', 'editJenis' => 'editJenis', 'deleteId' => 'deleteId', 'editKriteria' => 'editKriteria'];
    public $kategoriMode, $jenisMode, $icon, $kategori, $jenis_usaha, $modalTitle, $kategori_id, $jenis_usaha_id, $delete_id;
    public $slider1, $slider2, $slider3, $tabActive;
    public $modal_max, $modal_min, $kriteria, $kriteria_id, $kriteriaMode, $user_id, $users, $deskripsi;

    public function mount()
    {
        $this->tabActive = 1;
        $this->users = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'opd');
            }
        )->get();
    }

    public function render()
    {
        $slide1 = ModelsSetting::where('name', 'slider_1')->first();
        $slide2 = ModelsSetting::where('name', 'slider_2')->first();
        $slide3 = ModelsSetting::where('name', 'slider_3')->first();
        return view('livewire.admin.setting', compact(['slide1', 'slide2', 'slide3']))->extends('layouts.app');
    }

    public function changeTab($num)
    {
        $this->tabActive = $num;
    }

    public function updatedSlider1()
    {
        $this->validate([
            'slider1' => 'required|image|max:2048',
        ]);
        $filename = 'slider1.' . $this->slider1->extension();
        if (Storage::disk('local')->exists('img/' . $filename)) {
            Storage::disk('local')->delete('img/' . $filename);
        }
        $this->slider1->storeAs('img', $filename);
        $slider = ModelsSetting::where('name', 'slider_1')->first();
        $slider->update(['value' => $filename]);
        $this->alert('success', 'Gambar berhasil diperbarui!');
    }
    public function updatedSlider2()
    {
        $this->validate([
            'slider2' => 'required|image|max:2048',
        ]);
        $filename = 'slider2.' . $this->slider2->extension();
        if (Storage::disk('local')->exists('img/' . $filename)) {
            Storage::disk('local')->delete('img/' . $filename);
        }
        $this->slider2->storeAs('img', $filename);
        $slider = ModelsSetting::where('name', 'slider_2')->first();
        $slider->update(['value' => $filename]);
        $this->alert('success', 'Gambar berhasil diperbarui!');
    }
    public function updatedSlider3()
    {
        $this->validate([
            'slider3' => 'required|image|max:2048',
        ]);
        $filename = 'slider3.' . $this->slider3->extension();
        if (Storage::disk('local')->exists('img/' . $filename)) {
            Storage::disk('local')->delete('img/' . $filename);
        }
        $this->slider3->storeAs('img', $filename);
        $slider = ModelsSetting::where('name', 'slider_3')->first();
        $slider->update(['value' => $filename]);
        $this->alert('success', 'Gambar berhasil diperbarui!');
    }

    public function addKategori()
    {
        $this->modalTitle = 'Tambah Kategori';
        $this->kategoriMode = TRUE;
        $this->reset(['jenisMode', 'kriteriaMode']);
    }

    public function addKriteria()
    {
        $this->modalTitle = 'Tambah Kriteria';
        $this->kriteriaMode = TRUE;
        $this->reset(['jenisMode', 'kategoriMode']);
    }

    public function editKriteria($id)
    {
        $this->kriteriaMode = TRUE;
        $this->modalTitle = 'Edit Data Kriteria';
        $this->kriteria_id = $id;
        $kriteria = Kriteria::find($id);
        $this->kriteria = $kriteria->name;
        $this->modal_min = $kriteria->min;
        $this->modal_max = $kriteria->max;
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
        $this->user_id = $data->user_id;
        $this->icon = $data->icon;
        $this->deskripsi = $data->deskripsi;
    }

    public function addJenis()
    {
        $this->modalTitle = 'Tambah Jenis Usaha';
        $this->jenisMode = TRUE;
        $this->reset(['kategoriMode', 'kriteriaMode']);
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
                'user_id' => $this->user_id,
                'icon' => $this->icon,
                'deskripsi' => $this->deskripsi,
            ]);
        }
        if ($this->kriteriaMode) {
            $data = Kriteria::updateOrCreate(['id' => $this->kriteria_id], [
                'name' => $this->kriteria,
                'min' => $this->modal_min,
                'max' => $this->modal_max,
            ]);
        }

        $this->alert('success', ($this->kategori_id || $this->jenis_usaha_id || $this->kriteria_id) ? 'Data updated successfully.' : 'Data created successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        if ($this->kategoriMode || $this->jenisMode) {
            $this->emit('refreshKategori');
            $this->emit('refreshJenis');
            $this->dispatchBrowserEvent('closeModalSetting');
        } else if ($this->kriteriaMode) {
            $this->emit('refreshKriteria');
            $this->dispatchBrowserEvent('closeModalKriteria');
        }
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['kategoriMode', 'jenisMode', 'icon', 'kategori', 'jenis_usaha', 'modalTitle', 'kategori_id', 'jenis_usaha_id', 'delete_id']);
        $this->reset(['kriteria', 'kriteria_id', 'modal_max', 'modal_min', 'kriteriaMode', 'deskripsi']);
        $this->user_id = '';
    }

    public function deleteId($id, $type)
    {
        $this->delete_id = $id;
        if ($type == 1) {
            $this->kategoriMode = TRUE;
        } else if ($type == 2) {
            $this->jenisMode = TRUE;
        } else if ($type == 3) {
            $this->kriteriaMode = TRUE;
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
        if ($this->kriteriaMode) {
            $data = Kriteria::find($this->delete_id);
            $data->delete();
        }

        $this->alert('success', 'Data deleted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->emit('refreshKategori');
        $this->emit('refreshJenis');
        $this->emit('refreshKriteria');
        $this->resetForm();
        $this->dispatchBrowserEvent('closeModalDelete');
    }
}
