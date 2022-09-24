@extends('layouts.admin')

@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp

@section('content')
    <div class="dash-analytics">
        <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
            <h1 style="font-weight: 900; font-style: italic;" class="d-size">SUBSCRIPTION</h1>
        </div>
        <div class="panel panel-headline">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $text = DB::table('tests')->first();
                        @endphp
                        <h4>
                            {!! $text->dis_subscription !!}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 style="font-style: italic; font-weight: bold; color: orange" class="panel-title">Purchase
                            Subscription </h3>
                    </div>
                </div>
            </div>
            <?php  $date = DB::table('subscription_details')->orderBy('id', 'DESC')->where('retailer_id', '=', session('business_id'))->first();
            $state_name = DB::table('states')->where('id', '=', $date->state_id ?? 1)->first();
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $startDate = date('Y-m-d', strtotime($date->starting_date ?? '12-2-2021'));
            $endDate = date('Y-m-d', strtotime($date->ending_date ?? '12-2-2021'));
            ?>
            @if(($currentDate >= $startDate) && ($currentDate <= $endDate))
                <section class="pb-0">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-md-12 p-5 bg-light">
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a style="background-color: green !important; color: white; font-size: 20px; font-weight: bold; font-style: italic" href="#" class="btn btn-dark btn-block">SUBSCRIPTION IS ACTIVE</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table responsive">

                                            <table class="table">
                                                <thead>
                                                <th>Transaction Id</th>
                                                <th>State Name</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Starting Date - Expiry Date</th>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>{{$date->transaction_id}}</td>
                                                    <td>{{$state_name->name}}</td>
                                                    <td>$ {{$date->price}}</td>
                                                    <td>
                                                        <span class="btn-dark">Activate</span>
                                                    </td>
                                                    <td>{{date("m-d-Y", strtotime($date->starting_date)) . '- ' .date("m-d-Y", strtotime($date->ending_date)) }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-center py-5" style="font-style: italic; color: #f8971c;">
                                <h1 class="m-0" style="font-weight: bold; font-size: 5rem;">ALMOST THERE.</h1>
                                <h3 class="m-0" style="font-size: 3rem;">COMPLETE THE PAYMENT FORM BELOW TO LOCK IN YOUR
                                    SUBSCRIPTION NOW.</h3>
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
                        <div class="col-md-6">
                            <h1 class="m-0"
                                style="font-weight: bold; font-size: 3rem; color: red; text-align: center; font-style: italic">
                                STATE / REGION</h1>
                            <br>
                            <h1 class="m-0"
                                style="font-weight: bold; font-size: 4rem; color: red; text-align: center; font-style: italic">{{$subPrice->name}}</h1>
                        </div>
                        <div class="col-md-6">
                            <h1 class="m-0"
                                style="font-weight: bold; font-size: 3rem; color: red; text-align: center; font-style: italic">
                                MONTHLY SUBSCRIPTION PRICE</h1>
                            <br>
                            <h1 class="m-0"
                                style="font-weight: bold; font-size: 4rem; color: red; text-align: center; font-style: italic">
                                ${{$subPrice->sub_price}}</h1>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        @include('partials.success-error')
                        <div class="col-md-12 d-payment">
                            <form action="{{ route('subscription.store') }}" method="POST" enctype="multipart/form-data"
                                  id="create-deal-form">
                                @csrf

                                <div class="form-group" style="display: none">
                                    <label for="product">State</label>
                                    <select name="state_id" id="state_id" class="form-control"
                                            style="margin-bottom: 1.2rem;" disabled>
                                        <option value="">Select State</option>
                                        @foreach ($state as $row)
                                            <option value="{{ $row->id }}"> {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row" style="display: none">
                                    @if($subPrice)
                                        <input type="hidden" name="state_id" value="{{$subPrice->id}}">
                                        <div class="form-group col-xs-12 col-sm-6 mb-3" id="sub">
                                            <label for="deal_price">Subscription Price</label>
                                            <input type="number" name="price" id="price" class="form-control" required
                                                   value="{{$subPrice->sub_price}}" readonly>
                                        </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="mt-0" style="font-weight: 900; font-style: italic;">PAYMENT
                                            INFORMATION</h2>
                                        <div class="form-group-lg name-on-card">
                                            <label for="name-on-card">Name on Card</label>
                                            <input type="text" class="form-control d-r-0" id="name-on-card"
                                                   name="name_on_card" value="{{ old('name_on_card') }}" required>
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
                                        <input type="number" class="form-control d-r-0" id="cardNumber"
                                               name="card_number"
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
                                            <button class="d-btn btn" id="create-deal-btn">ACTIVATE SUBSCRIPTION
                                            </button>
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
                                            <p style="font-style: italic">By clicking <span style="font-weight: bold;">Checkout</span>,
                                                you're agreeing to 420 Finder's <span
                                                    style="font-weight: bold; text-decoration: underline">User Agreement</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                @else
                                    <div class="form-group col-xs-12 col-sm-12 mb-3" id="description">
                                        <h4 style="color: red;text-align: center;">Your State is Not Eligible</h4>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endif
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
                    var price = msg.success.sub_price
                    if (price > 0) {
                        $("#price").val(msg.success.sub_price);
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
