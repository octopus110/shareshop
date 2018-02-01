<div class="pageHeader">
    <form action="/server/order" method="post" onsubmit="return navTabSearch(this);">
        <div class="searchBar">
            <table class="searchContent">
                <tr>
                    <td>
                        <select class="combox" name="status">
                            <option value="-1" {{ $status==-1?'selected':'' }}>订单状态</option>
                            <option value="0" {{ $status==0?'selected':'' }}>已付款</option>
                            <option value="1" {{ $status==1?'selected':'' }}>未付款</option>
                            <option value="2" {{ $status==2?'selected':'' }}>被关闭</option>
                        </select>
                    </td>
                    <td>
                        <select class="combox" name="delivery">
                            <option value="-1" {{ $delivery==-1?'selected':'' }}>物流状态</option>
                            <option value="0" {{ $delivery==0?'selected':'' }}>未发货</option>
                            <option value="1" {{ $delivery==1?'selected':'' }}>已发货</option>
                            <option value="2" {{ $delivery==2?'selected':'' }}>已签收</option>
                        </select>
                    </td>
                    <td>
                        <div class="buttonActive">
                            <div class="buttonContent">
                                <button type="submit">检索</button>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </form>
</div>
<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="delete" href="order/stop?id={id}" target="ajaxTodo" title="确定要关闭吗?"><span>关闭订单</span></a>
            </li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th>编号</th>
            <th>商品名称</th>
            <th>商家ID</th>
            <th>商家名称</th>
            <th>订单类型</th>
            <th>用户唯一号</th>
            <th>用户微信昵称</th>
            <th>交易金额</th>
            <th>交易订单号</th>
            <th>订单状态</th>
            <th>物流状态</th>
            <th>物流单号</th>
            <th>物流公司</th>
            <th>下单时间</th>
            @if($userType)
                <th @show:$userType></th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr target="id" rel="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->storeid }}</td>
                <td>{{ $item->storename }}</td>
                <td>{{ $item->type($item->type) }}</td>
                <td>{{ $item->openid }}</td>
                <td>{{ $item->nickname }}</td>
                <td>{{ $item->money }}</td>
                <td>{{ $item->rid }}</td>
                <td>{{ $item->status($item->status) }}</td>
                <td>{{ $item->delivery($item->delivery) }}</td>
                <td>{{ $item->express_id }}</td>
                <td>{{ $item->express_name }}</td>
                <td>{{ $item->created_at }}</td>
                @if($userType)
                    <td>
                        @if($item->delivery==0&&$item->status==0&&$item->type==0)
                            {{--<a class="button" href="order/send?id={{$item->id}}" target="ajaxTodo"
                               title="确定要发货吗?"><span>发货</span></a>--}}
                            <a class="button" href="/server/order/send?id={{$item->id}}" target="dialog" rel="express"
                               mask="true"><span>发货</span></a>
                        @endif
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>