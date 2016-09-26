<?php

namespace App\Http\Controllers\Cp;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class MissionController extends CommonController
{
    public function index()
    {
        return view('cp.mission');
    }

    public function getmission()
    {
        $uid = session('userid');
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        include 'conn.php';
        //$rs = mysql_query("select count(*) from case_mmorpg");
        $rs = mysql_query("select count(*) from project where cpid='$uid'");
        $row = mysql_fetch_row($rs);
        $result["total"] = $row[0];
        //$rs = mysql_query("select case_mmorpg.cid,cmodel,ccase,cexpect,ctype,cresult,cbug from $pname limit $offset,$rows");
        $rs= mysql_query("select * from project where cpid='$uid' limit $offset,$rows");
        $items = array();
        while($row = mysql_fetch_object($rs)){
            array_push($items, $row);
        }
        $result["rows"] = $items;
        echo json_encode($result);
    }

    public function savemission()
    {
        $userid = session('userid');
        $mtitle = ($_POST['pname']);
        $mdescription = ($_POST['pdescription']);
        $str_file = $_POST['application'];
        $str_file = ($str_file!=NULL)?$str_file:"";
        $affect = DB::insert('INSERT INTO project(cpid,pname,pdescription,binarydata) values (?, ?, ?, ? )',
            [$userid,$mtitle,$mdescription,$str_file]);
        if($affect ==1){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }

    public function savechange()
    {
        $userid = session('userid');
        $pid = $_POST['pid'];
        $mtitle = ($_POST['pname']);
        $mdescription = ($_POST['pdescription']);
        $str_file = $_POST['application'];
        $str_file = ($str_file!=NULL)?$str_file:"";
        $affect = DB::update('UPDATE project SET cpid=?,pname=?,pdescription=?,binarydata=? where pid=?',
            array($userid,$mtitle,$mdescription,$str_file, $pid));
        if($affect ==1){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }
}
