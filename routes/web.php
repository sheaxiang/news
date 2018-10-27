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

Route::any('/git/web_hook', function (\Illuminate\Http\Request $request) {
	$target = '/www/wwwroot/news.webooc.com'; // 生产环境web目录

	$token = 'goodbad12';
	dd($request->all());
	/*$json = json_decode(file_get_contents('php://input'), true);

	if (empty($json['config']['secret']) || $json['config']['secret'] !== $token) {
		return response()->json('error request',400);
	}*/

	$cmd="cd $target ; sudo git pull 2>&1";
	echo 1;
	dd(shell_exec($cmd));
	return response()->json(shell_exec($cmd));
});
