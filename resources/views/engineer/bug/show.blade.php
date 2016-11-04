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
        <form action="{{url('engineer/bug/'.$field->bid)}}" method="post">
            <input type="hidden" name="_method" value="put">
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>项目：</th>
                        <td>
                            <select name="pid" disabled="disabled">
                                @foreach($data as $d)
                                    <option value="{{$d->pid}}"
                                        @if($d->pid==$field->pid) selected
                                        @endif
                                    >{{$d->pname}}</option>
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
                            <input type="text" class="lg" name="btitle" value="{{$field->btitle}}" readonly="readonly">
                            <p>标题可以写30个字</p>
                        </td>
                    </tr>
                    <tr>
                        <th>详细内容：</th>
                        <td>
                            {{--<textarea class="lg" name="bdescription" readonly="readonly">{!! $field->bdescription !!}</textarea>--}}
                                {!! $field->bdescription !!}
                        </td>
                        <style type="text/css">
                            p img {
                                max-width: 50%; /*图片自适应宽度*/
                            }
                        </style>
                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            {{--<input type="submit" value="提交">--}}
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <script>
        window.onload=function(){
            var num = document.getElementsByTagName('img');
            for(i=0;i<num.length;i++){
                num[i].setAttribute('onClick',"showImage('"+num[i].src+"')");
            }
            document.getElementById('display_img').setAttribute('onClick',"");
        }
    </script>
@endsection