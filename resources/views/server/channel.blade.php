<div class="pageContent">
    <table class="table" width="100%" layoutH="138">
        <thead>
        <tr>
            <th>编号</th>
            <th>微信昵称</th>
            <th>身份证号</th>
            <th>获得收益</th>
            <th>已发放金额</th>
            <th>最后一次收益时间</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr target="id" rel="{{ $item->id }}">
                <td>{{ $item->id }}</td>
                <td>{{ $item->nickname }}</td>
                <td>{{ $item->IDnumber }}</td>
                <td>{{ $item->earnings }}</td>
                <td>{{ $item->getearnings }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                    <a class="button" href="channel/earnings/{{ $item->id  }}" target="dialog" rel="detail"
                       mask="true"><span>查看收益列表</span></a>
                    @if($mType)
                        <a class="button" href="channel/send?id={{$item->id}}" target="ajaxTodo" rel="send"
                           title="确定要发红包吗?"><span>发红包</span></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>