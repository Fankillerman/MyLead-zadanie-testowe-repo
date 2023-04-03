@extends('layouts.app')

@section('content')
    <div class="container">
        @auth
            <a class="btn btn-warning" href="{{ route('product-edit', $product) }}">Edit</a>
        @endauth
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div><h1>{{ __('Product name: '.$product->name) }}</h1></div>

            </div>

            <div>
                <div>{{ __('Description') }}</div>
                <div>{{ $product->description }}</div>
                <br>
                <br>
                <div>{{ __('Category') }}</div>
                <div>{{ $product->category->name }}</div>
                <br>
                <br>
                <div>{{ __('Prices') }}</div>
                @foreach($product->prices as $prices)
                    <div>{{ $prices->price }}</div>
                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection
