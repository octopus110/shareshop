<?php
//Route::any('/login', 'memberController@login');
Route::get('/', 'indexController@index');
Route::get('/list/{id?}/{k?}', 'indexController@_list');
Route::any('/ajax_list/{id?}/{k?}', 'indexController@ajax_list');//ajax获取产品 下拉刷新
Route::any('/details/{id?}', 'indexController@detail');

Route::any('/cart', 'memberController@carts');//购物车
Route::any('/cart/deal/{id?}', 'memberController@cartDel');

Route::any('/order/del/{id?}', 'memberController@order_del');//删除订单
Route::any('/obligation/{type?}', 'memberController@obligation');//待付款 待签收 待发货

Route::get('/transaction', 'memberController@transaction');
Route::any('/address', 'memberController@address');
Route::get('/address/deal/{id?}/{t?}', 'memberController@address_deal');
Route::any('/address/edit/{id?}', 'memberController@edit');

Route::any('/wechat', 'WechatController@serve');

Route::group(['middleware' => 'wechat.oauth'], function () {
    Route::get('/member', 'memberController@member'); //用户页面
    Route::any('/create/order', 'indexController@order');//生成订单

    Route::any('/cart', 'memberController@carts');//购物车
});

Route::any('/pay', 'indexController@pay');//支付
Route::any('/pay/callback', 'indexController@callback');//支付回调

Route::any('/multiple_pay', 'indexController@multiple_pay');//根据订单id支付（待支付）
Route::any('/multiple_pay/callback', 'indexController@multiple_callback');//根据订单id支付（待支付） 支付回调

Route::any('/pay/success', function () {//支付成功
    return view('pay_success');
});

Route::group(['prefix' => 'server'], function () {

    Auth::routes();

    Route::get('/home', 'homeController@index')->name('home');
    Route::get('/quit', 'homeController@quit')->name('quit');
    //多图片上传接口
    Route::any('/update', 'updateController@images');
    //分类管理
    Route::any('/classify', 'classifyController@_list');
    Route::any('/classify/add', 'classifyController@add');
    Route::any('/classify/del', 'classifyController@del');
    Route::any('/classify/modify', 'classifyController@modify');
    //商品管理
    Route::any('/commodity', 'commodityController@_list');
    Route::any('/commodity/add', 'commodityController@add');
    Route::any('/commodity/del', 'commodityController@del');
    Route::any('/commodity/modify', 'commodityController@modify');
    Route::any('/commodity/detail/{id}', 'commodityController@detail');
    Route::any('/commodity/soldout', 'commodityController@soldout');
    //订单管理
    Route::any('/order', 'orderController@_list');
    Route::any('/order/stop', 'orderController@stop');
    Route::any('/order/send', 'orderController@send');
    //个体渠道商
    Route::any('/channel', 'channelController@_list');
    Route::any('/channel/send', 'channelController@send');
    Route::any('/channel/earnings/{id}', 'channelController@earnings');
    //注册商管理
    Route::any('/user', 'userController@_list');
    Route::any('/user/add', 'userController@add');
    Route::any('/user/del', 'userController@del');
    Route::any('/user/modify', 'userController@modify');
    //管理员管理
    Route::any('/admin', 'sundryController@admin');
    Route::any('/admin/add', 'sundryController@add');
    Route::any('/admin/del', 'sundryController@del');
    Route::any('/admin/modify', 'sundryController@modify');
    //首页轮播图管理
    Route::any('/banner', 'sundryController@banner');
    Route::any('/banner/update', 'updateController@banner');
    Route::any('/banner/del', 'sundryController@banner_del');
});