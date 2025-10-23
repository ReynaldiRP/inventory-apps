@extends('layouts.app', ['pageSlug' => 'users'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h1>Create User</h1>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('users.store') }}" autocomplete="off">
                        <div class="card-body">
                            @csrf

                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label>{{ __('User Name') }}</label>
                                <input type="text" name="name"
                                    class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('User Name') }}" value="{{ old('name') }}">
                                @include('alerts.feedback', ['field' => 'name'])
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label>{{ __('User Email') }}</label>
                                <input type="email" name="email"
                                    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('User Email') }}" value="{{ old('email') }}">
                                @include('alerts.feedback', ['field' => 'email'])
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label>{{ __('Password') }}</label>
                                <input type="password" name="password"
                                    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Password') }}">
                                @include('alerts.feedback', ['field' => 'password'])
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                <label>{{ __('Confirm Password') }}</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Confirm Password') }}">
                                @include('alerts.feedback', ['field' => 'password_confirmation'])
                            </div>

                            <div class="form-group{{ $errors->has('phone_number') ? ' has-danger' : '' }}">
                                <label>{{ __('Phone Number') }}</label>
                                <input type="text" name="phone_number"
                                    class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Phone Number') }}" value="{{ old('phone_number') }}">
                                @include('alerts.feedback', ['field' => 'phone_number'])
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-danger' : '' }}">
                                <label>{{ __('Address') }}</label>
                                <input type="text" name="address"
                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Address') }}" value="{{ old('address') }}">
                                @include('alerts.feedback', ['field' => 'address'])
                            </div>
                            <div class="form-group">
                                <label>{{ __('Gender') }}</label>
                                <select name="gender" class="form-control">
                                    <option style="color: black;" value="male"
                                        {{ old('gender') == 'male' ? 'selected' : '' }}>
                                        {{ __('Male') }}</option>
                                    <option style="color: black;" value="female"
                                        {{ old('gender') == 'female' ? 'selected' : '' }}>
                                        {{ __('Female') }}</option>
                                </select>
                                @include('alerts.feedback', ['field' => 'gender'])
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
