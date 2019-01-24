@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Create Content') }}</div>
                <div class="card-body">
                    <form method="POST" action="/contents">
                        @csrf
                        <div class="form-group">
                            <label for="contentTitleInput">{{ __('Title') }}</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
                                id="contentTitleInput"
                                name="title"
                                required
                                placeholder="{{ __('Title') }}"
                                value="{{ old('title') }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="contentDescriptionInput">{{ __('Description') }}</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('description') ? 'is-invalid' : ''}}"
                                name="description"
                                required
                                id="contentDescriptionInput"
                                value="{{ old('description') }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="contentTypeInput">{{ __('Type') }}</label>
                            <select
                                class="form-control {{ $errors->has('type') ? 'is-invalid' : ''}}"
                                name="type"
                                required
                                id="contentType"
                            >
                                @foreach ($contentTypes as $contentType)
                                    <option value="{{ $contentType->id }}">{{ $contentType->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contentDurationInput">{{ __('Duration') }} ({{ __('Seconds') }})</label>
                            <input
                                type="number"
                                class="form-control {{ $errors->has('duration') ? 'is-invalid' : ''}}"
                                name="duration"
                                required
                                id="contentDurationInput"
                                value="{{ old('duration') }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="contentStartInput">{{ __('Start') }}</label>
                            <input
                                type="datetime-local"
                                class="form-control {{ $errors->has('start') ? 'is-invalid' : ''}}"
                                name="start"
                                id="contentStartInput"
                                value="{{ old('start') }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="contentEndInput">{{ __('End') }}</label>
                            <input
                                type="datetime-local"
                                class="form-control {{ $errors->has('start') ? 'is-invalid' : ''}}"
                                name="end"
                                id="contentEndInput"
                                value="{{ old('end') }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="contentTextInput">{{ __('Text') }}</label>
                            <textarea class="form-control {{ $errors->has('text') ? 'is-invalid' : ''}}" id="contentTextInput" name="text" rows="3">{{ old('text') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Create Content') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
