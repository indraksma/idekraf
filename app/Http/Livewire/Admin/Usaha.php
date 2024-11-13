<?php

namespace App\Http\Livewire\Admin;

use App\Imports\UsahaImport;
use App\Models\JenisUsaha;
use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\Produk;
use App\Models\Usaha as ModelsUsaha;
use App\Models\User;
use Excel;
use Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Storage;

class Usaha extends Component
{
    use LivewireAlert, WithFileUploads;
    protected $listeners = ['editUsaha' => 'editEkraf', 'detailUsaha' => 'detailEkraf', 'deleteId' => 'deleteId', 'addProduk' => 'addProduk'];
    public $nama_produk, $harga, $foto_produk, $tipe_produk, $deskripsi_produk, $ekspor;
    public $usaha_id, $nama_usaha, $kategori, $kategori_id, $jenis_usaha, $jenis_usaha_id, $user, $modalTitle, $deskripsi, $alamat, $website, $link_maps, $logo, $name, $email, $no_hp, $password, $editMode, $delete_id, $filelogo, $nama_kategori, $nama_jenis;
    public $instagram, $tiktok, $facebook, $twitter, $shopee, $tokopedia, $kriteria_id, $kriteria, $jumlah_pekerja, $whatsapp, $youtube, $file_import, $startDate, $endDate;
    public $detailMode = false;
    public function mount()
    {
        $this->kategori = Kategori::all();
        $this->jenis_usaha = JenisUsaha::orderBy('jenis_usaha', 'ASC')->get();
        $this->kriteria = Kriteria::all();

        if (Auth::user()->hasRole('user')) {
            $countusaha = ModelsUsaha::where('user_id', Auth::user()->id)->count();
            if ($countusaha == 0) {
                $this->editMode = FALSE;
            } else {
                $this->editMode = TRUE;
                $usaha = ModelsUsaha::where('user_id', Auth::user()->id)->first();
                $this->usaha_id = $usaha->id;
                $this->nama_usaha = $usaha->nama_usaha;
                $this->alamat = $usaha->alamat;
                $this->deskripsi = $usaha->deskripsi;
                $this->website = $usaha->website;
                $this->link_maps = $usaha->link_maps;
                $this->kategori_id = $usaha->kategori_id;
                $this->jenis_usaha_id = $usaha->jenis_usaha_id;
                $this->filelogo = $usaha->logo;
                $this->instagram = $usaha->instagram;
                $this->tiktok = $usaha->tiktok;
                $this->facebook = $usaha->facebook;
                $this->twitter = $usaha->twitter;
                $this->shopee = $usaha->shopee;
                $this->tokopedia = $usaha->tokopedia;
                $this->jumlah_pekerja = $usaha->jumlah_pekerja;
                $this->kriteria_id = $usaha->kriteria_id;
                $this->whatsapp = $usaha->whatsapp;
                $this->youtube = $usaha->youtube;
            }
        }
    }

    public function render()
    {
        if (Auth::user()->hasRole('user')) {
            $countusaha = ModelsUsaha::where('user_id', Auth::user()->id)->count();
            if ($countusaha == 0) {
                $cekverifikasi = 0;
            } else {
                $usaha = ModelsUsaha::where('user_id', Auth::user()->id)->first();
                if ($usaha->isVerified) {
                    $cekverifikasi = 1;
                } else {
                    $cekverifikasi = 2;
                }
            }
        } else {
            $cekverifikasi = 1;
        }
        return view('livewire.admin.usaha', compact('cekverifikasi'))->extends('layouts.app');
    }

    public function addEkraf()
    {
        $this->editMode = FALSE;
        $this->modalTitle = "Tambah Data Ekraf";
    }

    public function addProduk($id)
    {
        $ekraf = ModelsUsaha::where('id', $id)->first();
        $this->nama_usaha = $ekraf->nama_usaha;
        $this->usaha_id = $id;
    }

