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
                                <th>{{ __('Start') }}</th>
                                <th>{{ __('End') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Updated') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $content)
                                <tr class="clickable" onclick="window.location.href = '/contents/{{ $content->id }}';">
                                    <td>{{ $content->id }}</td>
                                    <td>{{ $content->title }}</td>
                                    <td>{{ $content->description }}</td>
                                    <td>{{ $content->type }}</td>
                                    <td>{{ $content->status }}</td>
                                    <td>{{ $content->start }}</td>
                                    <td>{{ $content->end }}</td>
                                    <td>{{ $content->created_at }}</td>
                                    <td>{{ $content->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="button" class="btn btn-primary" value="{{ __('Create Content') }}" onclick="window.location.href = '/contents/create';"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
