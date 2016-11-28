@extends('layouts.engineer')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('engineer/bug')}}">首页</a> &raquo; 全部bug
    </div>
    {{--{{session('pid')}}--}}
    <!--面包屑导航 结束-->
    <table width="100%">
        <tr>
            <td align="center" valign="middle">
                <table id="dg_bug" title="我的bug" class="easyui-datagrid" style="width:100%"
                       @if(count($pid)>0)
                            url="{{url('engineer/getbug')}}?_token={{csrf_token()}}&pid={{$pid}}&uid_tome={{$uid_tome}}&uid_mysub={{$uid_mysub}}"
                       @else
                            url="{{url('engineer/getbug')}}?_token={{csrf_token()}}&uid_tome={{$uid_tome}}&uid_mysub={{$uid_mysub}}"
                       @endif
                       toolbar="#toolbar" pagination="true" pageSize="50" PageList="[50,100,150,200]"
                       rownumbers="true" fitColumns="true" singleSelect="true" nowrap="false"
                data-options="remoteSort:false,multiSort:true">
                    <thead>
                    <tr>
                        <th data-options="field:'bid',sortable:true" width="6%" >Bug ID</th>
                        <th data-options="field:'model_name',sortable:true" width="6%" >模块</th>
                        <th width="40%" data-options="field:'btitle',formatter:rowformatter_buglist">标题</th>
                        <th field="bdescription" hidden="true" width="0%" >详细步骤</th>
                        <th data-options="field:'status',formatter:rowformatter_bugstatus,sortable:true" width="7%">状态</th>
                        <th data-options="field:'priority_name',sortable:true,
                        styler:function(value,index,row){
                        if (value=='S'){
                            return 'background-color:red;font-weight:bold;';}
                        else if (value=='B'){
                            return 'background-color:steelblue;font-weight:bold;';}
                        else if (value=='C'){
                            return 'background-color:yellow;font-weight:bold;';}
                        }
                        " width="6%" >优先级</th>
                        <th data-options="field:'pname'" width="10%">项目名称</th>
                        <th data-options="field:'username',sortable:true" width="6%">提交人</th>
                        <th data-options="field:'bug_assignname',sortable:true" width="6%">负责人</th>
                        {{--<th data-options="field:'bid',formatter:rowformatter_buglist_operate" width="5%">操作</th>--}}
                        <th data-options="field:'btime',sortable:true" width="13%">提交时间</th>
                    </tr>
                    </thead>
                </table>
                <div id="toolbar" style="padding:5px;height:auto">
                    <div>
                        <a href="{{url('engineer/bug/create')}}" class="easyui-linkbutton" iconCls="icon-add" plain="true"
                           >新建bug</a>
                    </div>
                    <div>
                        &nbsp;&nbsp;&nbsp;&nbsp;请选择项目:&nbsp;
                        <select id="projectselect_bug" class="easyui-combobox" panelHeight="auto" style="width:100px"
                        >
                            <option value=0>所有项目</option>
                            @foreach($data as $d)
                                <option value="{{$d->pid}}"
                                        @if($d->pid==$pid) selected
                                        {{--@elseif($d->pid == session('pid')) selected--}}
                                        @endif
                                >{{$d->pname}}</option>;
                            @endforeach
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;请选择模块:&nbsp;&nbsp;
                        <select id="modelselect_bug" class="easyui-combobox" panelHeight="auto" style="width:100px"
                        >
                            <option value=0>所有模块</option>
                            @foreach($model as $m)
                                echo "
                                <option value="{{$m->model_id}}"
                                >{{$m->model_name}}</option>";
                            @endforeach
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;请选择提交人:&nbsp;&nbsp;
                        <select id="projectselect_user" class="easyui-combobox" panelHeight="auto" style="width:100px">
                            <option value=0>所有人</option>
                            <option value=1>我</option>
                        </select>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input id="projectselect_input" class="easyui-textbox" style="width:20%"
                               data-options="prompt:'请输入要搜索的关键字，以空格隔开'"/>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="#" class="easyui-linkbutton" iconCls="icon-search"
                           onclick="loadDataGridBugWithParam()">搜索</a>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    {{--<form action="#" method="post">--}}
        {{--<div class="result_wrap">--}}
            {{--<!--快捷导航 开始-->--}}
            {{--<div class="result_content">--}}
                {{--<div class="short_wrap">--}}
                    {{--<a href="{{url('engineer/bug/create')}}"><i class="fa fa-plus"></i>新建bug</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!--快捷导航 结束-->--}}
        {{--</div>--}}

        {{--<div class="result_wrap">--}}
            {{--<div class="result_content">--}}
                {{--<table class="list_tab" border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed;">--}}
                    {{--<tr>--}}
                        {{--<th class="tc" width="5%">ID</th>--}}
                        {{--<th width="47%">标题</th>--}}
                        {{--<th width="8%">审核状态</th>--}}
                        {{--<th width="9%">所属项目</th>--}}
                        {{--<th width="8%">发布人</th>--}}
                        {{--<th width="13%">更新时间</th>--}}
                        {{--<th width="15%">操作</th>--}}
                    {{--</tr>--}}
                    {{--@foreach($data as $v)--}}
                    {{--<tr>--}}
                        {{--<th class="tc">{{$v->bid}}</th>--}}
                        {{--<td>--}}
                            {{--<li style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;-o-text-overflow:ellipsis;-icab-text-overflow: ellipsis; -khtml-text-overflow: ellipsis; -moz-text-overflow: ellipsis; -webkit-text-overflow: ellipsis; ">--}}
                                {{--<a href="{{url('engineer/bug/'.$v->bid)}}">--}}
                                    {{--<nobr>{{$v->btitle}}</nobr>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</td>--}}
                        {{--<td style="padding: 0"><select style="width:100%;height:100%" onchange="javascript:location.href=this.value;">--}}
                                {{--<option value="">全部</option>--}}
                                {{--<option value="http://www.sina.com">我</option>--}}
                            {{--</select>--}}
                        {{--</td>--}}
                        {{--@if($v->status ==0)--}}
                            {{--<td class="status"><span style="color:darkblue;">开始</span></td>--}}
                        {{--@elseif($v->status ==1)--}}
                            {{--<td class="status"><span style="color:orange;">进行中</span></td>--}}
                        {{--@elseif($v->status ==2)--}}
                            {{--<td class="status"><span style="color:orange;">待验证</span></td>--}}
                        {{--@elseif($v->status ==3)--}}
                            {{--<td class="status"><span style="color:orange;">RBT</span></td>--}}
                        {{--@elseif($v->status ==4)--}}
                            {{--<td class="status"><span style="color:orange;">待回归</span></td>--}}
                        {{--@elseif($v->status ==5)--}}
                            {{--<td class="status"><span style="color:forestgreen;">关闭</span></td>--}}
                        {{--@elseif($v->status ==6)--}}
                            {{--<td class="status"><span style="color:forestgreen;">无效问题</span></td>--}}
                        {{--@elseif($v->status ==7)--}}
                            {{--<td class="status">'<span style="color:forestgreen;">暂不修复</span></td>--}}
                        {{--@else--}}
                            {{--<td class="status"><span style="color:darkblue;">未知状态</span></td>--}}
                        {{--@endif--}}
                        {{--<td class="pname">{{$v->pname}}</td>--}}
                        {{--<td class="username">{{$v->username}}</td>--}}
                        {{--<td style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;-o-text-overflow:ellipsis;-icab-text-overflow: ellipsis; -khtml-text-overflow: ellipsis; -moz-text-overflow: ellipsis; -webkit-text-overflow: ellipsis; ">{{$v->btime}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{url('engineer/bug/'.$v->bid.'/edit')}}">修改</a>--}}
                            {{--<a href="#">删除</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--@endforeach--}}
                {{--</table>--}}

                {{--<div class="page_list">--}}
                    {{--<ul>--}}
                        {{--{{$data->links()}}--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</form>--}}
    <!--搜索结果页面 列表 结束-->
    {{--<style>--}}
        {{--.result_content ul li span{--}}
            {{--font-size: 15px;--}}
            {{--padding: 6px 12px;--}}
        {{--}--}}
    {{--</style>--}}
    {{--<script type="text/javascript">--}}
        {{--$(function(){--}}

            {{--$('.pid').click(function(){--}}
                {{--if(!$(this).is('.input')){--}}
                    {{--$(this).addClass('input').html('<input style="width:90%" type="text" value="'+ $(this).text() +'" />').find('input').focus().blur(function(){--}}
                        {{--var thisid = $(this).parent().siblings("th:eq(0)").text();--}}
                        {{--var thisvalue=$(this).val();--}}
                        {{--var thisclass = $(this).parent().attr("class");--}}
                        {{--alert(thisid);--}}
                        {{--alert(thisvalue);--}}
                        {{--alert(thisclass);--}}
{{--//                        $.ajax({--}}
{{--//                            type: 'POST',--}}
{{--//                            url: 'update.php',--}}
{{--//                            data: "thisid="+thisid+"&thisclass="+thisclass+"&thisvalue="+thisvalue--}}
{{--//                        });--}}
                        {{--$(this).parent().removeClass('input').html('<li><a href=\"http://www.baidu.com\">'+$(this).val() || 0+'</a></li>');--}}
                    {{--});--}}
                {{--}--}}
            {{--}).hover(function(){--}}
                {{--$(this).addClass('hover');--}}
            {{--},function(){--}}
                {{--$(this).removeClass('hover');--}}
            {{--});--}}

        {{--});--}}
    {{--</script>--}}
@endsection