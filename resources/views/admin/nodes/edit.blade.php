@extends('admin.public.index')


@section('content')

	<!-- 显示错误信息 开始 -->
	@if (count($errors) > 0)
	    <div class="mws-form-message error">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<!-- 显示错误信息 结束 -->

	<!-- 内容 开始 -->
	<div class="mws-panel grid_8">
		<div class="mws-panel-header">
	    	<span>权限修改页面 : </span>
	    </div>
	    <div class="mws-panel-body no-padding">
	        <form class="mws-form" action="/admin/nodes/{{ $nodes->id }}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	        	{{ method_field('PUT') }}
	            <div class="mws-form-inline">
	                <div class="mws-form-row">
	                    <label class="mws-form-label">
	                        权限名称
	                    </label>
	                    <div class="mws-form-item" >
	                        <input type="text" class="small" name="desc" value="{{ $nodes->desc }}" style="width:300px">
	                    </div>
	                </div>

	                <div class="mws-form-row">
	                    <label class="mws-form-label">
	                        控制器名称
	                    </label>
	                    <div class="mws-form-item" >
	                        <input type="text" class="small" name="cname" value="{{ $nodes->cname }}" style="width:300px">
	                    </div>
	                </div>

	                <div class="mws-form-row">
	                    <label class="mws-form-label">
	                        方法名称
	                    </label>
	                    <div class="mws-form-item" >
	                        <input type="text" class="small" name="aname" value="{{ $nodes->aname }}" style="width:300px">
	                    </div>
	                </div>
	            </div>
	            <div class="mws-button-row">
	                <input type="submit" value="提交" class="btn btn-info">               
	            </div>
	        </form>
	    </div>   	
	</div>
	<!-- 内容 结束 -->
@endsection