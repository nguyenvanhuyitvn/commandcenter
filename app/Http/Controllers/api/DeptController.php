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
class DeptController extends Controller
{
    public $successStatus = 200;
    public function index(){
        $depts = Dept::all();
        return response()->json(['data'=> $depts], $this->successStatus);
    }
    public function show($id){
        $depts = Dept::find($id);
        if($depts){
            return response()->json(['data'=> $depts], $this->successStatus);
        }else{
            return response()->json(['data'=> 'Data null'], 401);
        }
    }
    public function create(){
            $data['provinces'] = Province::all();
            $data['districts'] = District::all();
            $data['wards'] = Ward::all();
            return response()->json(['data'=> $data], $this->successStatus);
    }
    public function store(Request $request){
        $depts = Dept::all();
        if($depts->count()!=0)
        {
            foreach($depts as $k=> $value){
                if($value['code'] === $request->code){
                    return response(['error' => 'Depts is existed'], 401);
                }
                else{
                   if ($request->hasFile('file')) {
                        $filename = $request->file->getClientOriginalName();
                        $path = $request->file->move("public/uploads",$filename);
                        $logoUrl = url('public/uploads'.'/'.$filename);
                        $request->merge(['image' => $filename]);
                        $depts= Dept::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()], $this->successStatus);
                    }else{
                        $filename = 'no-image.png';
                        $logoUrl = url('public/uploads'.'/'.$filename);
                        $request->merge(['image' =>  $filename]);
                        $depts= Dept::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
                    }

                }
            }
        }else{

            if ($request->hasFile('file')) {
                        $filename = $request->file->getClientOriginalName();
                        $path = $request->file->move("public/uploads",$filename);
                        $logUrl = url('public/uploads'.'/'.$filename);
                        $request->merge(['image' => $filename]);
                        $depts= Dept::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
                    }else{
                        $request->merge(['image' => 'public/uploads/no-image.png']);
                        $depts= Dept::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
                    }
        }
    }
    public function edit($id){
        $depts = Dept::find($id);
        if(!$depts){
            return response()->json(['data'=> 'Data null'], 401);
        }else{
            return response()->json(['data'=> $depts], $this->successStatus);
        }
    }
    public function update(Request $request, $id){
        $depts = Dept::find($id);
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $logo = $request->image->getClientOriginalName();
            $path = $request->image->move("public/uploads",$logo);
            $logoUrl = url('public/uploads'.'/'.$logo);
            $request->merge(['logo' => $logo]);
            $depts->update($request->all());
            return response()->json(['success'=> "Updated Successfull"], $this->successStatus);
       }else{
            $input= $request->only(['code','name', 'districts_id', 'provinces_id','wards_id','address']);
            $depts->update($input);
            return response()->json(['success'=> "Updated Successfull"], $this->successStatus);
       }
    }
    public function destroy($id){
        $depts = Dept::destroy($id);
        if($depts){
            return response()->json(['success'=> "Deleted Successfull"], $this->successStatus);
        }else{
            return response()->json(['error'=> "Cannot find depts"], $this->successStatus);
        }

    }
}
