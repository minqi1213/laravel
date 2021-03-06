@extends('layouts.cp_layout')
@section('content')
    <table width="100%"><tr><td align="center" valign="middle">
                <table id="dg_bug_cp" title="我的bug" class="easyui-datagrid" style="width:100%"
                       url="{{url('cp/getbug')}}?_token={{csrf_token()}}"
                       toolbar="#toolbar" pagination="true" pageSize="50" PageList="[50,100,150,200]"
                       rownumbers="true" fitColumns="true" singleSelect="true">
                    <thead>
                    <tr>
                        <th field="btitle" width="57%">标题</th>
                        <th field="bdescription" hidden="true" width="0%">详细步骤</th>
                        <th field="binarydata" hidden="true" width="0%">截图1</th>
                        <th field="binarydata2" hidden="true" width="0%">截图2</th>
                        <th field="pid" hidden="true" width="0%">项目编号</th>
                        <th data-options="field:'bid',formatter:rowformatter_buglist" width="5%">详情</th>
                        <th field="btime" width="18%">提交时间</th>
                        <th data-options="field:'pname'" width="10%" >项目名称</th>
                        <th field="uid" hidden="true" width="0%">提交人编号</th>
                        <th data-options="field:'username'" width="10%" >提交人</th>
                    </tr>
                    </thead>
                </table>
                <div id="toolbar" style="padding:5px;height:auto">
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;请选择项目:&nbsp;&nbsp;
                        <select id="projectselect_bug" class="easyui-combobox" panelHeight="auto" style="width:100px">
                            <option value=0>所有项目</option>
                            @foreach($data as $d)
                                echo "
                                <option value="{{$d->pid}}">{{$d->pname}}</option>";
                            @endforeach
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="projectselect_input" class="easyui-textbox" style="width:40%" data-options="prompt:'请输入要搜索的关键字，以空格隔开'"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="loadDataGridBugWithParamCP()">搜索</a>
                    </div>
                </div>
            </td></tr>
    </table>
@endsection