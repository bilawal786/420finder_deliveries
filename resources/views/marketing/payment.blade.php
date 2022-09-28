@extends('layouts.admin')
@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp
@section('content')
    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    @if($p <= 10)
                        <h3 class="panel-title"
                            style="font-size: 3rem; font-weight: bold;font-style: italic;color: #f8971c;"><img
                                src="{{asset('images/ab.png')}}" style="height: 25px">TOP BUSINESS POSITION # {{$p}}
                        </h3>
                    @elseif($p > 10 && $p <= 15)
                        <h3 class="panel-title"
                            style="font-size: 3rem; font-weight: bold;font-style: italic;color: #f8971c;"><img
                                src="{{asset('images/ab.png')}}" style="height: 25px">TOP BANNERS POSITION # {{$p-10}}
                        </h3>
                    @elseif($p > 15 && $p <= 20)
                        <h3 class="panel-title"
                            style="font-size: 3rem; font-weight: bold;font-style: italic;color: #f8971c;"><img
                                src="{{asset('images/ab.png')}}" style="height: 25px">MIDDLE BANNER POSITION # {{$p-15}}
                        </h3>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form action="{{ route('banner.payment', ['id'=>request()->route('id')]) }}" method="POST"
                  enctype="multipart/form-data" id="create-deal-form">
                @csrf
                <div class="row">
                    @include('partials.success-error')
                    <div class="col-md-12">

                        <div class="row">
                            <input type="hidden" name="area_id" value="{{$area->id}}">
                            <input type="hidden" name="position" value="{{$p}}">
                            <div class="form-group-lg col-xs-12 col-sm-6 col-md-3 mb-3" id="sub">
                                <label for="deal_price"> Price</label>
                                <input type="hidden" name="price" id="price"
                                       style="  height: 80px;padding: 10px 16px;font-size: 4rem; font-style: italic"
                                       class="form-control" required value="{{$price}}" readonly>
                                <input type="text"
                                       style="  height: 80px;padding: 10px 16px;font-size: 4rem; font-style: italic"
                                       class="form-control" required value="${{$price}}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="area_id" value="{{$area->id}}">
                            <input type="hidden" name="position" value="{{$p}}">
                            <div class="form-group-lg col-xs-12 col-sm-12 col-md-5 mb-3" id="sub">
                                <label for="deal_price"> For</label>
                                @if($p <= 10)
                                    <input type="text" id="price"
                                           style="  height: 80px;padding: 10px 16px;font-size: 4rem; font-style: italic"
                                           class="form-control" required value="TOP BUSINESS POSITION # {{$p}}"
                                           readonly>
                                @elseif($p > 10 && $p <= 15)
                                    <input type="text" id="price"
                                           style="  height: 80px;padding: 10px 16px;font-size: 4rem; font-style: italic"
                                           class="form-control" required value="TOP BANNERS POSITION # {{$p-10}}"
                                           readonly>
                                @elseif($p > 15 && $p <= 20)
                                    <input type="text" id="price"
                                           style="  height: 80px;padding: 10px 16px;font-size: 4rem; font-style: italic"
                                           class="form-control" required value="MIDDLE BANNER POSITION # {{$p-15}}"
                                           readonly>
                                @endif
                            </div>
                        </div>
                        <p style="font-size: 2.5rem; font-style: italic">
                            Thank your interest in our TOP 10 POSITIONS and MARKETING BANNERS. Once you have made your
                            purchase, contact us ASAP at SUPPORT@420FINDER.NET so we can finalize the details of your
                            listing.
                        </p>
                        {{--                        <div class="row">--}}
                        {{--                            <div class="form-group name-on-card col-xs-12 col-sm-6 mb-3">--}}
                        {{--                                <label for="name-on-card">Name on Card</label>--}}
                        {{--                                <input type="text" class="form-control" id="name-on-card" name="name_on_card"--}}
                        {{--                                       value="{{ old('name_on_card') }}" required>--}}
                        {{--                            </div>--}}

                        {{--                            <div class="form-group CVV col-xs-12 col-sm-6">--}}
                        {{--                                <label for="cvv">CVV</label>--}}
                        {{--                                <input type="number" class="form-control" id="cvv" name="cvv"--}}
                        {{--                                       value="{{ old('cvv') }}"--}}
                        {{--                                       required>--}}
                        {{--                            </div>--}}


                        {{--                            <div class="form-group col-xs-12 mb-3 col-sm-6" id="card-number-field">--}}
                        {{--                                <label for="cardNumber">Card Number</label>--}}
                        {{--                                <input type="number" class="form-control" id="cardNumber" name="card_number"--}}
                        {{--                                       value="{{ old('card_number') }}" required>--}}
                        {{--                            </div>--}}

                        {{--                            <div class="form-group col-xs-12 col-sm-6" id="expiration-date">--}}
                        {{--                                <label>Expiration Date</label><br/>--}}
                        {{--                                <select class="form-control" id="expiration-month" name="expiration_month"--}}
                        {{--                                        style="float: left; width: 100px; margin-right: 10px;" required>--}}
                        {{--                                    @foreach($months as $k=>$v)--}}
                        {{--                                        <option--}}
                        {{--                                            value="{{ $k }}" {{ old('expiration_month') == $k ? 'selected' : '' }}>{{ $v }}</option>--}}
                        {{--                                    @endforeach--}}
                        {{--                                </select>--}}
                        {{--                                <select class="form-control" id="expiration-year" name="expiration_year" style="float: left; width: 100px;" required>--}}
                        {{--                                    @for($i = date('Y'); $i <= (date('Y') + 15); $i++)--}}
                        {{--                                        <option value="{{ $i }}">{{ $i }}</option>--}}
                        {{--                                    @endfor--}}
                        {{--                                </select>--}}
                        {{--                            </div>--}}

                        {{--                        </div>--}}

                        {{--                        <div class="form-group">--}}
                        {{--                            <button class="btn btn-dark btn-block" id="create-deal-btn">Subscribe</button>--}}
                        {{--                        </div>--}}


                        <div class="text-center py-5" style="font-style: italic; color: #f8971c;">
                            <h1 class="m-0" style="font-weight: bold; font-size: 5rem;">ALMOST THERE.</h1>
                            <h3 class="m-0" style="font-size: 3rem;">COMPLETE THE PAYMENT FORM BELOW TO LOCK IN YOUR
                                POSITION.</h3>
                            <h3 class="m-0" style="font-size: 3rem; font-weight: bold;">PRICE: ${{$price}}</h3>
                            <div class="mt-5" style="font-size: 1rem; color: #CCC;">
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                                <i class="fa fa-circle mx-2"></i>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 d-payment">

                        {{--                        <div class="form-group" style="display: none">--}}
                        {{--                            <label for="product">State</label>--}}
                        {{--                            <select name="state_id" id="state_id" class="form-control"--}}
                        {{--                                    style="margin-bottom: 1.2rem;" disabled>--}}
                        {{--                                <option value="">Select State</option>--}}
                        {{--                                @foreach ($state as $row)--}}
                        {{--                                    <option value="{{ $row->id }}" > {{ $row->name }}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}

                        {{--                        <div class="row" style="display: none">--}}
                        {{--                            @if($subPrice)--}}
                        {{--                                <input type="hidden" name="state_id" value="{{$price}}">--}}
                        {{--                                <div class="form-group col-xs-12 col-sm-6 mb-3" id="sub" >--}}
                        {{--                                    <label for="deal_price">Subscription Price</label>--}}
                        {{--                                    <input type="number" name="price"  id="price" class="form-control" required value="{{$price}}" readonly>--}}
                        {{--                                </div>--}}
                        {{--                        </div>--}}
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="mt-0" style="font-weight: 900; font-style: italic;">PAYMENT INFORMATION</h2>
                                <div class="form-group-lg name-on-card">
                                    <label for="name-on-card">Name on Card</label>
                                    <input type="text" class="form-control d-r-0" id="name-on-card" name="name_on_card"
                                           value="{{ old('name_on_card') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-right m-2">
                                    <img src="{{asset('images/payment-420finder-logo.png')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group-lg col-xs-12 mb-3 col-sm-6" id="card-number-field">
                                <label for="cardNumber">Card Number</label>
                                <input type="number" class="form-control d-r-0" id="cardNumber" name="card_number"
                                       value="{{ old('card_number') }}" required>
                            </div>

                            <div class="form-group-lg col-xs-12 col-sm-3" id="expiration-date">
                                <label>Expiration Date</label><br/>
                                <select class="form-control d-r-0" id="expiration-month" name="expiration_month"
                                        style="float: left; width: 100px; margin-right: 10px;" required>
                                    @foreach($months as $k=>$v)
                                        <option
                                            value="{{ $k }}" {{ old('expiration_month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control d-r-0" id="expiration-year" name="expiration_year"
                                        style="float: left; width: 100px;" required>

                                    @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group-lg CVV col-xs-12 col-sm-3">
                                <label for="cvv">CVV</label>
                                <input type="number" class="form-control d-r-0" id="cvv" name="cvv"
                                       value="{{ old('cvv') }}"
                                       required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-card">
                                    <img src="{{asset('images/VectorSmartObject.png')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-center">
                                    <button class="d-btn btn" id="create-deal-btn">CHECKOUT</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <h3 class="m-0" style="font-weight: bold">authorize.net</h3>
                                    <p class="m-0">A Visa Solution</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-center">
                                    <p style="font-style: italic">By clicking <span
                                            style="font-weight: bold;">Checkout</span>, you're agreeing to 420 Finder's
                                        <span
                                            style="font-weight: bold; text-decoration: underline">User Agreement</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{--                        @else--}}
                        {{--                            <div class="form-group col-xs-12 col-sm-12 mb-3" id="description">--}}
                        {{--                                <h4 style="color: red;text-align: center;">Your State is Not Eligible</h4>--}}
                        {{--                            </div>--}}
                        {{--                        @endif--}}
                    </div>
                </div>
            </form>
        </div>


    </div>

@endsection


