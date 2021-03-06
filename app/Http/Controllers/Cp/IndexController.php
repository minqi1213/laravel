<?php

namespace App\Http\Controllers\Cp;

use App\Http\Model\Cp;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
    public function index(){

        //$pdo = DB::connection()->getPdo();
        return view('cp.index');
    }

    public function info(){

        //$pdo = DB::connection()->getPdo();
        return view('cp.info');
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
                $user = Cp::where('cpid','=',session('userid'))->first();
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
            return view('cp.pass');
        }
    }
}
