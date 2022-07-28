@extends('layouts.admin')

    @section('content')

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-headline">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="panel-title">Request Products</h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-headline">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                           @include('partials.success-error')
                           
                            <form action="{{ route('submitproductrequest') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Brand</label>
                                    <select id="rp_brand_id" name="brand_id" class="form-control" required="">
                                        <option value="">Select</option>
                                        @if($brands->count() > 0)
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Product</label>
                                    <select id="rp_products" name="product_id[]" class="selectPlugin form-control" multiple="multiple" required="">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">Submit Request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-headline">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="panel-title">Submitted Requests</h3>
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
                                        <th>Brand Name</th>
                                        <th>Product Name</th>
                                        <th>Status</th>
                                        <th>Request Submitted At</th>
                                    </thead>
                                    <tbody>
                                        @if($requests->count() >0)
                                            @foreach($requests as $index => $request)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <?php
                                                        $brand = App\Models\Brand::where('id', $request->brand_id)
                                                        ->select('name')
                                                            ->first();
                                                            echo "<strong>" . $brand->name . "</strong>";
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                            $products = explode(", ", $request->products);

                                                            foreach($products as $init => $id) {
                                                                $product = App\Models\BrandProduct::where('id', $id)
                                                                    ->select('name')
                                                                    ->first();
                                                                echo "<strong>" . $init + 1 . "</strong>. " . $product->name . ".<br>";
                                                            }

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($request->status == '') {
                                                            ?>
                                                            <span class="label label-warning">Pending</span>
                                                            <?php
                                                        } elseif ($request->status == 0) {
                                                            ?>
                                                            <span class="label label-danger">Rejected</span>
                                                            <?php
                                                        } elseif ($request->status == 1) {
                                                            ?>
                                                            <span class="label label-info">Approved</span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>{{ $request->created_at->diffForHumans() }} At <br> {{ $request->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @endsection
