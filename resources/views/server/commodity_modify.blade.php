<style type="text/css" media="screen">
    .my-uploadify-button {
        background: none;
        border: none;
        text-shadow: none;
        border-radius: 0;
    }

    .uploadify:hover .my-uploadify-button {
        background: none;
        border: none;
    }

    .fileQueue {
        width: 400px;
        height: 150px;
        overflow: auto;
        border: 1px solid #E5E5E5;
        margin-bottom: 10px;
    }

</style>
<div class="pageContent">
    <div class="pageFormContent" layoutH="10">
        <h2 class="contentTitle">产品图片</h2>
        @foreach($images as $item)
            <img src="/uploads/{{ $item->src }}" alt="" height="100"/>
        @endforeach
        <input id="testFileInput2" type="file" name="image"
               uploaderOption="{
                                    swf:'/uploadify/scripts/uploadify.swf',
                                    uploader:'/server/update',
                                    formData:{'_token':'{{csrf_token()}}'},
                                    queueID:'fileQueue',
                                    buttonImage:'/uploadify/img/add.jpg',
                                    buttonClass:'my-uploadify-button',
                                    width:102,
                                    auto:false,
                                    onUploadSuccess:function(file,data,respone){
                                        var id = jQuery.parseJSON(data).id;
                                        var image = $('#image');
                                        image.val(image.val()+','+id);
                                    },
                                }"
        />

        <div id="fileQueue" class="fileQueue"></div>
        <input type="image" src="/uploadify/img/upload.jpg"
               onclick="$('#testFileInput2').uploadify('upload', '*');"/>
        <input type="image" src="/uploadify/img/cancel.jpg"
               onclick="$('#testFileInput2').uploadify('cancel', '*');"/>

        <form method="post" action="commodity/modify" class="pageForm required-validate"
              onsubmit="return validateCallback(this, navTabAjaxDone)">
            <input type="hidden" name="image_id" value="" id="image">
            <input type="hidden" name="id" value="{{ $commodity->id }}">

            <h2 class="contentTitle">产品信息</h2>

            <p>
                <label>所属渠道商：</label>
                @if($role == 0)
                    <select class="combox" name="sid">
                        <option value="all">选择分类</option>
                        @foreach($merchant as $item)
                            <option value="{{ $item->id }}">{{ $item->storename }}</option>
                        @endforeach
                    </select>
                @else
                    <input name="" type="text" class="required readonly" value="{{ $merchant->name }}"/>
                    <input name="sid" type="hidden" class="required" value="{{ $merchant->id }}"/>
                @endif
            </p>

            <p>
                <label>产品名称：</label>
                <input name="name" type="text" class="required" value="{{ $commodity->name }}" alt="输入名称"/>
            </p>

            <p>
                <label>产品分类：</label>
                <select class="combox" name="classify">
                    <option value="all">选择分类</option>
                    @foreach($classify as $item)
                        <option value="{{ $item->id }}" {{ $item->id == $commodity->classify_id?'selected':'' }}>{{ $item->name }}</option>
                    @endforeach
                </select>
            </p>

            <p>
                <label>库存数量：</label>
                <input name="quantity" type="text" class="required" value="{{ $commodity->quantity }}" alt="输入数量"/>
            </p>

            <p>
                <label>商品价格：</label>
                <input name="price" type="text" class="required" value="{{ $commodity->price }}" alt="输入价格"/>
            </p>

            <div style="clear: both;"></div>

            <h2 class="contentTitle">产品介绍</h2>

            <div class="unit">
                <textarea class="editor" name="description" rows="25" cols="150" tools="simple">
                    {{ $commodity->introduce }}
                </textarea>
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
</div>