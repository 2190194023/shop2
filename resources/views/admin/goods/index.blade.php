@extends('admin.public.index')

@section('content')
	<style type="text/css">
	.sb{
		overflow:hidden;
		text-overflow:ellipsis;
		white-space:nowrap;
	}
	</style>
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span><i class="icon-table"></i> 商品管理</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            	<div class="dataTables_filter" id="DataTables_Table_1_filter">
            		<!-- 搜索 开始 -->
            		<form class="form-inline" action="/admin/goods">
			            <div class="form-group">
			              	<input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="商品名称">
			            	<button type="submit" class="btn btn-success">搜索</button>
			          </div>
			        </form>
			        <!-- 搜索 结束 -->
            	</div>
            	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
	                <thead>
	                    <tr>
	                        <th>ID</th>                         
                            <th>商品名称</th>
                            <th>生产厂家</th>
                            <th>简介</th>
                            <th>单价</th>
                            <th>尺寸</th>
                            <th>状态</th>
                            <th>库存量</th>
                            <th>销售</th>
                            <th>添加时间</th>
                            <th>型号</th>
                            <th>图片</th>
                            <th>活动</th>
                            <th>操作</th>
	                    </tr>
	                </thead>
	                
		            <tbody role="alert" aria-live="polite" aria-relevant="all">
		            	@foreach($goods as $k=>$v)
                        <tr class="odd" style="text-align: center;">
                            <td>{{ $v->id }}</td>
                            <td>
                            	<a href="/admin/discuss/{{ $v->id }}">{{ $v->gname }}</a>
                            </td>
                            <td>{{ $v->gcompany }}</td>
                            <td>
                            	<p title="{{ $v->gdescr }}" class="sb" style="width:30px;">{{ $v->gdescr }}<p>
                            </td>
                            <td>{{ $v->gprice }}</td>
                            <td>{{ $v->size }}</td>

							@if($v->gstatus == 1)
                            <td> 新添加</td>
                            @elseif($v->gstatus == 2)
                            <td>在售</td>
                            @else
                            <td>下线</td>
                            @endif

                            <td>{{ $v->gtock }}</td>
                            <td>{{ $v->gnum }}</td>
                            <td>{{ $v->gaddtime }}</td>
                            <td>{{ $v->xinghao }}</td>
                            <td><img src="/uploads/{{ $v->url }}" width="100px"></td>
                            <td>
								@if($v->pid == 0)
									无活动
								@else									
                          		活动：{{ $v->pid }}
                          		@endif
                            </td>
                            <td>
                            	<a href="/admin/goods/{{ $v->id }}/edit" class="btn btn-info">修改</a>
                            	<form action="/admin/goods/{{ $v->id }}" method="post" style="display:inline-block;">
                            		{{ csrf_field() }}
                            		{{ method_field('DELETE') }}
                            		<input type="submit" value="删除" class="btn btn-danger">
                            	</form>
                            </td>
                        </tr>
                        @endforeach
		            </tbody>
	        	</table>

	            
				<!-- 页码 开始 -->
            	<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
           			{{ $goods->appends(['search'=>$search])->links() }}
            
        		</div>
 				<!-- 页码 结束 -->
				
				<!-- 页码 样式 -->
            	<style>
			        .pagination{

			            margin:0px;
			        }
			        .pagination li{
			            float: left;
			            height: 20px;
			            padding: 0 10px;
			            display: block;
			            font-size: 12px;
			            line-height: 20px;
			            text-align: center;
			            cursor: pointer;
			            outline: none;
			            background-color: #444444;
			            text-decoration: none;
			            border-right: 1px solid rgba(0, 0, 0, 0.5);
			            border-left: 1px solid rgba(255, 255, 255, 0.15);
			            box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
			        }
			        .pagination a{
			             color: #fff;
			        }
			        .pagination .active{
			            
			            color: #323232;
			            border: none;
			            background-image: none;
			            box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
			            background-color: #f08dcc;
			        }
				</style>


        	</div>
        </div>
    </div>

@endsection