<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Str;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;
    protected $listeners = ['refreshUserTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects('users.id');
    }

    public function query()
    {
        return User::with('roles'); // Eager load roles to avoid N+1 issues
    }

    public function columns(): array
    {
        return [
            Column::make("Nama", "name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("No HP", "no_hp")
                ->sortable()
                ->searchable(),
            Column::make('Role')
                ->label(
                    function ($row, Column $column) {
                        $rolename = $row->roles->pluck('name')->first();
                        return Str::ucfirst($rolename);
                    }
                ),
            Column::make('Action')
                ->label(
                    function ($row, Column $column) {
                        $edit = '<a class="btn btn-sm btn-warning mb-1" wire:click="$emit(' . "'editUser', " . $row->id . ')" data-toggle="modal" data-target="#modal-lg">Ubah</a>';
                        $delete = '<a class="btn btn-sm btn-danger text-white mb-1" wire:click="$emit(' . "'deleteId', " . $row->id . ')" data-toggle="modal" data-target="#deleteModal">Hapus</a>';
                        return $edit . '&nbsp;' . $delete;
                    }
                )->html(),
        ];
    }
}
