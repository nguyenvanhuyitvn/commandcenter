<?php

namespace App\Http\Controllers\api;
use App\User;
use App\models\Department;
use App\models\Hospital;
use App\models\AccountType;
use App\models\Position;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        if(Auth::attempt($request->only('email', 'password'))){
            $user = Auth::user();
            $success['token'] = $user->createToken('Myapp')->accessToken;
            return response()->json(['success'=>$success], $this->successStatus);
        }else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function get_register(){
        $data['hospital'] = Hospital::all();
        $data['position'] = Position::all();
        $data['account_types'] = AccountType::all();
        return response()->json(['success'=>$data], $this->successStatus);
    }
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'email'=> 'required | email',
            'password' => 'required',
            'c_password' => 'required | same:password',
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],401);
        }
        $email = trim($request->email);
        $input['password'] = bcrypt($input['password']);
        $users = User::all();
        if($request->account_types == 2 || $request->account_types ==3){
            $parent_id = 0;
        }else{
            $hospital = Hospital::where('hospital_id', $request->hospitals_id)->get();
            $parent_id = $hospital['depts_id'];
        }
        if($users->count()!=0)
        {
            foreach($users as $k=> $value){
                if($value['email'] === $email){
                    return response(['error' => 'User is existed'], 401);
                }
                else{
                   if ($request->hasFile('file')) {
                        $filename = $request->file->getClientOriginalName();
                        $path = $request->file->move("uploads",$filename);
                        $logoUrl = url('uploads'.'/'.$filename);
                        $request->merge(['image' => $filename]);
                        $users= User::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()], $this->successStatus);
                    }else{
                        $filename = 'no-image.png';
                        $logoUrl = url('uploads'.'/'.$filename);
                        $request->merge(['image' =>  $filename]);
                        $users= User::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
                    }

                }
            }
        }else{

            if ($request->hasFile('file')) {
                        $filename = $request->file->getClientOriginalName();
                        $path = $request->file->move("uploads",$filename);
                        $logUrl = url('uploads'.'/'.$filename);
                        $request->merge(['image' => $filename]);
                        $hospital= User::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
                    }else{
                        $request->merge(['image' => 'avatar.jpg']);
                        $hospital= User::create($request->all());
                        return response(['success'=>'Created successfull','request'=> $request->all()],$this->successStatus);
                    }
        }
        // $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return response()->json(['success'=> $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = User::all();
        return response()->json(['success' => $user], $this->successStatus);
    }
    public function show($id){
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);

    }
    public function edit($id){
        $user = User::find($id);
        if($user){
            return response()->json(['data'=> 'Data null'], 401);
        }else{
            return response()->json(['data'=> $user], $this->successStatus);
        }
    }
    public function update(Request $request, $id){
        $user = User::find($id);
        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $logo = $request->image->getClientOriginalName();
            $path = $request->image->move("uploads",$logo);
            $logoUrl = url('uploads'.'/'.$logo);
            $request->merge(['image' => $logo]);
            $user = User::update($request->all());
            return response()->json(['success'=> "Updated Successfull"], $this->successStatus);
       }else{
            $input= $request->only(['name','email', 'hospitals_id','positions_id','account_types_id','departments_id','status','password']);
            $user = User::update($input);
            return response()->json(['success'=> "Updated Successfull"], $this->successStatus);
       }
    }
}
