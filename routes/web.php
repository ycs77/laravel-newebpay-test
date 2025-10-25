<?php

use Illuminate\Support\Facades\Route;

include_once 'payment.php';
include_once 'query.php';
include_once 'cancel.php';
include_once 'close.php';
include_once 'period.php';

Route::get('/', function () {
    return view('welcome');
});
