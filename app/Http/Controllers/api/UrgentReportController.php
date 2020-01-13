<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SeriousProblemType;
use App\models\UrgentReport;
use App\models\Patient;
use App\User;
use Auth;
use Mail;
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
        return response()->json(['success'=> $mailTo], $this->successStatus);
    }
    public function store(Request $request){
        // Get email
        $user = Auth::user();
        $parent_id = $user['parent_id'];
        if(isset($parent_id)){
            $user1 = User::find($parent_id);
            $mailToUser1 = $user1['email'];
            if(isset($user1['parent_id'])){
                $user2 = User::find($user1['parent_id']);
                $mailToUser2 = $user1['email'];
                $mailTo = $mailToUser1.','.$mailToUser2;
                if(isset($user2['parent_id'])){
                    $user3 = User::find($user1['parent_id']);
                    $mailToUser3 = $user1['email'];
                    $mailTo = "'".$mailToUser1."'".','."'".$mailToUser2."'".','."'".$mailToUser3."'";
                }
            }else{
                $mailTo =  $mailToUser1;
            }
        }
        $Dept = User::find($parent_id);
        $mailFrom = $user['email'];
        // Patient Table
        $patients = new Patient;
        $patients->name = $request->name;
        $patients->case_number = $request->case_number;
        $patients->birthday = $request->birthday;   
        $patients->gender= $request->gender;
        $patients->departments_id= $request->patient_department_id;
        $patients->save();
        $patients_id = $patients->id;
        $request->merge(['patients_id' =>  $patients_id]);
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $path = $request->file->move("uploads",$filename);
            $file = url('uploads'.'/'.$filename);
            $request->merge(['file' => $filename]);
            $urgent_reports= UrgentReport::create($request->except('name', 'case_number','birthday','gender','patient_department_id'));
            return response(['success'=>'Created successfull','request'=> $request->all()], $this->successStatus);
        }else{
            $urgent_reports= UrgentReport::create($request->except('file','name', 'case_number','birthday','gender','patient_department_id','patient_hospital_id'));
            return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
        }
    }
}
