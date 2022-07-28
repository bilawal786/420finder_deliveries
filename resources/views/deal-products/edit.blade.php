@extends('layouts.admin')

    @section('content')

        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">Remove Products from Deal</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="deal-title">
                            <h4 class="mb-5">Deal Title : {{ $deals[0]->title }}</h4>
                        </div>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <th>#</th>
                              <th>Title</th>
                              <th>Picture</th>
                              <th>Price</th>
                              <th>Description</th>
                              <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($deals as $deal)
                                    <?php
                                         $product = \App\Models\DeliveryProducts::where('id', $deal->product_id)->first();
                                    ?>
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td><img src="{{ $product->image }}" style="width: 50px;height: 50px;" class="img-thumbnail"></td>
                                        <td>{{ $product->price }}</td>
                                        <td>{!! $product->description !!}</td>
                                        <td>
                                            <button class="btn btn-danger" onclick="handleDelete({{ $deal->deal_id }}, {{ $deal->product_id }})">Remove</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6">No Deals Product found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                  <!-- Modal -->
                  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">

                        <form action="" method="POST" id="deleteDealProductForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Remove Product From Deal</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to remove this Product?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back</button>
                                <button type="submit" class="btn btn-primary">Yes, Remove</button>
                            </div>
                        </div>

                        </form>

                    </div>
                 </div>

                 {{-- Modal End --}}

    @endsection

@section('scripts')
    <script>
        function handleDelete(dealId, productId) {
           let form = document.getElementById('deleteDealProductForm');
           form.action = `/deals/products/delete/${dealId}/${productId}`;
           $("#deleteModal").modal('show');
       }
    </script>
 @endsection
