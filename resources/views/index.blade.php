<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>聚合星</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link href="https://cdn.bootcss.com/twitter-bootstrap/3.0.1/css/bootstrap.min.css" rel="stylesheet">
	<style>
		a:link { text-decoration: none;color: black}
	</style>
</head>
<body>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column col-lg-12">
			<h3 class="text-center">
				News
			</h3>
			<h5 class="text-center text-warning">
				最后获取时间: {{ $record ->created_at }}
			</h5>
			@foreach($tags as $v)
				<button type="button" class="btn btn-link btn-small @if($tag == $v['value']) active @endif"><a href="/?tag={{ $v['value'] }}" @if($tag == $v['value'])  class="text-muted" @else style="color: black" @endif>{{ $v['name'] }}</a> </button>
			@endforeach
			<br/>
			<table class="table table-bordered table-hover" style="margin-top: 10px;">
				<thead>
				<tr>
					<th class="text-center">
						编号
					</th>
					<th class="text-center">
						标题
					</th>
					@if(isset($list[0]->reply_number))
						<th class="text-center">
							回复数
						</th>
					@endif

					@if(isset($list[0]->red_number))
						<th class="text-center">
							热度
						</th>
					@endif
				</tr>
				</thead>
				<tbody>
				@foreach($list as $k => $item)
					<tr>
						<td class="text-center">
							{{ $k + 1 }}
						</td>
						<td class="text-center">
							<a href="{{ $item->link }}">{{ $item->title }}</a>
						</td>
						@if(isset($list[0]->reply_number))
							<td class="text-center">
								{{ $item->reply_number }}
							</td>
						@endif
						@if(isset($list[0]->red_number))
							<td class="text-center">
								{{ $item->red_number }}
							</td>
						@endif
					</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{{ $list->appends(['tag' => $tag])->links() }}
			</div>
		</div>
	</div>
</div>
</body>
</html>