    public function editEkraf($id)
    {
        $this->usaha_id = $id;
        $this->editMode = TRUE;
        $this->modalTitle = "Ubah Data Ekraf";
        $ekraf = ModelsUsaha::where('id', $id)->first();
        $this->nama_usaha = $ekraf->nama_usaha;
        $this->alamat = $ekraf->alamat;
        $this->deskripsi = $ekraf->deskripsi;
        $this->website = $ekraf->website;
        $this->instagram = $ekraf->instagram;
        $this->tiktok = $ekraf->tiktok;
        $this->facebook = $ekraf->facebook;
        $this->twitter = $ekraf->twitter;
        $this->shopee = $ekraf->shopee;
        $this->tokopedia = $ekraf->tokopedia;
        $this->jumlah_pekerja = $ekraf->jumlah_pekerja;
        $this->kriteria_id = $ekraf->kriteria_id;
        $this->link_maps = $ekraf->link_maps;
        $this->kategori_id = $ekraf->kategori_id;
        $this->jenis_usaha_id = $ekraf->jenis_usaha_id;
        $this->filelogo = $ekraf->logo;
        $this->whatsapp = $ekraf->whatsapp;
        $this->youtube = $ekraf->youtube;
    }

    public function detailEkraf($id)
    {
        $this->detailMode = true;
        $ekraf = ModelsUsaha::where('id', $id)->first();
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
        $this->instagram = $ekraf->instagram;
        $this->tiktok = $ekraf->tiktok;
        $this->facebook = $ekraf->facebook;
        $this->twitter = $ekraf->twitter;
        $this->shopee = $ekraf->shopee;
        $this->tokopedia = $ekraf->tokopedia;
        $this->jumlah_pekerja = $ekraf->jumlah_pekerja;
        $this->kriteria_id = $ekraf->kriteria_id;
        $this->whatsapp = $ekraf->whatsapp;
        $this->youtube = $ekraf->youtube;
    }

    public function updatedLogo()
    {
        $this->resetErrorBag();
        $this->validate([
            'logo' => 'image|max:1024',
        ]);
    }

    public function resetForm()
    {
        $this->reset(['nama_produk', 'tipe_produk', 'foto_produk', 'deskripsi_produk', 'harga', 'ekspor']);
        $this->reset(['nama_kategori', 'nama_jenis', 'usaha_id', 'nama_usaha', 'kategori_id', 'jenis_usaha_id', 'user', 'modalTitle', 'deskripsi', 'alamat', 'website', 'link_maps', 'logo', 'filelogo', 'name', 'email', 'no_hp', 'password', 'editMode', 'delete_id']);
        $this->reset(['instagram', 'facebook', 'twitter', 'tiktok', 'shopee', 'tokopedia', 'jumlah_pekerja', 'whatsapp', 'youtube', 'file_import', 'startDate', 'endDate']);
        $this->kriteria_id = '';
        $this->kategori_id = '';
        $this->jenis_usaha_id = '';
        $this->detailMode = false;
    }

    public function store()
    {
        if ($this->editMode === FALSE) {
            $this->validate([
                'logo' => 'required|image|max:1024',
            ]);
            $filename = md5($this->logo . microtime()) . '.' . $this->logo->extension();
            $this->logo->storeAs('img', $filename);
            if (Auth::user()->hasRole('admin')) {
                $user = User::create([
                    'name'      => $this->name,
                    'email'      => $this->email,
                    'no_hp'      => $this->no_hp,
                    'password' => Hash::make($this->password),
                ])->assignRole('user');
                $userid = $user->id;
                $verify = 1;
            } else {
                $userid = Auth::user()->id;
                $verify = 0;
            }
        } else {
            $ekraf = ModelsUsaha::where('id', $this->usaha_id)->first();
            $verify = $ekraf->isVerified;
            $userid = $ekraf->user_id;

            if ($this->logo != NULL) {
                $this->validate([
                    'logo' => 'required|image|max:1024',
                ]);
                $filename = md5($this->logo . microtime()) . '.' . $this->logo->extension();
                $this->logo->storeAs('img', $filename);
                if (Storage::disk('local')->exists('img/' . $ekraf->logo)) {
                    $this->alert('success', 'Ada filenya lho');
                    Storage::disk('local')->delete('img/' . $ekraf->logo);
                }
            } else {
                $filename = $ekraf->logo;
            }
        }
        $ekraf = ModelsUsaha::updateOrCreate(['id' => $this->usaha_id], [
            'jenis_usaha_id' => $this->jenis_usaha_id,
            'kategori_id' => $this->kategori_id,
            'user_id' => $userid,
            'nama_usaha' => $this->nama_usaha,
            'alamat' => $this->alamat,
            'deskripsi' => $this->deskripsi,
            'website' => $this->website,
            'jumlah_pekerja' => $this->jumlah_pekerja,
            'kriteria_id' => $this->kriteria_id,
            'instagram' => $this->instagram,
            'tiktok' => $this->tiktok,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'shopee' => $this->shopee,
            'tokopedia' => $this->tokopedia,
            'link_maps' => $this->link_maps,
            'youtube' => $this->youtube,
            'whatsapp' => $this->whatsapp,
            'logo' => $filename,
            'isVerified' => $verify,
        ]);

        $this->alert('success', $this->usaha_id ? 'Data updated successfully.' : 'Data created successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        if (Auth::user()->hasRole('admin')) {
            $this->resetForm();
        } else {
            $this->resetForm();
            $this->remountUsaha();
        }
        $this->emit('refreshUsahaTable');
        $this->dispatchBrowserEvent('closeModalEkraf');
    }

