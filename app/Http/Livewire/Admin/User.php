<?php

namespace App\Http\Livewire\Admin;

use App\Models\User as ModelsUser;
use Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Spatie\Permission\Models\Role;

class User extends Component
{
    use LivewireAlert;
    protected $listeners = ['deleteId' => 'deleteId', 'editUser' => 'editUser'];
    public $role_list, $role, $modalTitle, $name, $no_hp, $email, $password, $reqpassword, $user_id, $delete_id;

    public function mount()
    {
        $this->role_list = Role::all();
    }

    public function render()
    {
        return view('livewire.admin.user')->extends('layouts.app');
    }

    public function addUser()
    {
        $this->reqpassword = TRUE;
        $this->modalTitle = 'Tambah Pengguna';
    }

    public function editUser($id)
    {

        $this->modalTitle = 'Ubah Pengguna';
        $this->reqpassword = false;
        $user = ModelsUser::where('id', $id)->first();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->no_hp = $user->no_hp;
        $this->email = $user->email;
        $this->role = $user->roles()->first()->id;
    }

    public function resetForm()
    {
        $this->reset(['role', 'modalTitle', 'name', 'no_hp', 'email', 'password', 'reqpassword', 'user_id', 'delete_id']);
    }

    public function store()
    {
        $messages = [
            '*.required'                => 'This column is required',
            '*.numeric'                 => 'This column is required to be filled in with number',
            '*.string'                  => 'This column is required to be filled in with letters',
        ];

        if ($this->reqpassword) {
            $this->validate(['password' => 'required'], $messages);
        }
        if ($this->password == NULL) {
            $user = ModelsUser::updateOrCreate(['id' => $this->user_id], [
                'name'      => $this->name,
                'email'      => $this->email,
                'no_hp'      => $this->no_hp,
            ]);
        } else {
            $user = ModelsUser::updateOrCreate(['id' => $this->user_id], [
                'name'      => $this->name,
                'email'      => $this->email,
                'no_hp'      => $this->no_hp,
                'password' => Hash::make($this->password),
            ]);
        }
        $role_name = Role::where('id', $this->role)->first()->name;
        $user->syncRoles([$role_name]);

        $this->alert('success', $this->user_id ? 'User updated successfully.' : 'User created successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        $this->resetForm();
        $this->emit('refreshUserTable');
        $this->dispatchBrowserEvent('closeModalUser');
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
    }

    public function destroy()
    {
        $user = ModelsUser::find($this->delete_id);
        $user->delete();

        $this->alert('success', 'User deleted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
        $this->resetForm();
        $this->emit('refreshUserTable');
        $this->dispatchBrowserEvent('closeModalDelete');
    }
}
