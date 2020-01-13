<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\models\Province;
use App\models\District;
use App\models\Ward;
use App\models\Dept;
use Auth;
use App\models\Hospital;
class HospitalsController extends Controller
{
    public $successStatus = 200;
    public function index(){
        $hospital = Hospital::all();
        return response()->json(['data'=> $hospital], $this->successStatus);
    }
    public function show($id){
        $hospital = Hospital::find($id);
        if($hospital){
            return response()->json(['data'=> 'Data null'], 401);
        }else{
            return response()->json(['data'=> $hospital], $this->successStatus);
        }
    }
    public function create(){
            $data['provinces'] = Province::all();
            $data['districts'] = District::all();
            $data['wards'] = Ward::all();
            $data['depts'] = Dept::all();
            return response()->json(['data'=> $data], $this->successStatus);
    }
    public function store(Request $request){
        $hospitals = Hospital::all();
        if($hospitals->count()!=0)
        {
            foreach($hospitals as $k=> $hospitals){
                if($hospitals['code'] === $request->code){
                    return response(['is_exist'=> '1', 'message' => 'Bệnh viện đã tồn tại']);
                }
                else{
                   if ($request->hasFile('file')) {
                        $filename = $request->file->getClientOriginalName();
                        $path = $request->file->move("uploads",$filename);
                        $logoUrl = url('uploads'.'/'.$filename);
                        $request->merge(['image' => $filename]);
                        $hospital= Hospital::create($request->all());
                        return response(['success'=>'Thêm bệnh viện thành công 1','request'=> $request->all()]);
                    }else{
                        $filename = 'no-image.png';
                        $request->merge(['image' =>  $filename]);
                        $hospital= Hospital::create($request->all());
                        return response(['success'=>'Thêm bệnh viện thành công 2','request'=> $request->all()]);
                    }

                }
            }
        }else{

            if ($request->hasFile('file')) {
                        $filename = $request->file->getClientOriginalName();
                        $path = $request->file->move("uploads",$filename);
                        $logUrl = url('uploads'.'/'.$filename);
                        $request->merge(['image' => $filename]);
                        $hospital= Hospital::create($request->all());
                        return response(['success'=>'Thêm bệnh viện thành công 3','request'=> $request->all()]);
                    }else{
                        $request->merge(['image' => 'no-image.png']);
                        $hospital= Hospital::create($request->all());
                        return response(['success'=>'Thêm bệnh viện thành công 4','request'=> $request->all()]);
                    }
        }
    //     if ($request->hasFile('file')) {
    //         $filename = $request->file->getClientOriginalName();
    //         $logo = $request->image->getClientOriginalName();
    //         $path = $request->image->move("uploads",$logo);
    //         $logoUrl = url('uploads'.'/'.$logo);
    //         $request->merge(['logo' => $logo]);
    //         $hospital = Hospital::create($request->all());
    //         return response()->json(['success'=> "Created Successfull"], $this->successStatus);
    //    }else{
    //         return response()->json(['error'=>'Hospital is not created.'],401);
    //    }
    }
    public function edit($id){
        $hospital = Hospital::find($id);
        if($hospital){
            return response()->json(['data'=> 'Data null'], 401);
        }else{
            return response()->json(['data'=> $hospital], $this->successStatus);
        }
    }
    public function update(Request $request, $id){
        $hospital = Hospital::find($id);
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $logo = $request->image->getClientOriginalName();
            $path = $request->image->move("uploads",$logo);
            $logoUrl = url('uploads'.'/'.$logo);
            $request->merge(['logo' => $logo]);
            $hospital = Hospital::create($request->all());
            return response()->json(['success'=> "Created Successfull"], $this->successStatus);
       }else{
            return response()->json(['error'=>'Hospital is not created.'],401);
       }
    }
}
