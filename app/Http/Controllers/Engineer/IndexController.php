<?php

namespace App\Http\Controllers\Engineer;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index(){

        //$pdo = DB::connection()->getPdo();
        $data = DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid'=>session('userid')]);
        return view('engineer.index',compact('data'));
//        return view('engineer.index');
    }

    public function info(){

        //$pdo = DB::connection()->getPdo();
        return view('engineer.info');
    }

    public function pass(){
        if($input = Input::all()){
            $rules = [
                'password'=>'required|between:6,20|confirmed',
            ];
            $message = [
                'password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须在6-20位之间',
                'password.confirmed'=>'新密码和确认密码不一致',
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes()){
                $user = User::where('uid','=',session('userid'))->first();
                $_password =  Crypt::decrypt($user->password);
                if($input['password_o']==$_password){
                    $user->password = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功');
                } else {

                    return back()->with('errors','原密码错误');
                }
            } else {
                return back()->withErrors($validator);
            }
        } else {
            return view('engineer.pass');
        }
    }
}
