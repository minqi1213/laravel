<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('resources/views/engineer/style/css/ch-ui.admin.css')}}">
    <link rel="stylesheet" href="{{asset('resources/views/engineer/style/font/css/font-awesome.min.css')}}">
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/views/engineer/style/js/jquery-1.9.1.min.js')}}"></script>
    <script type="text/javascript">
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


    </script>

</head>
<body>
@yield('content')
</body>
</html>