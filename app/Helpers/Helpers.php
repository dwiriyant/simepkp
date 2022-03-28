<?php
namespace App\Helpers;

class Helpers
{
    public static function getNumberOfMonth($month)
    {
        $data = [
            "jan" => "01",
            "feb" => "02",
            "mar" => "03",
            "apr" => "04",
            "mei" => "05",
            "jun" => "06",
            "jul" => "07",
            "ags" => "08",
            "sep" => "09",
            "okt" => "10",
            "nov" => "11",
            "des" => "12",
        ];
        return $data[$month];
    }

    public static function getNumberToMonth($month)
    {
        $data = [
            "01" => "JAN",
            "02" => "FEB",
            "03" => "MAR",
            "04" => "APR",
            "05" => "MEI",
            "06" => "JUN",
            "07" => "JUL",
            "08" => "AGS",
            "09" => "SEP",
            "10" => "OKT",
            "11" => "NOV",
            "12" => "DES",
        ];
        return $data[$month];
    }

}