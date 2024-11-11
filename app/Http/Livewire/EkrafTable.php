<?php

namespace App\Http\Livewire;

use App\Models\JenisUsaha;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Usaha;
use Auth;

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
        if (Auth::user()->hasRole('opd')) {
            $jenisusaha = JenisUsaha::where('user_id', Auth::user()->id)->get();
            $juid = [];
            foreach ($jenisusaha as $ju) {
                array_push($juid, $ju->id);
            }
            return Usaha::query()
                ->where('isVerified', 1)->whereIn('jenis_usaha_id', $juid);
        } else {
            return Usaha::query()
                ->where('isVerified', 1);
        }
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
