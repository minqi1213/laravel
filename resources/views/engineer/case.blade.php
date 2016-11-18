@extends('layouts.engineer_layout')
@section('content')
    <table width="100%"><tr><td align="center" valign="middle">
                <table id="dg" title="我的用例" class="easyui-datagrid" style="width:100%"
                       url="{{url('engineer/getcase')}}?_token={{csrf_token()}}"
                       toolbar="#toolbar" pagination="true" nowrap="false"
                       rownumbers="true" fitColumns="true" singleSelect="true"
                       data-options="onClickRow: onClickRow"
                >
                    <thead>
                    <tr>
                        <th field="cmodel" width="10%">模块</th>
                        <th field="ccase" width="40%">测试用例</th>
                        <th field="ctype" width="10%">测试类型</th>
                        <th field="username" width="10%">执行者</th>
                        <th data-options="field:'cresult',formatter:formatResult,
                        editor:{
							type:'combobox',
							options:{
								valueField:'resultid',
								textField:'resultname',
								method:'get',
								url:'{{url("/resources/org/json/results.json")}}',
								required:true
							}
						}" width="10%">测试结果</th>
                        <th data-options="field:'cbug',formatter:rowformatter,editor:'textbox'" width="20%" >bug</th>
                    </tr>
                    </thead>
                </table>
                <div id="toolbar" style="padding:5px;height:auto">
                    <div>
                        <a href="#" class="easyui-linkbutton" iconCls="icon-add" plain="true"
                           >新建执行用例</a>
                    </div>
                    {{--<div>--}}
                        {{--<a href="#" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editCase()">执行用例</a>--}}
                    {{--</div>--}}
                    <div>
                        项目:
                        <select id="projectselect" class="easyui-combobox" panelHeight="auto" style="width:100px">
                            @foreach($data as $d)
                                echo "<option value="{{$d->pid}}">{{$d->pname}}</option>";
                            @endforeach
                        </select>
                        <a href="#" class="easyui-linkbutton" iconCls="icon-search" onclick="loadDataGridWithParam()">选择</a>
                    </div>
                </div>

                <div id="dlg" class="easyui-dialog" style="width:600px;height:400px;padding:10px 20px"
                     closed="true" buttons="#dlg-buttons">
                    <div class="ftitle">用例状态</div>
                    <form id="fm" method="post" novalidate>
                        <div class="fitem">
                            <label>用例:</label>
                            <textarea name="ccase" class="easyui-validatebox" disabled="disabled" style="width:100%;resize:none;"></textarea>
                        </div>
                        <div class="fitem">
                            <label>期望结果:</label>
                            <textarea name="cexpect" class="easyui-validatebox" disabled="disabled" style="width:100%;resize:none;"></textarea>
                        </div>
                        <div class="fitem">
                            <label>实际结果:</label>
                            <select id="cresult" name="cresult">
                                <option value='未执行'>未执行</option>
                                <option value='通过'>通过</option>
                                <option value='失败'>失败</option>
                            </select>
                        </div>
                        <div class="fitem">
                            <label>bug:</label>
                            <input name="cbug" class="easyui-validatebox">
                        </div>
                    </form>
                </div>
                <div id="dlg-buttons">
                    <a href="#" class="easyui-linkbutton" iconCls="icon-ok" onclick="saveStatus()">保存</a>
                    <a href="#" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
                </div>
            </td></tr>
    </table>

@endsection