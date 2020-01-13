<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SeriousProblemType;
use App\User;
use Auth;
class UrgentReportController extends Controller
{
    public $successStatus = 200;
    public function index(){
            $problem_types = SeriousProblemType::all();
            $data = buildTree($problem_types, 0);
            return response()->json(['data'=> $data], $this->successStatus);
    }
    public function create(){
        $user = Auth::user();
        $parent_id = $user['parent_id'];
        $data = User::find($parent_id);
        return response()->json(['success'=> $data], $this->successStatus);
    }
}
