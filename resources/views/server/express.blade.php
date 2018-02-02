<div class="pageContent">
    <form method="post" action="/server/order/send" class="pageForm required-validate"
          onsubmit="return validateCallback(this, navTabAjaxDone);">
        <input type="hidden" name="id" value="{{ $id }}">

        <div class="pageFormContent" layoutH="56">
            <p>
                <label>快递公司：</label>
                <select name="express_name" class="required combox">
                    <option value="顺丰快递">顺丰快递</option>
                    <option value="圆通快递">圆通快递</option>
                    <option value="中通快递">中通快递</option>
                    <option value="申通快递">申通快递</option>
                    <option value="韵达快递">韵达快递</option>
                    <option value="邮政快递">邮政快递</option>
                    <option value="天天快递">天天快递</option>
                    <option value="京东快递">京东快递</option>
                    <option value="宅急送">宅急送</option>

                </select>
            </p>

            <p>
                <label>快递单号：</label>
                <input name="express_id" type="text" value="" class="required combox"/>
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
