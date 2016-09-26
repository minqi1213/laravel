<?php

namespace App\Http\Controllers\Cp;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function upload()
    {
        $file = Input::file('Filedata');
        if($file -> isValid()){
            $realPath = $file -> getRealPath(); //临时文件的绝对路径
            $extension = $file -> getClientOriginalExtension(); //上传文件的后缀
            $newName = date('YmdHis').mt_rand(100,999).'.'.$extension;
            $path = $file -> move(base_path().'/applications', $newName);
            $filePath = 'applications/'.$newName;
            return $filePath;
        }
    }
}
