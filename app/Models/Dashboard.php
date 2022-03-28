<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = ['branch_id', 'created_by', 'outstanding_kredit', 'kredit_produktif', 'baki_debet_npl', 'non_performing_loan', 'month'];

    public function scopeBranch($query, $value) {
        if($value)
            return $query->where('branch_id', $value);
        return $query;
    }
}
