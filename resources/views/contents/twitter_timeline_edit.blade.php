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
                                value="{{ (old('title')) ? old('title') :  $content->title }}"
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
                                value="{{ (old('description')) ? old('description') :  $content->description }}"
                            />
                        </div>
                        <div class="form-group">
                            <label for="pageTypeInput">{{ __('Type') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                name=""
                                disabled
                                id="pageTypeInput"
                                value="{{ $contentTypeTitle }}"
                            />
                        </div>

                            <div class="form-group">
                                <label for="contentPriorityInput">{{ __('Pages') }}</label>
                                <select
                                    class="form-control {{ $errors->has('priority') ? 'is-invalid' : ''}}"
                                    name="priority"
                                    id="contentPriorityInput"
                                >
                                    <option value="1" {{ $content->priority === 1 ? 'selected' : '' }}>{{ __('High') }}</option>
                                    <option value="2" {{ $content->priority === 2 ? 'selected' : '' }}>{{ __('Normal') }}</option>
                                    <option value="3" {{ $content->priority === 3 ? 'selected' : '' }}>{{ __('Low') }}</option>
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
                                value="{{ (old('duration')) ? old('duration') :  $content->duration }}"
                            />
                        </div>

                        <div class="form-group">
                            <label for="contentRuntimeInput">{{ __('Runtime') }} ({{ __('Days') }})</label>
                            <input
                                type="number"
                                class="form-control {{ $errors->has('runtime') ? 'is-invalid' : ''}}"
                                name="runtime"
                                id="contentRuntimeInput"
                                value="{{ (old('runtime')) ? old('runtime') :  $content->runtime }}"
                            />
                        </div>

                        <div class="form-group">
                            <label for="contentTextInput">{{ __('Twitter User') }}</label>
                            <input
                                type="text"
                                class="form-control {{ $errors->has('text') ? 'is-invalid' : ''}}"
                                id="contentTextInput"
                                name="text"
                                value="{{ (old('text')) ? old('text') :  $content->text }}"
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
                                        <option value="{{ $page->id }}" {{ $content->pages->contains($page->id) ? 'selected' : '' }}>{{ $page->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="contentCreatedAtInput">{{ __('Created at') }}</label>
                            <input
                                type="datetime-local"
                                class="form-control {{ $errors->has('created_at') ? 'is-invalid' : ''}}"
                                name="created_at"
                                id="contentCreatedAtInput"
                                value="{{ $content->created_at}}"
                                disabled
                            />
                        </div>

                        <div class="form-group">
                            <label for="contentUpdatedAtInput">{{ __('Updated at') }}</label>
                            <input
                                type="datetime-local"
                                class="form-control {{ $errors->has('updated_at') ? 'is-invalid' : ''}}"
                                name="updated_at"
                                id="contentUpdatedAtInput"
                                value="{{ $content->updated_at}}"
                                disabled
                            />
                        </div>

                        <hr />

                        <div class="form-group text-left">
                            <label for="contentStatusInput">{{ __('Content is active?') }}</label>
                            <div class="checkbox-wrapper">
                                <input
                                    type="checkbox"
                                    class="{{ $errors->has('status') ? 'is-invalid' : ''}}"
                                    name="status"
                                    id="contentStatusInput"
                                    value="1"
                                    {{ $content->status == true ? 'checked' : '' }}
                                />
                            </div>
                        </div>

                        <hr />

                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>

                    </form>

                    <hr />

                    <form method="POST" action="/contents/{{ $content->id }}" class="mt-3">
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
