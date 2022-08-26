@extends('layouts.admin')

@section('content')

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

            <h3 style="float: right;font-size: 15px;">{{\Carbon\Carbon::now()->addMonth(1)->format('M, Y')}}
                - {{\Carbon\Carbon::now()->addMonth(2)->format('M, Y')}}</h3>
            <h3 class="panel-title" style="text-align: center">Top Business Positions </h3>
            {{--            <p class="panel-subtitle">Today</p>--}}

        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2 </span>
                            <span class="number">${{$area->p1}}</span>
                        </p>
                        @if(in_array('1', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p1,'p'=>1])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p2}}</span>
                        </p>
                        @if(in_array('2', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p2,'p'=>2])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p3}}</span>
                        </p>

                        @if(in_array('3', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p3,'p'=>3])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p4}}</span>
                        </p>
                        @if(in_array('4', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p4,'p'=>4])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p5}}</span>
                        </p>
                        @if(in_array('5', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p5,'p'=>5])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p6}}</span>
                        </p>
                        @if(in_array('6', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p6,'p'=>6])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p7}}</span>
                        </p>
                        @if(in_array('7', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p7,'p'=>7])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p8}}</span>
                        </p>
                        @if(in_array('8', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p8,'p'=>8])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p9}}</span>
                        </p>
                        @if(in_array('9', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p9,'p'=>9])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->p10}}</span>
                        </p>
                        @if(in_array('10', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon sales-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->p10,'p'=>10])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>


            </div>

        </div>

    </div><br>
    <div class="panel panel-headline">
        <div class="panel-heading">
            <h3 style="float: right;font-size: 15px;">{{\Carbon\Carbon::now()->addMonth(1)->format('M, Y')}}
                - {{\Carbon\Carbon::now()->addMonth(2)->format('M, Y')}}</h3>
            <h3 class="panel-title" style="text-align: center">Top Banners </h3>
            {{--            <p class="panel-subtitle">Today</p>--}}

        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->bp1}}</span>
                        </p>
                        @if(in_array('11', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon  brand-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp1,'p'=>11])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->bp2}}</span>
                        </p>
                        @if(in_array('12', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon  brand-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp2,'p'=>12])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->bp3}}</span>
                        </p>
                        @if(in_array('13', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon  brand-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp3,'p'=>13])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->bp4}}</span>
                        </p>
                        @if(in_array('14', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon  brand-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp4,'p'=>14])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>
                <div class="col-md-3">
                    <div class="metric">
                        <p>
                            <span class="title">Position 2x2</span>
                            <span class="number">${{$area->bp5}}</span>
                        </p>
                        @if(in_array('15', $position,true))
                            <div class="m-icon customer-icon">
                                <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                            </div>
                        @else
                        <div class="m-icon  brand-icon">
                            <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp5,'p'=>15])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                        </div>
                        @endif

                    </div>

                </div>


            </div>

        </div>

    </div><br>
    @if($area->status==1)
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 style="float: right;font-size: 15px;">{{\Carbon\Carbon::now()->addMonth(1)->format('M, Y')}}
                    - {{\Carbon\Carbon::now()->addMonth(2)->format('M, Y')}}</h3>
                <h3 class="panel-title" style="text-align: center">Middle Banners </h3>
                {{--            <p class="panel-subtitle">Today</p>--}}

            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="metric">
                            <p>
                                <span class="title">Position 2x2</span>
                                <span class="number">${{$area->bp6}}</span>
                            </p>
                            @if(in_array('16', $position,true))
                                <div class="m-icon customer-icon">
                                    <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                                </div>
                            @else
                            <div class="m-icon  brand-icon">
                                <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp6,'p'=>16])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                            </div>
                            @endif

                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <p>
                                <span class="title">Position 2x2</span>
                                <span class="number">${{$area->bp7}}</span>
                            </p>
                            @if(in_array('17', $position,true))
                                <div class="m-icon customer-icon">
                                    <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                                </div>
                            @else
                            <div class="m-icon  brand-icon">
                                <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp7,'p'=>17])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                            </div>
                            @endif

                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <p>
                                <span class="title">Position 2x2</span>
                                <span class="number">${{$area->bp8}}</span>
                            </p>
                            @if(in_array('18', $position,true))
                                <div class="m-icon customer-icon">
                                    <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                                </div>
                            @else
                            <div class="m-icon  brand-icon">
                                <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp8,'p'=>18])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                            </div>
                            @endif

                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="metric">
                            <p>
                                <span class="title">Position 2x2</span>
                                <span class="number">${{$area->bp9}}</span>
                            </p>
                            @if(in_array('19', $position,true))
                                <div class="m-icon customer-icon">
                                    <a href="#"><i class="fa fa-usd" aria-hidden="true"></i> Booked</a>
                                </div>
                            @else
                            <div class="m-icon  brand-icon">
                                <a href="{{route('bookme',['id'=>$area->id,'price'=>$area->bp9,'p'=>19])}}"><i class="fa fa-usd" aria-hidden="true"></i> Bookme</a>
                            </div>
                            @endif

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

