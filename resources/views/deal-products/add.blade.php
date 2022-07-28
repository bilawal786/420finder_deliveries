@extends('layouts.admin')

    @section('content')

        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">Add Product to Deal</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                 <div class="row">
                    <div class="col-12 col-md-6">
                        @include('partials.success-error')

                        <form action="{{ route('deal-product.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="deals">Deals</label>
                            <select name="deal" id="deals" required class="form-control">
                                <option disabled selected>Select Deal</option>
                                @forelse ($deals as $deal)
                                  <option value="{{ $deal->id }}">{{ $deal->title }}</option>
                                @empty
                                    <option disabled>No deals found</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="products">Products</label>
                            <select name="product" id="products" required class="form-control">
                                <option disabled selected>Select Product</option>
                                @forelse ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                    </option>
                                @empty
                                    <option disabled>No products found</option>
                                @endforelse
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>

                    </form>
                    </div>
                 </div>
            </div>
        </div>

    @endsection
