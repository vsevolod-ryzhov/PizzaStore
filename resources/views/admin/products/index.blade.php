@extends('layouts.app')

@section('content')
    @include('admin.products._nav')

    <p><a href="{{ route('admin.products.create') }}" class="btn btn-success">Add Product</a></p>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><a href="{{ route('admin.products.show', $product) }}">{{ $product->title }}</a></td>
                <td>{{ $product->price }}</td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
