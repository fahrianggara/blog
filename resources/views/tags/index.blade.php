@extends('layouts.dashboard')

@section('title')
    {{ trans('tags.title.index') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('tags') }}
@endsection

@section('content')
    <!-- section:content -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">

                            <form action="{{ route('tags.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" type="search" class="form-control"
                                        placeholder="{{ trans('tags.form_control.input.search.placeholder') }}"
                                        value="{{ request()->get('keyword') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        @can('tag_create')
                            <div class="col-md-6">
                                <a href="{{ route('tags.create') }}" class="btn btn-primary float-right" role="button">
                                    {{ trans('tags.button.create.value') }}
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- list tag -->
                        @if (count($tags))
                            @foreach ($tags as $tag)

                                <!-- tag list -->
                                <li
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                                    <label class="mt-auto mb-auto">
                                        <!-- todo: show tag title -->
                                        {{ $tag->title }}
                                    </label>
                                    <div>
                                        <!-- edit -->
                                        @can('tag_update')
                                            <a href="{{ route('tags.edit', ['tag' => $tag]) }}" class="btn btn-sm btn-info"
                                                role="button">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        <!-- delete -->
                                        @can('tag_delete')
                                            <form class="d-inline" action="{{ route('tags.destroy', ['tag' => $tag]) }}"
                                                role="alert" method="POST"
                                                alert-title="{{ trans('tags.alert.delete.title.warning') }}"
                                                alert-text="{{ trans('tags.alert.delete.message.confirm', ['title' => $tag->title]) }}"
                                                btn-cancel="{{ trans('tags.button.cancel.value') }}"
                                                btn-confirm="{{ trans('tags.button.delete.value') }}">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </li>
                                <!-- end  tag list -->

                            @endforeach

                        @else
                            <b>
                                @if (request()->get('keyword'))
                                    {{ trans('tags.label.no_data.search', ['keyword' => request()->get('keyword')]) }}
                                @else
                                    {{ trans('tags.label.no_data.fetch') }}
                                @endif
                            </b>
                        @endif
                    </ul>
                </div>
            </div>
            @if ($tags->hasPages())
                <div class="">
                    {{ $tags->links('vendor.pagination.bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>

@endsection

@push('js-internal')
    <script>
        $(document).ready(function() {
            // event delete category
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
