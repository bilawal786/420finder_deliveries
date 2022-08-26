@extends('layouts.admin')
@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp
@section('content')

    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="panel-title">Purchase Position </h3>
                </div>

            </div>
        </div>
{{--        {{dd(Carbon\Carbon::now()->addMonth(1)->format('m, y'))}}--}}
        <div class="panel-body">
            <div class="row">
                @include('partials.success-error')
                <div class="col-md-12">
                    <form action="{{ route('banner.payment', ['id'=>request()->route('id')]) }}" method="POST" enctype="multipart/form-data"
                          id="create-deal-form">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="area_id" value="{{$area->id}}">
                            <input type="hidden" name="position" value="{{$p}}">
                            <div class="form-group col-xs-12 col-sm-6 mb-3" id="sub">
                                <label for="deal_price"> Price</label>
                                <input type="number" name="price" id="price" class="form-control" required
                                       value="{{$price}}" readonly>

                            </div>
                            <div class="col-xs-12 col-sm-12 mb-3">
                                <label for="" style="margin-bottom: 1rem; margin-top: 10px;">Description</label>
                                <textarea name="description" id="" rows="8" class="form-control"></textarea>
                            </div>


                        </div>

                        <div class="row">

                            <div class="form-group name-on-card col-xs-12 col-sm-6 mb-3">
                                <label for="name-on-card">Name on Card</label>
                                <input type="text" class="form-control" id="name-on-card" name="name_on_card"
                                       value="{{ old('name_on_card') }}" required>

                            </div>

                            <div class="form-group CVV col-xs-12 col-sm-6">
                                <label for="cvv">CVV</label>
                                <input type="number" class="form-control" id="cvv" name="cvv"
                                       value="{{ old('cvv') }}"
                                       required>
                            </div>


                            <div class="form-group col-xs-12 mb-3 col-sm-6" id="card-number-field">
                                <label for="cardNumber">Card Number</label>
                                <input type="number" class="form-control" id="cardNumber" name="card_number"
                                       value="{{ old('card_number') }}" required>
                            </div>

                            <div class="form-group col-xs-12 col-sm-6" id="expiration-date">
                                <label>Expiration Date</label><br/>
                                <select class="form-control" id="expiration-month" name="expiration_month"
                                        style="float: left; width: 100px; margin-right: 10px;" required>
                                    @foreach($months as $k=>$v)
                                        <option
                                            value="{{ $k }}" {{ old('expiration_month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control" id="expiration-year" name="expiration_year"
                                        style="float: left; width: 100px;" required>

                                    @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <button class="btn btn-dark btn-block" id="create-deal-btn">Subscribe</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection


