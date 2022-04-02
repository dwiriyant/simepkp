<?php

namespace App\Imports;

use Auth;
use Carbon;
use Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

use App\Models\User;
use App\Models\Branch;
use App\Models\Customer;

class CustomersImport implements ToModel, WithHeadingRow, WithStartRow
{
    private $rowNumber = 2;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!isset($row['kd_cab'])) {
            if(array_key_exists('kd_cab', $row) && $row['kd_cab'] == null){
                return null;
            }

            Session::put('import_customer', ['Format File Upload Excel tidak sesuai']);

            return null;
        }            
        $this->rowNumber++;
        $aomn = User::whereRaw('LOWER(`name`) LIKE ?', [ $row['aonm'] ])->first();
        if($aomn) {
            $aomn = $aomn->id;
        } else {
            Session::push('import_customer', 'Pada baris ke '. $this->rowNumber . ' `'. $row['nama_singkat'] .'` tidak memiliki AONM yang terdaftar di sistem');
                    
            return null;
        }
        $branch = Branch::where('code', $row['kd_cab'])->first();
        if($branch) {
            $branch = $branch->id;
        } else {
            Session::push('import_customer', 'Pada baris ke '. $this->rowNumber . ' `'. $row['nama_singkat'] .'` tidak memiliki KD_CAB yang terdaftar di sistem');
                    
            return null;
        }
        Customer::updateOrCreate(
            [
                'branch_id' => $branch,
                'no_rek' => $row['no_rek']
            ],
            [
                'no_akd' => $row['no_rek'],
                'nama_singkat' => $row['nama_singkat'],
                'tgl_jt' => is_string($row['tgl_jt']) ? date('Y-m-d', strtotime(str_replace('/', '-',$row['tgl_jt']))) : Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_jt']))->format('Y-m-d'),
                'jnk_wkt_bl' => $row['jnk_wkt_bl'],
                'plafond_awal' => (float)$row['plafond_awal'],
                'bunga' => (float)$row['bunga'],
                'pokok' => (float)$row['pokok'],
                'kolektibility' => $row['kolektibility'],
                'prd_name' => $row['prd_name'],
                'saldo_akhir' => (float)$row['saldo_akhir'],
                'totagunan_ydp' => (float)$row['totagunan_ydp'],
                'tglmulai' => is_string($row['tglmulai']) ? date('Y-m-d', strtotime(str_replace('/', '-',$row['tglmulai']))) : Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tglmulai']))->format('Y-m-d'),
                'aonm' => $aomn,
            ]
        );
    }

    public function headingRow(): int
    {
        return 1;
    }

    public function startRow(): int
    {
        return 2;
    }
}
