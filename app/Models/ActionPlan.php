<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    protected $fillable = ['visit_id', 'action', 'action_correction', 'completion_date'];

    public function visit()
    {
        return $this->belongsTo('App\Models\Visit');
    }
}
