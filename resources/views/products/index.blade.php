@extends('layouts.admin')

@php
$months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');
@endphp

    @section('content')
        <div class="dash-analytics">
            <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
                <h1 style="font-weight: 900; font-style: italic;" class="d-size">PRODUCTS</h1>
            </div>
            <div class="panel panel-headline">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $text = DB::table('tests')->first();
                            @endphp
                            <h4>
                                {!! $text->del_product !!}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            @if(is_null($paid))
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="panel-title">Products</h3>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
                          </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <th>#</th>
                                  <th>Product Name</th>
                                  <th>Status</th>
                                  <th>Category</th>
                                  <th>Price</th>
                                  <th>Published?</th>
                                  <th>Action</th>
                                  <th>Created At</th>
                                </thead>
                                <tbody>
                                  @if($products->count() > 0)
                                    @foreach($products as $index => $product)
                                      <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                          <img src="{{ $product->image }}" alt="" style="width: 25px;height: 25px;">
                                          <strong>{{ $product->name }}</strong>
                                          @if($product->off > 0)
                                          <br>
                                          &nbsp;&nbsp;&nbsp;<span class="label label-warning">{{ $product->off }}% off</span>
                                          @endif
                                        </td>
                                        <td>
                                            @if ($product->brand_product)
                                            <label class="badge" style="background: #4b4bd5;">Verified</label>

                                            @else
                                                Not verified
                                            @endif

                                        </td>
                                        <td>
                                           <?php
                                                $category = \App\Models\Category::where('id', $product->category_id)->pluck('name')->first();
                                            ?>
                                            {{ $category }}
                                        </td>
                                        <td>${{ $product->price }}</td>
                                        <td>
                                          @if($product->status == 0)
                                            No
                                          @else
                                            Yes
                                          @endif
                                        </td>

                                        @if ($product->brand_product)
                                            <td title="Can not edit brand product">
                                                <button disabled class="text-center" style="background: #fff; border: 1px solid #fff;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 167.751 167.751" style="enable-background:new 0 0 167.751 167.751;fill: #d72424;" xml:space="preserve" height="25" width="25">
                                                        <path d="M0,83.875c0,46.249,37.626,83.875,83.875,83.875s83.875-37.626,83.875-83.875S130.125,0,83.875,0S0,37.626,0,83.875z   M83.875,152.751C45.897,152.751,15,121.854,15,83.875c0-16.292,5.698-31.272,15.191-43.078l96.762,96.762  C115.147,147.052,100.168,152.751,83.875,152.751z M152.75,83.875c0,16.292-5.698,31.272-15.19,43.078L40.797,30.191  C52.603,20.698,67.583,15,83.875,15C121.853,15,152.75,45.897,152.75,83.875z"/>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        <g>
                                                        </g>
                                                        </svg>
                                                </button>

                                            </td>
                                        @else
                                        <td>
                                            <a href="{{ route('editproduct', ['id' => $product->id]) }}" class="btn border bg-white">Edit</a>
                                            <button type="submit" class="btn border bg-white" onclick="handleDelete({{ $product->id }})">Delete</button>
                                          </td>
                                        @endif
                                          <td>
                                            {{ $product->created_at->diffForHumans() }}
                                          </td>
                                      </tr>
                                    @endforeach
                                  @else
                                    <tr class="text-center">
                                      <td colspan="6">No Product Found.</td>
                                    </tr>
                                  @endif
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>

                      <!-- Modal -->
                   <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        <form action="" method="POST" id="deleteProductForm">
                            @csrf
                            @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this Product?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                                <button type="submit" class="btn btn-primary">Yes, Delete</button>
                            </div>
                        </div>

                        </form>

                    </div>
                 </div>

                 {{-- Modal End --}}

                </div>
            </div>
            @else
            {{-- PAYMENT PANEL --}}
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="panel-title text-center">Payment</h3>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                @include('partials.success-error')

                {{-- PAYMENT CHECKOUT --}}
                <div class="payment mt-3">
                     <div class="row mt-4">

                        <div class="col-xs-12 col-sm-6 col-sm-offset-3">

                        <form action="{{ route('storeretailerpayment') }}" method="POST" id="retailer-products-payment">
                            @csrf
                            <div class="row">

                           <div class="form-group name-on-card col-xs-12 mb-3">
                                 <label for="name-on-card">Name on Card</label>
                                 <input type="text" class="form-control" id="name-on-card" name="name_on_card" value="{{ old('name_on_card') }}" required>

                            </div>

                            <div class="form-group CVV col-xs-12">
                                 <label for="cvv">CVV</label>
                                  <input type="number" class="form-control" id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                            </div>


                             <div class="form-group col-xs-12 mb-3" id="card-number-field">
                                   <label for="cardNumber">Card Number</label>
                                   <input type="number" class="form-control" id="cardNumber" name="card_number" value="{{ old('card_number') }}" required>
                            </div>

                            <div class="form-group col-xs-12" id="expiration-date">
                                    <label>Expiration Date</label><br/>
                                    <select class="form-control" id="expiration-month" name="expiration_month" style="float: left; width: 100px; margin-right: 10px;" required>
                                                @foreach($months as $k=>$v)
                                                    <option value="{{ $k }}" {{ old('expiration_month') == $k ? 'selected' : '' }}>{{ $v }}</option>
                                                @endforeach
                                            </select>
                                    <select class="form-control" id="expiration-year" name="expiration_year"  style="float: left; width: 100px;" required>

                                                @for($i = date('Y'); $i <= (date('Y') + 15); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                     </select>
                                </div>

                            </div>

                            <div style="margin-top: 1rem">
                                <button class="btn btn-primary" id="retailer-products-payment-submit">Pay</button>
                            </div>

                        </form>

                         </div>
                    </div>
                </div>
                {{-- PAYMENT CHECKOUT ENDS --}}

            </div>
            {{-- PANEL BODY ENDS --}}
            </div>
            {{-- PANEL ENDS --}}
            @endif
        </div>
    @endsection


@section('scripts')
    <script>
        function handleDelete(id) {
           let form = document.getElementById('deleteProductForm');
           form.action = '/product/' + id;
           $("#deleteModal").modal('show');
       }

       $("#retailer-products-payment").submit(function () {
                $("#retailer-products-payment-submit").attr("disabled", true);
                return true;
       });

    </script>
 @endsection
