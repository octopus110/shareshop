<div class="pageContent">
    <form method="post" action="user/add" class="pageForm required-validate"
          enctype="multipart/form-data" onsubmit="return iframeCallback(this)">
        {{ csrf_field()}}
        <div class="pageFormContent" layoutH="56">
            <h6 style="padding:10px 0">唯一识别编号 进入公众号->我的账号->个人信息 中获取</h6>
            <p>
                <label>商店名称：</label>
                <input name="storename" type="text" class="required" alt=""/>
            </p>

            <p style="width: 600px;">
                <label>商店简介：</label>
                <textarea name="storeintroduce" cols="60" rows="4"></textarea>
            </p>

            <label>logo上传：</label>

            <div class="upload-wrap">
                <input type="file" name="image" accept="image/*" class="valid" style="left: 0px;">
            </div>

            <div style="clear: both;height: 50px;"></div>
            <p>
                <label>微信唯一识别编号：</label>
                <input name="weixin" type="text" class="required" alt="微信唯一编号"/>
            </p>

            <p>
                <label>负责人名称：</label>
                <input name="name" type="text" class="required"/>
            </p>

            <p>
                <label>负责人手机号：</label>
                <input name="phone" class="required phone" type="text" alt=""/>
            </p>

            <p>
                <label>负责人邮箱：</label>
                <input name="email" class="required email" type="text" alt="用于登录和找回密码"/>
            </p>

            <p>
                <label>登录密码：</label>
                <input name="password" id="passwordId" class="required alphanumeric" minlength="6" maxlength="20"
                       type="text" alt=""/>
            </p>

            <p>
                <label>确认密码：</label>
                <input name="password" class="required" equalto="#passwordId" type="text" alt=""/>
            </p>

            <p>
                <label>负责人身份证号：</label>
                <input name="IDnumber" class="required IDnumeric" type="text" alt=""/>
            </p>

            <p>
                <label>公司注册号：</label>
                <input name="provider" class="required" type="text" alt=""/>
            </p>

            <p>
                <label>分红额度(元)：</label>
                <input name="profit" class="required number" value="5" type="text"/>
            </p>

            <p>
                <label>分红有效期限(天)：</label>
                <input name="deadline" class="required digits" type="text" value="3"/>
            </p>

            <p>
                <label>手续费(默认0.2)：</label>
                <input name="chang" class="required digits" type="text" value="0.2"/>
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
