<?php

namespace App\Http\Controllers\Engineer;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MissionController extends CommonController
{
    public function index()
    {
        return view('engineer.mission');
    }

    public function getmission()
    {
        $uid=session('userid');
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        include 'conn.php';
        //$rs = mysql_query("select count(*) from case_mmorpg");
        $rs = mysql_query("select count(*) from project left join userproject on project.pid = userproject.pid and userproject.uid='$uid'");
        $row = mysql_fetch_row($rs);
        $result["total"] = $row[0];
        //$rs = mysql_query("select case_mmorpg.cid,cmodel,ccase,cexpect,ctype,cresult,cbug from $pname limit $offset,$rows");
        $rs= mysql_query("select project.pid, project.pname, project.ptime, userproject.status, userproject.status, project.pid,project.pdescription,project.binarydata from project left join userproject on project.pid = userproject.pid and userproject.uid='$uid' limit $offset,$rows");
        $items = array();
        while($row = mysql_fetch_object($rs)){
            array_push($items, $row);
        }
        $result["rows"] = $items;
        echo json_encode($result);
    }

    public function acceptmission()
    {
        $uid=session('userid');
        $pid = intval($_REQUEST['pid']);

        $affect = DB::insert('INSERT INTO userproject(uid,pid,status) values (?, ?, 1)',
            [$uid,$pid]);
        if($affect ==1){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }
}
