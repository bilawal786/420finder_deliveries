@extends('layouts.admin')

@section('content')

    <div class="panel panel-headline">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">

                    <h4>
                        Available Area Details
                    </h4>
                </div>
            </div>
        </div>
    </div>
    @if($area)
        <div class="panel panel-headline">
            <div class="panel-heading">
                <?php
                $state = DB::table('states')->find($business->state_province);
                if($state == null){
                    $StateName = 'No State';
                }else{
                    $StateName = $state->name;
                }
                ?>

                <h3 class="panel-title" style="text-align: center">{{$StateName}} </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    @foreach($area as $row)
                        <div class="col-md-3">
                            <div class="metric" style="display: block!important; text-align: center;padding: 10px!important;">
                                <h4><b>{{$row->title}}</b></h4>
                                <h5><b>{{$row->sub_title}}</b></h5>
                                <a href="{{route('marketing',['id'=>$row->id])}}" class="btn btn-primary">Open Me</a>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    @else
        <div class="panel panel-headline">
            <div class="panel-heading">
                <h3 class="panel-title" style="text-align: center;color: red">No Available Area </h3>
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

