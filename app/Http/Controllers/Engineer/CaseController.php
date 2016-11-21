<?php

namespace App\Http\Controllers\Engineer;

use App\Http\Model\Project;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CaseController extends CommonController
{
    public function index()
    {
        $data = DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid' => session('userid')]);
        return view('engineer.case', compact('data'));
    }

    public function getcase()
    {
        $uid = session('userid');
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page - 1) * $rows;
        $result = array();
        $projectname =isset($_POST['pname']) ?  DB::table('project')->select('project_name')->where('pname','=',$_POST['pname'])->first()->project_name :"";
        $pname = isset($_POST['pname']) ? strtolower("case_" . trim($projectname)) : "";
        $pid=isset($_POST['pname']) ?  DB::table('project')->select('pid')->where('pname','=',$_POST['pname'])->first()->pid :"";
        if($pid!=""){
            session(['pid'=>$pid]);
        }
        include 'conn.php';
        if ($pname != "") {
            //$rs = mysql_query("select count(*) from case_mmorpg");
            $rs = mysql_query("select count(*) from $pname");
            $row = mysql_fetch_row($rs);
            $result["total"] = $row[0];
            //$rs = mysql_query("select case_mmorpg.cid,cmodel,ccase,cexpect,ctype,cresult,cbug from $pname limit $offset,$rows");
            $rs = @mysql_query("select $pname.cid,$pname.ccase, $pname.cexpect, $pname.ctype, $pname.cresult,$pname.cmodel ,$pname.cbug , user.username  from  $pname left join user on user.uid=$pname.case_uid  limit $offset,$rows");
            $items = array();
            while ($row = mysql_fetch_object($rs)) {
                array_push($items, $row);
            }
            $result["rows"] = $items;
            echo json_encode($result);
        } else {
            if (session('pid')!=""){
                $pid = session('pid');
                $projectname =DB::table('project')->select('project_name')->where('pid','=',$pid)->first()->project_name;
                $pname = strtolower("case_" . trim($projectname));
                //$rs = mysql_query("select count(*) from case_mmorpg");
                $rs = mysql_query("select count(*) from $pname");
                $row = mysql_fetch_row($rs);
                $result["total"] = $row[0];
                //$rs = mysql_query("select case_mmorpg.cid,cmodel,ccase,cexpect,ctype,cresult,cbug from $pname limit $offset,$rows");
                $rs = @mysql_query("select $pname.cid,$pname.ccase, $pname.cexpect, $pname.ctype, $pname.cresult,$pname.cmodel ,$pname.cbug , user.username  from  $pname left join user on user.uid=$pname.case_uid  limit $offset,$rows");
                $items = array();
                while ($row = mysql_fetch_object($rs)) {
                    array_push($items, $row);
                }
                $result["rows"] = $items;
                echo json_encode($result);
            } else {
                $result["total"] = 0;
                $result["rows"] = "";
                echo json_encode($result);}
        }
    }

    public function updatestatus()
    {
        $uid = session('userid');
        $cid = intval($_REQUEST['cid']);
        $cresult = $_REQUEST['cresult'];
        $cbug = $_REQUEST['cbug'];
        $pid = session('pid');
        $projectname = DB::table('project')->select('project_name')->where('pid','=',$pid)->first()->project_name;
        $case_table = strtolower("case_" . trim($projectname));
        $affect = DB::update('UPDATE '.$case_table.' SET cresult=?, cbug=? where cid=?',
            array($cresult,$cbug,$cid));
        if($affect ==1){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }

    public function getbugdetail()
    {
        $bid = isset($_POST['bid']) ? trim($_POST['bid']):"";
        include('conn.php');
        $items=array();
        $rs=mysql_query("select bid,pid,uid,btitle,bdescription,uid,binarydata,binarydata2 from bug where bid=$bid");
        while($row=mysql_fetch_object($rs)){
            array_push($items , $row);
        }
        $result['rows']=$items;
        if(count($items)==0){
            echo "$.messager.show({
			title: '错误！',
			msg: '此bug不存在'
		});return;";
        } else {
            echo json_encode($result);}
    }
}
