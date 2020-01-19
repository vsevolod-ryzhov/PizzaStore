@extends('layouts.app')

@section('content')
    @include('admin.products._nav')

    <div class="d-flex flex-row mb-3">
        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary mr-1">Edit</a>

        <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="mr-1">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Delete</button>
        </form>
    </div>

    <table class="table table-bordered table-striped">
        <tbody>
        <tr>
            <th>ID</th><td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>Title</th><td>{{ $product->title }}</td>
        </tr>
        <tr>
            <th>Price</th><td>{{ $product->price }}</td>
        </tr>
        <tr>
            <th>Image</th>
            <td>
                @if ($product->image)
                    <code>{{ $product->image }}</code>
                    <img src="{{ $img }}" />
                @endif
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
