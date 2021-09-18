@extends('layouts.dashboard')

@section('title')
    {{ trans('posts.title.index') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('posts') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">

                            <form action="" method="GET" class="form-inline form-row">
                                <div class="col">
                                    <div class="input-group mx-1">
                                        <label
                                            class="font-weight-bold mr-2">{{ trans('posts.form_control.select.status.label') }}</label>
                                        <select name="status" class="custom-select">

                                            @foreach ($statuses as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ $statusSelected == $value ? 'selected' : null }}>
                                                    {{ $label }}</option>
                                            @endforeach


                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"
                                                type="submit">{{ trans('posts.button.apply.value') }}</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="input-group mx-1">
                                        <input name="keyword" value="{{ request()->get('keyword') }}" type="search"
                                            class="form-control"
                                            placeholder="{{ trans('posts.form_control.input.search.placeholder') }}">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        @can('post_create')
                            <div class="col-md-6">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary float-right" role="button">
                                    {{ trans('tags.button.create.value') }}
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse ($posts as $post)

                            <div class="card my-2">
                                <div class="card-body">
                                    <h5>{{ $post->title }}</h5>
                                    <p>
                                        {{ $post->description }}
                                        {{-- Description --}}
                                    </p>
                                    <div class="float-right">
                                        <!-- detail -->
                                        @can('post_detail')
                                            <a href="{{ route('posts.show', ['post' => $post]) }}"
                                                class="btn btn-sm btn-primary" role="button">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan
                                        <!-- edit -->
                                        @can('post_update')
                                            <a href="{{ route('posts.edit', ['post' => $post]) }}"
                                                class="btn btn-sm btn-info" role="button">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('post_delete')
                                            <!-- delete -->
                                            <form class="d-inline"
                                                action="{{ route('posts.destroy', ['post' => $post]) }}" role="alert"
                                                method="POST" alert-title="{{ trans('posts.alert.delete.title.warning') }}"
                                                alert-text="{{ trans('posts.alert.delete.message.confirm', ['title' => $post->title]) }}"
                                                btn-cancel="{{ trans('posts.button.cancel.value') }}"
                                                btn-confirm="{{ trans('posts.button.delete.value') }}">
                                                @method('DELETE')
                                                @csrf

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan

                                    </div>
                                </div>
                            </div>

                        @empty
                            <b>
                                @if (request()->get('keyword'))
                                    {{ trans('posts.label.no_data.search', ['keyword' => request()->get('keyword')]) }}
                                @else
                                    {{ trans('posts.label.no_data.fetch') }}
                                @endif
                            </b>
                        @endforelse
                    </ul>
                </div>
            </div>
            @if ($posts->hasPages())
                <div class="">
                    {{ $posts->links('vendor.pagination.bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>

@endsection

@push('js-internal')
    <script>
        $(document).ready(function() {
            $("form[role='alert']").submit(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: "warning",
                    allowOutsideClick: false,
                    showCancelButton: true,
                    cancelButtonText: $(this).attr('btn-cancel'),
                    confirmButtonText: $(this).attr('btn-confirm'),
                    confirmButtonColor: '#d33',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        e.target.submit();
                    }
                });
            });
        });
    </script>
@endpush
