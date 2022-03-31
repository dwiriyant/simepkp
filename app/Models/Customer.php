<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['branch_id', 'no_rek', 'no_akd', 'nama_singkat', 'tgl_jt', 'jnk_wkt_bl', 'plafond_awal', 'bunga', 'pokok', 'kolektibility', 'prd_name', 'saldo_akhir', 'totagunan_ydp', 'tglmulai', 'aonm'];

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'aonm');
    }

    public function visit()
    {
        return $this->hasMany('App\Models\Visit');
    }

}
