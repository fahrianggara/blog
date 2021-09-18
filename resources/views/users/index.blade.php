@extends('layouts.dashboard')

@section('title')
    {{ trans('users.title.index') }}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('users') }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">

                            <form action="{{ route('users.index') }}" method="GET">
                                <div class="input-group">
                                    <input name="keyword" value="{{ request()->get('keyword') }}" type="search"
                                        class="form-control"
                                        placeholder="{{ trans('users.form_control.input.search.placeholder') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @can('user_create')
                            <div class="col-md-6">
                                <a href="{{ route('users.create') }}" class="btn btn-primary float-right" role="button">
                                    {{ trans('users.button.create.value') }}
                                    <i class="fas fa-plus-square"></i>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- list users -->
                        @forelse ($users as $user)

                            <div class="col-md-4">
                                <div class="card my-1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <i class="fas fa-id-badge fa-4x"></i>
                                            </div>
                                            <div class="col-md-10">
                                                <table>
                                                    <tr>
                                                        <th>
                                                            {{ trans('users.form_control.input.name.label') }}
                                                        </th>
                                                        <td>:</td>
                                                        <td>
                                                            {{ $user->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            Email
                                                        </th>
                                                        <td>:</td>
                                                        <td>
                                                            {{ $user->email }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>
                                                            {{ trans('users.label.role') }}
                                                        </th>
                                                        <td>:</td>
                                                        <td>
                                                            {{ $user->roles->first()->name }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="float-right">
                                            <!-- edit -->
                                            @can('user_update')
                                                <a href="{{ route('users.edit', ['user' => $user]) }}"
                                                    class="btn btn-sm btn-info" role="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            <!-- delete -->
                                            @can('user_delete')
                                                <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST"
                                                    role="alert" class="d-inline"
                                                    alert-title="{{ trans('users.alert.delete.title.warning') }}"
                                                    alert-text="{{ trans('users.alert.delete.message.confirm', ['title' => $user->name]) }}"
                                                    btn-cancel="{{ trans('users.button.cancel.value') }}"
                                                    btn-confirm="{{ trans('users.button.delete.value') }}">

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
                            </div>
                        @empty
                            <b>
                                @if (request()->get('keyword'))
                                    {{ trans('users.label.no_data.search', ['keyword' => request()->get('keyword')]) }}
                                @else
                                    {{ trans('users.label.no_data.fetch') }}
                                @endif
                            </b>
                        @endforelse
                    </div>
                </div>
            </div>
            @if ($users->hasPages())
                <div>
                    {{ $users->links('vendor.pagination.bootstrap-4') }}
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
