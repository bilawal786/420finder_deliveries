@extends('layouts.admin')

@php
    $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp

@section('content')

    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="panel-title">Purchase Subscription </h3>
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
                                            <a href="#" class="btn btn-dark btn-block">Activate Subscription</a>
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
                                                @if($date->status==1)
                                                    <td>
                                                        <span class="btn-dark">Activate</span>
                                                    </td>
                                                @else
                                                    <td>
                                                        <span class="btn-danger">Not Activate</span>
                                                    </td>
                                                @endif

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
                    @include('partials.success-error')
                    <div class="col-md-12">
                        <form action="{{ route('subscription.store') }}" method="POST" enctype="multipart/form-data"
                              id="create-deal-form">
                            @csrf


                            <div class="form-group" style="display: none">
                                <label for="product">State</label>
                                <select name="state_id" id="state_id" class="form-control"
                                        style="margin-bottom: 1.2rem;" disabled>
                                    <option value="">Select State</option>
                                    @foreach ($state as $row)
                                        <option value="{{ $row->id }}" > {{ $row->name }}</option>
                                    @endforeach
                                </select>


                            </div>

                            <div class="row">
                                @if($subPrice)
                                    <input type="hidden" name="state_id" value="{{$subPrice->id}}">
                                    <div class="form-group col-xs-12 col-sm-6 mb-3" id="sub" >
                                        <label for="deal_price">Subscription Price</label>
                                        <input type="number" name="price"  id="price" class="form-control" required
                                               value="{{$subPrice->sub_price}}" readonly>
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
