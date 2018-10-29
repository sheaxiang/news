<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function index(Request $request)
	{
		$tags = [['name' => '知乎', 'value' => 'zhihu'], ['name' => 'v2ex', 'value' => 'v2ex'], ['name' => '微博', 'value' => 'weibo'], ['name' => '网易新闻', 'value' => 'wy163'], ['name' => '腾讯新闻', 'value' => 'tengxun'], ['name' => 'cnBeta', 'value' => 'cnbeta'], ['name' => '安全客', 'value' => 'anquanke']];

		$tag = in_array($request->tag, array_column($tags, 'value')) ? $request->tag : Cache::get('tag', 'zhihu');

		$query = DB::table($tag);
		if($tag == 'cnbeta') {
			$query = $query->orderBy('inputtime','desc');
		} elseif ($tag == 'wy163' || $tag == 'tengxun') {
			$query->orderBy('update_time','desc');
		}

		$list = $query->paginate(50);

		Cache::forever('tag', $tag);

		$record = DB::table('record')->where('title', $tag)->orderBy('created_at', 'desc')->first();

		return view('index', compact('tag', 'list', 'tags', 'record'));
    }
}
