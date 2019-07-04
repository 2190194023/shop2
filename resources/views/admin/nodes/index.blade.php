@extends('admin.public.index')

@section('content')
	<div class="mws-panel grid_8">
    	<div class="mws-panel-header">
        	<span><i class="icon-table"></i> 权限列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            	<div class="dataTables_filter" id="DataTables_Table_1_filter">
            		<form action="/admin/nodes" method="get">
	            		<label>
	            			<input type="text" name="search_uname" placeholder="权限名" value="{{ $params['search_uname'] or '' }}"">
	            		</label>
	       
	            		<label>
							<input type="submit" value="搜索"  class="btn btn-success">
	            		</label>
            		</form>
            	</div>
            	<table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">

	                <thead>
	                    <tr>
	                        <th>id</th>
	                        <th>权限名称</th>
	                        <th>控制器名称</th>
	                        <th>方法名称</th>
	                        <th>操作</th>
	                    </tr>
	                </thead>
	                
		            <tbody role="alert" aria-live="polite" aria-relevant="all">
		            	@foreach($data as $k=>$v)
		            	<tr class="odd">
		                    <td style="text-align: center;">{{ $v->id }}</td>
		                    <td style="text-align: center;">{{ $v->desc }}</td>
		                    <td style="text-align: center;">{{ $v->cname }}</td>
		                    <td style="text-align: center;">{{ $v->aname }}</td>

		                    <td style="text-align: center;">
								<a href="/admin/nodes/{{ $v->id }}/edit" class="btn btn-info">修改权限</a>
		                    </td>
		                </tr>
		              	@endforeach
		            </tbody>

	        	</table>
	           	<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
           			{{ $data->appends($params)->links() }}
        		</div>

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
@endsection