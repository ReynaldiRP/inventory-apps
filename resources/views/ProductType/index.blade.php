@extends('layouts.app', ['pageSlug' => 'dashboard'])
@section('content')
   <div class="row">
        <div class="col-md-12">
            <div class="card p-3">
                <div class="card-header">
                    <h4 class="card-title">Table Product Types</h4>
                    <a href="{{ route('product-types.create') }}" class="btn btn-primary btn-sm float-right">Create New Product Type</a>
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
                                        Action
                                    </th>
                                </tr>
                            </thead>
                    <tbody>
                        @foreach($productTypes as $productType)
                            <tr>
                                <td>{{ $productType->id }}</td>
                                <td>{{ $productType->type_code }}</td>
                                <td>{{ $productType->type_name }}</td>
                                <td>{{ $productType->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                            <a href="{{ route('product-types.edit', $productType->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('product-types.destroy', $productType->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this product type?')">Delete</button>
                                            </form>
                                        </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection