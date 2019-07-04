@extends('admin.public.index')

@section('content')

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> 订单列表</span>
    </div>
    <!-- 搜索 开始 -->
        <div class="form-body" style="height:50px;padding-top:30px" data-example-id="simple-form-inline">
          <form class="form-inline" action="/admin/order">
            <div class="form-group">
              <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="订单号">
            <button type="submit" class="btn btn-success">搜索</button>
          </div>
        </form>
        </div>
        <!-- 搜索 结束 <--></-->
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>订单号</th>
                    <th>用户</th>
                    <th>收货人</th>
                    <th>收货地址</th>
                    <th>收货人电话</th>
                    <th>购买数量</th>
                    <th>购买时间</th>
                    <th>总金额</th>
                    <th>快递单号</th>
                    <th>状态</th>
                    <th>编辑</th>
                </tr>
            </thead>
            <tbody>
            	@foreach($data as $k=>$v)
                <tr style="text-align:center;">
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->oid }}</td>
                    <td>{{ $v->uid }}</td>
                    <td>{{ $v->oname }}</td>
                    <td>{{ $v->oaddress }}</td>
                    <td>{{ $v->ophone }}</td>
                    <td>{{ $v->onum }}</td>
                    <td>{{ $v->oaddtime }}</td>
                    <td>{{ $v->ototal }}</td>
                    <td>{{ $v->kdd }}</td>
                    <td style="width:150px;">
                    		<a href="javascript:;" id="sta" token="{{ csrf_token() }}" onclick="member_stu(this,'{{ $v->id }}','{{ $v->ostatus }}')" class="btn btn-info">@if($v->ostatus == 0) 新订单 @elseif($v->ostatus == 1) 已发货 @elseif($v->ostatus == 2) 已收货 @elseif($v->ostatus == 3) 无效订单 @endif</a>
                    </td>
                    <td style="width:230px;">
                      <a title="查看详情" class="btn btn-info" href="/admin/order/detail/{{ $v->oid }}">订单详情</a>
		              <a title="删除" class="btn btn-danger" token="{{ csrf_token() }}" onclick="member_del(this,'{{ $v->id }}')" href="javascript:;">删除</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <h5>共有数据 {{ $num }} 条</h5>
    <div class="pull-right">
            <!-- 显示页码 -->
            {{ $data->appends(['search'=>$search])->links() }}
    </div>
</div>
<style type="text/css">
        #pull_right{
            text-align:center;
        }
        .pull-right {
            /*float: left!important;*/
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
    </style>
<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript">
      /*订单-删除*/
      function member_del(obj,id){
      		let token = $(obj).attr('token');
      		$.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
			if(!window.confirm('你确定要删除吗?')){
				return false;
			}
      	  // 发送ajax删除
      	  $.post('/admin/order/del',{id:id},function(res){
      	  	if(res == 'ok'){
				// 删除tr节点
                alert('已成功删除');
				$(obj).parent().parent().remove();
			}else{
				alert('删除失败')
			}
      	  },'html')
              
        };
      /*订单-状态修改*/
      function member_stu(obj,id,status){
      		if(status>=3 || status<0){
      			alert('无效订单');
				    return true;
      		}else{
    				let token = $(obj).attr('token');
    	      		$.ajaxSetup({headers: {'X-CSRF-TOKEN': token} });
    	      		$.ajaxSetup({async:false});
    				if(!window.confirm('你确定要修改订单状态吗?')){
    					return false;
    				}
    	      	  // 发送ajax删除
    	      	  $.post('/admin/order/update',{id:id,status:status},function(res){
    	      	  	if(res == "ok"){
    					alert('修改成功');
    					window.location.href = window.location.href;
    					return true;
    				}else{
    					alert('修改失败');
    					return false;
    				}
    	      	  },'html')
          		}
        };
</script>
@endsection