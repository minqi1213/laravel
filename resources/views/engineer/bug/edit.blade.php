@extends('layouts.engineer')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href={{url('engineer/bug')}}>首页</a> &raquo; 新建bug
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('engineer/bug/create')}}"><i class="fa fa-plus"></i>新建bug</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
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
        <form action="{{url('engineer/bug/'.$field->bid)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>项目：</th>
                        <td>
                            <select name="pid">
                                @foreach($data as $d)
                                    <option value="{{$d->pid}}"
                                        @if($d->pid==$field->pid) selected
                                        @endif
                                    >{{$d->pname}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>模块：</th>
                        <td>
                            <select name="bug_model">
                                <option value="0">请选择模块</option>
                                @foreach($model as $m)
                                    <option value="{{$m->model_id}}"
                                            @if($m->model_id==$field->bug_model) selected
                                            @endif
                                    >{{$m->model_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>优先级：</th>
                        <td>
                            <select name="bug_priority">
                                <option value="0">请选择优先级</option>
                                @foreach($priority as $p)
                                    <option value="{{$p->priority_id}}"
                                            @if($p->priority_id==$field->bug_priority) selected
                                            @endif
                                    >{{$p->priority_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>负责人：</th>
                        <td>
                            <select name="bug_assign">
                                <option value="0">请选择负责人</option>
                                @foreach($assign as $a)
                                    <option value="{{$a->uid}}"
                                            @if($a->uid==$field->bug_assign) selected
                                            @endif
                                    >{{$a->username}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr style="display: none">
                        <th><i class="require">*</i>用户id：</th>
                        <td>
                            <input type="text" class="lg" name="uid" value="{{session('userid')}}">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>标题：</th>
                        <td>
                            <input type="text" class="lg" name="btitle" value="{{$field->btitle}}">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>详细内容：</th>
                        <td>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.config.js')}}"></script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/ueditor.all.min.js')}}"> </script>
                            <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
                            <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
                            <script type="text/javascript" charset="utf-8" src="{{asset('resources/org/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                            <script id="editor" name="bdescription" type="text/plain" style="width:800px;height:500px;">
                                {!! $field->bdescription !!}
                            </script>
                            <script type="text/javascript">
                                var ue = UE.getEditor('editor');
                            </script>
                            <style>
                                .edui-default{line-height:28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow:hidden;height:20px}
                                div.edui-box{overflow:hidden;height:22px}
                            </style>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script>
        function changeProgress(statusid) {
            url = "{{url('engineer/changeprogress')}}?_token={{csrf_token()}}";
            var postStr = "bid=" + {{$field->bid}} + "&status=" + statusid;
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
        window.onload=function(){
            showProgressBar({{$field->status}});
        }
    </script>
@endsection