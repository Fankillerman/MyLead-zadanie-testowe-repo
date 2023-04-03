@extends('layouts.app')

@section('content')
    @if($errors->any())
        <div id="error-box">
            <!-- Display errors here -->
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">{{ __('Create Product') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('product-save') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="id_category " class="col-md-4 col-form-label text-md-right">Category</label>
                                <div class="col-md-6">

                                    <select name="id_category" id="id_category" class="form-control">
                                        <option value="">All categories</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description" required
                                              autocomplete="description">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="prices"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="prices" type="number"
                                           class="form-control @error('price') is-invalid @enderror" name="prices[]"
                                           value="" min="0" required autocomplete="price">

                                    @error('prices')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new_prices">Add new prices</label>
                                <input type="number" id="new_prices" name="prices[]" value="">
                                <button type="button" class="btn btn-primary" onclick="addPriceField()">Add price field
                                </button>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create Product') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        function addPriceField() {
            var lastFormGroup = document.querySelector('.form-group:last-of-type');

            var newInput = document.createElement('input');
            newInput.type = 'number';
            newInput.name = 'prices[]';
            newInput.value = '';


            var newFormGroup = document.createElement('div');
            newFormGroup.className = 'form-group';
            newFormGroup.appendChild(newInput);

            lastFormGroup.parentNode.insertBefore(newFormGroup, lastFormGroup.nextSibling);
        }
    </script>
@endsection
