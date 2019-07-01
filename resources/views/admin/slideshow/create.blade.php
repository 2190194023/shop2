@extends('admin.public.index')

@section('content')

				

			@if (count($errors) > 0)
			    <div class="alert alert-danger">
			        <ul>
			            @foreach ($errors->all() as $error)
			                <li>{{ $error }}</li>
			            @endforeach
			        </ul>
			    </div>
			@endif

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-ok"></i>轮播图添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form id="mws-validate" enctype="multipart/form-data" class="mws-form" action="/admin/slideshow"  method="post">
                    		{{ csrf_field() }}
                        	<div class="mws-form-row">
                            	<label class="mws-form-label">标题</label>
                            	<div class="mws-form-item">
                                	<input type="text" name="title" class="small">
                                </div>
                            </div>
						  	<div class="mws-form-row">
                            	<label class="mws-form-label">跳转地址</label>
                            	<div class="mws-form-item">
                                	<input type="text" name="furl" class="small">
                                </div>
                            </div>
                            <div class="mws-form-row" style="width:200px;">
						        <label class="mws-form-label">轮播图图片</label>
						        <input type="file" name="surl" class="small" >
						  	</div>
                            <div class="mws-form-row">
                            	<label class="mws-form-label">状态</label>
                                	<input type="radio" name="status" class="small" value="0" checked>不激活
                                	<input type="radio" name="status" class="small" value="1">激活
                            </div>
						    <div class="mws-form-row">
						  		<button type="submit" class="btn btn-info">提交</button>
							</div>
                        </form>
                    </div>    	
                </div>
@endsection