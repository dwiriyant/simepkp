<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = ['visit_id', 'recommendation', 'recommendation_correction'];

    public function visit()
    {
        return $this->belongsTo('App\Models\Visit');
    }
}
