<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SeriousProblemType;
use App\models\UrgentReport;
use App\models\Patient;
use App\models\ReportType;
use App\models\Department;
use App\User;
use Auth;
use Mail;
class UrgentReportController extends Controller
{
    public $successStatus = 200;
    public function index(){
            $urgent_reports = UrgentReport::all();
            foreach($urgent_reports as $key=> $value){
                // Tần suất báo cáo
                if($value[$key]['frequence'] == 1){
                    $urgent_reports[$key]['frequence'] = "Hàng ngày";
                }else if($value[$key]['frequence'] == 2){
                    $urgent_reports[$key]['frequence'] = "Hàng tuần";
                }else{
                    $urgent_reports[$key]['frequence'] = "Hàng tháng";
                }
                // Loại báo cáo
                $urgent_reports[$key]['report_types_id']= $urgent_reports[$key]->ReportType->name;
                // Thông báo cho bác sĩ
                if($value[$key]['notify_doctor']==1){
                    $urgent_reports[$key]['notify_doctor'] = "Có";
                }else if($value[$key]['notify_doctor'] == 2){
                    $urgent_reports[$key]['notify_doctor'] = "Không";
                }else{
                    $urgent_reports[$key]['notify_doctor'] = "Không ghi nhận";
                }
                // Thông báo cho người nhà bệnh nhân
                if($value[$key]['notify_family']==1){
                    $urgent_reports[$key]['notify_family'] = "Có";
                }else if($value[$key]['notify_family'] == 2){
                    $urgent_reports[$key]['notify_family'] = "Không";
                }else{
                    $urgent_reports[$key]['notify_family'] = "Không ghi nhận";
                }
                // Thông báo cho người bệnh
                if($value[$key]['notify_patient']==1){
                    $urgent_reports[$key]['notify_patient'] = "Có";
                }else if($value[$key]['notify_patient'] == 2){
                    $urgent_reports[$key]['notify_patient'] = "Không";
                }else{
                    $urgent_reports[$key]['notify_patient'] = "Không ghi nhận";
                }
                // Mức độ nghiêm trọng
                if($value[$key]['trouble_level']==1){
                    $urgent_reports[$key]['trouble_level'] = "Nặng";
                }else if($value[$key]['trouble_level'] == 2){
                    $urgent_reports[$key]['trouble_level'] = "Nhẹ";
                }else{
                    $urgent_reports[$key]['trouble_level'] = "Trung bình";
                }
                // Lưu hồ sơ y tế
                if($value[$key]['recorded_medical ']==1){
                    $urgent_reports[$key]['recorded_medical '] = "Có";
                }else if($value[$key]['recorded_medical '] == 2){
                    $urgent_reports[$key]['recorded_medical '] = "Không";
                }else{
                    $urgent_reports[$key]['recorded_medical '] = "Không ghi nhận";
                }
                // Đối tượng xảy ra sự cố
                if($value[$key]['problem_object ']==1){
                    $urgent_reports[$key]['problem_object '] = "Người bệnh";
                }else if($value[$key]['problem_object '] == 2){
                    $urgent_reports[$key]['problem_object '] = "Người nhà";
                }else if($value[$key]['problem_object '] == 3){
                    $urgent_reports[$key]['problem_object '] = "Nhân viên y tế";
                }else{
                    $urgent_reports[$key]['problem_object '] = "Trang thiết bị y tế";
                }
            }
            return response()->json(['data'=> $urgent_reports], $this->successStatus);
    }
    public function create(){
        $user = Auth::user();
        $data['departments'] = Department::where('hospitals_id', $user->hospitals_id)->get();
        $data['ReportTypes'] = ReportType::all();
        $data['SeriousProblemTypes'] = SeriousProblemType::all();
        $receiver = array();
        $parent_id = $user['parent_id'];
        if(isset($parent_id)){
            $user1 = User::find($parent_id);
            if($user1){
                $receiver[0][] = $user1;
            }
            if(isset($user1['parent_id'])){
                $user2 = User::find($user1['parent_id']);
                if($user2){
                    $receiver[1][] = $user2;
                }
                if(isset($user2['parent_id'])){
                    $user3 = User::find($user2['parent_id']);
                    if($user3){
                        $receiver[3][] = $user3;
                    }
                }
            }
        }
        $data['sender'] = $user;
        $data['receiver'] = $receiver;
        return response()->json(['success'=> $data], $this->successStatus);
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
                $mailToUser2 = $user2['email'];
                $mailTo = $mailToUser1.','.$mailToUser2;
                if(isset($user2['parent_id'])){
                    $user3 = User::find($user2['parent_id']);
                    $mailToUser3 = $user3['email'];
                    $mailTo = "'".$mailToUser1."'".','."'".$mailToUser2."'".','."'".$mailToUser3."'";
                }
            }else{
                $mailTo =  $mailToUser1;
            }
        }
        $mailToArray = explode(',', $mailTo);
        dd($mailToArray); exit();
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
        if ($request->hasFile('attachments')) {
            $filename = $request->file('attachments')->getClientOriginalName();
            $path = $request->file('attachments')->move("uploads",$filename);
            $file = url('uploads'.'/'.$filename);
            $request->merge(['file' => $file]);
            $urgent_reports= UrgentReport::create($request->except('name', 'case_number','birthday','gender','patient_department_id'));
            if($urgent_reports){
                $data = array('name'=>'name', 'body' => 'Body');
                Mail::send('emails.mail', $data, function($message) {
                    $message->to(['huynvtest@gmail.com','luongitbkap@gmail.com'])
                    ->subject('Laravel Test Mail');
                    $message->from('huynvtest@gmail.com','Test Email');
                });
                return response(['success'=>'Created successfull','request'=> $request->all()], $this->successStatus);
            }

        }else{
            $urgent_reports= UrgentReport::create($request->except('file','name', 'case_number','birthday','gender','patient_department_id','patient_hospital_id'));
            if($urgent_reports){
                $data = array('name'=>'name', 'body' => 'Body');
                Mail::send('emails.mail', $data, function($message) {
                    $message->to(['huynvtest@gmail.com','luongitbkap@gmail.com'])
                    ->subject('Laravel Test Mail');
                    $message->from('huynvtest@gmail.com','Test Email');
                });
                return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
            }
        }

    }
}
