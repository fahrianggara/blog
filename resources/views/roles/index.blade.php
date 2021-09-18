@extends('layouts.dashboard')

@section('title')
    {{ trans('roles.title.index') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('roles') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">

                            <form action="{{ route('roles.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" value="{{ request()->get('keyword') }}" type="search"
                                        class="form-control"
                                        placeholder="{{ trans('roles.form_control.input.search.placeholder') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        @can('role_create')
                            <div class="col-md-6">
                                <a href="{{ route('roles.create') }}" class="btn btn-primary float-right" role="button">
                                    {{ trans('roles.button.create.value') }}
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <!-- list role -->
                        @forelse ($roles as $role)
                            <li
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
                                <label class="mt-auto mb-auto">
                                    {{ $role->name }}
                                </label>
                                <div>
                                    <!-- detail -->
                                    @can('role_detail')
                                        <a href="{{ route('roles.show', ['role' => $role]) }}" class="btn btn-sm btn-primary"
                                            role="button">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                    <!-- edit -->
                                    @can('role_update')
                                        <a href="{{ route('roles.edit', ['role' => $role]) }}" class="btn btn-sm btn-warning "
                                            role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endcan
                                    <!-- delete -->
                                    @can('role_delete')
                                        <form class="d-inline" action="{{ route('roles.destroy', ['role' => $role]) }}"
                                            role="alert" method="POST"
                                            alert-title="{{ trans('roles.alert.delete.title.warning') }}"
                                            alert-text="{{ trans('roles.alert.delete.message.confirm', ['title' => $role->name]) }}"
                                            btn-cancel="{{ trans('roles.button.cancel.value') }}"
                                            btn-confirm="{{ trans('roles.button.delete.value') }}">
                                            @method('DELETE')
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan

                                </div>
                            </li>
                        @empty
                            <b>
                                @if (request()->get('keyword'))
                                    {{ trans('roles.label.no_data.search', ['keyword' => request()->get('keyword')]) }}
                                @else
                                    {{ trans('roles.label.no_data.fetch') }}
                                @endif
                            </b>
                        @endforelse
                        <!-- list role -->
                    </ul>
                </div>
            </div>
            @if ($roles->hasPages())
                <div class="">
                    {{ $roles->links('vendor.pagination.bootstrap-4') }}
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
