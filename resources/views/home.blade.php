@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ Storage::disk('public')->url($product->image) }}" class="card-img-top" alt="{{ $product->title }}" />
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->title }}</h5>
                        <p class="card-text">{{ money($product->price * 100) }}</p>
                        <a href="{{ route('order.add', [$product->id, 1]) }}" class="btn btn-primary">Add to cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
