@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Products</h1>
        <form method="GET" action="{{ route('products') }}">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="search">Search</label>
                        <input type="text" name="search" id="search" class="form-control" value="{{ $searchTerm }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            <option value="">All categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if ($categoryId == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sort_by">Sort By</label>
                        <select name="sort_by" id="sort_by" class="form-control">
                            <option value="name" @if ($sortBy == 'name') selected @endif>Name</option>
                            <option value="min_price" @if ($sortBy == 'min_price') selected @endif>Minimal Price
                            </option>
                            <option value="max_price" @if ($sortBy == 'max_price') selected @endif>Maximal Price
                            </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <select name="sort_order" id="sort_order" class="form-control">
                            <option value="asc" @if ($sortOrder == 'asc') selected @endif>Ascending</option>
                            <option value="desc" @if ($sortOrder == 'desc') selected @endif>Descending</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('products') }}" class="btn btn-default">Reset</a>
                </div>
            </div>
        </form>
        <div class="row mt-4">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $product->category->name }}</h6>
                            <p class="card-text">{{ $product->description }}</p>
                            @if ($sortBy == 'name')
                                <p class="card-text">Minimal Price: ${{ $product->prices()->min('price'), 2}}</p>
                                <p class="card-text">Average Price: ${{ number_format($product->prices()->avg('price'), 2)}}</p>
                                <p class="card-text">Maximal Price: ${{ $product->prices()->max('price'), 2}}</p>
                            @endif


                            @if ($sortBy == 'min_price')
                                <p class="card-text">Minimal Price: ${{ $product->prices()->min('price'), 2}}</p>
                            @endif
                            @if ($sortBy == 'max_price')
                                <p class="card-text">Maximal Price: ${{ $product->prices()->max('price'), 2}}</p>
                            @endif
                            <a href="{{ route('product-show', ['id' => $product->id]) }}"
                               class="card-link">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
