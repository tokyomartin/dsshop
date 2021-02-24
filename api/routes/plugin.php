<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//如果有版本控制的话，请复制以下代码，修改版本号;访问地址把v1换成设置的版本号即可
Route::prefix('v1')->namespace('v1')->group(function () {
    // 插件
    Route::namespace('Plugin')->group(function () {
        // 插件后台
        Route::prefix('admin')->namespace('Admin')->middleware(['auth:api'])->group(function () {
            //栏目文章_s
            Route::get('column', 'ColumnController@list')->middleware(['permissions:ColumnList']);    //栏目列表
            Route::get('column/{id}', 'ColumnController@detail')->middleware(['permissions:ColumnEdit']);    //栏目详情
            Route::post('column', 'ColumnController@create')->middleware(['permissions:ColumnCreate']);    //栏目添加
            Route::post('column/{id}', 'ColumnController@edit')->middleware(['permissions:ColumnEdit']);    //栏目修改
            Route::post('column/destroy/{id}', 'ColumnController@destroy')->middleware(['permissions:ColumnDestroy']);    //栏目删除
            Route::get('article', 'ArticleController@list')->middleware(['permissions:ArticleList']);    //文章列表
            Route::get('article/{id}', 'ArticleController@detail')->middleware(['permissions:ArticleEdit']);    //文章详情
            Route::post('article', 'ArticleController@create')->middleware(['permissions:ArticleCreate']);    //文章添加
            Route::post('article/{id}', 'ArticleController@edit')->middleware(['permissions:ArticleEdit']);    //文章修改
            Route::post('article/destroy/{id}', 'ArticleController@destroy')->middleware(['permissions:ArticleDestroy']);    //文章删除
            //栏目文章_e
            //优惠券_s
            Route::get('coupon', 'CouponController@list')->middleware(['permissions:CouponList']);    //优惠券列表
            Route::post('coupon', 'CouponController@create')->middleware(['permissions:CouponCreate']);    //优惠券添加
            Route::post('coupon/{id}', 'CouponController@edit')->middleware(['permissions:CouponEdit']);    //优惠券操作
            Route::post('coupon/destroy/{id}', 'CouponController@destroy')->middleware(['permissions:CouponDestroy']);    //优惠券删除
            //优惠券_e
            //评价_s
            Route::get('comment', 'CommentController@list')->middleware(['permissions:CommentList']);    //评价列表
            Route::post('comment', 'CommentController@create')->middleware(['permissions:CommentCreate']);    //评价回复
            Route::post('comment/{state}', 'CommentController@edit')->middleware(['permissions:CommentEdit']);    //评价操作
            Route::post('comment/destroy/{id}', 'CommentController@destroy')->middleware(['permissions:CommentDestroy']);    //评价删除
            //评价_e
            //分销_s
            Route::get('distribution', 'DistributionController@list')->middleware(['permissions:DistributionList']);    //分销列表
            Route::post('distribution', 'DistributionController@create')->middleware(['permissions:DistributionCreate']);    //分销添加
            Route::post('distribution/{photo}', 'DistributionController@edit')->middleware(['permissions:DistributionEdit']);    //分销修改
            Route::post('distribution/destroy/{photo}', 'DistributionController@destroy')->middleware(['permissions:DistributionDestroy']);    //分销删除
            //分销_e
            //前台插件列表
        });
        // 插件前台
        Route::prefix('app')->namespace('Client')->middleware(['appverify', 'auth:web'])->group(function () {
            //优惠券_s
            Route::get('coupon', 'CouponController@list');    //优惠券列表
            Route::get('coupon/user/count', 'CouponController@count');    //我的优惠券数量
            Route::get('coupon/user', 'CouponController@user');    //我的优惠券列表
            Route::post('coupon', 'CouponController@create');    //领取优惠券
            //优惠券_e
            //评价_s
            Route::get('comment/detail/{id}', 'CommentController@detail');    //获取需要评价的商品列表
            Route::post('comment/{id}', 'CommentController@create');    //评价
            //评价_e
            //APP验证插件列表
        });
        Route::prefix('app')->namespace('Client')->middleware(['appverify'])->group(function () {
            //栏目文章_s
            Route::get('column', 'ColumnController@list');    //栏目列表
            Route::get('column/{id}', 'ColumnController@detail');    //栏目详情
            Route::post('column/pv/{id}', 'ColumnController@pv');    //增加栏目访问量
            Route::get('article/column/{id}', 'ArticleController@list');    //文章列表
            Route::get('article/{id}', 'ArticleController@detail');    //文章详情
            Route::post('article/pv/{id}', 'ArticleController@pv');    //增加文章访问量
            //栏目文章_e
            //评价_s
            Route::get('comment/good', 'CommentController@good');    //获取商品评价列表
            //评价_e
            //APP无需验证插件列表
        });
    });
});
