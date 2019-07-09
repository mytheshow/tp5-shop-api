<?php

use think\Route;

Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');
//Theme列表
Route::get('api/:version/theme', 'api/:version.Theme/getSimpleList');
//Theme详情
Route::get('api/:version/theme/:id', 'api/:version.Theme/getComplexOne');
//Category列表
Route::get('api/:version/category/all', 'api/:version.Category/getAllCategories');
//最新Product
Route::get('api/:version/product/recent/:count', 'api/:version.Product/getRecent');
Route::get('api/:version/product/:id', 'api/:version.Product/getOne',[],['id'=>'\d+']);
//获取指定分类下的所有商品
Route::get('api/:version/product/by_category', 'api/:version.Product/getAllInCategory');
Route::post('api/:version/token/user','api/:version.Token/getToken');
Route::Post('api/:version/address','api/:version.Address/createOrUpdateAddress');
//Order
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
//订单分页
Route::get('api/:version/order/paginate', 'api/:version.Order/getSummary');
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail',[], ['id'=>'\d+']);

//Pay
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');
Route::post('api/:version/pay/notify', 'api/:version.Pay/receiveNotify');