<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\SeriousProblemType;
use App\models\UrgentReport;
use App\models\Patient;
use App\models\ReportType;
use App\models\Department;
use App\models\AccountType;
use App\User;
use Auth;
use Mail;
class UrgentReportController extends Controller
{
    public $successStatus = 200;
    public function index(){
            $urgent_reports = UrgentReport::all();
            return response()->json(['data'=> $urgent_reports], $this->successStatus);
    }
    public function show($id){
        $urgent_reports = UrgentReport::find($id);
            // serious_problem_types
            $arr = explode(',',$urgent_reports['serious_problem_types_id']);
            // dd($arr); exit();
            foreach($arr as $key1 => $value1){
                $data[] = SeriousProblemType::where('id', $value1)->first()->toArray();
            }
            $urgent_reports['serious_problem_types'] = buildTree($data, 0);
            
            // Tần suất báo cáo
            if($urgent_reports['frequence'] == 1){
                $urgent_reports['frequence'] = "Hàng ngày";
            }else if($urgent_reports['frequence'] == 2){
                $urgent_reports['frequence'] = "Hàng tuần";
            }else{
                $urgent_reports['frequence'] = "Hàng tháng";
            }
            // Loại báo cáo
            $urgent_reports['report_types_id']= $urgent_reports->ReportType->name;
            // Thông báo cho bác sĩ
            if($urgent_reports['notify_doctor']==1){
                $urgent_reports['notify_doctor'] = "Có";
            }else if($urgent_reports['notify_doctor'] == 2){
                $urgent_reports['notify_doctor'] = "Không";
            }else{
                $urgent_reports['notify_doctor'] = "Không ghi nhận";
            }
            // Thông báo cho người nhà bệnh nhân
            if($urgent_reports['notify_family']==1){
                $urgent_reports['notify_family'] = "Có";
            }else if($urgent_reports['notify_family'] == 2){
                $urgent_reports['notify_family'] = "Không";
            }else{
                $urgent_reports['notify_family'] = "Không ghi nhận";
            }
            // Thông báo cho người bệnh
            if($urgent_reports['notify_patient']==1){
                $urgent_reports['notify_patient'] = "Có";
            }else if($urgent_reports['notify_patient'] == 2){
                $urgent_reports['notify_patient'] = "Không";
            }else{
                $urgent_reports['notify_patient'] = "Không ghi nhận";
            }
            // Mức độ nghiêm trọng
            if($urgent_reports['trouble_level']==1){
                $urgent_reports['trouble_level'] = "Nặng";
            }else if($urgent_reports['trouble_level'] == 2){
                $urgent_reports['trouble_level'] = "Nhẹ";
            }else{
                $urgent_reports['trouble_level'] = "Trung bình";
            }
            // Lưu hồ sơ y tế
            if($urgent_reports['recorded_medical ']==1){
                $urgent_reports['recorded_medical '] = "Có";
            }else if($urgent_reports['recorded_medical '] == 2){
                $urgent_reports['recorded_medical '] = "Không";
            }else{
                $urgent_reports['recorded_medical '] = "Không ghi nhận";
            }
            // Đối tượng xảy ra sự cố
            if($urgent_reports['problem_object ']==1){
                $urgent_reports['problem_object '] = "Người bệnh";
            }else if($urgent_reports['problem_object '] == 2){
                $urgent_reports['problem_object '] = "Người nhà";
            }else if($urgent_reports['problem_object '] == 3){
                $urgent_reports['problem_object '] = "Nhân viên y tế";
            }else{
                $urgent_reports['problem_object '] = "Trang thiết bị y tế";
            }
            return response()->json(['data'=> $urgent_reports], $this->successStatus);
    }
    public function create(){
        $user = Auth::user();
        $account_types = AccountType::where('code','BYT')->first();
        $email_BTY = User::where('account_types_id', $account_types['id'])->first();
        $data['departments'] = Department::where('hospitals_id', $user->hospitals_id)->first();
        $data['ReportTypes'] = ReportType::all();
        $data['SeriousProblemTypes'] = SeriousProblemType::all();
        $receiver = array();
        $receiver[] = $email_BTY;
        if(isset($user['parent_id'])){
            $user_dept = User::where('account_types_id', $user['parent_id'])->first();
            $receiver[] = $user_dept;
        }
        $data['receiver'] = $receiver;
        return response()->json(['success'=> $data], $this->successStatus);
    }
    public function store(Request $request){
        // Get email
        $user = Auth::user();
        $account_types = AccountType::where('code','BYT')->first();
        $email_BTY = User::where('account_types_id', $account_types['id'])->first();
        $parent_id = $user['parent_id'];
        $receiver = array();
        if(isset($user['parent_id'])){
            $user_dept = User::where('account_types_id', $user['parent_id'])->first();
            $mailTo = $user_dept['email'].','.$email_BTY['email'];
        }
        
        $mailToArray = explode(',', $mailTo);
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
                $data = array('name'=>'Xin chào!', 'body' => 'Bạn vừa nhận được 01 email mới');
                // dd($mailToArray);exit();
                Mail::send('emails.mail', $data, function($message) use($mailToArray) {
                    $message->to($mailToArray)
                    ->subject('BÁO CÁO KHẨN CẤP');
                    $message->from('huyitbkap@gmail.com','Test Email');
                });
                return response(['success'=>'Created successfull','request'=> $request->all()], $this->successStatus);
            }

        }else{
            $urgent_reports= UrgentReport::create($request->except('file','name', 'case_number','birthday','gender','patient_department_id','patient_hospital_id'));
            if($urgent_reports){
                $data = array('name'=>'Xin chào!', 'body' => 'Bạn vừa nhận được 01 email mới');
                Mail::send('emails.mail', $data, function($message) use($mailToArray) {
                    $message->to($mailToArray)
                    ->subject('BÁO CÁO KHẨN CẤP');
                    $message->from('huyitbkap@gmail.com','Test Email');
                });
                return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
            }
        }

    }
}
