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
                                <th>#</th>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Created') }}</th>
                                <th>{{ __('Updated') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr class="clickable" onclick="window.location.href = '/pages/{{ $page->id }}';">
                                    <td>{{ $page->id }}</td>
                                    <td>{{ $page->title }}</td>
                                    <td>{{ $page->description }}</td>
                                    <td>{{ $page->created_at }}</td>
                                    <td>{{ $page->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="button" class="btn btn-primary" value="{{ __('Create Page') }}" onclick="window.location.href = '/pages/create';"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
