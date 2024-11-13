<?php

namespace App\Exports;

use App\Models\Usaha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Carbon\Carbon;

class UsahasExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell
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
        return Usaha::where('isVerified', true)->whereBetween('created_at', [$this->startDate, $this->endDate])->orderBy('nama_usaha', 'ASC')->get();
    }

    public function headings(): array
    {
        return [
            'NO',
            'NAMA EKRAF',
            'TANGGAL REGISTRASI',
            'PEMILIK',
            'SEKTOR',
            'KATEGORI',
            'NO HP',
            'EMAIL',
            'ALAMAT',
            'WEBSITE',
            'WHATSAPP',
            'INSTAGRAM',
            'TIKTOK',
            'YOUTUBE',
            'FACEBOOK',
            'TWITTER / X',
            'SHOPEE',
            'TOKOPEDIA',
        ];
    }

    /**
     * Map data to the export format
     */
    public function map($usaha): array
    {
        $this->rowNumber++;
        $tgl = \Carbon\Carbon::parse($usaha->created_at)->format('d-m-Y');
        return [
            $this->rowNumber,
            $usaha->nama_usaha,
            $tgl,
            $usaha->user->name,
            $usaha->jenis_usaha->jenis_usaha,
            $usaha->kategori->nama_kategori,
            $usaha->user->no_hp,
            $usaha->user->email,
            $usaha->alamat,
            $usaha->website,
            $usaha->whatsapp,
            $usaha->instagram,
            $usaha->tiktok,
            $usaha->youtube,
            $usaha->facebook,
            $usaha->twitter,
            $usaha->shopee,
            $usaha->tokopedia,
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
