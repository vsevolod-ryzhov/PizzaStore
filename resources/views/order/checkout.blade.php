@extends('layouts.app')

@section('content')
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-sm-6">
            <form method="POST" action="{{ route('order.create') }}">
                @csrf

                <div class="form-group">
                    <label for="customer_email" class="col-form-label">E-Mail Address</label>
                    <input id="customer_email" type="email" class="form-control{{ $errors->has('customer_email') ? ' is-invalid' : '' }}" name="customer_email" value="{{ old('customer_email') }}" required>
                    @if ($errors->has('customer_email'))
                        <span class="invalid-feedback"><strong>{{ $errors->first('customer_email') }}</strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Order now</button>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Count</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($items as $item)
                    <tr>
                        <td>{{ ++$loop->index }}</td>
                        <td><a href="{{ route('product', $item['product']->id) }}">{{ $item['product']->title }}</a></td>
                        <td>{{ money($item['product']->price * 100) }}</td>
                        <td>{{ $item['cart']->getCount() }}</td>
                        <td>{{ money($item['cart']->getCost() * 100) }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="row">
                <div class="col-sm-12 text-right">
                    <p>Cart total price: {{ money($total_cost * 100) }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
