@extends('admin.public.index')


@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span><i class="icon-table"></i> 轮播图列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    <form class="form-inline" action="/admin/slideshow">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="轮播图标题">
                            <button type="submit" class="btn btn-success">搜索</button>
                        </div>
                    </form>
                </div>
                <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">

                    <thead>
                        <tr>
                            <th>id</th>
                            <th>标题</th>
                            <th>图片</th>
                            <th>链接地址</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    
                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                        @foreach($data as $k=>$v)
                        <tr class="odd" style="text-align:center;">
                            <td>{{ $v->id }}</td>
                            <td>{{ $v->title }}</td>
                            <td><img src="/uploads/{{ $v->surl }}" width="100px"></td>
                            <td><a href="{{ $v->furl }}" style="color:#000;">{{ $v->furl }}</a></td>
                            <td style="width:150px;">
                                    <a href="javascript:;" id="sta" token="{{ csrf_token() }}" onclick="member_sta(this,'{{ $v->id }}','{{ $v->status }}')" class="btn btn-info">@if($v->status == 0) 未激活 @elseif($v->status == 1) 已激活 @endif</a>
                            </td>
                            <td style="width:230px;">
                                <a title="删除" class="btn btn-danger" token="{{ csrf_token() }}" onclick="member_del(this,'{{ $v->id }}')" href="javascript:;">删除</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                    {{ $data->appends(['search'=>$search])->links() }}
                </div>
                
                <script type="text/javascript">
                    /*删除*/
                    function member_del(obj,id){
                        let token = $(obj).attr('token');
                        $.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
                        if(!window.confirm('你确定要删除吗?')){
                            return false;
                        }
                        // 发送ajax删除
                        $.post('/admin/adminuser/del',{id:id,_method:"DELETE"},function(res){
                        if(res == 'ok'){
                            // 删除tr节点
                            alert('删除成功');
                            window.location.href = window.location.href;
                        }else{
                            alert('删除失败')
                        }
                    },'html')
                              
                };
                </script>

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