    public function remountUsaha()
    {
        $countusaha = ModelsUsaha::where('user_id', Auth::user()->id)->count();
        if ($countusaha == 0) {
            $this->editMode = FALSE;
        } else {
            $this->editMode = TRUE;
            $usaha = ModelsUsaha::where('user_id', Auth::user()->id)->first();
            $this->usaha_id = $usaha->id;
            $this->nama_usaha = $usaha->nama_usaha;
            $this->alamat = $usaha->alamat;
            $this->deskripsi = $usaha->deskripsi;
            $this->website = $usaha->website;
            $this->link_maps = $usaha->link_maps;
            $this->kategori_id = $usaha->kategori_id;
            $this->jenis_usaha_id = $usaha->jenis_usaha_id;
            $this->filelogo = $usaha->logo;
            $this->instagram = $usaha->instagram;
            $this->tiktok = $usaha->tiktok;
            $this->facebook = $usaha->facebook;
            $this->twitter = $usaha->twitter;
            $this->shopee = $usaha->shopee;
            $this->tokopedia = $usaha->tokopedia;
            $this->jumlah_pekerja = $usaha->jumlah_pekerja;
            $this->kriteria_id = $usaha->kriteria_id;
            $this->whatsapp = $usaha->whatsapp;
            $this->youtube = $usaha->youtube;
        }
    }

    public function storeProduk()
    {
        if ($this->foto_produk != NULL) {
            $this->validate([
                'foto_produk' => 'required|image|max:1024',
            ]);
            $filename = 'p' . md5($this->foto_produk . microtime()) . '.' . $this->foto_produk->extension();
            $this->foto_produk->storeAs('img', $filename);
        } else {
            $filename = 'default_produk.jpg';
        }
        $produk = Produk::create([
            'usaha_id' => $this->usaha_id,
            'nama_produk' => $this->nama_produk,
            'tipe_produk' => $this->tipe_produk,
            'deskripsi' => $this->deskripsi_produk,
            'foto' => $filename,
            'ekspor' => $this->ekspor,
            'harga' => $this->harga,
        ]);

        $this->alert('success', 'Data created successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->dispatchBrowserEvent('closeModalProduk');
    }

    public function import()
    {
        // dd($this->file_import);
        $file_path = $this->file_import->store('files', 'public');
        // dd($file_path);
        Excel::import(new UsahaImport($this->kriteria_id, $this->jenis_usaha_id, $this->kategori_id), storage_path('/app/public/' . $file_path));
        Storage::disk('public')->delete($file_path);

        $this->resetForm();
        $this->emit('closeModalImport');
        $this->alert('success', 'Data berhasil diimport!', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
    }

    public function destroy()
    {
        $usaha = ModelsUsaha::find($this->delete_id);
        $usaha->delete();

        $this->alert('success', 'Data deleted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->emit('refreshUsahaTable');
        $this->dispatchBrowserEvent('closeModalDelete');
    }
}
