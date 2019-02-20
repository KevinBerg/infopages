<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $content->title}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <META HTTP-EQUIV="refresh" CONTENT="{{ $content->duration }}">
    <script src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
</head>
<body class="text-center" cz-shortcut-listen="true">
<div class="container" id="wrapper">
  <div class="row">
    <div class="col"></div>
    <div class="col-10" id="start">
    <a class="twitter-timeline" id="WURST" href="https://twitter.com/{{ $content->text }}">Tweets by {{ $content->text }}</a>
    </div><div class="col">
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $('html, body').animate({ scrollTop: 15000 }, 250000, "linear");
    });
</script>
</body>
</html>
