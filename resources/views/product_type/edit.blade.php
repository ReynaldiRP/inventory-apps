@extends('layouts.app', ['pageSlug' => 'product-types'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h1>Edit Product Type</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('product-types.update', $productType->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="form-group{{ $errors->has('type_code') ? ' has-danger' : '' }}">
                            <label>{{ __('Type Code') }}</label>
                            <input type="text" name="type_code"
                                class="form-control{{ $errors->has('type_code') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Enter type code') }}"
                                value="{{ old('type_code', $productType->type_code) }}">
                            @include('alerts.feedback', ['field' => 'type_code'])
                        </div>

                        <div class="form-group{{ $errors->has('type_name') ? ' has-danger' : '' }}">
                            <label>{{ __('Type Name') }}</label>
                            <input type="text" name="type_name"
                                class="form-control{{ $errors->has('type_name') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Enter type name') }}"
                                value="{{ old('type_name', $productType->type_name) }}">
                            @include('alerts.feedback', ['field' => 'type_name'])
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Save Changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
