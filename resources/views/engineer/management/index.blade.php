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
        <div id="right_dailyexecute" class="result_content" style="width: 45%;height: 45%;float: left;margin-left:10px;">
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
        <div id="right_priority" class="result_content" style="width: 45%;height: 45%;float: left;margin-left:10px;">
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
        <div id="left_submit" class="result_content" style="width: 45%;height: 45%;float: left;margin-left:10px;">
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
        <div id="right_assign" class="result_content" style="width: 45%;height: 45%;float: left;margin-left:10px;">
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