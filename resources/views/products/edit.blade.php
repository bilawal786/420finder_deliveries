@extends('layouts.admin')

@section('content')

    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="panel-title">Edit Products</h3>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('products') }}" class="btn btn-primary">Go Back</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">

                    @include('partials.success-error')

                    <form action="{{ route('updateproduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="" class="pb-2">Avatar image</label>
                                <img src="{{ $product->image }}" alt="" class="w-100 img-thumbnail">
                                <div class="form-group mt-3">
                                    <input type="file" name="image" class="form-control">
                                </div>

                                <div class="mt-3">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control" required="">
                                            <option disabled>Select</option>
                                            <option value="0"
                                                    @if(!$product->status)
                                                        selected
                                                @endif>Unpublished
                                            </option>
                                            <option value="1" @if($product->status)
                                                selected
                                                @endif>Published
                                            </option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-10">
                                <div class="form-group pb-4">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                                           required="">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea id="editor1" name="description" cols="5" rows="5" class="form-control"
                                              required="">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group pt-3">
                                    <label for="">External ID</label>
                                    <input type="text" name="sku" value="{{ $product->sku }}" class="form-control">
                                </div>
                                @if($product->category_id == '4')
                                    <label for="">Prices</label>
                                    <div class="row">
                                        <div class="col-md-9" id="flowerId">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-1">1 gram :</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" value="{{$product->fp1}}" name="fp1"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-1">3.5 or 1/8oz :</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" value="{{$product->fp2}}" name="fp2"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-1">7g or 1/4oz :</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" value="{{$product->fp3}}" name="fp3"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-1">14 g or 1/2oz :</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" value="{{$product->fp4}}" name="fp4"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="text-1">28g or 1oz :</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="number" value="{{$product->fp5}}" name="fp5"
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group pt-3">
                                        <label for="">Price*</label>
                                        <input type="number" name="price" value="{{ $product->price }}"
                                               class="form-control"
                                               required="">
                                    </div>
                                @endif
{{--                                <div class="form-group pt-3">--}}
{{--                                    <label for="">Gallery Images</label>--}}
{{--                                    <div class="row">--}}
{{--                                        @if($gallery->count() > 0)--}}
{{--                                            @foreach($gallery as $single)--}}
{{--                                                <div class="col-md-1 py-3">--}}
{{--                                                    <a href="{{ route('removegalleryimage', ['id' => $single->id]) }}"--}}
{{--                                                       onclick="return confirm('Are you sure you want to delete this image?');">--}}
{{--                                                        <img src="{{ $single->image }}" alt="{{ $product->name }}"--}}
{{--                                                             class="w-100 img-thumbnail">--}}
{{--                                                    </a>--}}
{{--                                                </div>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                    <input type="file" name="galleryimages[]" multiple="" class="form-control">--}}
{{--                                </div>--}}
                                <div class="form-group pt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5><strong>Featured Products</strong></h5>
                                            <p>Make this a featured product and select the position on your landing
                                                page</p>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="">
                                                <input type="checkbox" name="is_featured"
                                                       @if($product->is_featured == 1) checked @endif> Featured?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group pt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5><strong>Strain (optional)</strong></h5>
                                        </div>
                                        <div class="col-md-12">
                                            @if($strains->count() >0)
                                                <select name="strain_id" class="select2 form-control">

                                                    @foreach($strains as $strain)
                                                        <option value="">Select an option</option>
                                                        @if($product->strain_id == $strain->id)
                                                            <option value="{{ $product->strain_id }}"
                                                                    selected="">{{ $strain->name }}</option>
                                                        @else
                                                            <option
                                                                value="{{ $strain->id }}">{{ $strain->name }}</option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group pt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5><strong>Genetics (optional)</strong></h5>
                                        </div>
                                        <div class="row">
                                            @if($genetics->count() >0)

                                                <div class="col-md-2 mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="genetic_id"
                                                               id="genetic_none" value=""
                                                               @if(is_null($product->genetic_id) || empty($product->genetic_id))
                                                                   checked
                                                            @endif
                                                        >
                                                        <label class="form-check-label" for="genetic_none">
                                                            None
                                                        </label>
                                                    </div>
                                                </div>

                                                @foreach($genetics as $genetic)
                                                    <div class="col-md-2 mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                   name="genetic_id" id="{{ $genetic->name }}"
                                                                   value="{{ $genetic->id }}"
                                                                   @if($genetic->id == $product->genetic_id)
                                                                       checked
                                                                @endif
                                                            >
                                                            <label class="form-check-label" for="{{ $genetic->name }}">
                                                                {{ $genetic->name }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group pt-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5><strong>Cannabinoids (optional)</strong></h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">THC %</label>
                                                    <input type="number" name="thc_percentage"
                                                           value="{{ $product->thc_percentage }}" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">CBD %</label>
                                                    <input type="number" name="cbd_percentage"
                                                           value="{{ $product->cbd_percentage }}" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
