<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table= 'areas';
    public $timestamps = false;
    public function hospital()
    {
      return $this->belongsTo('App\modles\Hospital', 'hospitals_id', 'id');
    }
}
