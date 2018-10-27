<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function index(Request $request)
	{
		$tag = in_array($request->tag, ['zhihu', 'v2ex']) ? $request->tag : 'zhihu';

		if($tag == 'zhihu') {
			$list = DB::table('zhihu')->get();
		} elseif($tag == 'v2ex') {
			$list = DB::table('v2ex')->get();
		}
		return view('index', compact('tag', 'list'));
    }
}
