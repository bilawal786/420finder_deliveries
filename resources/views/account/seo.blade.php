@extends('layouts.admin')
@section('content')
    <div class="dash-analytics">
        <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
            <h1 style="font-weight: 900; font-style: italic;" class="d-size">S E O</h1>
        </div>
        <!-- OVERVIEW -->
        <div class="panel panel-headline">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title">Seo Settings</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{route('update.seo')}}" method="POST">
                            @csrf
                            <label for="">Header</label>
                            <textarea name="text" class="form-control" id="" cols="30" rows="10">{{$business->seo}}</textarea>
                            <br>
                            <button class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
