<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['customer_id', 'visit_at', 'result', 'document', 'status'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function recommendation()
    {
        return $this->hasOne('App\Models\Recommendation');
    }

    public function action_plan()
    {
        return $this->hasOne('App\Models\ActionPlan');
    }
}
