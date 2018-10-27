<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>news</title>
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
				最后获取时间: {{ $list[0]->created_at }}
			</h5>
			@foreach($tags as $v)
				<button type="button" class="btn btn-link btn-small @if($tag == $v['value']) active @endif"><a href="/?tag={{ $v['value'] }}" @if($tag == $v['value'])  class="text-muted" @else style="color: black" @endif>{{ $v['name'] }}</a> </button>
			@endforeach
			<br/>
			<table class="table table-bordered table-hover" style="margin-top: 10px;">
				<thead>
				<tr>
					<th>
						编号
					</th>
					<th>
						标题
					</th>
					<th>
						回复数
					</th>
				</tr>
				</thead>
				<tbody>
				@foreach($list as $item)
					<tr>
						<td>
							{{ $item->id }}
						</td>
						<td>
							<a href="{{ $item->link }}">{{ $item->title }}</a>
						</td>
						<td>
							{{ $item->reply_number }}
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

</body>
</html>