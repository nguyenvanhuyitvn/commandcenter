<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Complainant extends Model
{
    protected $table = "complainants";
    public $timestamps = false;
    public function ReportType()
    {
        return $this->belongsTo('App\models\ReportType', 'report_types_id', 'id');
    }
}
