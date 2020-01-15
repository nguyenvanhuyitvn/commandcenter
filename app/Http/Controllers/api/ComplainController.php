<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Mail;
use App\models\Complainant;
use App\models\ReportType;
use App\models\Department;
use App\models\Complain;
use App\models\AccountType;
class ComplainController extends Controller
{
    public $successStatus = 200;
    public function index(){
        $complains = Complain::all();
        return response()->json(['data'=> $complains], $this->successStatus);
    }

    public function show(){
        $complains = Complain::find($id);
        if($complains['frequence'] == 1){
            $complains['frequence'] = "Hàng ngày";
        }else if($complains['frequence'] == 2){
            $complains['frequence'] = "Hàng tuần";
        }else{
            $complains['frequence'] = "Hàng tháng";
        }
        // Loại báo cáo
        $complains['report_types_id']= $complains->ReportType->name;
        return response()->json(['data'=> $complains], $this->successStatus);
    }
    public function create(){
        $user = Auth::user();
        $account_types = AccountType::where('code','BYT')->first();
        $email_BYT = User::where('account_types_id', $account_types['id'])->first();
        $data['departments'] = Department::where('hospitals_id', $user->hospitals_id)->first();
        $data['ReportTypes'] = ReportType::all();
        $data['SeriousProblemTypes'] = SeriousProblemType::all();
        $receiver = array();
        $receiver[] = $email_BYT;
        if(isset($user['parent_id'])){
            $user_dept = User::where('account_types_id', $user['parent_id'])->first();
            $receiver[] = $user_dept;
        }
        $data['receiver'] = $receiver;
        return response()->json(['success'=> $data], $this->successStatus);
    }
    public function store(Request $request){
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
        $complainants = new Complainant;
        $complainants->name = $request->name;
        $complainants->passport = $request->passport;
        $complainants->birthday = $request->birthday;
        $complainants->gender= $request->gender;
        $complainants->date_of_issue= $request->date_of_issue;
        $complainants->place_of_issue= $request->place_of_issue;
        $complainants->phone= $request->phone;
        $complainants->address= $request->address;
        $complainants->save();
        $complainants_id = $complainants->id;
        $request->merge(['complainants_id' =>  $complainants_id]);
        if ($request->hasFile('attachments')) {
            $filename = $request->attachments->getClientOriginalName();
            $path = $request->attachments->move("public/uploads",$filename);
            $file = url('public/uploads'.'/'.$filename);
            $request->merge(['attachments' => $file]);
            $complains= Complain::create($request->except('name', 'passport','birthday','gender','date_of_issue','place_of_issue','phone','address'));
            if($complains){
                $data = array('name'=>'Xin chào!', 'body' => 'Bạn vừa nhận được 01 email mới');
                // dd($mailToArray);exit();
                Mail::send('emails.mail', $data, function($message) use($mailToArray) {
                    $message->to($mailToArray)
                    ->subject('BÁO CÁO KHẨN CẤP');
                    $message->from('huyitbkap@gmail.com','Khiếu nại');
                });
                return response(['success'=>'Created successfull','request'=> $request->all()], $this->successStatus);
            }else{
                return response(['error'=>'Cannot created'], 401);
            }
        }else{
            $complains= Complain::create($request->except('file','name', 'case_number','birthday','gender','patient_department_id','patient_hospital_id'));
            if($complains){
                $data = array('name'=>'Xin chào!', 'body' => 'Bạn vừa nhận được 01 email mới');
                Mail::send('emails.mail', $data, function($message) use($mailToArray) {
                    $message->to($mailToArray)
                    ->subject('BÁO CÁO KHẨN CẤP');
                    $message->from('huyitbkap@gmail.com','Khiếu nại');
                });
                return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
            }
        }
    }
}
