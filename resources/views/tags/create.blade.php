@extends('layouts.dashboard')

@section('title')
    {{ trans('tags.title.create') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('add_tags') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tags.store') }}" method="POST">
                        @csrf
                        <!-- title -->
                        <div class="form-group">
                            <label for="input_tag_title" class="font-weight-bold">
                                {{ trans('tags.form_control.input.title.label') }}
                            </label>
                            <input id="input_tag_title" value="{{ old('title') }}" name="title" type="text"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="{{ trans('tags.form_control.input.title.placeholder') }}" autofocus />

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- slug -->
                        <div class="form-group">
                            <label for="input_tag_slug" class="font-weight-bold">
                                {{ trans('tags.form_control.input.slug.label') }}
                            </label>
                            <input id="input_tag_slug" value="{{ old('slug') }}" name="slug" type="text"
                                class="form-control @error('slug') is-invalid @enderror"
                                placeholder="{{ trans('tags.form_control.input.slug.placeholder') }}" readonly />

                            @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success float-right px-4">
                            {{ trans('tags.button.save.value') }}
                        </button>
                        <a href="{{ route('tags.index') }}" class="btn btn-primary float-right mr-1 px-4">
                            {{ trans('categories.button.back.value') }}
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js-internal')
    <script>
        $(function() {
            const generateSlug = (value) => {
                return value.trim()
                    .toLowerCase()
                    .replace(/[^a-z\d-]/gi, '-')
                    .replace(/-+/g, '-').replace(/^-|-$/g, "")
            }

            $('#input_tag_title').change(function(e) {
                e.preventDefault();

                let title = $(this).val();
                $('#input_tag_slug').val(generateSlug(title));
            });
        });
    </script>
@endpush
