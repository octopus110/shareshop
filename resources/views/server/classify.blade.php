<div class="pageContent">
    <div class="panelBar">
        <ul class="toolBar">
            <li><a class="add" href="classify/add" target="navTab" rel="add"><span>添加</span></a></li>
            <li><a class="delete" href="classify/del?id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
            <li><a class="edit" href="classify/modify?id={id}" target="navTab" rel="modify"><span>修改</span></a></li>
            <li class="line">line</li>
        </ul>
    </div>
    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th>编号</th>
            <th>分类名</th>
            <th>分类标志</th>
            <th>排序</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr target="id" rel="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td><img src="/uploads/{{ $item->src }}" alt="无标志" width="64px"></td>
                <td>{{ $item->sort }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>