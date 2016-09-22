<?php

namespace App\Http\Controllers\Cp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests;

require_once 'resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login(){
        if($input = Input::all()){
            $code = new \Code;
            $_code = $code->get();
            if(strtoupper($input['code'])!=$_code){
                return back()->with('msg','验证码错误！');
            }
            $user = DB::select('select * from cp where cpname=:username limit 1',['username'=>$input['username']]);
            if($user==[]){
                return back()->with('msg','用户名或者密码错误！');
            }
            if($user[0]->cpname != $input['username'] || Crypt::decrypt($user[0]->password)!=$input['password']){
                return back()->with('msg','用户名或者密码错误！');
            }
            session(['role'=>'cp']);
            session(['userid'=>$user[0]->cpid]);
            session(['name'=>$user[0]->cpname]);
            return redirect('cp/index');
        } else {
            return view('cp.login');
        }
    }

    public function code(){
        $code = new \Code;
        $code -> make();
    }

    public function getcode(){
        $code = new \Code;
        echo $code -> get();
    }

    public function crypt(){
        $str = 'eyJpdiI6InJCVnJhbVNnUzdxSUFVT28xQmVxMHc9PSIsInZhbHVlIjoickdjN2VpVlRlclQ0aHprY3M3UEVWdz09IiwibWFjIjoiMWNiZDEwYTE3MWYxNjQ0NmYyZTY0OGY2YWUzYmViMTg5MmNjMWJhZWIzNDZkMmZkMjM3ZDdlMmYxNmJlM2ZkNSJ9';
        echo Crypt::decrypt($str);
    }

    public function quit(){
        session(['role'=>null]);
        session(['userid'=>null]);
        session(['name'=>null]);
        return redirect('cp/login');
    }
}
