<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Ycs77\NewebPay\Facades\NewebPay;

// 1. MPG 多功能收款

Route::prefix('/payment')->group(function () {

    // 1-1. 基本收款範例
    //
    // http://localhost:8000/payment/basic
    //
    // 4000-2211-1111-1111 (一次付清+分期付款)
    // 4003-5511-1111-1111 (紅利折抵)
    Route::get('/basic', function () {
        return NewebPay::payment()
            ->withOrder('Order'.time())
            ->withAmount(1050)
            ->withItemDescription('測試商品')
            ->withEmail('customer@example.com')
            ->submit();
    });

    // 1-2. 測試 ReturnUrl (付款完成後導向頁面)
    Route::get('/return', function () {
        return NewebPay::payment()
            ->withOrder('Order'.time())
            ->withAmount(1050)
            ->withItemDescription('測試商品')
            ->withEmail('customer@example.com')
            ->withReturnUrl(config('app.url').'/payment/return/callback')
            ->submit();
    });
    Route::post('/return/callback', function (Request $request) {
        $result = NewebPay::result($request);
        return response()->json($result->data());
    });

    // 1-3. 測試 ReturnUrl (付款完成後的通知連結，以幕後方式回傳給商店相關支付結果資料)

    // 1-4. 測試 CustomerUrl (商店取號網址)

    // 1-5. 測試 ClientBackUrl (付款時點擊「返回按鈕」的網址)

});
