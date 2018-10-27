<?php

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

Route::get('/', 'IndexController@index');

Route::post('/git/web_hook', function (\Illuminate\Http\Request $request) {
	$target = '/www/wwwroot/news.webooc.com'; // 生产环境web目录

	$signature = "sha1=".hash_hmac('sha1', $request->getContent(), env('WEBHOOK_SECRET_TOKEN'));

	if(strcmp($signature, $request->header('X-Hub-Signature')) != 0){
		exit('error request');
	}

	var_dump(shell_exec("cd $target ;git pull 2>&1"));
	exit;
});
