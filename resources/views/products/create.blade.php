@extends('layouts.app', ['pageSlug' => 'products'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card p-3">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h1 class="mb-0">Create Product</h1>
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('products.store') }}" autocomplete="off">
                    @csrf

                    <div class="form-group{{ $errors->has('code') ? ' has-danger' : '' }}">
                        <label>Product Code</label>
                        <input type="text" name="code"
                            class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                            placeholder="Enter product code" value="{{ old('code') }}">
                        @include('alerts.feedback', ['field' => 'code'])
                    </div>

                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                        <label>Product Name</label>
                        <input type="text" name="name"
                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            placeholder="Enter product name" value="{{ old('name') }}">
                        @include('alerts.feedback', ['field' => 'name'])
                    </div>

                    <div class="form-group{{ $errors->has('type_id') ? ' has-danger' : '' }}">
                        <label>Product Type</label>
                        <select name="type_id"
                            class="form-control text-white"
                            style="background-color: rgba(0,0,0,0.7); border: 1px solid #555;">
                            <option value="">-- Select Type --</option>
                            @foreach($productTypes as $type)
                                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->type_name }}
                                </option>
                            @endforeach
                        </select>
                        @include('alerts.feedback', ['field' => 'type_id'])
                    </div>

                    <div class="form-group{{ $errors->has('unit') ? ' has-danger' : '' }}">
                        <label>Unit</label>
                        <input type="text" name="unit"
                            class="form-control{{ $errors->has('unit') ? ' is-invalid' : '' }}"
                            placeholder="e.g. pcs, box, kg" value="{{ old('unit') }}">
                        @include('alerts.feedback', ['field' => 'unit'])
                    </div>

                    <div class="form-group{{ $errors->has('stock') ? ' has-danger' : '' }}">
                        <label>Stock</label>
                        <input type="number" name="stock"
                            class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}"
                            placeholder="Enter stock quantity" value="{{ old('stock', 0) }}">
                        @include('alerts.feedback', ['field' => 'stock'])
                    </div>

                    <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                        <label>Price</label>
                        <input type="number" step="0.01" name="price"
                            class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                            placeholder="Enter price" value="{{ old('price', 0) }}">
                        @include('alerts.feedback', ['field' => 'price'])
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-fill btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
