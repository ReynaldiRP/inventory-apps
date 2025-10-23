@extends('layouts.app', ['pageSlug' => 'receipts'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h4 class="card-title">Table Receipts</h4>
                    <a href="{{ route('receipts.create') }}" class="btn btn-primary btn-sm float-right">Create New Receipt</a>
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
                                        Receipt Number
                                    </th>
                                    <th>
                                        User
                                    </th>
                                    <th>
                                        Product
                                    </th>
                                    <th>
                                        Quanity
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th>
                                        Notes
                                    </th>
                                    <th>
                                        Types
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipts as $receipt)
                                    <tr>

                                        <td>
                                            {{ $loop->index + 1 }}
                                        </td>
                                        <td>
                                            {{ $receipt->receipt_number }}
                                        </td>
                                        <td>
                                            {{ $receipt->user->name }}
                                        </td>
                                        <td>
                                            {{ $receipt->product->name }}
                                        </td>
                                        <td>
                                            {{ $receipt->quantity }}
                                        </td>
                                        <td>
                                            {{ $receipt->price }}
                                        </td>
                                        <td>
                                            {{ $receipt->notes }}
                                        </td>
                                        <td>
                                            <div class="badge badge-{{ $receipt->type == 'in' ? 'success' : 'danger' }}">
                                                {{ ucfirst($receipt->type) }}
                                            </div>
                                        </td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('receipts.edit', $receipt->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('receipts.destroy', $receipt->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="ml-2 btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this receipt?')">Delete</button>
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
