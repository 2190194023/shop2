@extends('admin.public.index')

@section('content')

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> 轮播图列表</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
            	<!-- 判断 此商品是否有评论 -->
            	@if(!empty($discuss_data[0]->id))
                <tr>
                    <th>id</th>
                    <th>用户名称</th>
                    <th>商品</th>
                    <th>评论内容</th>
                    <th>评论时间</th>
                    <th>编辑</th>
                </tr>
                @else
					<center style="line-height:30px;font-size:21px;">此商品还没有评论</center>
	            @endif
            </thead>
            <tbody>
            	
	            	@foreach($discuss_data as $k=>$v)
	                <tr style="text-align:center;">
	                    <td>{{ $v->id }}</td>
	                    <td>{{ $uname[$k] }}</td>
	                    <td><img src="/uploads/{{ $goodimg }}" width="100px">{{ $goodname }}</td>
	                    <td>{{ $v->content }}</td>
	                    <td style="width:150px;">{{ $v->addtime }}</td>
	                    <td style="width:230px;">
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
            {{ $discuss_data->links() }}
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
      	  $.post('/admin/discuss/destroy',{id:id,_method:"DELETE"},function(res){
      	  	if(res == 'ok'){
				// 删除tr节点
				alert('已成功删除');
				window.location.href = window.location.href;
			}else{
				alert('删除失败')
			}
      	  },'html')
              
        };

        
  		
</script>
@endsection