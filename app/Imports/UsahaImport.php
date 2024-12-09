<?php

namespace App\Imports;

use App\Models\Kecamatan;
use App\Models\Usaha;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsahaImport implements ToModel, WithHeadingRow
{
    private $kriteria_id, $jenis_usaha_id, $kategori_id;

    public function __construct($kriteria_id, $jenis_usaha_id, $kategori_id)
    {
        $this->kriteria_id = $kriteria_id;
        $this->jenis_usaha_id = $jenis_usaha_id;
        $this->kategori_id = $kategori_id;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $kecamatan_id = Kecamatan::where('kecamatan', 'LIKE', '%' . $row['kecamatan'] . '%')->first()->id;
        $user = User::create([
            'name' => $row['nama_pemilik'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'password' => Hash::make($row['password']),
        ])->assignRole('user');
        return new Usaha([
            'kriteria_id' => $this->kriteria_id,
            'kategori_id' => $this->kategori_id,
            'jenis_usaha_id' => $this->jenis_usaha_id,
            'kecamatan_id' => $kecamatan_id,
            'user_id' => $user->id,
            'nama_usaha' => $row['nama_usaha'],
            'alamat' => $row['alamat'],
            'deskripsi' => $row['deskripsi'],
            'website' => $row['website'],
            'whatsapp' => $row['whatsapp'],
            'instagram' => $row['instagram'],
            'tiktok' => $row['tiktok'],
            'youtube' => $row['youtube'],
            'facebook' => $row['facebook'],
            'twitter' => $row['twitter'],
            'shopee' => $row['shopee'],
            'tokopedia' => $row['tokopedia'],
            'link_maps' => $row['link_maps'],
            'jumlah_pekerja' => $row['jumlah_pekerja'],
            'modal_usaha' => $row['modal_usaha'],
            'omzet' => $row['omzet'],
            'isVerified' => 1,
        ]);
    }
}
