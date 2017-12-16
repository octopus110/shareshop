<div class="pageContent">
    <form method="post" action="admin/add" class="pageForm required-validate"
          onsubmit="return validateCallback(this, navTabAjaxDone)">
        <div class="pageFormContent" layoutH="56">
            <p>
                <label>微信号：</label>
                <input name="weixin" type="text" class="required" alt="关注我们公众号的微信号"/>
            </p>

            <p>
                <label>名称：</label>
                <input name="name" type="text" class="required" alt="输入真实名字"/>
            </p>

            <p>
                <label>手机号：</label>
                <input name="phone" class="required phone" type="text" alt="输入真实手机号"/>
            </p>

            <p>
                <label>邮箱：</label>
                <input name="email" class="required email" type="text" alt="用于用户登录和找回密码"/>
            </p>

            <p>
                <label>密码：</label>
                <input name="password" id="passwordId" class="required alphanumeric" minlength="6" maxlength="20"
                       type="text" alt=""/>
            </p>

            <p>
                <label>确认密码：</label>
                <input name="password" class="required" equalto="#passwordId" type="text" alt=""/>
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
