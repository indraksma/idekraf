<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Usaha;

class EkrafTable extends DataTableComponent
{
    protected $model = Usaha::class;
    protected $listeners = ['refreshUsahaTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects('usahas.id');
    }

    public function builder(): Builder
    {
        return Usaha::query()
            ->where('isVerified', 1);
    }

    public function columns(): array
    {
        return [
            Column::make("Nama Ekraf", "nama_usaha")
                ->searchable()
                ->sortable(),
            Column::make('Nama Pemilik', 'user.name')
                ->searchable()
                ->sortable(),
            Column::make('Jenis Usaha', 'jenis_usaha.jenis_usaha')
                ->searchable()
                ->sortable(),
            Column::make('Nama Kategori', 'kategori.nama_kategori')
                ->searchable()
                ->sortable(),
            Column::make('Aksi')
                ->label(function ($row, Column $column) {
                    return view('components.action-buttons', ['id' => $row->id]);
                }),
        ];
    }
}
