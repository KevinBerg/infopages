<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ERROR</title>
	<META HTTP-EQUIV="refresh" CONTENT="60">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/text.css') }}" rel="stylesheet">
</head>
<body class="text-center" cz-shortcut-listen="true">
	<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
		<main role="main" class="inner cover m-5">
			<h1 class="cover-heading">ERROR.</h1>
			<p class="lead">{{ $message }}</p>
            <p>{{ __('Retry after 60 seconds') }}.</p>
		</main>
	</div>
</body>
</html>
