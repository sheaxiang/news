<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function index(Request $request)
	{
		$tags = [['name' => '知乎', 'value' => 'zhihu'], ['name' => 'v2ex', 'value' => 'v2ex']];
		echo 1;
		dd(in_array($request->tag, array_column($tags, 'value')));
		$tag = in_array($request->tag, array_column($tags, 'value')) ? $request->tag : 'zhihu';

		if($tag == 'zhihu') {
			$list = DB::table('zhihu')->get();
		} elseif($tag == 'v2ex') {
			$list = DB::table('v2ex')->get();
		}
		return view('index', compact('tag', 'list', 'tags'));
    }
}
