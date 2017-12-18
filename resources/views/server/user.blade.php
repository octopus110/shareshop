<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="user/add" target="navTab" rel="add"><span>添加</span></a></li>
            <li><a class="delete" href="user/del?id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="user/modify?id={id}" target="navTab" rel="modify"><span>修改</span></a></li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th>编号</th>
            <th>负责人名字</th>
            <th>微信号</th>
            <th>店铺名称</th>
            <th>店铺logo</th>
            <th>负责人电话</th>
            <th>负责人邮箱</th>
            <th>负责人身份证号</th>
            <th>公司注册号</th>
            <th>分红额度</th>
            <th>分红有效期限</th>
            <th>注册时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr target="id" rel="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->weixin }}</td>
                <td>{{ $item->storename }}</td>
                <td><img src="/uploads/{{ $item->logo }}" alt="无标志"></td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->IDnumber }}</td>
                <td>{{ $item->provider }}</td>
                <td>{{ $item->profit }}</td>
                <td>{{ $item->deadline }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>