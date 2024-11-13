<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Component
{
    use LivewireAlert;
    public $oldPass, $newPass, $user_id, $email, $errorOldPass, $errorMsg, $name;

    public function mount()
    {
        $user = User::find(Auth::user()->id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->errorMsg = 'Password Lama Tidak Sesuai!';
    }

    public function render()
    {
        return view('livewire.admin.change-password')->extends('layouts.app');
    }

    public function updatedOldPass()
    {
        $this->reset('errorOldPass');
        $user = User::find($this->user_id);
        if (Hash::check($this->oldPass, $user->password)) {
            $this->errorOldPass = FALSE;
        } else {
            $this->errorOldPass = TRUE;
        }
    }

    public function resetForm()
    {
        $this->reset(['oldPass', 'newPass', 'errorOldPass']);
    }

    public function store()
    {
        $user = User::find($this->user_id);
        $user->name = $this->name;
        $user->email = $this->email;
        if ($this->newPass) {
            $user->password = Hash::make($this->newPass);
        }
        $user->update();

        $this->resetForm();
        $this->alert('success', 'Data pengguna berhasil diubah', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }
}
