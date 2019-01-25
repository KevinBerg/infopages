@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Contents') }}</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Duration') }} ({{ __('Seconds') }})</th>
                                <th>{{ __('Runtime') }} ({{ __('Days') }})</th>
                                <th>{{ __('Pages') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Updated') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                                <tr class="clickable {{ $content->status == true ? 'text-white bg-success' : '' }}" onclick="window.location.href = '{{ url('contents', [$content->id] ) }}';">
                                    <td>{{ $content->id }}</td>
                                    <td>{{ $content->title }}</td>
                                    <td>{{ $content->description }}</td>
                                    <td>{{ $contentTypes->find($content->type)->title }}</td>
                                    <td>{{ $content->status == true ? __('Yes') : __('No') }}</td>
                                    <td>{{ $content->duration }}</td>
                                    <td>{{ $content->runtime }}</td>
                                    <td>
                                        @if ( $content->pages )
                                            @foreach ($content->pages as $page)
                                                <p>{{ $page->title }}</p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ $content->created_at }}</td>
                                    <td>{{ $content->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="button" class="btn btn-primary" value="{{ __('Create Content') }}" onclick="window.location.href = '{{ url('contents/create') }}';"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
