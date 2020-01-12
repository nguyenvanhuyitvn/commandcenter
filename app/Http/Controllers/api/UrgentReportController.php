<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SeriousProblemType;
class UrgentReportController extends Controller
{
    public $successStatus = 200;
    public function create(){
            $problem_types = SeriousProblemType::all();
            $data = UrgentReportsFormat($problem_types, 0, '--|');
            return response()->json(['data'=> $data], $this->successStatus);
    }
}
