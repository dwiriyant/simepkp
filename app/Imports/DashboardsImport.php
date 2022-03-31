<?php

namespace App\Imports;

use Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

use App\Helpers\Helpers;
use App\Models\Dashboard;

class DashboardsImport implements ToModel, WithHeadingRow, WithStartRow
{
    private $branch_id;

    public function __construct(int $branch_id) 
    {
        $this->branch_id = $branch_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $head = $row;
        unset($head[""]);
        unset($head["indikator_keuangan_utama"]);
        $head = array_keys($head);
        foreach ($head as $key => $value) {
            $convert = explode('_', $value);
            if(isset($convert[1])) {
                $month = Helpers::getNumberOfMonth($convert[1]);
                $year = $convert[2];
            }
            $new_head[$value] = date("Y-m-t", strtotime($year.'-'.$month.'-01'));
        }
        foreach ($new_head as $key => $value) {
            if(isset($row['indikator_keuangan_utama']) && $row['indikator_keuangan_utama'] == 'Kredit Yang Diberikan') {
                Dashboard::updateOrCreate(
                    ['month' => $value, 'branch_id' => $this->branch_id],
                    ['outstanding_kredit' => $row[$key]]
                );
            }
            if(isset($row['indikator_keuangan_utama']) && $row['indikator_keuangan_utama'] == 'Kredit Produktif') {
                Dashboard::updateOrCreate(
                    ['month' => $value, 'branch_id' => $this->branch_id],
                    ['kredit_produktif' => $row[$key]]
                );
            }
            if(isset($row['indikator_keuangan_utama']) && $row['indikator_keuangan_utama'] == 'Baki Debet NPL Kredit Produktif') {
                Dashboard::updateOrCreate(
                    ['month' => $value, 'branch_id' => $this->branch_id],
                    ['baki_debet_npl' => $row[$key]]
                );
            }
            if(isset($row['indikator_keuangan_utama']) && $row['indikator_keuangan_utama'] == 'NPL Kredit Produktif') {
                Dashboard::updateOrCreate(
                    ['month' => $value, 'branch_id' => $this->branch_id],
                    ['non_performing_loan' => $row[$key]]
                );
            }
        }
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
