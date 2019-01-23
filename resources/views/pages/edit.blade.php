@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Edit Page') }}</div>
                <div class="card-body">

                    <form method="POST" action="/pages/{{ $page->id }}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="pageTitleInput">{{ __('Title') }}</label>
                            <input type="text" class="form-control" id="pageTitleInput" name="title" required placeholder="{{ __('Title') }}" value="{{ $page->title }}" />
                        </div>
                        <div class="form-group">
                            <label for="pageDescriptionInput">{{ __('Description') }}</label>
                            <input type="text" class="form-control" name="description" type="text" id="pageDescriptionInput" required value="{{ $page->description }}"/>
                        </div>
                        <input type="submit" class="btn btn-md btn-success" value="{{ __('Save') }}"/>
                    </form>

                    <form method="POST" action="/pages/{{ $page->id }}" class="mt-3">
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
