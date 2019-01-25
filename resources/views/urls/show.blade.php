@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Pages') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Page Title') }}</th>
                                <th>{{ __('URL') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td>{{ $page->title }}</td>
                                    <td><a href="{{ url('render', [$page->title] ) }}" target="_blank">{{ url('render', [$page->title] ) }}</a></td>
                                    <td><a href="{{ url('pages', [$page->id] ) }}">{{ __('Edit') }}</a></td>
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
