@extends('layouts.admin')

    @section('content')

        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">All Deal Products</h3>
                    </div>
                    <div class="col-md-6 text-right">
                      <a href="{{ route('deal-product.add') }}" class="btn btn-dark">Add Product To Deal</a>
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
                              <th>Title</th>
                              <th>Picture</th>
                              <th>Products</th>
                              <th>Description</th>
                              <th>Ending Date</th>
                              <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($deals as $deal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $deal[0]->title }}</td>
                                        <td><img src="{{ $deal[0]->picture }}" style="width: 50px;height: 50px;" class="img-thumbnail"></td>
                                        <td>
                                            <ul style="padding: 14px">
                                            @foreach ($deal as $d)
                                                <?php
                                                $product = \App\Models\DeliveryProducts::where('id', $d->product_id)->first();
                                                ?>
                                                <li>{{ $product->name }}</li>
                                            @endforeach
                                          </ul>
                                        </td>
                                        <td>{{ $deal[0]->description }}</td>
                                        <td>{{ $deal[0]->ending_date }}</td>
                                        <td>
                                            <a href="{{ route('deal-product.edit', $deal[0]->deal_id ) }}">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        No Deals Product found
                                    </tr>
                                @endforelse
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
