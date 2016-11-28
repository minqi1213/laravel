@extends('layouts.engineer')
@section('content')
    <script type="text/javascript" src="{{asset('resources/org/chart/Chart.js')}}"></script>
    {{--<script type="text/javascript" src="{{asset('resources/org/chart/Chart.min.js')}}"></script>--}}
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('engineer/management')}}">首页</a> &raquo; 全部数据
    </div>

    <div class="result_wrap">
        <center><h3>功能交互测试报告</h3></center>
        <div class="result_content" style="width: 50%;height: 50%;float: left">
            <table class="list_tab" width="100%" >
                <tr>
                    <td width="30%">测试应用</td>
                    <td width="70%">xxxx</td>
                </tr>
                <tr>
                    <td width="30%">测试类型</td>
                    <td width="70%">深度交互测试</td>
                </tr>
                <tr>
                    <td width="30%">硬件环境</td>
                    <td width="30%">华为Mate7，华为荣耀6，三星A8，小米3</td>
                </tr>
                <tr>
                    <td width="30%">负责人</td>
                    <td width="30%">SunnyTest</td>
                </tr>
            </table>
        </div>
        <div class="result_content" style="width: 50%;height: 50%;float: left">
            <table class="list_tab" width="100%" >
                <tr>
                    <td width="30%">测试版本</td>
                    <td width="70%">V1.0</td>
                </tr>
                <tr>
                    <td width="30%">测试时间</td>
                    <td width="70%">2016/11/20--2016/11/22</td>
                </tr>
                <tr>
                    <td width="30%">软件环境</td>
                    <td width="30%">Android4.1--Android5.1</td>
                </tr>
                <tr>
                    <td width="30%">测试人员</td>
                    <td width="30%">SunnyTest</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="result_wrap">
        <div class="result_content" style="width: 100%;height: 100%">
            <center><h3>测试内容</h3></center>
        <textarea style="width: 100%;height: 80px; resize:none" readonly="readonly">
 1. 已完成功能交互测试用例维护，本次新增测试用例79条。
 2. 已完成功能交互测试用例执行，本次共计执行测试用例443条。
 3. 针对已修复Bug进行验证及RBT测试。
 4. 截止当前，共计提交222个Bug，其中35个S级Bug，所提交Bug均已提交至JIRA
        </textarea>
        </div>
    </div>

    <div class="result_wrap">
        <div class="result_content" style="width: 100%;height: 100%">
            <center><h3>测试总结</h3></center>
            <table class="list_tab" width="100%" >
                <tr>
                    <th >用例执行结果</th>
                    <td >Total</td>
                    <td >1739</td>
                    <td >Pass</td>
                    <td >1000</td>
                    <td >Fail</td>
                    <td >200</td>
                    <td >N/A</td>
                    <td >100</td>
                    <td >Block</td>
                    <td >100</td>
                    <td >NR</td>
                    <td >100</td>
                    <td >覆盖率</td>
                    <td >100%</td>
                    <td >通过率</td>
                    <td >80%</td>
                </tr>
            {{--</table>--}}
            {{--<table class="list_tab" width="100%" >--}}
                <tr>
                    <th >Open Bug</th>
                    <td >Total</td>
                    <td >173</td>
                    <td >S级</td>
                    <td >55</td>
                    <td >A级</td>
                    <td >116</td>
                    <td >B级</td>
                    <td >2</td>
                    <td >C级</td>
                    <td >0</td>
                </tr>
                <tr>
                    <th >严重问题列举</th>
                    <td  colspan="16">1.[1.0][新手引导]引导攻击好友，攻击完成后提示获得300000金币，金币数量没有增加，需重新登陆<br>
                    2. [1.0][UE]在iPhone5S手机上，进行正常游戏时，手机发热严重且界面刷新缓慢。<br>
                    3. [1.0][UE]在三星A7手机上，点击任意界面，游戏卡顿严重，页面刷新极慢</td>
                </tr>
                <tr>
                    <th >概要总结</th>
                    <td  colspan="16">
                        <table width="100%">
                            <tr >
                                <th>模块</th>
                                <td>Bug数量</td>
                                <td>S级Bug</td>
                                <td width="40%">备注</td>
                            </tr>
                            <tr>
                                <th>任务</th>
                                <td>24</td>
                                <td>8</td>
                                <td width="40%"></td>
                            </tr>
                            <tr><th>名将</th>
                                <td>6</td>
                                <td>6</td>
                                <td width="40%"></td></tr>
                            <tr>
                                <td>活动</td>
                                <td>21</td>
                                <td>5</td>
                                <td width="40%"></td>
                            </tr>
                            <tr>
                                <th>宗派</th>
                                <td>11</td>
                                <td>5</td>
                                <td width="40%"></td>
                            </tr>
                            <tr>
                                <th>技能</th>
                                <td>11</td>
                                <td>5</td>
                                <td width="40%"></td>
                            </tr>
                            <tr>
                                <th>背包</th>
                                <td>2</td>
                                <td>0</td>
                                <td width="40%"></td>
                            </tr>
                            <tr>
                                <th>仓库</th>
                                <td>1</td>
                                <td>0</td>
                                <td width="40%"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="result_wrap">
        <div id="left_dailyadd" class="result_content" style="width: 45%;height: 45%;float: left">
            <h3>每日新增case</h3>
            <table class="list_tab">
                <tr>
                    <th>Nov.10</th>
                    <th>Nov.11</th>
                    <th>Nov.12</th>
                    <th>Nov.13</th>
                    <th>Nov.14</th>
                    <th>Nov.15</th>
                    <th>Nov.16</th>
                    <th>Nov.17</th>
                </tr>
                <tr>
                    <td>67</td>
                    <td>40</td>
                    <td>2</td>
                    <td>5</td>
                    <td>53</td>
                    <td>70</td>
                    <td>42</td>
                    <td>34</td>
                </tr>
            </table>
            <div style="width: 80%;height: 80%">
                <canvas id="myChart_dailyadd" width="400" height="400" style="width:400px;height:400px"></canvas>
            </div>
            <script>
                var ctx_dailyadd = document.getElementById("myChart_dailyadd");
                var myChart_dailyadd = new Chart(ctx_dailyadd, {
                    type: 'line',
                    data: {
                        labels: ["Nov.10", "Nov.11", "Nov.12", "Nov.13", "Nov.14", "Nov.15","Nov.16","Nov.17"],
                        datasets: [{
                            label: '每日新增的case数',
                            data: [67, 40, 2, 5, 53, 70, 42, 34],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
//                    ,
//                    options: {
//                        scales: {
//                            yAxes: [{
//                                ticks: {
//                                    beginAtZero:true
//                                }
//                            }]
//                        }
//                    }
                });
            </script>
        </div>
        <div id="right_dailyexecute" class="result_content" style="width: 45%;height: 45%;float: left;margin-left:10%;">
            <h3>每日执行case</h3>
            <table class="list_tab">
                <tr>
                    <th>Nov.10</th>
                    <th>Nov.11</th>
                    <th>Nov.12</th>
                    <th>Nov.13</th>
                    <th>Nov.14</th>
                    <th>Nov.15</th>
                    <th>Nov.16</th>
                    <th>Nov.17</th>
                </tr>
                <tr>
                    <td>40</td>
                    <td>50</td>
                    <td>30</td>
                    <td>35</td>
                    <td>60</td>
                    <td>55</td>
                    <td>40</td>
                    <td>48</td>
                </tr>
            </table>
            <div style="width: 80%;height: 80%">
                <canvas id="myChart_dailyexecute" width="400" height="400" style="width:400px;height:400px"></canvas>
            </div>
            <script>
                var ctx_dailyexecute = document.getElementById("myChart_dailyexecute");
                var myChart_dailyexecute = new Chart(ctx_dailyexecute, {
                    type: 'line',
                    data: {
                        labels: ["Nov.10", "Nov.11", "Nov.12", "Nov.13", "Nov.14", "Nov.15","Nov.16","Nov.17"],
                        datasets: [{
                            label: '每日执行的case数',
                            data: [40, 50, 30, 35, 60, 55, 40, 48],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
//                    ,
//                    options: {
//                        scales: {
//                            yAxes: [{
//                                ticks: {
//                                    beginAtZero:false
//                                }
//                            }]
//                        }
//                    }
                });
            </script>
        </div>

        <div id="left_status" class="result_content" style="width: 45%;height: 45%;float: left">
            <h3>Bug状态</h3>
            <table class="list_tab">
                <tr>
                    <th>开始</th>
                    <th>RBT</th>
                    <th>无效问题</th>
                    <th>暂不修复</th>
                    <th>待回归</th>
                    <th>进行中</th>
                    <th>待验证</th>
                    <th>关闭</th>
                </tr>
                <tr>
                    <td>67</td>
                    <td>40</td>
                    <td>2</td>
                    <td>5</td>
                    <td>53</td>
                    <td>70</td>
                    <td>42</td>
                    <td>34</td>
                </tr>
            </table>
            <div style="width: 80%;height: 80%">
                <canvas id="myChart_status" width="400" height="400" style="width:400px;height:400px"></canvas>
            </div>
            <script>
                var ctx_status = document.getElementById("myChart_status");
                var myChart_status = new Chart(ctx_status, {
                    type: 'pie',
                    data: {
                        labels: ["开始", "RBT", "无效问题", "暂不修复", "待回归", "进行中","待验证","关闭"],
                        datasets: [{
                            label: '# of Votes',
                            data: [67, 40, 2, 5, 53, 70, 42, 34],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
//                    ,
//                    options: {
//                        scales: {
//                            yAxes: [{
//                                ticks: {
//                                    beginAtZero:true
//                                }
//                            }]
//                        }
//                    }
                });
            </script>
        </div>
        <div id="right_priority" class="result_content" style="width: 45%;height: 45%;float: left;margin-left:10%;">
            <h3>Bug优先级</h3>
            <table class="list_tab">
                <tr>
                    <th>S</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                </tr>
                <tr>
                    <td>15</td>
                    <td>60</td>
                    <td>43</td>
                    <td>20</td>
                </tr>
            </table>
            <div style="width: 80%;height: 80%">
                <canvas id="myChart_priority" width="400" height="400" style="width:400px;height:400px"></canvas>
            </div>
            <script>
                var ctx_priority = document.getElementById("myChart_priority");
                var myChart_priority = new Chart(ctx_priority, {
                    type: 'pie',
                    data: {
                        labels: ["S", "A", "B", "C"],
                        datasets: [{
                            label: '# of Votes',
                            data: [15, 60, 43, 20],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
//                    ,
//                    options: {
//                        scales: {
//                            yAxes: [{
//                                ticks: {
//                                    beginAtZero:false
//                                }
//                            }]
//                        }
//                    }
                });
            </script>
        </div>

        <div id="left_submit" class="result_content" style="width: 45%;height: 45%;float: left;">
            <h3>Bug提交人</h3>
            <table class="list_tab">
                <tr>
                    <th>李伟麟</th>
                    <th>马航宇</th>
                    <th>王金发</th>
                    <th>吴涛</th>
                    <th>张洋</th>
                    <th>曹杨</th>
                    <th>史云鹏</th>
                </tr>
                <tr>
                    <td>35</td>
                    <td>40</td>
                    <td>42</td>
                    <td>52</td>
                    <td>14</td>
                    <td>27</td>
                    <td>62</td>
                </tr>
            </table>
            <div style="width: 80%;height: 80%">
            <canvas id="myChart_submit" width="400" height="400" style="width:400px;height:400px"></canvas>
                </div>
            <script>
                var ctx_submit = document.getElementById("myChart_submit");
                var myChart_submit = new Chart(ctx_submit, {
                    type: 'pie',
                    data: {
                        labels: ["李伟麟", "马航宇", "王金发", "吴涛", "张洋", "曹杨","史云鹏"],
                        datasets: [{
                            label: '# of Votes',
                            data: [35, 40, 42, 52, 14, 27, 62],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
//                    ,
//                    options: {
//                        scales: {
//                            yAxes: [{
//                                ticks: {
//                                    beginAtZero:true
//                                }
//                            }]
//                        }
//                    }
                });
            </script>
        </div>
        <div id="right_assign" class="result_content" style="width: 45%;height: 45%;float: left;margin-left:10%;">
            <h3>Bug指派人</h3>
            <table class="list_tab">
                <tr>
                    <th>李伟麟</th>
                    <th>马航宇</th>
                    <th>王金发</th>
                    <th>吴涛</th>
                    <th>张洋</th>
                    <th>曹杨</th>
                    <th>史云鹏</th>
                </tr>
                <tr>
                    <td>15</td>
                    <td>20</td>
                    <td>12</td>
                    <td>34</td>
                    <td>26</td>
                    <td>17</td>
                    <td>6</td>
                </tr>
            </table>
            <div style="width: 80%;height: 80%">
            <canvas id="myChart_assign" width="400" height="400" style="width:400px;height:400px"></canvas>
                </div>
            <script>
                var ctx_assign = document.getElementById("myChart_assign");
                var myChart_assign = new Chart(ctx_assign, {
                    type: 'pie',
                    data: {
                        labels: ["李伟麟", "马航宇", "王金发", "吴涛", "张洋", "曹杨","史云鹏"],
                        datasets: [{
                            label: '# of Votes',
                            data: [15, 20, 12, 34, 26, 17, 6],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    }
//                    ,
//                    options: {
//                        scales: {
//                            yAxes: [{
//                                ticks: {
//                                    beginAtZero:false
//                                }
//                            }]
//                        }
//                    }
                });
            </script>
        </div>
    </div>
@endsection