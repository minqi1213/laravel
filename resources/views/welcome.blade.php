<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{asset('resources/views/engineer/style/css/ch-ui.admin.css')}}">
        <link rel="stylesheet" href="{{asset('resources/views/engineer/style/font/css/font-awesome.min.css')}}">
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">欢迎访问SunnyTest众包平台</div>
                <br><br><br><br><br><br>
                <input type="submit"  style="width:200px;height:50px;font-size:20px" value="我是工程师" onClick='location.href="{{url('engineer')}}"'/>
                <input type="submit" style="width:200px;height:50px;font-size:20px" value="我是开发商" onClick='location.href="{{url('cp')}}"'/>
            </div>
        </div>
    </body>
</html>
