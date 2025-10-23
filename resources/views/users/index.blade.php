@extends('layouts.app', ['pageSlug' => 'users'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h4 class="card-title">Table Users</h4>
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Create New User</a>
                    @include('alerts.success', ['key' => 'success'])
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter" id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Number
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Roles
                                    </th>
                                    <th>
                                        Email
                                    </th>
                                    <th>
                                        Phone Number
                                    </th>
                                    <th>
                                        Address
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>

                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $user->role->name }}
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td>
                                            {{ $user->phone_number }}
                                        </td>
                                        <td>
                                            {{ $user->address }}
                                        </td>
                                        <td>
                                            <div
                                                class="badge badge-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                                                {{ ucfirst($user->status) }}
                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-2 btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
