@extends('layouts.admin')

@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp

@section('content')

    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="panel-title">Create New Deal</h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('deals') }}" class="btn btn-dark">Go Back</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                @include('partials.success-error')

                <div class="col-md-12">
                    @if($subPrice)
                        <form action="{{ route('freeDealsave') }}" method="POST" enctype="multipart/form-data"
                              id="create-deal-form">
                            @csrf

                            <div class="form-group">
                                <label for="">Deal Title (choose something catchy!)</label>
                                <input type="text" name="title" placeholder="Enter Title" class="form-control" required=""
                                       value="{{ old('title') }}">
                            </div>


                            <div class="form-group">
                                <label for="">Deal Image</label>
                                <input type="file" name="picture[]" class="form-control" required="" multiple>
                            </div>

                            <div class="form-group">
                                <label for="product">Products Included in deal (Optional. Choose up to 2)</label>
                                <select name="product_id" id="product" class="form-control" style="margin-bottom: 1.2rem;">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>

                                <select name="product_id_2" class="form-control">
                                    <option value="">Select Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="row">
                                <div class="form-group col-xs-12 col-sm-6 mb-3" style="display: none">
                                    <label for="deal_price">State</label>
                                    <select name="state_id" id="state_id" class="form-control"
                                            style="margin-bottom: 1.2rem;display: none">
                                        <option value="">Select State</option>
                                        @foreach ($state as $row)
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="state_id"  value="{{$subPrice->id}}">
                                <div class="form-group col-xs-12 col-sm-6 mb-3" id="sub">
                                    <label for="deal_price">Deal Price</label>
                                    <input type="number" readonly name="deal_price" id="deal_price" class="form-control"
                                           required value="{{ $subPrice->deal_price }}">
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="">Description of Deal</label>
                                <textarea name="description" cols="5" rows="5" placeholder="Enter Details about deal"
                                          class="form-control" required="">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group" style="display: none">
                                <label for="tier">Choose how long your Deal will be listed</label>
                                <select name="tier_id" id="tier" class="form-control">
                                    <option disabled selected>Choose Tier</option>
                                    <option value="1">1 week: $50</option>
                                    <option value="2">2 week: $80</option>
                                    <option value="3">4 weeks: $140</option>
                                </select>
                            </div>

                            <div id="onlinedeal" style="display: none;">
                                <div class="form-group">
                                    <label for="">Coupon Code</label>
                                    <input type="text" name="coupon_code" placeholder="Enter Coupon Code"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Percentage</label>
                                    <input type="number" name="percentage" placeholder="Enter Percentage"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-dark btn-block" id="create-deal-btn">Create Deal</button>
                            </div>
                        </form>
                    @else
                        <div class="form-group col-xs-12 col-sm-12 mb-3" id="description">
                            <h4 style="color: red;text-align: center;">Your State is Not Eligible</h4>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('#create-deal-form').on('submit', function () {
            $("#create-deal-btn").attr("disabled", true);
            return true;
        });
    </script>
    <script>
        $('#state_id').on('change', function () {
            $.ajax({
                type: 'POST',
                url: '{{route('get.subscription')}}',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: this.value,

                },
                success: function (msg) {
                    var price = msg.success.deal_price
                    if (price > 0) {
                        $("#deal_price").val(msg.success.deal_price);
                        $("#sub").show();
                        $("#description").hide();
                    } else {
                        $("#sub").hide();
                        $("#description").show();
                    }

                }
            });
        });
    </script>
@endsection
