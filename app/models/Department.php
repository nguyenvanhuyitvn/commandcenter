<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = "departments";

    public function hospital()
    {
        return $this->belongsTo('App\models\Hospital', 'hospitals_id', 'id');
    }

}
