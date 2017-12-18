<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="admin/add" target="navTab" rel="add"><span>添加</span></a></li>
            <li><a class="delete" href="admin/del?id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="admin/modify?id={id}" target="navTab" rel="modify"><span>修改</span></a></li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th>编号</th>
            <th>微信号</th>
            <th>名字</th>
            <th>手机号</th>
            <th>邮箱</th>
            <th>注册时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr target="id" rel="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->weixin }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>