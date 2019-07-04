@extends('admin.public.index')

@section('content')

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><i class="icon-table"></i> 订单详情</span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>订单号</th>
                    <th>商品</th>
                    <th>商品图片</th>
                    <th>单价</th>
                    <th>总价</th>
                    <th>订单时间</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align:center;">
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->uid }}</td>
                    <!-- 商品 -->
                    @php 
                        use App\Models\Goods;
                        $v = Goods::where('id',$data->money)->first();
                    @endphp
                    <td>{{ $v->gname }}</td>
                    <td><img src="/uploads/{{ $v->url }}" width="120px"></td>
                    <td>{{ $data->qian }}</td>
                    <td>{{ $data->hou }}</td>
                    <td>{{ $data->otime }}</td>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection