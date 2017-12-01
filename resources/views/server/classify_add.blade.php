<div class="pageContent">
    <form method="post" action="classify/add" class="pageForm required-validate" enctype="multipart/form-data"
          onsubmit="return iframeCallback(this)">
        {{ csrf_field()}}
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>分类名称：</label>
                <input name="name" type="text" class="required" alt="输入名称"/>
            </p>

            <label>图标上传：</label>

            <div class="upload-wrap">
                <input type="file" name="image" accept="image/*" class="valid" style="left: 0px;">
            </div>

            <div class="clear"></div>

            <p>
                <label>分类排序：</label>
                <input name="sort" class="digits" type="text" size="30" alt="请输入数字"/>
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
