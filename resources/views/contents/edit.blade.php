@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">{{ __('Edit Content') }}</div>
                <div class="card-body">
                    <form method="POST" action="/contents/{{ $content->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="contentTitleInput">{{ __('Title') }}</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}"
                                id="contentTitleInput"
                                name="title"
                                required
                                placeholder="{{ __('Title') }}"
                                value="{{ $content->title }}"
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
                                value="{{ $content->description }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="pageTypeInput">{{ __('Description') }}</label>
                            <select
                                class="form-control {{ $errors->has('type') ? 'is-invalid' : ''}}"
                                name="type"
                                required
                                id="contentType"
                            >
                                @foreach ($contentTypes as $contentType)
                                    <option value="{{ $contentType->id }}" {{ $content->type === $contentType->id ? 'selected' : '' }} >{{ $contentType->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contentStartInput">{{ __('Start') }}</label>
                            <input
                                type="datetime-local"
                                class="form-control {{ $errors->has('start') ? 'is-invalid' : ''}}"
                                name="start"
                                id="contentStartInput"
                                value="{{ $content->start }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="contentEndInput">{{ __('End') }}</label>
                            <input
                                type="datetime-local"
                                class="form-control {{ $errors->has('start') ? 'is-invalid' : ''}}"
                                name="end"
                                id="contentEndInput"
                                value="{{ $content->end }}"
                            />
                        </div>

                        @if ($pages->count())
                            <div class="form-group">
                                <label for="contentPagesInput">{{ __('Pages') }}</label>
                                <select
                                    multiple
                                    class="form-control {{ $errors->has('pages') ? 'is-invalid' : ''}}"
                                    name="pages[]"
                                    id="contentPagesInput"
                                >
                                    @foreach ($pages as $page)
                                        <option value="{{ $page->id }}">{{ $page->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="contentStatusInput">{{ __('Status') }}</label>
                            <input
                                type="checkbox"
                                class="form-control {{ $errors->has('status') ? 'is-invalid' : ''}}"
                                name="status"
                                id="contentStatusInput"
                                value="1"
                                {{ $content->status == true ? 'checked' : '' }}
                            />
                        </div>

                        <hr />

                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
