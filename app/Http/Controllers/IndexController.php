<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function index(Request $request)
	{
		$tags = [['name' => '知乎', 'value' => 'zhihu'], ['name' => 'v2ex', 'value' => 'v2ex'], ['name' => 'cnBeta', 'value' => 'cnbeta'], ['name' => '安全客', 'value' => 'anquanke']];
		dd(Cache::has('tag'));
		$tag = in_array($request->tag, array_column($tags, 'value')) ? $request->tag : Cache::get('tag', 'zhihu');

		if($tag == 'cnbeta') {
			$query = DB::table('cnbeta')->orderBy('inputtime','desc');
		} else {
			$query = DB::table($tag);
		}

		$list = $query->paginate(40);

		$record = DB::table('record')->first();

		Cache::forever('tag', $tag);

		return view('index', compact('tag', 'list', 'tags', 'record'));
    }
}
