<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function index(Request $request)
	{
		$tags = [['name' => '知乎', 'value' => 'zhihu'], ['name' => 'v2ex', 'value' => 'v2ex'], ['name' => 'cnBeta', 'value' => 'cnbeta'], ['name' => '安全客', 'value' => 'anquanke']];
		$tag = in_array($request->tag, array_column($tags, 'value')) ? $request->tag : 'zhihu';

		if($tag == 'cnbeta') {
			$query = DB::table('cnbeta')->orderBy('inputtime','desc');
		} else {
			$query = DB::table($tag);
		}

		$list = $query->paginate(1);
		$record = DB::table('record')->first();

		return view('index', compact('tag', 'list', 'tags', 'record'));
    }
}
