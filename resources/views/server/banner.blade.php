<style>
    .banner_img_td td {
        padding: 0 10px;
    }
</style>
<div class="pageContent">
    <form method="post" action="/server/banner/update" enctype="multipart/form-data"
          class="pageForm required-validate" onsubmit="return iframeCallback(this);">

        {{ csrf_field()}}

        <div class="pageFormContent banner_img_td" layoutH="56">
            <div class="unit">
                <h2 class="contentTitle">图片上传</h2>

                <div style="padding-bottom: 10px;color: red;">*如果要替换，删除后上传即可</div>
                <table>
                    <tr>
                        <td>
                            <div class="upload-wrap">
                                <input type="file" name="image[]" accept="image/*" class="valid" style="left: 0px;">
                                @if(isset($images[0]))
                                    <div class="thumbnail">
                                        <img src="/uploads/{{ $images[0]['src'] }}"
                                             style="max-width: 80px; max-height: 80px">
                                        <a class="del-icon" href="/server/banner/del?id={{ $images[0]['id'] }}"
                                           target="ajaxTodo"></a>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <input type="text" name="src[]" placeholder="跳转地址" value="{{ isset($images[0]['href'])?$images[0]['href']:'' }}"/>
                        </td>
                        <td>
                            <div class="upload-wrap">
                                <input type="file" name="image[]" accept="image/*">
                                @if(isset($images[1]))
                                    <div class="thumbnail">
                                        <img src="/uploads/{{ $images[1]['src'] }}"
                                             style="max-width: 80px; max-height: 80px">
                                        <a class="del-icon" href="/server/banner/del?id={{ $images[1]['id'] }}"
                                           target="ajaxTodo"></a>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <input type="text" name="src[]" placeholder="跳转地址" value="{{ isset($images[1]['href'])?$images[1]['href']:'' }}"/>
                        </td>
                        <td>
                            <div class="upload-wrap">
                                <input type="file" name="image[]" accept="image/*">
                                @if(isset($images[2]))
                                    <div class="thumbnail">
                                        <img src="/uploads/{{ $images[2]['src'] }}"
                                             style="max-width: 80px; max-height: 80px">
                                        <a class="del-icon" href="/server/banner/del?id={{ $images[2]['id'] }}"
                                           target="ajaxTodo"></a>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <input type="text" name="src[]" placeholder="跳转地址" value="{{ isset($images[2]['href'])?$images[2]['href']:'' }}"/>
                        </td>
                        <td>
                            <div class="upload-wrap">
                                <input type="file" name="image[]" accept="image/*">
                                @if(isset($images[3]))
                                    <div class="thumbnail">
                                        <img src="/uploads/{{ $images[3]['src'] }}"
                                             style="max-width: 80px; max-height: 80px">
                                        <a class="del-icon" href="/server/banner/del?id={{ $images[3]['id'] }}"
                                           target="ajaxTodo"></a>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <input type="text" name="src[]" placeholder="跳转地址" value="{{ isset($images[3]['href'])?$images[3]['href']:'' }}"/>
                        </td>
                    </tr>
                </table>


            </div>
        </div>
        <div class="formBar">
            <ul>
                <li>
                    <div class="buttonActive">
                        <div class="buttonContent">
                            <button type="submit">提交</button>
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