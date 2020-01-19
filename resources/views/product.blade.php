@extends('layouts.app')

@section('content')
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
                    <img src="{{ $img }}" />
                @endif
            </td>
        </tr>
        <tbody>
        </tbody>
    </table>
@endsection
