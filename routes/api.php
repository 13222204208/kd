<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('minapp')->group(function (){

    Route::group(['namespace' => 'Minapp\User'], function () {

        Route::post('login', 'LoginController@login');//用户登陆
        Route::get('agreement', 'AgreementController@agreement');//服务协议

        Route::group(['middleware' => 'auth:api'], function () {   
            Route::post('upload-img', 'RealNameController@uploadImg');//上传图片      
            Route::post('real-name', 'RealNameController@realName');//实名认证    

            Route::post('store-address', 'AddressController@storeAddress');//添加新地址
            Route::get('address-list', 'AddressController@addressList');//地址列表
            Route::post('del-address', 'AddressController@delAddress');//删除地址
            Route::post('update-address', 'AddressController@updateAddress');//更新地址

        });
    });

    Route::group(['namespace' => 'Minapp\Order'], function () {
        
        Route::group(['middleware' => 'auth:api'], function () {   
            Route::post('store-order', 'ExpressOrderController@storeOrder');//发货
            Route::get('order-list', 'ExpressOrderController@orderList');//订单列表
        });
    });
});

Route::prefix('admin')->group(function (){

    Route::group(['namespace' => 'Admin\Login'], function () {

        Route::post('login','LoginController@login');//登录

        Route::post('logout','LoginController@logout');//登出

        Route::group(['middleware' => 'auth:admin'], function () {
            Route::get('info','LoginController@info');//获取后台登陆信息      
        });
    });

    Route::group(['namespace' => 'Admin\Contact'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            
            Route::resource('contact-us', 'ContactUsController');//联系我们
            
            
        });
    });

    Route::group(['namespace' => 'Admin\UserAgreement'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            
            Route::resource('agreement', 'UserAgreementController');//用户协议
                   
        });
    });

    Route::group(['namespace' => 'Admin\Consult'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            
            Route::resource('consult-type', 'ConsultTypeController');//参考类型

            Route::resource('consult', 'ConsultController');//参考内容      
        });
    });

    Route::group(['namespace' => 'Admin\RealName'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('real-name', 'RealNameController');//实名认证
            
        });
    });

    Route::group(['namespace' => 'Admin\Notepad'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('notepad', 'NotepadController');//记事本
        });
    });

    Route::group(['namespace' => 'Admin\Triage'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('triage', 'TriageController');//检伤分类
        });
    });

    Route::group(['namespace' => 'Admin\UserGuide'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('user-guide', 'UserGuideController');//用户指南
        });
    });

    Route::group(['namespace' => 'Admin\Order'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('order', 'OrderController');//订单列表
        });
    });

    Route::group(['namespace' => 'Admin\Position'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('position', 'PositionController');//设置位置列表
        });
    });

    Route::group(['namespace' => 'Admin\Admin'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('admin', 'AdminController');//后台帐号
        });
    });

    Route::group(['namespace' => 'Admin\User'], function () {

        Route::group(['middleware' => 'auth:admin'], function () {   
            Route::resource('user', 'UserController');//app用户帐号
        });
    });

});