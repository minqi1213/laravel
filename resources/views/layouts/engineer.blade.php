<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/engineer/style/css/easyui.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/engineer/style/css/icon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('resources/views/engineer/style/css/demo.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/engineer/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/engineer/style/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/ch-ui.admin.js')}}"></script>
    {{--<script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery-1.9.1.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery.easyui.min.js')}}"></script>
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
    <script type="text/javascript">
        function showImage(src) {
            $('#dlg_displayimg').window('open');
            $('#display_img').attr('src', '');
            $('#display_img').attr('src', src);
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
        function rowformatter(value, row, index) {
            //return "<a href='detail.php?id="+value+"' target='_blank' >"+value+"</a>";
            return "<div><a href=\"#\" class=\"easyui-linkbutton\" plain=\"true\" onclick=\"showBug('" + value + "')\">" + value + "</a></div>";
        }
        function rowformatter_buglist(value, row, index) {
            //return "<a href='detail.php?id="+value+"' target='_blank' >"+value+"</a>";
            return "<div><a href=\"/engineer/bug/"+row.bid+"\" class=\"easyui-linkbutton\" plain=\"true\" >" + value + "</a></div>";
        }
        function rowformatter_buglist_operate(value, row, index) {
            //return "<a href='detail.php?id="+value+"' target='_blank' >"+value+"</a>";
            return "<div><a href=\"/engineer/bug/"+value+"/edit\" class=\"easyui-linkbutton\" plain=\"true\" >修改</a></div>";
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

</head>
<body>
@yield('content')
<div id="dlg_displayimg" class="easyui-window" title="截图浏览" data-options="modal:true,closed:true"
     style="top:10px;width:90%;height:90%;padding:10px;"
     closed="true">
    <img id="display_img" name="display_img" width="90%" src="">
</div>
</body>
</html>