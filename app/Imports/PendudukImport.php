<?php

namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Carbon\Carbon;

class PendudukImport implements ToModel
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
    private $dusun;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row[0] == 'NO') {
            return null;
        }
        for ($i = 1; $i <= 20; $i += 1) {
            if ($i != 12 and $i != 15 and $i != 17 or gettype($row[6]) == "string") {
                if ($row[$i] == null) {
                    return null;
                }
            }
        }
        return new Penduduk([
            'user_id' => $this->userId,
            'tgl_pindah_masuk' => date('Y-m-d'),
            'tgl_lapor' => date('Y-m-d'),
            'NIK' => $row[1],
            'NKK' => $row[2],
            'nama' => $row[3],
            'jenis_kelamin' => $this->getKelamin(strtolower($row[4])),
            'tempat_lahir' => $row[5],
            'tgl_lahir' => $this->convertTgl($row[6]),
            'agama' => $this->getAgama(strtolower($row[7])),
            'usia' => $this->rapihkan($row[8]),
            'status_pernikahan' => $this->getStatusPernikahan(strtolower($row[9])),
            'alamat' => $row[10],
            'kewarganegaraan' => $this->getKewarganegaraan(strtolower($row[11])),
            'dusun' => $this->cekDusun($row[12]),
            'rt' => $this->rapihkan($row[13]),
            'rw' => $this->rapihkan($row[14]),
            'kepemilikan_bpjs' => $this->getKepemilikanBpjs(strtolower($row[15])),
            'kepemilikan_e_ktp' => $this->getKepemilikanEKtp(strtolower($row[16])),
            'pekerjaan' => $this->getPekerjaan(strtolower($row[17])),
            'pendidikan' => $this->getPendidikan(strtolower($row[18])),
            'nama_ibu' => $row[19],
            'nama_ayah' => $row[20],
        ]);
    }
    private function rapihkan($data)
    {
        return str_replace("'", "", $data);
    }

    private function cekDusun($data)
    {
        if ($data == null) {
            return 'Tidak Ada';
        }
        return $data;
    }
    private function convertTgl($data)
    {
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($data));
    }

    private function getKelamin($data)
    {
        if ($data == null) {
            return '1';
        }
        return ($data === 'laki-laki') ? '1' : '2';
    }

    private function getAgama($data)
    {
        $arr = ['islam', 'kristen protestan', 'kristen katholik', 'hindu', 'buddha', 'khonghucu'];
        return (string) (array_search($data, $arr) + 1);
    }

    private function getKewarganegaraan($data)
    {
        $arr = ['indonesia', 'wna', 'kedua kewarganegaraan'];
        return (string) (array_search($data, $arr) + 1);
    }

    private function getStatusPernikahan($data)
    {
        $arr = ['belum kawin', 'kawin', 'cerai hidup', 'cerai mati'];
        return (string) (array_search($data, $arr) + 1);
    }

    private function getPendidikan($data)
    {
        $arr = ['belum Sekolah', 'tamat sd', 'belum tamat sd', 'akademi', 'sd sederajat', 'sltp sederajat', 'slta sederajat', 'diploma 1', 'diploma 2', 'diploma 3', 'diploma 4', 'stara 1', 'stara 2', 'stara 3'];
        return (string) (array_search($data, $arr) + 1);
    }
    private function getKepemilikanBpjs($data)
    {
        $arr = ['ppu', 'pbpu', 'pd pemda', 'bukan pekerja', 'pbi jk', 'tidak ada'];
        if ($data == null) {
            return 6;
        }
        return (string) (array_search($data, $arr) + 1);
    }

    private function getKepemilikanEKtp($data)
    {
        $arr = ['ada', 'tidak ada'];
        return (string) (array_search($data, $arr) + 1);
    }

    private function getPekerjaan($data)
    {
        $arr = ["buruh harian lepas", "belum bekerja", "pengrajin logam", "wiraswasta", "guru", "mengurus rumah tangga", "pegawai negri sipil", "tentara nasional indonesia", "guru ngaji", "wirausaha", "penjahit", "pensiun pns", "bemulung", "buruh", "linmas wilayah", "driver", "petani", "amil", "service"];
        if ($data == null) {
            return 2;
        }
        return (string) (array_search($data, $arr) + 1);
    }


}
