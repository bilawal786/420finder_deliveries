@extends('layouts.admin')

    @section('content')
        <div class="dash-analytics">
            <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
                <h1 style="font-weight: 900; font-style: italic;" class="d-size">ORDERS</h1>
            </div>
        <div class="panel panel-headline">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $text = DB::table('tests')->first();
                        @endphp
                        <h4>
                            {!! $text->dis_orders !!}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title">Orders</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                          <table class="table table-responsive">
                            <thead>
                              <th>No.</th>
                              <th>#Order Number</th>
                              <th>Customer Name</th>
                              <th>Price</th>
                              <th>Created At</th>
                              <th>Order Details</th>
                              <th>Action</th>
                            </thead>
                            <tbody>
                                  @forelse ($orders as $order)
                                  <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $order->tracking_number }}</td>
                                        <?php
                                            $user = \App\Models\User::where('id', $order->customer_id)->first();
                                        ?>
                                        <td>{{ $user->name }}</td>
                                        <?php
                                                           $orderPrice =  App\Models\Order::where('tracking_number', $order->tracking_number)->sum('price')
                                                        ?>
                                        <td>$ {{ $orderPrice }}</td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td>
                                            <button class="btn" onclick="viewOrder({{ $order->id }})">View Order</button>
                                        </td>
                                        <td>
                                            <form action="{{ route('order.status') }}" method="POST" id="status-form-{{ $order->id }}">
                                                @csrf
                                                <input type="hidden" name="order_id"  value="{{ $order->id }}">
                                                <input type="hidden" name="status" value="" id="status-value-{{ $order->id }}">
                                                <button type="button"
                                                style="margin-bottom: 0.5rem"
                                                onclick="changeStatus('Accepted', {{ $order->id }})" class="btn btn-primary" {{ $order->status == 'Accepted' ? "disabled='true'" : '' }}>

                                                    @if ($order->status == 'Accepted')
                                                        Accepted
                                                    @else
                                                        Accept
                                                    @endif

                                                </button>
                                                <button type="button"
                                                style="margin-bottom: 0.5rem"
                                                onclick="changeStatus('Rejected', {{ $order->id }})" class="btn btn-primary" {{ $order->status == 'Rejected' ? "disabled='true'" : '' }}>

                                                    @if ($order->status == 'Rejected')
                                                        Rejected
                                                    @else
                                                        Reject
                                                    @endif

                                                </button>
                                                <button type="button" onclick="changeStatus('Completed', {{ $order->id }})" class="btn btn-primary" {{ $order->status == 'Completed' ? "disabled='true'" : '' }}>

                                                @if ($order->status == 'Completed')
                                                    Completed
                                                @else
                                                    Complete
                                                @endif
                                                </button>
                                            </form>

                                            @if ($order->status == 'Completed')
                                              <button type="submit" class="btn btn-primary" style="margin-top: 0.5rem" onclick="reviewCustomer({{ $order->id }})">Review</button>
                                            @endif
                                        </td>
                                  <tr>

                                  @empty
                                    <tr colspan="6" class="text-center">No orders found</tr>
                                  @endforelse
                            </tbody>
                          </table>
                          <div class="pagination">
                            {{ $orders->links("pagination::bootstrap-4") }}
                          </div>
                        </div>
                    </div>

               <!-- Modal -->
               <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">

                    <form action="{{ route('order.rating') }}" method="POST" id="reviewCustomerForm">
                        @csrf

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Review Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="order_id" value="" id="reviewOrderId">
                            <input type="hidden" name="rating" value="" id="reviewRating">
                            <div class="customer-rating"></div>
                            <span id="customer-rated" style="display: none;margin-top: 0.5rem;">Rated: <span></span></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Go Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    </form>

                </div>
               </div>
               {{-- Modal End --}}

                @foreach ($orders as $order)
                {{-- VIEW ORDER MODAL --}}
                <div class="modal fade" id="viewOrderModal-{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Order Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <?php
                                $user = \App\Models\User::where('id', $order->customer_id)->first();
                            ?>

                                <div>
                                    <span>Customer Name:</span>
                                    <span>{{ $user->name }}</span>
                                </div>

                                <div>
                                    <span>Customer Email:</span>
                                    <span>{{ $user->email }}</span>
                                </div>

                                <div>
                                    <span>Customer Phone:</span>
                                    <span>{{ $user->phone }}</span>
                                </div>

                                <div>
                                    <span>Customer Address:</span>
                                    <span>{{ $user->delivery_address }}</span>
                                </div>
                                <?php $total = 0;?>
                                <?php
                                      $products = App\Models\Order::where('tracking_number', $order->tracking_number)
                                      ->whereNull('orders.deal_id')
                                      ->join('delivery_products', 'orders.product_id', '=', 'delivery_products.id')
                                      ->get();
                                ?>
                                @if($products->count() > 0)
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                    <h6 style="font-weight: bold;
                                    margin: 0.3rem 0 0.7rem;
                                    border-bottom: 2px solid #f8971c;
                                    display: inline-block;
                                    padding-bottom: 0.3rem; font-size: 1.7rem">Products</h6>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th># NO</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($products as $product)
                                             <?php $total = $total + $product->price; ?>
                                              <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ $product->image }}" alt="Product Image" height="80px" width="80px">
                                                </td>
                                                <td>
                                                    {{ $product->name }}
                                                </td>
                                                <td>
                                                    {{ $product->qty }}
                                                </td>
                                                <td>
                                                   $ {{ $product->price }}
                                                </td>
                                              </tr>
                                            @endforeach
                                            {{-- <tr>
                                                <td colspan="3">
                                                    Total:
                                                </td>
                                                <td>
                                                    $ {{ number_format($products->sum('price'), 2) }}
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                @endif

                                <?php
                                      $deals = App\Models\Order::where('tracking_number', $order->tracking_number)
                                      ->whereNull('orders.product_id')
                                      ->join('deals', 'orders.deal_id', '=', 'deals.id')
                                      ->get();
                                ?>

                                @if($deals->count() > 0)
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                    <h6 style="font-weight: bold;
                                    margin: 0.3rem 0 0.7rem;
                                    border-bottom: 2px solid #f8971c;
                                    display: inline-block;
                                    padding-bottom: 0.3rem; font-size: 1.7rem">Deals</h6>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th># NO</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($deals as $deal)
                                            <?php $total = $total + $deal->deal_price; ?>
                                              <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{ json_decode($deal->picture)[0] }}" alt="Deal Image" height="80px" width="80px">
                                                </td>
                                                <td>
                                                    {{ $deal->title }}
                                                </td>
                                                <td>
                                                   $ {{ number_format($deal->deal_price, 2) }}
                                                </td>
                                              </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                @endif

                                @if($products->count() > 0 || $deals->count() > 0)
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div style="display: flex;
                                        align-items: center;
                                        justify-content: space-between;">
                                            <h6 style="font-size: 2rem;
                                            font-weight: 600;
                                            margin-bottom: 0;">Total: </h6>
                                            <span style="font-size: 2rem;
                                            font-weight: 600;
                                            margin-bottom: 0;">
                                            $ {{ number_format($total, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                   </div>
                   {{-- VIEW ORDER MODAL ENDS --}}

                </div>
                @endforeach

            </div>
        </div>
        </div>
    @endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating.css') }}">
@endsection

@section('scripts')

    <script src="{{ asset('assets/vendor/jquery-star-rating/jquery-star-rating.js') }}"></script>
    <script>
        function changeStatus(val, orderId) {
            $(`#status-value-${orderId}`).val(val);
            $(`#status-form-${orderId}`).submit();
        }

        function reviewCustomer(orderId) {
            $('#reviewOrderId').val(orderId);
            $("#reviewModal").modal('show');
        }

        $(".customer-rating").starRating({
            initialRating: 0,
            strokeColor: '#894A00',
            strokeWidth: 10,
            starSize: 25,
            callback: function(currentRating, $el){
                $('#customer-rated').show();
                $('#customer-rated').css({
                    'display': 'block'
                });
                $('#customer-rated span').text(currentRating);
                $('#reviewRating').val(currentRating);
            }
        });

        function viewOrder(orderId) {
          $(`#viewOrderModal-${orderId}`).modal('show');
        }

        var orderId = {!! request()->has('order') ? json_encode(request()->get('order')) : 0 !!};

        if(orderId) {
            viewOrder(orderId);
        }

    </script>
@endsection

