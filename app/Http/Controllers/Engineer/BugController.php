<?php

namespace App\Http\Controllers\Engineer;

use App\Http\Model\Bug;
use App\Http\Model\User;
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
//        $bugs = DB::select("select bug.bid,bug.btitle,bug.uid,bug.pid,bug.bdescription,bug.binarydata,bug.binarydata2,bug.btime,bug.status,project.pname,user.username from bug,userproject,user,project where userproject.pid=bug.pid and userproject.uid=:uid and bug.uid=user.uid and project.pid=bug.pid order by bug.btime asc",
//            ['uid'=>session('userid')])->paginate(15);
//        $bugs = DB::table('bug')
//            ->join('project',function($join){
//                $join->on('project.pid', '=', 'bug.pid');
//            })
//            ->join('user',function($join){
//                $join->on('user.uid', '=', 'bug.uid');
//            })
//            ->select('bug.bid','bug.btitle','bug.uid','bug.pid','bug.bdescription','bug.btime','bug.status','project.pname','user.username')
//            ->orderBy('bug.btime','desc')
//            ->paginate(15);
//        return view('engineer.bug.index')->with('data',$bugs);
        $input = Input::all();
        $pid = isset($input['pid']) ? intval($input['pid']):"";
        $uid_tome = isset($input['uid_tome']) ? intval($input['uid_tome']):"";
        $uid_mysub = isset($input['uid_mysub']) ? intval($input['uid_mysub']):"";
        $model = DB::select('select model.model_id,model.model_name from model where model_pid=:pid',['pid'=>session('pid')]);
        $data = DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid'=>session('userid')]);
        return view('engineer.bug.index',compact('data','pid','uid_tome','uid_mysub','model'));
    }
    //post.engineer/bug 添加bug提交
    public function store()
    {
        $input = Input::except('_token');
        $rules = [
            'btitle'=>'required',
        ];
        $message = [
            'btitle.required'=>'bug标题不能为空',
        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator->passes()){
            $re = Bug::create($input);
            if($re){
                return redirect('engineer/bug');
            } else {
                return back()->with('errors','bug添加失败，请稍后再试！');
            }
        } else {
            return back()->withErrors($validator);
        }
    }
    //get.engineer/bug/create   添加bug
    public function create()
    {
        $data =  DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid'=>session('userid')]);
        $model = DB::select('select model.model_id,model.model_name from model where model_pid=:pid',['pid'=>session('pid')]);
        $priority = DB::select('select * from priority');
        $assign = DB::select('select user.uid,user.username from user,userproject where userproject.uid = user.uid and userproject.pid = :pid;',['pid'=>session('pid')]);
        return view('engineer.bug.add',compact('data','model','priority','assign'));
    }
    //get.engineer/bug/{bug}    显示单个bug信息
    public function show($bug_id)
    {
        $field = Bug::find($bug_id);
        $data =  DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid'=>session('userid')]);
        $model = DB::select('select model.model_id,model.model_name from model,bug where bug.pid=model.model_pid and bug.bid=:bid',['bid'=>$bug_id]);
        $priority = DB::select('select * from priority');
        $assign = DB::select('select user.uid,user.username from user,userproject where userproject.uid = user.uid and userproject.pid = (select pid from bug where bid=:bid);',['bid'=>$bug_id]);
        return view('engineer/bug/show', compact('field','data','model','priority','assign'));
    }
    //delete.engineer/bug/{bug}     删除bug
    public function destroy()
    {

    }
    //PUT|PATCH.engineer/bug/{bug}      更新bug
    public function update($bug_id)
    {
        $input = Input::except('_token','_method','uid');
        $temp = DB::table('user')->select('username')->where('uid','=',$input['bug_assign'])->first();
        $input['bug_assignname'] = $temp->username;
        $re = Bug::where('bid',$bug_id)->update($input);
        if($re){
            return redirect('engineer/bug');
        } else {
            return back()->with('errors','bug修改失败，请稍后再试！');
        }
    }
    //get.engineer/bug/{bug}/edit       编辑bug
    public function edit($bug_id)
    {
        $field = Bug::find($bug_id);
        $data =  DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid'=>session('userid')]);
        $model = DB::select('select model.model_id,model.model_name from model,bug where bug.pid=model.model_pid and bug.bid=:bid',['bid'=>$bug_id]);
        $priority = DB::select('select * from priority');
        $assign = DB::select('select user.uid,user.username from user,userproject where userproject.uid = user.uid and userproject.pid = (select pid from bug where bid=:bid);',['bid'=>$bug_id]);
        return view('engineer/bug/edit', compact('field','data','model','priority','assign'));
    }

    public function getbug()
    {
        $uid=session('userid');
        $input = Input::all();
        $pid = isset($input['pid']) ? intval($input['pid']):"";
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        $pname = isset($_POST['pname']) ? strtolower("case_".trim($_POST['pname'])):"";
        $projectid = isset($_POST['projectid']) ? intval($_POST['projectid']):0;
        $isuser = isset($_POST['isuser']) ? intval($_POST['isuser']):0;
        $keyword = isset($_POST['keyword'])? trim($_POST['keyword']):"";
        $model = isset($_POST['model']) ? intval($_POST['model']):0;
        //search query keyword and project user
        $query_keyword = "";
        if($keyword == ""){
            $query_keyword = "";
        } else {
            $arr = preg_split('/[\n\r\t\s]+/i', $keyword);
            for ($i=0;$i<count($arr);$i++){
                $query_keyword = $query_keyword."(bug.btitle like '%$arr[$i]%' or bug.bdescription like '%$arr[$i]%') and ";
            }
        }
        if($input['uid_mysub']!=""){
            $isuser=1;
        }
        $query_user= ($isuser==1)? " and bug.uid="."$uid" : '';
        if (session('pid')!=""){
            $projectid = session('pid');
        }
        if ($projectid !=""){
            $query_project = ($projectid==0)? '' : " and bug.pid="."$projectid";
                if ($projectid!=0){session(['pid'=>$projectid]);}
        } else{
            $query_project = ($pid==0)? '' : " and bug.pid="."$pid";
            if (session('pid')==""){
                session(['pid'=>$pid]);
            }

        }
        $query_assign_to_me = ($input['uid_tome']=="")?'':' and bug.bug_assign='.$input['uid_tome'];
        $query_model = ($model == 0)?'':' and bug.bug_model='.$model;
        include 'conn.php';
        //$rs = mysql_query("select count(*) from case_mmorpg");
        //dd("select bug.bid,bug.btitle,bug.uid,bug.pid,bug.bdescription,bug.binarydata,bug.binarydata2,bug.btime,bug.status,project.pname,user.username from bug, userproject,user,project where ".$query_keyword."userproject.pid=bug.pid and userproject.uid='$uid'".$query_user."$query_project"." and bug.uid=user.uid and project.pid=bug.pid order by bug.btime desc limit $offset,$rows");
        $rs = mysql_query("select count(*) from bug, userproject,user where ".$query_keyword."userproject.pid=bug.pid and userproject.uid='$uid'".$query_user."$query_project".$query_model." and bug.uid=user.uid order by bug.btime asc");
        $row = mysql_fetch_row($rs);
        $result["total"] = $row[0];
        //$rs = mysql_query("select case_mmorpg.cid,cmodel,ccase,cexpect,ctype,cresult,cbug from $pname limit $offset,$rows");
        $rs= mysql_query("select model.model_name,priority.priority_name,bug.bug_assignname,bug.bid,bug.btitle,bug.uid,bug.pid,bug.btime,bug.status,project.pname,user.username from ((bug left join model on model.model_id=bug.bug_model) left join priority on priority.priority_id=bug.bug_priority), userproject,user,project where ".$query_keyword."userproject.pid=bug.pid and userproject.uid='$uid'".$query_user."$query_project"."$query_assign_to_me".$query_model." and bug.uid=user.uid and project.pid=bug.pid order by bug.btime desc limit $offset,$rows");
        $items = array();
        while($row = mysql_fetch_object($rs)){
            array_push($items, $row);
        }
        $result["rows"] = $items;
        echo json_encode($result);
    }

    public function changeprogress()
    {
        $bid = $_POST['bid'];
        $status = $_POST['status'];
        $affect = DB::update('UPDATE bug SET status=? where bid='.$bid,
            array($status));
        if($affect ==1){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }

    public function setSessionPid(){
        $pid = $_POST['pid'];
        session(['pid'=>$pid]);
    }
}
