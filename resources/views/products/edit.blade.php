@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product-store', $product->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Product name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $product->name }}">
                            </div>

                            <div class="form-group row">
                                <label for="id_category " class="col-md-4 col-form-label text-md-right">Category</label>
                                <div class="col-md-6">

                                    <select name="id_category" id="id_category" class="form-control">
                                        <option value="">All categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                    @if ($product->category->id == $category->id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description"
                                          name="description">{{ $product->description }}</textarea>
                            </div>
                            @foreach($product->prices as $key =>$price)
                                <div class="form-group">
                                    <label for="prices">Price</label>
                                    <input id="prices" type="number" min="0" name="prices[{{$price->id}}]"
                                           value="{{ $price->price }}">
                                </div>

                            @endforeach

                            <div class="form-group">
                                <label for="new_prices">Add new prices</label>
                                <input type="number" id="new_prices" name="new_prices[]" value="">
                                <button type="button" class="btn btn-primary" onclick="addPriceField()">
                                    Add price field
                                </button>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>

                        <script>
                            function addPriceField() {
                                var lastFormGroup = document.querySelector('.form-group:last-of-type');

                                var newInput = document.createElement('input');
                                newInput.type = 'number';
                                newInput.name = 'new_prices[]';
                                newInput.value = '';


                                var newFormGroup = document.createElement('div');
                                newFormGroup.className = 'form-group';
                                newFormGroup.appendChild(newInput);

                                lastFormGroup.parentNode.insertBefore(newFormGroup, lastFormGroup.nextSibling);
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
