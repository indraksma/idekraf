<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Illuminate\Support\Facades\Auth;
use App\Models\JenisUsaha;
use App\Models\Usaha;
use Illuminate\Support\Carbon;

class ProdukExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell
{
    protected $startDate;
    protected $endDate;
    private $rowNumber = 0;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = Carbon::parse($startDate)->startOfDay();
        $this->endDate = Carbon::parse($endDate)->endOfDay();
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if (Auth::user()->hasRole('opd')) {
            $jenisusaha = JenisUsaha::where('user_id', Auth::user()->id)->get();
            $juid = [];
            foreach ($jenisusaha as $ju) {
                array_push($juid, $ju->id);
            }
            return Produk::join('usahas', 'usahas.id', '=', 'produks.usaha_id')->where('usahas.isVerified', true)->whereIn('usahas.jenis_usaha_id', $juid)->whereBetween('produks.created_at', [$this->startDate, $this->endDate])->orderBy('produks.nama_produk', 'ASC')->get();
        } else if (Auth::user()->hasRole('user')) {
            return Produk::join('usahas', 'usahas.id', '=', 'produks.usaha_id')->where('usahas.user_id', Auth::user()->id)->where('usahas.isVerified', true)->whereBetween('produks.created_at', [$this->startDate, $this->endDate])->orderBy('produks.nama_produk', 'ASC')->get();
        } else if (Auth::user()->hasRole('admin')) {
            return Produk::whereBetween('created_at', [$this->startDate, $this->endDate])->orderBy('nama_produk', 'ASC')->get();
        }
    }

    public function headings(): array
    {
        return [
            'NO',
            'TANGGAL TERDAFTAR',
            'NAMA PRODUK',
            'NAMA USAHA',
            'TIPE PRODUK',
            'HARGA',
            'POTENSI EKSPOR',
            'DESKRIPSI',
        ];
    }

    /**
     * Map data to the export format
     */
    public function map($produk): array
    {
        $this->rowNumber++;
        $tgl = \Carbon\Carbon::parse($produk->created_at)->format('d-m-Y');
        if ($produk->ekspor == 1) {
            $ekspor = 'Ya';
        } else {
            $ekspor = 'Tidak';
        }
        return [
            $this->rowNumber,
            $tgl,
            $produk->nama_produk,
            $produk->usaha->nama_usaha,
            $produk->tipe_produk,
            $produk->harga,
            $ekspor,
            $produk->deskripsi,
        ];
    }

    /**
     * Define starting cell if you want to start from a specific cell
     */
    public function startCell(): string
    {
        return 'A1';
    }
}
