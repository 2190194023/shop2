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
	    	<span>用户修改页面 : </span>
	    </div>
	    <div class="mws-panel-body no-padding">
	        <form class="mws-form" action="/admin/roles/{{ $roles->id }}" method="post" enctype="multipart/form-data">
	        	{{ csrf_field() }}
	        	{{ method_field('PUT') }}
	            <div class="mws-form-inline">
	                <div class="mws-form-row">
	                    <label class="mws-form-label">
	                        角色名称
	                    </label>
	                    <div class="mws-form-item" >
	                        <input type="text" class="small" name="rname" disabled value="{{  $roles->rname }}" style="width:300px">
	                    </div>
	                </div>

	                <div class="mws-form-row">
        				<label class="mws-form-label">角色权限</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline" style="width:550px;border:1px solid #000;padding:5px;">
        						@foreach($list as $k=>$v)
        						<h4>{{ $conall[$k] }} <small>{{ $k }}</small></h4>
									@foreach($v as $kk=>$vv)
									@if(in_array($vv['id'],$temp))

        							<li style="width:120px;border:1px solid #000;padding:3px">
        								<input type="checkbox" name="nids[]" value="{{ $vv['id'] }}" checked>
        								<label>{{ $vv['desc'] }}</label>
        							</li>
        							@else
									<li style="width:120px;border:1px solid #000;padding:3px">
        								<input type="checkbox" name="nids[]" value="{{ $vv['id'] }}">
        								<label>{{ $vv['desc'] }}</label>
        							</li>
        							@endif
        							@endforeach
        						@endforeach
        					</ul>
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