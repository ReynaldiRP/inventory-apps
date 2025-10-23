@extends('layouts.app', ['pageSlug' => 'roles'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h1>Create Role</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('roles.store') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('Role Name') }}</label>
                                <input type="text" name="name"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Role Name') }}" value="{{ old('name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
