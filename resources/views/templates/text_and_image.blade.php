<!DOCTYPE html>
<html>
<head>
    <title>{{ $content->title }}</title>
	<meta charset="utf-8">
	<META HTTP-EQUIV="refresh" CONTENT="{{ $content->duration }}">
    <link href="{{ asset('css/text_and_image.css') }}" rel="stylesheet">
</head>
<body>
	<div class="header">TODO</div>
	<div class="content">
		<div class="textContent">
                IMAGE TEXT TYPE
			    {{ $content->text }}
			<br/><br/>
		</div>
	</div>
</body>
</html>
