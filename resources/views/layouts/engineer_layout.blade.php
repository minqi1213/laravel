<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/engineer/style/css/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/engineer/style/css/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/engineer/style/css/demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/org/uploadify/uploadify.css')}}">
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery.easyui.min.js')}}"></script>
    <script src="{{asset('resources/org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
    <style type="text/css">
        #fm {
            margin: 0;
            padding: 10px 30px;
        }

        .ftitle {
            font-size: 14px;
            font-weight: bold;
            color: #666;
            padding: 5px 0;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
        }

        .fitem {
            margin-bottom: 5px;
        }

        .fitem label {
            display: inline-block;
            width: 80px;
        }

        h1 {
            color: white;
            font-size: 24pt;
            text-align: center;
            font-family: arial, sans-serif
        }

        .menu_header {
            color: white;
            font-size: 12pt;
            text-align: center;
            font-family: arial, sans-serif;
            font-weight: bold
        }

        .label_header {
            background: black
        }

        p {
            color: black;
            font-size: 12pt;
            text-align: justify;
            font-family: arial, sans-serif
        }

        p.foot {
            color: white;
            font-size: 9pt;
            text-align: center;
            font-family: arial, sans-serif;
            font-weight: bold
        }

        a.menu_a:link, a.menu_a:visited, a.menu_a:active {
            color: white
        }

        fieldset {
            width: 90%;
            margin: 0 auto;
        }

        legend {
            font-weight: bold;
            font-size: 14px;
        }

        .uploadify {
            display: inline-block
        }

        .uploadify-button {
            border: none;
            border-radius: 5px;
            margin-top: 8px;
        }

        table.add_tab tr td span.uploadify-button-text {
            color: #FFF;
            margin: 0;
        }
    </style>

