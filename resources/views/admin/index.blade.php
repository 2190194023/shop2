@extends('admin.public.index')

@section('content')


<script language=javascript> function tick() { var hours, minutes, seconds, ap; var intHours, intMinutes, intSeconds; var today; today = new Date(); intHours = today.getHours(); intMinutes = today.getMinutes(); intSeconds = today.getSeconds(); if (intHours == 0) { hours = "12:"; ap = "Midnight"; } else if (intHours < 12) { hours = intHours+":"; ap = "A.M."; } else if (intHours == 12) { hours = "12:"; ap = "Noon"; } else { hours = intHours + ":"; ap = "P.M."; } if (intMinutes < 10) { minutes = "0"+intMinutes+":"; } else { minutes = intMinutes+":"; } if (intSeconds < 10) { seconds = "0"+intSeconds+" "; } else { seconds = intSeconds+" "; } timeString = hours+minutes+seconds+ap; Clock.innerHTML = timeString; window.setTimeout("tick();", 1000); } window.onload = tick; </script>
    <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-table"></i> 我的首页</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            
                            <tbody>

                                <tr><td colspan="2" align='center'>
                                    欢迎管理员：<span class="x-red">test</span>
                                    ！当前时间:<span><span id="Clock"></span></span>
                                </td></tr>
                                <tr><td colspan="2" align='center'><div class="layui-card-header">系统信息</div></td></tr>
                                <tr>
                                        <th>版本</th>
                                        <td>测试版</td></tr>
                                    <tr>
                                        <th>服务器地址</th>
                                        <td></td></tr>
                                    <tr>
                                        <th>操作系统</th>
                                        <td></td></tr>
                                    <tr>
                                        <th>运行环境</th>
                                        <td></td></tr>
                                    <tr>
                                        <th>PHP版本</th>
                                        <td></td></tr>
                                    <tr>
                                        <th>PHP运行方式</th>
                                        <td></td></tr>
                                    <tr>
                                        <th>MYSQL版本</th>
                                        <td>5.5.53</td></tr>
                                    <tr>
                                        <th>Laravel</th>
                                        <td></td></tr>
                                    <tr>
                                        <th>表单上传附件限制</th>
                                        <td></td></tr>
                                    <tr>
                                    <tr>
                                        <th>服务器上传附件限制</th>
                                        <td></td></tr>
                                    <tr>
                                        <th>执行时间限制</th>
                                        <td>30s</td></tr>
                            </tbody>
                        </table>
                    </div>
    </div>

    <CENTER>
    <div>Copyright Your Website 2012. All Rights Reserved.</div>
    <div>开发者ODX.69c.shop</div>
    <div>Copyright Your Website 19201. All Rights Reserved.</div>
    <div>GANXIE</div>
@endsection