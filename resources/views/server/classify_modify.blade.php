<div class="pageContent">
    <form method="post" action="classify/modify" enctype="multipart/form-data" class="pageForm required-validate"
          onsubmit="return iframeCallback(this);">
        <input type="hidden" name="id" value="{{ $data->id }}">
        {{ csrf_field()}}
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>分类名称：</label>
                <input name="name" type="text" class="required" size="30" value="{{ $data->name }}" alt="输入名称"/>
            </p>

            <label>图标上传：</label>
            <img src="/uploads/{{ $data->src }}" style="max-width: 80px; max-height: 80px">
            <div class="upload-wrap">
                <input type="file" name="image" accept="image/*" class="valid" style="left: 0px;">
                @if($data->src)
                    <div class="thumbnail">

                        <a class="del-icon" href="/server/banner/del?id={{ $data->id }}"
                           target="ajaxTodo"></a>
                    </div>
                @endif
            </div>

            <div class="clear"></div>

            <p>
                <label>排序号：</label>
                <input name="sort" type="text" size="30" value="{{ $data->sort }}" alt="输入数字"/>
            </p>
        </div>
        <div class="formBar">
            <ul>
                <li>
                    <div class="buttonActive">
                        <div class="buttonContent">
                            <button type="submit">保存</button>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="button">
                        <div class="buttonContent">
                            <button type="button" class="close">取消</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </form>
</div>
