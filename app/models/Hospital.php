<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = "hospitals";
    public $timestamps = false;
    public function department()
    {
        return $this->hasMany('App\models\Department', 'hospitals_id', 'id');
    }
    
    public function dept()
    {
        return $this->belongsTo('App\models\Dept', 'depts_id', 'id');
    }
    
}
