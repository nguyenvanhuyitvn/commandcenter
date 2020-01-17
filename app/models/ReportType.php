<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    protected $table = "report_types";
    
    public function UrgentReport()
    {
        return $this->hasMany('App\models\UrgentReport', 'report_types_id', 'id');
    }
    public function complain()
    {
        return $this->hasMany('App\models\Complain', 'report_types_id', 'id');
    }
    
}
