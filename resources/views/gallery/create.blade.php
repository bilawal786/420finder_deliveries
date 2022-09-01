@extends('layouts.admin')

@section('content')

    <!-- OVERVIEW -->
    <div class="panel panel-headline">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="panel-title">Gallery</h3>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">

                <div id="upload-3-queue" class="queue"></div>

                <button type="button" class="btn btn-success fileup-btn">
                    Select images
                    <input type="file" id="upload-3" multiple accept="image/*">
                </button>




            </div>
        </div>
    </div>
@endsection
