<?php
Route::get('/', 'indexController@index');
Route::get('/list/{id?}/{k?}', 'indexController@_list');
Route::any('/ajax_list/{id?}/{k?}', 'indexController@ajax_list');//ajax获取产品 下拉刷新
Route::get('/member', function () {
    return view('member');
});
Route::get('/cart', function () {
    return view('cart');
});
Route::get('/transaction', function () {
    return view('transaction');
});
Route::get('/address', function () {
    return view('address');
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