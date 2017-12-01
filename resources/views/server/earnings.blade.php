<div class="pageContent sortDrag" selector="h1" layoutH="42">
    <div class="panel" defH="150">
        {{--     <h1>{{  }}</h1>--}}

        <div>
            <table class="table" width="100%" layoutH="138">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>获利金额</th>
                    <th>产品ID</th>
                    <th>产品名称</th>
                    <th>获利时间</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->money }}</td>
                        <td>{{ $item->cid }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>