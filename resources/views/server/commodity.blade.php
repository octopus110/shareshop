<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="commodity/add" target="navTab" rel="add"><span>添加</span></a></li>
            <li>
                <a class="delete" href="commodity/del?id={id}" target="ajaxTodo" title="确定要删除吗?">
                    <span>删除</span>
                </a>
            </li>
            <li><a class="edit" href="commodity/modify?id={id}" target="navTab" rel="modify"><span>修改</span></a></li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th>编号</th>
            <th>商品名称</th>
            <th>商品类别</th>
            <th>商品数量</th>
            <th>商品销量</th>
            <th>商品价格</th>
            <th>商品状态</th>
            <th>上架时间</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr target="id" rel="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->classify }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->sales }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->status($item->status) }}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a class="button" href="commodity/detail/{{ $item->id  }}" target="dialog" rel="detail"
                       mask="true"><span>查看简介</span></a>
                    @if($item->status)
                        <a class="button" href="commodity/soldout?id={{$item->id}}&s=0" target="ajaxTodo"
                           title="确定要上架吗?"><span>上架</span></a>
                    @else
                        <a class="button" href="commodity/soldout?id={{$item->id}}&s=1" target="ajaxTodo"
                           title="确定要下架吗?"><span>下架</span></a>
                    @endif

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>