<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = "hospitals";

    public function department()
    {
        return $this->hasMany('App\models\Department', 'hospitals_id', 'id');
    }

}
