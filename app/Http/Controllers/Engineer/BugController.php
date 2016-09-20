<?php

namespace App\Http\Controllers\Engineer;

use App\Http\Model\Bug;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class BugController extends CommonController
{
    public function index()
    {
        $data = DB::select('select project.pid,project.pname from project,userproject where userproject.uid=:uid and userproject.status=1 and userproject.pid=project.pid',
            ['uid'=>session('userid')]);
        return view('engineer.bug',compact('data'));
    }

    public function getbug()
    {
        $uid=session('userid');
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();
        $pname = isset($_POST['pname']) ? strtolower("case_".trim($_POST['pname'])):"";
        $projectid = isset($_POST['projectid']) ? intval($_POST['projectid']):0;
        $isuser = isset($_POST['isuser']) ? intval($_POST['isuser']):0;
        $keyword = isset($_POST['keyword'])? trim($_POST['keyword']):"";

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
        $query_user= ($isuser==1)? " and bug.uid="."$uid" : '';
        $query_project = ($projectid==0)? '' : " and bug.pid="."$projectid";
        include 'conn.php';
        //$rs = mysql_query("select count(*) from case_mmorpg");
        $rs = mysql_query("select count(*) from bug, userproject,user where ".$query_keyword."userproject.pid=bug.pid and userproject.uid='$uid'".$query_user."$query_project"." and bug.uid=user.uid order by bug.btime asc");
        $row = mysql_fetch_row($rs);
        $result["total"] = $row[0];
        //$rs = mysql_query("select case_mmorpg.cid,cmodel,ccase,cexpect,ctype,cresult,cbug from $pname limit $offset,$rows");
        $rs= mysql_query("select bug.bid,bug.btitle,bug.uid,bug.pid,bug.bdescription,bug.binarydata,bug.binarydata2,bug.btime,project.pname,user.username from bug, userproject,user,project where ".$query_keyword."userproject.pid=bug.pid and userproject.uid='$uid'".$query_user."$query_project"." and bug.uid=user.uid and project.pid=bug.pid order by bug.btime asc limit $offset,$rows");
        $items = array();
        while($row = mysql_fetch_object($rs)){
            array_push($items, $row);
        }
        $result["rows"] = $items;
        echo json_encode($result);
    }

    public function savebug()
    {
//        $input = Input::all();
        $userid =session('userid');
        $bproject = $_POST['projectselect_newbug'];
        $btitle = $_POST['btitle'];
        $bdescription = $_POST['bdescription'];
        $str_file1 = $_POST['photo1'];
        $str_file2 = $_POST['photo2'];
        $str_file1 = ($str_file1!=NULL)?$str_file1:"";
        $str_file2 = ($str_file2!=NULL)?$str_file2:"";
//        include('conn.php');
//        $sql = "INSERT INTO bug(uid,pid,btitle,bdescription,type,binarydata,binarydata2)VALUES('$userid','$bproject','$btitle','$bdescription','','$str_file1','$str_file2')";
//        $result = @mysql_query($sql);
//        if ($result){
//            echo json_encode(array('success'=>true));
//        } else {
//            echo json_encode(array('msg'=>'Some errors occured.'));
//        }
        $affect = DB::insert('INSERT INTO bug(uid,pid,btitle,bdescription,binarydata,binarydata2) values (?, ?, ?, ?, ?, ? )',
            [$userid,$bproject,$btitle,$bdescription,$str_file1,$str_file2]);
        if($affect ==1){
            echo json_encode(array('success'=>true));
        } else {
            echo json_encode(array('msg'=>'Some errors occured.'));
        }
    }
}
