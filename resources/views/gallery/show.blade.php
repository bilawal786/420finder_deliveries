@extends('layouts.admin')

@section('content')

    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="panel-title">Single Image</h3>
                </div>
                <div class="col-md-6 text-right">
                   <a href="{{route('gallery.index')}}" class="btn btn-primary">Back to Gallery</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12" style="margin: 10px auto;text-align: center;">
{{--                    <button class="btn btn-success" style="margin: 10px;" ><i class="fa fa-download"></i> </button>--}}
                    <form action="{{ route('gallery.destroy', $data->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" style="margin: 10px;" ><i class="fa fa-trash"></i> </button>
                    </form>

                </div>
            </div>
            <div class="row">
                <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="thumbnail">
                                    <img src="{{$data->image}}" alt="Lights" style="width:100%;">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
