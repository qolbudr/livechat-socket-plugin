<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web;
use App\Http\Controllers\Chat;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Web::class, 'index']);
Route::get('fetch_all_chat/{chat_id}/{from_id}', [Chat::class, 'get_all_chat']);
Route::get('fetch_all_message/{chat_id}/{from_id}/{to_id}', [Chat::class, 'get_all_message']);
Route::get('send_message/{chat_id}/{from_id}/{to_id}/{from_name}/{to_name}/{message}', [Chat::class, 'send_message']);
