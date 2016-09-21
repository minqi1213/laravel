<?php

namespace App\Http\Controllers\Engineer;

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
        $pname = isset($_POST['pname']) ? strtolower("case_" . trim($_POST['pname'])) : "";
        include 'conn.php';
        if ($pname != "") {
            //$rs = mysql_query("select count(*) from case_mmorpg");
            $rs = mysql_query("select count(*) from usercase left join $pname on usercase.cid=$pname.cid where usercase.uid=$uid");
            $row = mysql_fetch_row($rs);
            $result["total"] = $row[0];
            //$rs = mysql_query("select case_mmorpg.cid,cmodel,ccase,cexpect,ctype,cresult,cbug from $pname limit $offset,$rows");
            $rs = @mysql_query("select usercase.cid,usercase.pid,usercase.cmodel,$pname.ccase, $pname.cexpect, $pname.ctype, usercase.cresult,usercase.cbug from usercase left join $pname on usercase.cid=$pname.cid where usercase.uid=$uid limit $offset,$rows");
            $items = array();
            while ($row = mysql_fetch_object($rs)) {
                array_push($items, $row);
            }
            $result["rows"] = $items;
            echo json_encode($result);
        } else {
            $result["total"] = 0;
            $result["rows"] = "";
            echo json_encode($result);
        }
    }

    public function updatestatus()
    {
        $uid = session('userid');
        $cid = intval($_REQUEST['cid']);
        $cresult = $_REQUEST['cresult'];
        $cbug = $_REQUEST['cbug'];
        $pid = intval($_REQUEST['pid']);

        $affect = DB::update('UPDATE usercase SET cresult=?, cbug=? where cid=? and pid=? and uid=?',
            array($cresult,$cbug,$cid,$pid,$uid));
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
