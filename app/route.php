<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

/**
 * 设置路由规则
 * @access public
 * @param string $rule 路由规则
 * @param string $route 路由地址
 * @param string $type 请求类型
 * @param array $option 路由参数
 * @param array $pattern 变量规则
 * @param string $group 所属分组
 * @return void
 */
//Route::rule('hello/:id', 'sample/Test/hello', 'GET|POST');
// Test
Route::get('api/:version/second', 'api/:version.Address/second');
Route::get('api/:version/three', 'api/:version.Address/three');

Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');

Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

/*Route::get('api/:version/product/by_category/:id','api/:version.Product/getAllInCategory');
Route::get('api/:version/product/:id','api/:version.Product/getOneProduct', [], ['id' => '\d+']);
Route::get('api/:version/product/recent','api/:version.Product/getRecent');*/

Route::group('api/:version/product', function (){
    Route::get('/by_category/:id', 'api/:version.Product/getAllInCategory');
    Route::get('/:id','api/:version.Product/getOneProduct', [], ['id' => '\d+']);
    Route::get('/recent','api/:version.Product/getRecent');
});

Route::get('api/:version/category/all','api/:version.Category/getAllCategories');

Route::post('api/:version/token/user', 'api/:version.Token/getToken');

Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');

Route::post('api/:version/order', 'api/:version.Order/placeOrder');
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');



