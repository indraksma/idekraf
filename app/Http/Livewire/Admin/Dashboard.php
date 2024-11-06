<?php

namespace App\Http\Livewire\Admin;

use App\Models\Produk;
use App\Models\Usaha;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Dashboard extends Component
{
    use LivewireAlert;
    public $produk, $ekraf, $user;

    public function mount()
    {
        $this->produk = Produk::all()->count();
        $this->ekraf = Usaha::where('isVerified', true)->count();
        $this->user = User::all()->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard')->extends('layouts.app');
    }
}
