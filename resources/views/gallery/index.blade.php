@extends('layouts.admin')

@section('content')
    <div class="dash-analytics">
        <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
            <h1 style="font-weight: 900; font-style: italic;" class="d-size">GALLERY</h1>
        </div>
        <div class="panel panel-headline">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        @php
                            $text = DB::table('tests')->first();
                        @endphp
                        <h4>
                            {!! $text->dis_gallery !!}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title">Gallery</h3>
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" data-toggle="modal" data-target="#upload" class="btn btn-primary" style="padding: 5px 10px;">Upload images</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">


                    <div class="container-fluid">
                        <div class="row">
                            @if(count($data) > 0)
                                @foreach($data as $row)
                                    <div class="col-md-3">
                                        <div class="thumbnail">
                                            <a href="{{route('gallery.show', [$row->id])}}">
                                                <img src="{{$row->image}}" alt="Lights" style="width:100%;">
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-md-12">
                                    <div class="thumbnail">
                                        <img src="https://420finder.net/images/no-image.jpg" alt="Lights" style="width:100%;">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Last Name -->
        <div class="modal fade" id="upload" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('savelastname') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><strong>Upload Images</strong></h4>
                            </div>
                            <div class="col-md-6 text-right pt-2 pe-3">
                                <button onclick="window.location.reload();" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-md-12">
                                <div id="upload-3-queue" class="queue"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary btn-block fileup-btn">
                                    Select images
                                    <input type="file" id="upload-3" multiple accept="image/*">
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
