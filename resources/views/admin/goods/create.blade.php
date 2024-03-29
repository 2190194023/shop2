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
                    	<span><i class="icon-ok"></i>商品添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form id="mws-validate" class="mws-form" enctype="multipart/form-data" action="/admin/goods" method="post">
                    		{{ csrf_field() }}
                        	<div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                        	<div class="mws-form-inline">	
                            	
                            	<div class="mws-form-row">
                                	<label class="mws-form-label">商品分类</label>
                                	<div class="mws-form-item">
                    					<select class="small"  name="tid">
                                        	<option value="0">--请选择--</option>
                                        	@foreach($cates as $k=>$v)
                                        	<option value="{{ $v->id }}" {{ $v->id == $id ? 'selected' : '' }}>{{ $v->cname }}</option>
                                        	@endforeach 
                    					</select>
                                    </div>
                                </div>

                              	<div class="mws-form-row">
                                	<label class="mws-form-label">商品名称</label>
                                	<div class="mws-form-item">
                                    	<input type="text" name="gname" class="small">
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                	<label class="mws-form-label">生产厂家</label>
                                	<div class="mws-form-item">
                                    	<input type="text" name="gcompany" class="small">
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                	<label class="mws-form-label">简介</label>
                                	<div class="mws-form-item">
                                    
                                    	<textarea name="gdescr" rows="10" cols="85">
                                    	</textarea>
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                	<label class="mws-form-label">单价</label>
                                	<div class="mws-form-item">
                                    	<input type="text" name="gprice" class="small">
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                	<label class="mws-form-label">尺寸</label>
                                	<div class="mws-form-item">
                                    	<input type="text" name="size" class="small">
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                	<label class="mws-form-label">状态</label>
                                	<div class="mws-form-item">
                                    	<select class="small"  name="gstatus">
                                        	<option value="0">--请选择--</option>
                                        	<option value="1">--新添加--</option>
                                        	<option value="2">--在售--</option>
                                        	<option value="3">--下架--</option>
                    					</select>
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                	<label class="mws-form-label">库存量</label>
                                	<div class="mws-form-item">
                                    	<input type="text" name="gtock" class="small">
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                	<label class="mws-form-label">型号</label>
                                	<div class="mws-form-item">
                                    	<input type="text" name="xinghao" class="small">
                                    </div>
                                </div>
                                <div class="mws-form-row" style="width: 350px">
                                    <label class="mws-form-label">商品图片</label>
                                    <div class="mws-form-item">
                                        <input type="file" name="url" class="small">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                	<label class="mws-form-label">活动</label>
                                	<div class="mws-form-item">
                                    	<select class="small"  name="pid">
                                        	<option value="0">--请选择--</option>
                                        	@foreach($huodong as $kk=>$vv)
                                        	<option value="{{ $vv->id }}">活动：{{ $vv->id }}</option>
                                        	@endforeach 
                    					</select>
                                    </div>
                                </div>
                            </div>
                            <div class="mws-button-row">
                            	<input type="submit" class="btn btn-danger">
                            </div>
                        </form>
                    </div>    	
                </div>
@endsection