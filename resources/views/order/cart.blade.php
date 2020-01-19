@extends('layouts.app')

@section('content')
    <h1>Your cart</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th></th>
            <th>Title</th>
            <th>Price</th>
            <th>Count</th>
            <th>Total</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($items as $item)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td><img style="max-width: 100px;" class="img-thumbnail" src="{{ Storage::disk('public')->url($item['product']->image) }}" alt="{{ $item['product']->title }}" /></td>
                <td><a href="{{ route('product', $item['product']->id) }}">{{ $item['product']->title }}</a></td>
                <td>{{ money($item['product']->price * 100) }}</td>
                <td>{{ $item['cart']->getCount() }}</td>
                <td>{{ money($item['cart']->getCost() * 100) }}</td>
                <td><a href="{{ route('order.remove', $item['product']->id)  }}">Delete</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-12 text-right">
            <p>Cart total price: {{ money($total_cost * 100) }}</p>
            <p><a class="btn btn-lg btn-primary" href="{{ route('order.checkout') }}">Checkout</a></p>
        </div>
    </div>
@endsection
