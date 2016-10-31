@extends('layouts.engineer')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('engineer/info')}}">首页</a> &raquo; 全部bug
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="" method="post">
            <table class="search_tab">
                <tr>
                    <th width="120">选择项目:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.baidu.com">百度</option>
                            <option value="http://www.sina.com">新浪</option>
                        </select>
                    </td>
                    <th width="120">选择提交人:</th>
                    <td>
                        <select onchange="javascript:location.href=this.value;">
                            <option value="">全部</option>
                            <option value="http://www.sina.com">我</option>
                        </select>
                    </td>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" placeholder="关键字"></td>
                    <td><input type="submit" name="sub" value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab" border="0" cellspacing="0" cellpadding="0" style="table-layout: fixed;">
                    <tr>
                        <th class="tc" width="5%">ID</th>
                        <th width="47%">标题</th>
                        <th width="8%">审核状态</th>
                        <th width="9%">所属项目</th>
                        <th width="8%">发布人</th>
                        <th width="13%">更新时间</th>
                        <th width="15%">操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>
                        <th class="tc">{{$v->bid}}</th>
                        <td>
                            <li style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;-o-text-overflow:ellipsis;-icab-text-overflow: ellipsis; -khtml-text-overflow: ellipsis; -moz-text-overflow: ellipsis; -webkit-text-overflow: ellipsis; ">
                                <a href="#">
                                    <nobr>{{$v->btitle}}</nobr>
                                </a>
                            </li>
                        </td>
                        {{--<td style="padding: 0"><select style="width:100%;height:100%" onchange="javascript:location.href=this.value;">--}}
                                {{--<option value="">全部</option>--}}
                                {{--<option value="http://www.sina.com">我</option>--}}
                            {{--</select>--}}
                        {{--</td>--}}
                        @if($v->status ==0)
                            <td class="status"><span style="color:darkblue;">开始</span></td>
                        @elseif($v->status ==1)
                            <td class="status"><span style="color:orange;">进行中</span></td>
                        @elseif($v->status ==2)
                            <td class="status"><span style="color:orange;">待验证</span></td>
                        @elseif($v->status ==3)
                            <td class="status"><span style="color:orange;">RBT</span></td>
                        @elseif($v->status ==4)
                            <td class="status"><span style="color:orange;">待回归</span></td>
                        @elseif($v->status ==5)
                            <td class="status"><span style="color:forestgreen;">关闭</span></td>
                        @elseif($v->status ==6)
                            <td class="status"><span style="color:forestgreen;">无效问题</span></td>
                        @elseif($v->status ==7)
                            <td class="status">'<span style="color:forestgreen;">暂不修复</span></td>
                        @else
                            <td class="status"><span style="color:darkblue;">未知状态</span></td>
                        @endif
                        <td class="pname">{{$v->pname}}</td>
                        <td class="username">{{$v->username}}</td>
                        <td style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;-o-text-overflow:ellipsis;-icab-text-overflow: ellipsis; -khtml-text-overflow: ellipsis; -moz-text-overflow: ellipsis; -webkit-text-overflow: ellipsis; ">{{$v->btime}}</td>
                        <td>
                            <a href="#">修改</a>
                            <a href="#">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>


<div class="page_nav">
<div>
<a class="first" href="/wysls/index.php/Admin/Tag/index/p/1.html">第一页</a> 
<a class="prev" href="/wysls/index.php/Admin/Tag/index/p/7.html">上一页</a> 
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/6.html">6</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/7.html">7</a>
<span class="current">8</span>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/9.html">9</a>
<a class="num" href="/wysls/index.php/Admin/Tag/index/p/10.html">10</a> 
<a class="next" href="/wysls/index.php/Admin/Tag/index/p/9.html">下一页</a> 
<a class="end" href="/wysls/index.php/Admin/Tag/index/p/11.html">最后一页</a> 
<span class="rows">11 条记录</span>
</div>
</div>



                <div class="page_list">
                    <ul>
                        <li class="disabled"><a href="#">&laquo;</a></li>
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">&raquo;</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
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