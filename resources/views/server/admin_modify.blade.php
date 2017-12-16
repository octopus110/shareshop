<div class="pageContent">
    <form method="post" action="admin/modify" class="pageForm required-validate"
          onsubmit="return validateCallback(this, navTabAjaxDone)">
        <div class="pageFormContent" layoutH="56">
            <input type="hidden" name="id" value="{{ $data->id }}">
            <p>
                <label>微信号：</label>
                <input name="weixin" type="text" class="required" value="{{ $data->weixin }}"/>
            </p>

            <p>
                <label>名称：</label>
                <input name="name" type="text" class="required" value="{{ $data->name }}"/>
            </p>

            <p>
                <label>手机号：</label>
                <input name="phone" class="required phone" type="text" value="{{ $data->phone }}"/>
            </p>

            <p>
                <label>邮箱：</label>
                <input name="email" class="required email" type="text" value="{{ $data->email }}"/>
            </p>

            <p>
                <label>密码：</label>
                <input name="password" id="passwordId" class="alphanumeric" minlength="6" maxlength="20"
                       type="text" alt="默认保留原密码"/>
            </p>

            <p>
                <label>确认密码：</label>
                <input name="password" class="" equalto="#passwordId" type="text" alt=""/>
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
