<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = ['branch_id', 'outstanding_kredit', 'kredit_produktif', 'baki_debet_npl', 'non_performing_loan', 'month'];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function scopeBranches($query, $value) {
        if($value)
            return $query->where('branch_id', $value);
        return $query;
    }
}
