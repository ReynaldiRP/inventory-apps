@extends('layouts.app', ['pageSlug' => 'receipts'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h1>Create Receipt</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('receipts.store') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf

                            <div class="form-group{{ $errors->has('receipt_number') ? ' has-danger' : '' }}">
                                <label>{{ __('Receipt Number') }}</label>
                                <input type="text" name="receipt_number"
                                    class="form-control{{ $errors->has('receipt_number') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Receipt Number') }}" value="{{ old('receipt_number') }}" required>
                                @include('alerts.feedback', ['field' => 'receipt_number'])
                            </div>

                            <div class="form-group{{ $errors->has('user_id') ? ' has-danger' : '' }}">
                                <label>{{ __('User') }}</label>
                                <select name="user_id"
                                    class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option style="color: black;" value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'user_id'])
                            </div>

                            <div class="form-group{{ $errors->has('product_id') ? ' has-danger' : '' }}">
                                <label>{{ __('Product') }}</label>
                                <select name="product_id"
                                    class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" required>
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option style="color: black;" value="{{ $product->id }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @include('alerts.feedback', ['field' => 'product_id'])
                            </div>

                            <div class="form-group{{ $errors->has('quantity') ? ' has-danger' : '' }}">
                                <label>{{ __('Quantity') }}</label>
                                <input type="number" name="quantity" min="1"
                                    class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Quantity') }}" value="{{ old('quantity') }}" required>
                                @include('alerts.feedback', ['field' => 'quantity'])
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                                <label>{{ __('Price') }}</label>
                                <input type="number" name="price" step="0.01" min="0"
                                    class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Price') }}" value="{{ old('price') }}" required>
                                @include('alerts.feedback', ['field' => 'price'])
                            </div>

                            <div class="form-group{{ $errors->has('notes') ? ' has-danger' : '' }}">
                                <label>{{ __('Notes') }}</label>
                                <textarea name="notes" rows="3" class="form-control{{ $errors->has('notes') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Additional notes...') }}">{{ old('notes') }}</textarea>
                                @include('alerts.feedback', ['field' => 'notes'])
                            </div>

                            <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                                <label>{{ __('Type') }}</label>
                                <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                    required>
                                    <option value="">Select Type</option>
                                    <option style="color: black;" value="in"
                                        {{ old('type') == 'in' ? 'selected' : '' }}>
                                        {{ __('In') }}</option>
                                    <option style="color: black;" value="out"
                                        {{ old('type') == 'out' ? 'selected' : '' }}>
                                        {{ __('Out') }}</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'type'])
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-fill btn-primary">{{ __('Create Receipt') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
