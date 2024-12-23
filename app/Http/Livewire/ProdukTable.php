<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Produk;
use App\Models\Usaha;
use App\Models\JenisUsaha;
use Illuminate\Support\Facades\Auth;

class ProdukTable extends DataTableComponent
{
    protected $model = Produk::class;
    protected $listeners = ['refreshProdukTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setAdditionalSelects('produks.id');
    }

    public function builder(): Builder
    {
        if (Auth::user()->hasRole('user')) {
            $usaha = Usaha::where('user_id', Auth::user()->id)->first();
            return Produk::query()
                ->where('usaha_id', $usaha->id);
        } else if (Auth::user()->hasRole('opd')) {
            $jenisusaha = JenisUsaha::where('user_id', Auth::user()->id)->get();
            $juid = [];
            foreach ($jenisusaha as $ju) {
                array_push($juid, $ju->id);
            }
            $usid = [];
            $usaha = Usaha::whereIn('jenis_usaha_id', $juid)->get();
            foreach ($usaha as $us) {
                array_push($usid, $us->id);
            }
            return Produk::query()->whereIn('usaha_id', $usid);
        } else {
            return Produk::query();
        }
    }

    public function columns(): array
    {
        return [
            Column::make("Nama Produk", "nama_produk")
                ->searchable()
                ->sortable(),
            Column::make("Harga", "harga")
                ->searchable()
                ->sortable(),
            Column::make("Nama Usaha", "usaha.nama_usaha")
                ->searchable()
                ->sortable(),
            Column::make("Tipe", "tipe_produk")
                ->searchable()
                ->sortable(),
            Column::make("Potensi Ekspor", "ekspor")
                ->sortable()
                ->format(function ($value) {
                    if ($value == 0) {
                        return 'Tidak';
                    } elseif ($value == 1) {
                        return 'Ya';
                    }
                }),
            Column::make('Aksi')
                ->label(function ($row, Column $column) {
                    return view('components.produk-actions', ['id' => $row->id]);
                }),
        ];
    }
}
