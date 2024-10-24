<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
//参加可能なroomがあれば1件返す
Route::get('/room/recive', 'App\Http\Controllers\GameController@getrooms');
//セッションからプレイヤーの状態を確認し状態にあった適切な処理を行う詳細はcontrollerに記載
Route::get('/room/check', 'App\Http\Controllers\GameController@checkroom');
//セッションの確認用
Route::get('/session/get', 'App\Http\Controllers\GameController@session');
//どんな状態でも参加可能なroomを1つ作成する
Route::get('/room/create', 'App\Http\Controllers\GameController@createroom');
//渡されたroomidの状態を戦闘状態にする
Route::POST('/room/change/battle', 'App\Http\Controllers\GameController@changebattle');
