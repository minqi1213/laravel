<?php

namespace App\Http\Controllers\Engineer;

use App\Http\Model\Bug;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class BugController extends CommonController
{
    //get.engineer/bug   全部bug列表
    public function index()
    {
//        $bugs = Bug::all();
        $bugs = DB::select("select bug.bid,bug.btitle,bug.uid,bug.pid,bug.bdescription,bug.binarydata,bug.binarydata2,bug.btime,bug.status,project.pname,user.username from bug,userproject,user,project where userproject.pid=bug.pid and userproject.uid=:uid and bug.uid=user.uid and project.pid=bug.pid order by bug.btime asc",
            ['uid'=>session('userid')]);
        return view('engineer.bug.index')->with('data',$bugs);
    }
    //post.engineer/bug 添加bug提交
    public function store()
    {
        $input = Input::all();
        dd($input);
        $rules = [
            'btitle'=>'required',
        ];
        $message = [
            'btitle.required'=>'bug标题不能为空',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){

        } else {
            return back()->withErrors($validator);
        }
    }
    //get.engineer/bug/create   添加bug
    public function create()
    {
        $data =  DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid'=>session('userid')]);
        return view('engineer.bug.add',compact('data'));
    }
    //get.engineer/bug/{bug}    显示单个bug信息
    public function show()
    {
        
    }
    //delete.engineer/bug/{bug}     删除bug
    public function destroy()
    {

    }
    //PUT|PATCH.engineer/bug/{bug}      更新bug
    public function update()
    {

    }
    //get.engineer/bug/{bug}/edit       编辑bug
    public function edit()
    {

    }
}
