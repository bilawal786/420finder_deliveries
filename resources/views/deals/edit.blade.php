@extends('layouts.admin')

    @section('content')

        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">Update Deal</h3>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="{{ route('deals') }}" class="btn btn-dark">Go Back</a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('updatedeal') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <input type="hidden" name="deal_id" value="{{ $deal->id }}">
                          <div class="form-group">
                            <label for="">Deal Title (choose something catchy!)</label>
                            <input type="text" name="title" value="{{ $deal->title }}" placeholder="Enter Title" class="form-control" required="">
                          </div>
                          <div class="form-group">
                            <label for="">Deal Image</label><br>
                            @foreach (json_decode($deal->picture) as $p)
                                 <img src="{{ $p }}" style="width: 50px;height: 50px;margin-bottom: 10px;" class="img-thumbnail">
                            @endforeach

                            <input type="file" name="picture[]" class="form-control" multiple>
                          </div>

                          <div class="form-group">
                            <label for="product">Products Included in deal (Optional. Choose up to 2)</label>
                            <select name="product_id" id="product" class="form-control" style="margin-bottom: 1.2rem;">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                  <option value="{{ $product->id }}"
                                    @if(!is_null($dealProduct1))
                                    @if ($product->id == $dealProduct1->product_id)
                                        selected
                                    @endif
                                    @endif
                                    >{{ $product->name }}</option>
                                @endforeach
                            </select>

                            <select name="product_id_2" class="form-control">
                                <option value="">Select Product</option>
                                @foreach ($products as $product)
                                  <option value="{{ $product->id }}"
                                    @if(!is_null($dealProduct2))
                                    @if ($product->id == $dealProduct2->product_id)
                                        selected
                                    @endif
                                    @endif
                                    >{{ $product->name }}</option>
                                @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="deal_price">Deal Price</label>
                            <input type="number" name="deal_price" id="deal_price" class="form-control" value="{{ $deal->deal_price }}" required>
                          </div>

                          <div class="form-group">
                            <label for="">Description of Deal</label>
                            <textarea name="description" cols="5" rows="5" placeholder="Enter Details about deal" class="form-control" required="">{{ $deal->description }}</textarea>
                          </div>

                          <div class="form-group">
                            <button class="btn btn-dark btn-block">Update Deal</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    @endsection
