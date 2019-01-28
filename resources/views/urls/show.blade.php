@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Page and Content overview') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Page Title') }}</th>
                                <th>{{ __('Page Description') }}</th>
                                <th>{{ __('URL') }}</th>
                                <th>{{ __('Contents') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td><a href="{{ url('pages', [$page->id] ) }}">{{ $page->title }}</a></td>
                                    <td>{{ $page->description }}</td>
                                    <td><a href="{{ url('render', [$page->title] ) }}" target="_blank">{{ url('render', [$page->title] ) }}</a></td>
                                    <td>
                                    @if ($page->contents)
                                        @foreach ($page->contents as $content)
                                            <p><a href="{{ url('contents', [$content->id] ) }}">{{ $content->title }} ({{ $content->status == true ? __('Active') : __('Inactive') }})</a></p>
                                        @endforeach
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
