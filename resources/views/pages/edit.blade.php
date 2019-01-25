@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">{{ __('Edit Page') }}</div>
                <div class="card-body">

                    <form method="POST" action="/pages/{{ $page->id }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="pageTitleInput">{{ __('Title') }}</label>
                            <input type="text" disabled class="form-control" id="pageTitleInput" required placeholder="{{ __('Title') }}" value="{{ $page->title }}" />
                        </div>
                        <div class="form-group">
                            <label for="pageDescriptionInput">{{ __('Description') }}</label>
                            <input type="text" class="form-control" name="description" type="text" id="pageDescriptionInput" required value="{{ $page->description }}"/>
                        </div>
                        <input type="submit" class="btn btn-md btn-success" value="{{ __('Save') }}"/>
                    </form>

                    <div class="alert alert-success mt-3" role="alert">
                        {{ __('Click here') }} <a href="{{ url('render', [$page->title]) }}" class="alert-link">{{ url('render', [$page->title]) }}</a> {{ __('to open the view') }}.
                    </div>

                    @if ($page->contents()->count())
                        <hr />
                        <div class="mt-5">
                            <h3>{{ __('Related Page Contents') }}</h3>
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
                                    @foreach ($page->contents as $content)
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
                        </div>
                    @endif

                    <hr />

                    <form method="POST" action="/pages/{{ $page->id }}" class="mt-5">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-md btn-danger" value="{{ __('delete') }}"/>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
