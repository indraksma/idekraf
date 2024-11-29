<?php

namespace App\Exports;

use App\Models\JenisUsaha;
use App\Models\Usaha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::user()->hasRole('opd')) {
            $jenisusaha = JenisUsaha::where('user_id', Auth::user()->id)->get();
            $juid = [];
            foreach ($jenisusaha as $ju) {
                array_push($juid, $ju->id);
            }
            return Usaha::where('isVerified', true)->whereIn('jenis_usaha_id', $juid)->whereBetween('created_at', [$this->startDate, $this->endDate])->orderBy('nama_usaha', 'ASC')->get();
        } else {
            return Usaha::where('isVerified', true)->whereBetween('created_at', [$this->startDate, $this->endDate])->orderBy('nama_usaha', 'ASC')->get();
        }
    }

    public function headings(): array
    {
        return [
            'NO',
            'NO REGISTER',
            'NAMA EKRAF',
            'TANGGAL REGISTRASI',
            'PEMILIK',
            'SEKTOR',
            'KATEGORI',
            'NO HP',
            'EMAIL',
            'NIB',
            'ALAMAT',
            'KECAMATAN',
            'JUMLAH PEKERJA',
            'MODAL USAHA',
            'OMZET BULANAN',
            'KLASIFIKASI UKM',
            'WEBSITE',
            'WHATSAPP',
            'INSTAGRAM',
            'TIKTOK',
            'YOUTUBE',
            'FACEBOOK',
            'TWITTER / X',
            'SHOPEE',
            'TOKOPEDIA',
            'DESKRIPSI',
            'KETERANGAN',
        ];
    }

    /**
     * Map data to the export format
     */
    public function map($usaha): array
    {
        $this->rowNumber++;
        $tgl = \Carbon\Carbon::parse($usaha->created_at)->format('d-m-Y');
        $tglreg = \Carbon\Carbon::parse($usaha->created_at)->format('Ymd');
        return [
            $this->rowNumber,
            $tglreg . '/' . $usaha->jenis_usaha_id . $usaha->kategori_id . '/' . $usaha->id,
            $usaha->nama_usaha,
            $tgl,
            $usaha->user->name,
            $usaha->jenis_usaha->jenis_usaha,
            $usaha->kategori->nama_kategori,
            $usaha->user->no_hp,
            $usaha->user->email,
            $usaha->nib,
            $usaha->alamat,
            $usaha->kecamatan->kecamatan,
            $usaha->jumlah_pekerja,
            $usaha->modal_usaha,
            $usaha->omzet,
            $usaha->kriteria->name,
            $usaha->website,
            $usaha->whatsapp,
            $usaha->instagram,
            $usaha->tiktok,
            $usaha->youtube,
            $usaha->facebook,
            $usaha->twitter,
            $usaha->shopee,
            $usaha->tokopedia,
            $usaha->deskripsi,
            $usaha->keterangan,
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
