@extends('layouts.engineer_layout')
@section('content')
    <table width="100%"><tr><td align="center" valign="middle">
    <table id="dg_bug" title="我的bug" class="easyui-datagrid" style="width:100%"
           url="{{url('engineer/getbug')}}?_token={{csrf_token()}}"
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
                        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newBug()">新建bug</a>
                    </div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;请选择项目:&nbsp;&nbsp;
                        <select id="projectselect_bug" class="easyui-combobox" panelHeight="auto" style="width:100px">
                            <option value=0>所有项目</option>
                            @foreach($data as $d)
                                echo "<option value="{{$d->pid}}">{{$d->pname}}</option>";
                            @endforeach
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;请选择提交人:&nbsp;&nbsp;
                        <select id="projectselect_user" class="easyui-combobox" panelHeight="auto" style="width:100px">
                            <option value=0>所有人</option>
                            <option value=1>我</option>
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="projectselect_input" class="easyui-textbox" style="width:40%" data-options="prompt:'请输入要搜索的关键字，以空格隔开'"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="loadDataGridBugWithParam()">搜索</a>
                    </div>
                </div>

                <div style="position:relative;width:100%">
                    <!-- Dailog for create new bug-->
                    <div id="dlg_newbug" class="easyui-dialog"  style="width:75%;height:500px;left:15%;top:10%;padding:10px 20px"
                         closed="true" buttons="#dlg-buttons-new">
                        <div class="ftitle">新建bug</div>
                        <form id="fm_newbug" method="post" enctype="multipart/form-data" novalidate>
                            <div class="fitem">
                                <label>请选择项目:</label>
                                <select id="projectselect_newbug" name="projectselect_newbug" data-options="required:true" class="easyui-combobox" panelHeight="auto" style="width:100px">
                                    @foreach($data as $d)
                                        echo "<option value="{{$d->pid}}">{{$d->pname}}</option>";
                                    @endforeach
                                </select>
                                <div class="fitem">
                                    <label>bug标题:</label>
                                    <input name="btitle" class="easyui-textbox" style="width:90%;resize:none;" data-options="required:true"/>
                                </div>
                                <div class="fitem">
                                    <label>bug详情:</label>
                                    <textarea name="bdescription" class="easyui-textbox" data-options="multiline:true,required:true" style="width:90%;height:300px;resize:none;"></textarea>
                                </div>.
                                <div style="margin-bottom:20px">
                                    <div>截图1:</div>
                                    <input name="photo1" class="easyui-textbox" size="50" type="text" readOnly="true" data-options="prompt:'选择一张截图...'"/>
                                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                                    <img id="edit_photo1" name="edit_photo1" width="40%" src="" onclick="javascript:showImg(src)" style="display:none;">
                                    {{--<input class="easyui-filebox" name="photo1" data-options="prompt:'选择一张截图...'" style="width:90%">--}}
                                </div>
                                <div style="margin-bottom:20px">
                                    <div>截图2:</div>
                                    <input name="photo2" class="easyui-textbox" size="50" type="text" readOnly="true" data-options="prompt:'选择一张截图...'"/>
                                    <input id="file_upload_2" name="file_upload_2" type="file" multiple="true">
                                    <img id="edit_photo2" name="edit_photo1" width="40%" src="" onclick="javascript:showImg(src)" style="display:none;">
                                    {{--<input class="easyui-filebox" name="photo2" data-options="prompt:'选择一张截图...'" style="width:90%">--}}
                                </div>
                                </div>
                        </form>
                    </div>
                    <div id="dlg-buttons-new">
                        <a id="savebtn_newbug" href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveBug()">保存</a>
                        <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg_newbug').dialog('close')">取消</a>
                    </div>
                </div>
            </td></tr>
    </table>
@endsection