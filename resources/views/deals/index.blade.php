@extends('layouts.admin')

@section('content')
    <div class="dash-analytics">
        <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
            <h1 style="font-weight: 900; font-style: italic;" class="d-size">DEALS</h1>
        </div>
        <div class="panel panel-headline">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $text = DB::table('tests')->first();
                        @endphp
                        <h4>
                            {!! $text->del_deal !!}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">All Deals</h3>
                    </div>
                    @if($deal_wallet->deal_wallet <= 0)
                        <div class="col-md-6 text-right">
                            <a href="{{ route('addnewdeal') }}" class="btn btn-dark">Add New Deal</a>
                        </div>
                    @else
                        <div class="col-md-6 text-right">
                            <a href="{{ route('freeDeal') }}" class="btn btn-dark">Add Free Deal({{$deal_wallet->deal_wallet}})</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <th>#</th>
                                <th>Title</th>
                                <th>Picture</th>
                                <th>Description</th>
                                <th>Deal Products</th>
                                <th>Deal Price</th>
                                {{-- <th>Coupon Code</th>
                                <th>Percentage</th> --}}
                                <th>Ending Date</th>
                                <th>Created at</th>
                                </thead>
                                <tbody>
                                @if($deals->count() > 0)

                                    @foreach($deals as $index => $deal)

                                        <tr>

                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $deal->title }}<br>
                                                <a href="{{ route('editdeal', ['id' => $deal->id]) }}">Edit</a> / <a
                                                    href="{{ route('deletedeal', ['id' => $deal->id]) }}"
                                                    onclick="return confirm('Are you sure you want to delete this deal?');">Delete</a>
                                            </td>

                                            <td><img src="{{ json_decode($deal->picture)[0] }}"
                                                     style="width: 50px;height: 50px;" class="img-thumbnail"></td>
                                            <td>{{ $deal->description }}</td>
                                            <td>
                                                <?php
                                                $products = \App\Models\DealProduct::where('deal_id', $deal->id)->join("delivery_products", 'delivery_products.id', 'deal_products.product_id')->get();
                                                ?>
                                                <ul>
                                                    @foreach ($products as $product)
                                                        <li>{{ $product->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>$ {{ $deal->deal_price }}</td>
                                            {{-- <td>
                                                @if($deal->coupon_code == NULL)
                                                    Not Set
                                                @else
                                                    {{ $deal->coupon_code }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($deal->percentage == NULL)
                                                    Not Set
                                                @else
                                                    {{ $deal->percentage }}
                                                @endif
                                            </td> --}}
                                            <td>{{ $deal->ending_date }}</td>
                                            <td>{{ $deal->created_at->diffForHumans() }}</td>
                                        </tr>

                                    @endforeach

                                @else

                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
