@extends('layouts.admin')

@section('content')

    <style>
        .metric{
            display: block;!important;
            padding: 10px;
        }
        .mytitle{
            font-size: 25px; margin-top: 0px
        }
    </style>
    <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
        <h1 style="font-weight: 900; font-style: italic;" class="d-size">SALES + MARKETING PRODUCTS</h1>
        <h3 style="font-style: italic;" class="m-0">+TOP 10 POSITIONS &nbsp; &nbsp; &nbsp; +MARKETING BANNERS &nbsp; &nbsp; &nbsp; +MORE</h3>
    </div>
    <div class="panel panel-headline">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">

                    <h4>
                        {!!$area->description  !!}
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 style="float: right;font-size: 15px;">1 {{\Carbon\Carbon::now()->addMonth(1)->format('M, Y')}} 12:00PM
                - 30 {{\Carbon\Carbon::now()->addMonth(2)->format('M, Y')}} 11:59PM</h3>
            <h2  class="panel-title" style="text-align: center; font-size: 30px">TOP 10 BUSINESS POSITIONS IN <b>{{strtoupper($area->title)}}</b> </h2>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#1 POSITION +</h1>
                                <h1 class="mytitle" >#1 TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('1', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p1,'p'=>1])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p1}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#2 POSITION +</h1>
                                <h1 class="mytitle" >#2 TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('2', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p2,'p'=>2])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p2}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#3 POSITION +</h1>
                                <h1 class="mytitle" >#3 TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('3', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p3,'p'=>3])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p3}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#4 POSITION +</h1>
                                <h1 class="mytitle" >#4 TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('4', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p4,'p'=>4])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p4}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#5 POSITION +</h1>
                                <h1 class="mytitle" >#5 TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('5', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p5,'p'=>5])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p5}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#6 POSITION +</h1>
                                <h1 class="mytitle" >NO TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('6', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p6,'p'=>6])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p6}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#7 POSITION +</h1>
                                <h1 class="mytitle" >NO TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('7', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p7,'p'=>7])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p7}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#8 POSITION +</h1>
                                <h1 class="mytitle" >NO TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('8', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p8,'p'=>8])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p8}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#9 POSITION +</h1>
                                <h1 class="mytitle" >NO TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('9', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p9,'p'=>9])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p9}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#10 POSITION +</h1>
                                <h1 class="mytitle" >NO TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('10', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->p10,'p'=>10])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->p10}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><br>
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 style="float: right;font-size: 15px;">1 {{\Carbon\Carbon::now()->addMonth(1)->format('M, Y')}} 12:00PM
                - 30 {{\Carbon\Carbon::now()->addMonth(2)->format('M, Y')}} 11:59PM</h3>
            <h2 class="panel-title" style="text-align: center; font-size: 30px">TOP 10 BANNER POSITIONS IN <b>{{strtoupper($area->title)}}</b> </h2>
            {{--            <p class="panel-subtitle">Today</p>--}}

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1 class="mytitle" >#1  BANNER POSITION IS INCLUDED WITH THE <BR> #1 BUSINESS POSITION ABOVE</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1 class="mytitle" >#2  BANNER POSITION IS INCLUDED WITH THE <BR> #2 BUSINESS POSITION ABOVE</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1 class="mytitle" >#3  BANNER POSITION IS INCLUDED WITH THE <BR> #3 BUSINESS POSITION ABOVE</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1 class="mytitle" >#4  BANNER POSITION IS INCLUDED WITH THE <BR> #4 BUSINESS POSITION ABOVE</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <h1 class="mytitle" >#5  BANNER POSITION IS INCLUDED WITH THE <BR> #5 BUSINESS POSITION ABOVE</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#6 POSITION</h1>
                                <h1 class="mytitle" >TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('11', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp1,'p'=>11])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->bp1}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#7 POSITION</h1>
                                <h1 class="mytitle" >TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('12', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp2,'p'=>12])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->bp2}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#8 POSITION</h1>
                                <h1 class="mytitle" >TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('13', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp3,'p'=>13])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->bp3}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#9 POSITION</h1>
                                <h1 class="mytitle" >TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('14', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp4,'p'=>14])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->bp4}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="metric">
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 class="mytitle" >#10 POSITION</h1>
                                <h1 class="mytitle" >TOP BANNER</h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                @if(in_array('15', $position,true))
                                    <div class="m-icon customer-icon">
                                        <a href="#"> CLAIMED</a>
                                    </div>
                                @else
                                    <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                        <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp5,'p'=>15])}}">CLAIM NOW</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <h1 style="font-size:25px" >
                                    FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                </h1>
                                <h1 class="mytitle" >
                                    TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                </h1>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <h1 style="font-size:40px; text-align: center" >${{$area->bp5}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    @if($area->status==1)
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 style="float: right;font-size: 15px;">1 {{\Carbon\Carbon::now()->addMonth(1)->format('M, Y')}} 12:00PM
                    - 30 {{\Carbon\Carbon::now()->addMonth(2)->format('M, Y')}} 11:59PM</h3>
                <h2  class="panel-title" style="text-align: center; font-size: 30px">MIDDLE BANNERS POSITIONS IN <b>{{strtoupper($area->title)}}</b> </h2>

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="metric">
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 class="mytitle" >#1 POSITION</h1>
                                    <h1 class="mytitle" >#1 MIDDLE BANNER</h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    @if(in_array('16', $position,true))
                                        <div class="m-icon customer-icon">
                                            <a href="#"> CLAIMED</a>
                                        </div>
                                    @else
                                        <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                            <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp6,'p'=>16])}}">CLAIM NOW</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 style="font-size:25px" >
                                        FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                    </h1>
                                    <h1 class="mytitle" >
                                        TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                    </h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <h1 style="font-size:40px; text-align: center" >${{$area->bp6}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="metric">
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 class="mytitle" >#2 POSITION</h1>
                                    <h1 class="mytitle" >#2 MIDDLE BANNER</h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    @if(in_array('17', $position,true))
                                        <div class="m-icon customer-icon">
                                            <a href="#"> CLAIMED</a>
                                        </div>
                                    @else
                                        <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                            <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp7,'p'=>17])}}">CLAIM NOW</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 style="font-size:25px" >
                                        FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                    </h1>
                                    <h1 class="mytitle" >
                                        TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                    </h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <h1 style="font-size:40px; text-align: center" >${{$area->bp7}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="metric">
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 class="mytitle" >#3 POSITION</h1>
                                    <h1 class="mytitle" >#3 MIDDLE BANNER</h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    @if(in_array('18', $position,true))
                                        <div class="m-icon customer-icon">
                                            <a href="#"> CLAIMED</a>
                                        </div>
                                    @else
                                        <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                            <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp8,'p'=>18])}}">CLAIM NOW</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 style="font-size:25px" >
                                        FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                    </h1>
                                    <h1 class="mytitle" >
                                        TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                    </h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <h1 style="font-size:40px; text-align: center" >${{$area->bp8}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="metric">
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 class="mytitle" >#4 POSITION</h1>
                                    <h1 class="mytitle" >#4 MIDDLE BANNER</h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    @if(in_array('19', $position,true))
                                        <div class="m-icon customer-icon">
                                            <a href="#"> CLAIMED</a>
                                        </div>
                                    @else
                                        <div style="background-color: green; text-align: center; padding: 0.5rem" class="m-icon sales-icon">
                                            <a style="color: white; font-size: 20px; text-align: center" href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp8,'p'=>19])}}">CLAIM NOW</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <h1 style="font-size:25px" >
                                        FROM {{\Carbon\Carbon::now()->addMonth(1)->format('m')}}/1  12:00 PM
                                    </h1>
                                    <h1 class="mytitle" >
                                        TO {{\Carbon\Carbon::now()->addMonth(2)->format('m')}}/30 11:59 PM
                                    </h1>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <h1 style="font-size:40px; text-align: center" >${{$area->bp8}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('styles')
    <style>

        .metric {
            display: flex;
            justify-content: space-between;
            padding: 6rem 2rem;
            box-shadow: 1px 1px 20px 0px rgb(0 0 0 / 19%);
            border: 0px;
        }

        .metric .m-icon {
            padding: 1.5rem;
            border-radius: 5px;
        }

        .metric .number {
            font-weight: 500;
        }

        .metric .m-icon.customer-icon {
            background-color: rgba(247, 184, 75, .18);
        }

        .metric .m-icon.customer-icon svg {
            fill: #f7b84be0;
        }

        .metric .m-icon.brand-icon {
            background-color: rgba(41, 156, 219, .18);
        }

        .metric .m-icon.brand-icon svg {
            fill: #299cdb;
        }

        .metric .m-icon.deal-icon {
            background-color: rgba(64, 81, 137, .18);
        }

        .metric .m-icon.deal-icon svg {
            fill: #405189;;
        }

        .metric .m-icon.sales-icon {
            background-color: rgba(10, 179, 156, .18)
        }

        .metric .m-icon.sales-icon svg {
            fill: #0ab39c;
        }

        .chart-row .line-chart,
        .chart-row .pie-chart {
            padding: 1rem;
            background-color: #fff;
            margin: 1rem 0;
            box-shadow: 1px 1px 13px 1px rgb(0 0 0 / 19%);
        }

        .apexcharts-title-text {
            font-size: 2rem;
        }
    </style>
@endsection

