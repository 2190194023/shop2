@extends('admin.public.index')

@section('content')

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i>分类显示</span>
    </div>
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
        <div class="dataTables_filter" id="DataTables_Table_1_filter">
            <form action="/admin/users" method="get">
                <label>
                    用户名 : 
                    <input type="text" name="search_uname" value="{{ $params['search_uname'] or '' }}">
                </label>
                <label>
                    邮箱 : 
                    <input type="text" name="search_email" value="{{ $params['search_email'] or '' }}">
                </label>
                <label>
                    <input type="submit"  class="btn btn-info">
                </label>
            </form>
        </div>
        <table class="mws-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>父类名称</th>
                    <th>父级ID</th>
                    <th>分类路径</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            	@php 
                use App\Models\Cates
                @endphp

                @foreach($cates as $k=>$v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->cname }}</td>
                    <td>
                    @if($v->pid ==0)
                        顶级分类
                    @else
                    @php
                        $v = Cates::where('id',$v->pid)->first();
                        echo $v->cname;
                    @endphp
                    @endif
                    </td>
                    <td>{{ $v->path }}</td>
                    <td>
                        @if(substr_count($v->path,',') < 2)
                        <a href="/admin/cates/create?id={{ $v->id }}" class="btn btn-primary">添加子分类</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
            {{ $cates->appends(['search'=>$search])->links() }}
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