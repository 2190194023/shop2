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
                    	<span><i class="icon-ok"></i>友情链接添加</span>
                    </div>
                    <div class="mws-panel-body no-padding">
                    	<form id="mws-validate" class="mws-form" action="/admin/link" method="post">
                    		{{ csrf_field() }}
                        	<div class="mws-form-row">
                            	<label class="mws-form-label">链接名称</label>
                            	<div class="mws-form-item">
                                	<input type="text" name="lname" class="small">
                                </div>
                            </div>
                            <div class="mws-form-row">
                            	<label class="mws-form-label">链接地址</label>
                            	<div class="mws-form-item">
                                	<input type="text" name="lurl" class="small" placeholder="https://www.baidu.com">
                                </div>
                            </div>
						    <div class="mws-form-row">
						  		<button type="submit" class="btn btn-info">提交</button>
							</div>
                        </form>
                    </div>    	
                </div>
@endsection