</head>
<body>
@yield('content')
<!-- Dailog for create new bug-->
<div id="dlg_displaybug" class="easyui-dialog" style="width:75%;height:500px;left:15%;top:10%;padding:10px 20px"
     closed="true" buttons="#dlg-buttons-display" data-options="
		toolbar: [{
					text:'编辑',
					id:'edit_bug_toolbar',
					iconCls:'icon-edit',
					handler:function(){
						editBug()
					}
				}]
	">

    <div class="ftitle">bug详情</div>
    <div id="progress_1" class="fitem" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(1)">开始流程</a>
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(2)">无效问题/暂不修复</a>
    </div>
    <div id="progress_2" class="fitem" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(0)">停止流程</a>
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(2)">解决问题</a>
    </div>
    <div id="progress_3" class="fitem" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(3)">RBT测试</a>
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(0)">重新打开问题</a>
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(6)">无效问题</a>
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(7)">暂不修复</a>
    </div>
    {{--<div id="mm1" style="width:100px;">--}}
        {{--<div><a onclick="javascript:changeProgress(6)">Invalid Issue</a></div>--}}
        {{--<div><a onclick="javascript:changeProgress(7)">Don't Fix Now</a></div>--}}
    {{--</div>--}}
    <div id="progress_4" class="fitem" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(4)">回归测试</a>
    </div>
    <div id="progress_5" class="fitem" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(5)">关闭问题</a>
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(0)">重新打开问题</a>
    </div>
    <div id="progress_6" class="fitem" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(0)">重新打开问题</a>
    </div>
    <div id="progress_7" class="fitem" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true" onclick="javascript:changeProgress(1)">开始流程</a>
    </div>
    <form id="fm_displaybug" method="post" enctype="multipart/form-data" novalidate>
        <div class="fitem">
            <label>请选择项目:</label>
            <select id="projectselect_displaybug" name="projectselect_displaybug" disabled="disabled"
                    data-options="required:true" class="easyui-combobox" panelHeight="auto" style="width:100px">
                @if(isset($data))
                @foreach($data as $d)
                    echo "
                    <option value="{{$d->pid}}">{{$d->pname}}</option>";
                @endforeach
                @endif
            </select>
            <label>&nbsp;&nbsp;&nbsp;&nbsp;状态:</label>
            <label><div id="bug_status_dlg"></div></label>

        </div>
        <div class="fitem">
            <label>bug编号:</label>
            <input id="bid_display" name="bid" class="easyui-textbox" style="width:90%;resize:none;" readOnly=true
                   data-options="required:true"/>
        </div>
        <div class="fitem">
            <label>bug标题:</label>
            <input id="btitle_display" name="btitle" class="easyui-textbox" style="width:90%;resize:none;"
                   data-options="required:true"/>
        </div>
        <div class="fitem">
            <label>bug详情:</label>
            <textarea id="bdescription_display" name="bdescription" class="easyui-textbox"
                      data-options="multiline:true,required:true"
                      style="width:90%;height:300px;resize:none;"></textarea>
        </div>
        <br><br>
        <div id="filearea_display">
            <div style="margin-bottom:20px">
                <div>截图1:</div>
                <input name="photo1" class="easyui-textbox" size="50" type="text" readOnly="true"
                       data-options="prompt:'选择一张截图...'"/>
                <input id="file_upload_edit" name="file_upload_edit" type="file" multiple="true">
                <img id="display_edit_photo1" name="edit_photo1" width="40%" src="" onclick="javascript:showImg(src)"
                     style="display:none;">
                {{--<input class="easyui-filebox" name="photo1" data-options="prompt:'选择一张截图...'" style="width:90%">--}}
            </div>
            <div style="margin-bottom:20px">
                <div>截图2:</div>
                <input name="photo2" class="easyui-textbox" size="50" type="text" readOnly="true"
                       data-options="prompt:'选择一张截图...'"/>
                <input id="file_upload_2_edit" name="file_upload_2_edit" type="file" multiple="true">
                <img id="display_edit_photo2" name="edit_photo1" width="40%" src="" onclick="javascript:showImg(src)"
                     style="display:none;">
                {{--<input class="easyui-filebox" name="photo2" data-options="prompt:'选择一张截图...'" style="width:90%">--}}
            </div>
        </div>
        <div id="imgarea_display">
            <div style="width:100%">
                <div id="display_photo1_div" style="margin-bottom:20px;width:50%;float:left">
                    <div>截图1:</div>
                    <img id="display_photo1" name="display_photo1" width="90%" src="" onclick="javascript:showImg(src)">
                </div>
                <div id="display_photo2_div" style="margin-bottom:20px;width:50%;float:left">
                    <div>截图2:</div>
                    <img id="display_photo2" name="display_photo2" width="90%" src="" onclick="javascript:showImg(src)">
                </div>
            </div>
        </div>
    </form>
</div>
<div id="dlg-buttons-display">
    <a id="savebtn_editbug" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveChange()">保存</a>
    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel"
       onclick="javascript:$('#dlg_displaybug').dialog('close');">取消</a>
</div>

<div id="dlg_displayimg" class="easyui-window" title="截图浏览" data-options="modal:true,closed:true"
     style="top:10px;width:100%;padding:10px;"
     closed="true">
    <img id="display_img" name="display_img" width="100%" src="">
</div>
</body>
<script type="text/javascript">
    var url;
    var bid;
    function newBug() {
        $('#dlg_newbug').dialog('open').dialog('setTitle', '新建bug');
        $('#fm_newbug').form('clear');
        $('#fm_newbug').form('load', {
            bdescription: '前提条件：\n\n复现步骤：\n	1.\n	2.\n	3.\n测试结果：\n\n期待结果：\n\n复现率：\n\n备注：\n\n设备信息：\n	设备：\n	系统版本：\nBug优先级：\n'
        });
        $('#edit_photo1').attr('src', '');
        $('#edit_photo1').attr('style', 'display:none;');
        $('#edit_photo2').attr('src', '');
        $('#edit_photo2').attr('style', 'display:none;');
        url = '{{url('engineer/savebug')}}?_token={{csrf_token()}}';
    }
    function showBug(bid) {
        url = "{{url('engineer/getbugdetail')}}?_token={{csrf_token()}}";
        var postStr = "bid=" + bid;
        //alert(postStr);
        var ajax = false;
        //开始初始化XMLHttpRequest对象
        if (window.XMLHttpRequest) { //Mozilla 浏览器
            ajax = new XMLHttpRequest();
            if (ajax.overrideMimeType) {//设置MiME类别
                ajax.overrideMimeType("text/xml");
            }
        }
        else if (window.ActiveXObject) { // IE浏览器
            try {
                ajax = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    ajax = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                }
            }
        }
        if (!ajax) { // 异常，创建对象实例失败
            window.alert("不能创建XMLHttpRequest对象实例.");
            return false;
        }
        //通过Post方式打开连接
        ajax.open("POST", url, true);
        //定义传输的文件HTTP头信息
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //发送POST数据
        ajax.send(postStr);
        //获取执行状态
        ajax.onreadystatechange = function () {
            //如果执行状态成功，那么就把返回信息写到指定的层里
            //alert(ajax.status);
            if (ajax.readyState == 4 && ajax.status == 200) {
                //alert(ajax.responseText);
                var rows = ajax.responseText;
                rows = JSON.parse(rows);
                $('#dlg_displaybug').dialog('open').dialog('setTitle', 'bug详情');
                $('#fm_displaybug').form('clear');
                $('#btitle_display').textbox('readonly', true);
                $('#bdescription_display').textbox('readonly', true);
                $('#imgarea_display').css('display', 'block');
                $('#filearea_display').css('display', 'none');
                $('#dlg-buttons-display').css('display', 'none');
                $('#fm_displaybug').form('load', rows.rows[0]);
                $('#projectselect_displaybug').combobox('setValue', rows.rows[0].pid);
                $('#projectselect_displaybug').combobox('disable');
                var userid = '{{session('userid')}}';
                if (userid != rows.rows[0].uid) {
                    $("div.dialog-toolbar [id='edit_bug_toolbar']").eq(0).hide();
                } else {
                    $("div.dialog-toolbar [id='edit_bug_toolbar']").eq(0).show();
                }
                row=rows.rows[0];
                if (row.binarydata == "") {
                    document.getElementById('display_photo1_div').style.display = "none";
                    $('#display_photo1').attr('src', "");
                    $('#fm_displaybug').form('load', {
                        photo1: ""
                    });
                    $('#display_edit_photo1').attr('src', '');
                    $('#display_edit_photo1').attr('style', 'display:none;');
                } else {
                    document.getElementById('display_photo1_div').style.display = "block";
                    $('#display_photo1').attr('src', '/' + row.binarydata);
                    $('#fm_displaybug').form('load', {
                        photo1: row.binarydata
                    });
                    $('#display_edit_photo1').attr('src', '/' + row.binarydata);
                    $('#display_edit_photo1').attr('style', 'display:block;');
                }
                if (row.binarydata2 == "") {
                    document.getElementById('display_photo2_div').style.display = "none";
                    $('#display_photo2').attr('src', "");
                    $('#fm_displaybug').form('load', {
                        photo2: ""
                    });
                    $('#display_edit_photo2').attr('src', '');
                    $('#display_edit_photo2').attr('style', 'display:none;');
                } else {
                    document.getElementById('display_photo2_div').style.display = "block";
                    $('#display_photo2').attr('src', '/' + row.binarydata2);
                    $('#fm_displaybug').form('load', {
                        photo2: row.binarydata2
                    });
                    $('#display_edit_photo2').attr('src', '/' + row.binarydata2);
                    $('#display_edit_photo2').attr('style', 'display:block;');
                }
            }
        }

    }
    function displayBug(index) {
        $('#dg_bug').datagrid('selectRow', index);
        $('#btitle_display').textbox('readonly', true);
        $('#bdescription_display').textbox('readonly', true);
        $('#imgarea_display').css('display', 'block');
        $('#filearea_display').css('display', 'none');
        $('#dlg-buttons-display').css('display', 'none');
        var row = $('#dg_bug').datagrid('getSelected');
        if (row) {
            $('#dlg_displaybug').dialog('open').dialog('setTitle', 'bug详情');
            $('#fm_displaybug').form('clear');
            $('#fm_displaybug').form('load', row);
            $('#projectselect_displaybug').combobox('setValue', row.pid);
            $('#projectselect_displaybug').combobox('disable');
            bid = row.bid;
            showProgressBar(row.status);
            $("#bug_status_dlg").empty();
            $('<div</div>').html((rowformatter_bugstatus(row.status))).appendTo($('#bug_status_dlg'));
            var userid = '{{session('userid')}}';
            if (userid != row.uid) {
                $("div.dialog-toolbar [id='edit_bug_toolbar']").eq(0).hide();
            } else {
                $("div.dialog-toolbar [id='edit_bug_toolbar']").eq(0).show();
            }
            if (row.binarydata == "") {
                document.getElementById('display_photo1_div').style.display = "none";
                $('#display_photo1').attr('src', "");
                $('#fm_displaybug').form('load', {
                    photo1: ""
                });
                $('#display_edit_photo1').attr('src', '');
                $('#display_edit_photo1').attr('style', 'display:none;');
            } else {
                document.getElementById('display_photo1_div').style.display = "block";
                $('#display_photo1').attr('src', '/' + row.binarydata);
                $('#fm_displaybug').form('load', {
                    photo1: row.binarydata
                });
                $('#display_edit_photo1').attr('src', '/' + row.binarydata);
                $('#display_edit_photo1').attr('style', 'display:block;');
            }
            if (row.binarydata2 == "") {
                document.getElementById('display_photo2_div').style.display = "none";
                $('#display_photo2').attr('src', "");
                $('#fm_displaybug').form('load', {
                    photo2: ""
                });
                $('#display_edit_photo2').attr('src', '');
                $('#display_edit_photo2').attr('style', 'display:none;');
            } else {
                document.getElementById('display_photo2_div').style.display = "block";
                $('#display_photo2').attr('src', '/' + row.binarydata2);
                $('#fm_displaybug').form('load', {
                    photo2: row.binarydata2
                });
                $('#display_edit_photo2').attr('src', '/' + row.binarydata2);
                $('#display_edit_photo2').attr('style', 'display:block;');
            }
        }
    }
    function showProgressBar(status) {
        $('#progress_1').attr('style', 'display:none;');
        $('#progress_2').attr('style', 'display:none;');
        $('#progress_3').attr('style', 'display:none;');
        $('#progress_4').attr('style', 'display:none;');
        $('#progress_5').attr('style', 'display:none;');
        $('#progress_6').attr('style', 'display:none;');
        $('#progress_7').attr('style', 'display:none;');
        if(status == 0){
            $('#progress_1').attr('style', 'display:block;');
        } else if(status == 1){
            $('#progress_2').attr('style', 'display:block;');
        } else if(status == 2){
            $('#progress_3').attr('style', 'display:block;');
        } else if(status == 3){
            $('#progress_4').attr('style', 'display:block;');
        } else if(status == 4){
            $('#progress_5').attr('style', 'display:block;');
        } else if(status == 5){
            $('#progress_6').attr('style', 'display:block;');
        } else if(status == 6){
            $('#progress_6').attr('style', 'display:block;');
        } else if(status == 7){
            $('#progress_7').attr('style', 'display:block;');
        }
    }

    function changeProgress(statusid) {
        url = "{{url('engineer/changeprogress')}}?_token={{csrf_token()}}";
        var postStr = "bid=" + bid + "&status=" + statusid;
        //alert(postStr);
        var ajax = false;
        //开始初始化XMLHttpRequest对象
        if (window.XMLHttpRequest) { //Mozilla 浏览器
            ajax = new XMLHttpRequest();
            if (ajax.overrideMimeType) {//设置MiME类别
                ajax.overrideMimeType("text/xml");
            }
        }
        else if (window.ActiveXObject) { // IE浏览器
            try {
                ajax = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    ajax = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {
                }
            }
        }
        if (!ajax) { // 异常，创建对象实例失败
            window.alert("不能创建XMLHttpRequest对象实例.");
            return false;
        }
        //通过Post方式打开连接
        ajax.open("POST", url, true);
        //定义传输的文件HTTP头信息
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //发送POST数据
        ajax.send(postStr);
        //获取执行状态
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                $('#dg_bug').datagrid('reload');    // reload the bug data
                showProgressBar(statusid);
                //$('#bug_status_dlg').append(rowformatter_bugstatus(statusid).html());
                $("#bug_status_dlg").empty();
                $('<div</div>').html((rowformatter_bugstatus(statusid))).appendTo($('#bug_status_dlg'));
            }
        }
    }

    function editBug() {


        $('#projectselect_displaybug').combobox('enable');
        $('#btitle_display').textbox('readonly', false);
        $('#bdescription_display').textbox('readonly', false);
        $('#imgarea_display').css('display', 'none');
        $('#filearea_display').css('display', 'block');
        $('#dlg-buttons-display').css('display', 'block');
        $('#savebtn_editbug').linkbutton('enable');
        url = '{{url('engineer/savechange')}}?_token={{csrf_token()}}';
    }
    function showImg(src) {
        $('#dlg_displayimg').window('open');
        $('#display_img').attr('src', '');
        $('#display_img').attr('src', src);
    }
    function editCase() {
        var row = $('#dg').datagrid('getSelected');
        if (row) {
            $('#dlg').dialog('open').dialog('setTitle', '执行用例');
            $('#fm').form('load', row);
            $('#cstatus').val(row.cstatus);
            url = '{{url('engineer/updatestatus')}}?_token={{csrf_token()}}&cid=' + row.cid + '&pid=' + row.pid;
        }
    }
    function saveStatus() {
        $('#fm').form('submit', {
            url: url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                result = result.substring(result.indexOf('{'), result.indexOf('}') + 1);
                var result = eval('(' + result + ')');
                if (result.success) {
                    $('#dlg').dialog('close');		// close the dialog
//                    $('#dg').datagrid('reload');	// reload the user data
                    $('#dg').datagrid('reload');
                    editIndex = undefined;
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
            }
        });
    }
    function saveBug() {
        $('#savebtn_newbug').linkbutton("disable");
        $('#fm_newbug').form('submit', {
            url: url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                result = result.substring(result.indexOf('{'), result.indexOf('}') + 1);
                var result = eval('(' + result + ')');
                if (result.success) {
                    $('#dlg_newbug').dialog('close');              // close the dialog
                    $('#dg_bug').datagrid('reload');    // reload the user data
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
                $('#savebtn_newbug').linkbutton("enable");
            }
        });
    }
    function saveChange() {
        $('#savebtn_editbug').linkbutton("disable");
        $('#fm_displaybug').form('submit', {
            url: url,
            onSubmit: function () {
                return $(this).form('validate');
            },
            success: function (result) {
                result = result.substring(result.indexOf('{'), result.indexOf('}') + 1);
                var result = eval('(' + result + ')');
                if (result.success) {
                    $('#dlg_displaybug').dialog('close');              // close the dialog
                    $('#dg_bug').datagrid('reload');    // reload the user data
                    $('#dg').datagrid('reload');
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
                $('#savebtn_editbug').linkbutton("enable");
            }
        });
    }

    function acceptMission(pid) {
        $('#fm_accept').form('clear');
        $('#fm_accept').form('load', {
            pid: pid
        });
        url = '{{url('engineer/acceptmission')}}?_token={{csrf_token()}}';
        $('#fm_accept').form('submit', {
            url: url,
            onSubmit: function () {
                return $(this).form('enableValidation').form('validate');
            },
            success: function (result) {
                result = result.substring(result.indexOf('{'), result.indexOf('}') + 1);
                var result = eval('(' + result + ')');
                if (result.success) {
                    $.messager.show({
                        title: '提示',
                        msg: '任务领取成功，请等待审核'
                    });
                    $('#dg_mission').datagrid('reload');	// reload the user data
                } else {
                    $.messager.show({
                        title: 'Error',
                        msg: result.msg
                    });
                }
            }
        });
    }
    function displayMission(index) {
        $('#dg_mission').datagrid('selectRow', index);
        var row = $('#dg_mission').datagrid('getSelected');
        if (row) {
            $('#dlg_mission').dialog('open').dialog('setTitle', '任务详情');
            $('#fm_mission').form('clear');
            $('#fm_mission').form('load', row);
            if ((row.status == 1) && (row.binarydata !== "")) {
                document.getElementById('pdownload').style.display = "block";
                $('#download_link').attr("href", '/'+row.binarydata);
            } else {
                document.getElementById('pdownload').style.display = "none";
                $('#download_link').attr("href", '');
            }
        }
    }
    function rowformatter(value, row, index) {
        //return "<a href='detail.php?id="+value+"' target='_blank' >"+value+"</a>";
        return "<div><a href=\"/engineer/bug/"+value+"\" class=\"easyui-linkbutton\" plain=\"true\" >" + value + "</a></div>";
    }
    function rowformatter_buglist(value, row, index) {
        //return "<a href='detail.php?id="+value+"' target='_blank' >"+value+"</a>";
        return "<div><a href=\"#\" class=\"easyui-linkbutton\" plain=\"true\" onclick=\"displayBug('" + index + "')\">" + value + "</a></div>";
    }

    function rowformatter_bugstatus(val, row, index){
        if (val == '0') {
            return '<span style="color:darkblue;">开始</span>';
        } else if (val == '1') {
            return '<span style="color:orange;">进行中</span>';
        } else if (val == '2') {
            return '<span style="color:orange;">待验证</span>';
        } else if (val == '3') {
            return '<span style="color:orange;">RBT</span>';
        } else if (val == '4') {
            return '<span style="color:orange;">待回归</span>';
        } else if (val == '5') {
            return '<span style="color:forestgreen;">关闭</span>';
        } else if (val == '6') {
            return '<span style="color:forestgreen;">无效问题</span>';
        } else if (val == '7') {
            return '<span style="color:forestgreen;">暂不修复</span>';
        } else {
            return "未知状态";
        }
    }

    function formatResult(val, row) {
        if (val == '2') {
            return '<span style="color:red;">失败</span>';
        } else if (val == '1') {
            return '<span style="color:green;">通过</span>';
        } else {
            return "未执行";
        }
    }
    function rowformatter_pstatus(val, row) {
        if (val == '1') {
            return '审核中';
        } else if (val == '2') {
            return '已接取';
        } else {
            return '未接取';
        }
    }
    function rowformatter_paccept(value, rowData, rowIndex) {
        if (rowData.status == '1' || rowData.status == '2') {
            return '已操作完成';
        } else {
            return "<div><a href=\"#\" class=\"easyui-linkbutton\" plain=\"true\" onclick=\"acceptMission('" + rowData.pid + "')\">接取</a></div>";
        }
    }
    function rowformatter_pinfo(value, row, index) {
        return "<div><a href=\"#\" class=\"easyui-linkbutton\" plain=\"true\" onclick=\"displayMission('" + index + "')\">任务详情</a></div>";
    }
    function loadDataGridWithParam() {
        $('#dg').datagrid({
            pageSize: 50,
            pageList: [50, 100, 150],
            queryParams: {
                pname: $('#projectselect').combobox('getText')
            }
        });

    }
    function loadDataGridBugWithParam() {
        $('#dg_bug').datagrid({
            queryParams: {
                projectid: $('#projectselect_bug').combobox('getValue'),
                isuser: $('#projectselect_user').combobox('getValue'),
                keyword: $('#projectselect_input').val()
            }
        });
    }

    <?php $timestamp = time();?>
		$(function () {
        $('#file_upload').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                '_token': '{{csrf_token()}}'
            },
            'buttonText': '图片上传',
            'swf': "{{asset('resources/org/uploadify/uploadify.swf')}}",
            'uploader': "{{url('engineer/upload')}}",
            'onUploadSuccess': function (file, data, response) {
//                $('#photo1_name').val(data);
                $('#fm_newbug').form('load', {
                    photo1: data
                });
                $('#edit_photo1').attr('src', '/' + data);
                $('#edit_photo1').attr('style', 'display:block;');
            }
        });
    });
    $(function () {
        $('#file_upload_2').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                '_token': '{{csrf_token()}}'
            },
            'buttonText': '图片上传',
            'swf': "{{asset('resources/org/uploadify/uploadify.swf')}}",
            'uploader': "{{url('engineer/upload')}}",
            'onUploadSuccess': function (file, data, response) {
//                $('#photo1_name').val(data);
                $('#fm_newbug').form('load', {
                    photo2: data
                });
                $('#edit_photo2').attr('src', '/' + data);
                $('#edit_photo2').attr('style', 'display:block;');
            }
        });
    });
    $(function () {
        $('#file_upload_edit').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                '_token': '{{csrf_token()}}'
            },
            'buttonText': '图片上传',
            'swf': "{{asset('resources/org/uploadify/uploadify.swf')}}",
            'uploader': "{{url('engineer/upload')}}",
            'onUploadSuccess': function (file, data, response) {
//                $('#photo1_name').val(data);
                $('#fm_displaybug').form('load', {
                    photo1: data
                });
                $('#display_edit_photo1').attr('src', '/' + data);
                $('#display_edit_photo1').attr('style', 'display:block;');
            }
        });
    });
    $(function () {
        $('#file_upload_2_edit').uploadify({
            'formData': {
                'timestamp': '<?php echo $timestamp;?>',
                '_token': '{{csrf_token()}}'
            },
            'buttonText': '图片上传',
            'swf': "{{asset('resources/org/uploadify/uploadify.swf')}}",
            'uploader': "{{url('engineer/upload')}}",
            'onUploadSuccess': function (file, data, response) {
//                $('#photo1_name').val(data);
                $('#fm_displaybug').form('load', {
                    photo2: data
                });
                $('#display_edit_photo2').attr('src', '/' + data);
                $('#display_edit_photo2').attr('style', 'display:block;');
            }
        });
    });

    var editIndex = undefined;
    function endEditing(){
        if (editIndex == undefined){return true}
        if ($('#dg').datagrid('validateRow', editIndex)){
            var ed = $('#dg').datagrid('getEditor', {index:editIndex,field:'cresult'});
            var resultname = $(ed.target).combobox('getText');
            $('#dg').datagrid('getRows')[editIndex]['resultname'] = resultname;
            $('#dg').datagrid('endEdit', editIndex);
            editIndex = undefined;
            return true;
        } else {
            return false;
        }
    }
    function onClickRow(index){
        if (editIndex != index){
            if (endEditing()){
                $('#dg').datagrid('selectRow', index)
                        .datagrid('beginEdit', index);
                editIndex = index;
                getChanges();
            } else {
                $('#dg').datagrid('selectRow', editIndex);
            }
        }
    }
    function append(){
        if (endEditing()){
            $('#dg').datagrid('appendRow',{status:'P'});
            editIndex = $('#dg').datagrid('getRows').length-1;
            $('#dg').datagrid('selectRow', editIndex)
                    .datagrid('beginEdit', editIndex);
        }
    }
    function removeit(){
        if (editIndex == undefined){return}
        $('#dg').datagrid('cancelEdit', editIndex)
                .datagrid('deleteRow', editIndex);
        editIndex = undefined;
    }
    function accept(){
        if (endEditing()){
            $('#dg').datagrid('acceptChanges');
        }
    }
    function reject(){
        $('#dg').datagrid('rejectChanges');
        editIndex = undefined;
    }
    function getChanges(){
        var rows = $('#dg').datagrid('getChanges');
//        alert(rows.length+' rows are changed!');
        if(rows.length != 0) {
            $('#fm').form('load', rows[0]);
            $('#cstatus').val(rows[0].cresult);
            url = '{{url('engineer/updatestatus')}}?_token={{csrf_token()}}&cid=' + rows[0].cid + '&pid=' + rows[0].pid + '&cresult=' + rows[0].cresult + '&cbug=' + rows[0].cbug;
            saveStatus();

        }
    }

</script>
</html>