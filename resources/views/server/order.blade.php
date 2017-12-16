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
            <th>订单类型</th>
            <th>用户微信昵称</th>
            <th>用户微信号</th>
            <th>交易金额</th>
            <th>交易订单号</th>
            <th>订单状态</th>
            <th>物流状态</th>
            <th>下单时间</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr target="id" rel="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->type($item->type) }}</td>
                <td>{{ $item->uid }}</td>
                <td>{{ $item->uid }}</td>
                <td>{{ $item->money }}</td>
                <td>{{ $item->rid }}</td>
                <td>{{ $item->status($item->status) }}</td>
                <td>{{ $item->delivery($item->delivery) }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    @if($item->delivery==0&&$item->status==0&&$item->type==0)
                        <a class="button" href="order/send?id={{$item->id}}" target="ajaxTodo" title="确定要发货吗?"><span>发货</span></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="panelBar">
        <div class="pages">
            <span>显示</span>
            <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="150">150</option>
                <option value="200">200</option>
                <option value="250">250</option>
            </select>
            <span>条，共${totalCount}条</span>
        </div>

        <div class="pagination" targetType="navTab" totalCount="200" numPerPage="20" pageNumShown="10"
             currentPage="1"></div>

    </div>
</div>