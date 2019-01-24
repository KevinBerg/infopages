@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Create Page') }}</div>
                <div class="card-body">
                    <form method="POST" action="/pages">
                        @csrf
                        <div class="form-group">
                            <label for="pageTitleInput">{{ __('Title') }}</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
                                id="pageTitleInput"
                                name="title"
                                required
                                placeholder="{{ __('Title') }}"
                                value="{{ old('title') }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="pageDescriptionInput">{{ __('Description') }}</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}"
                                name="description"
                                type="text"
                                required
                                id="pageDescriptionInput"
                                value="{{ old('description') }}"
                            />
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Create Page') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
