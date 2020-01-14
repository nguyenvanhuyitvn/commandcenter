<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    protected $table = "depts";
    
    public function hospital()
    {
        return $this->hasMany('App\mdoels\Hospital', 'depts_id', 'id');
    }
    
}
