@extends('layouts.admin')

@section('content')
    <div class="d-box-text text-center p-4 mb-5" style="border-radius: 20px;">
        <h1 style="font-weight: 900; font-style: italic;" class="d-size">DASHBOARD</h1>
    </div>
    <div class="panel panel-headline">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    @php
                        $text = DB::table('tests')->first();
                    @endphp
                    <h4>
                        {!! $text->dis_dashboard !!}
                    </h4>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-headline">

        <div class="panel-heading">

            <h3 class="panel-title">Dashboard</h3>
            {{--                <p class="panel-subtitle">Today</p>--}}

        </div>

        <div class="panel-body">

            <div class="row">

                {{--                    <div class="col-md-3">--}}

                {{--                        <div class="metric">--}}

                {{--                            <div class="m-icon customer-icon">--}}
                {{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 22a8 8 0 1 1 16 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6z"/></svg>--}}
                {{--                            </div>--}}

                {{--                            <p>--}}
                {{--                                <span class="title">Customers</span>--}}
                {{--                                <span class="number">{{ $customers }}</span>--}}
                {{--                            </p>--}}

                {{--                        </div>--}}

                {{--                    </div>--}}

                {{--                    <div class="col-md-3">--}}

                {{--                        <div class="metric">--}}

                {{--                            <div class="m-icon brand-icon">--}}
                {{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M7 5V2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v3h4a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h4zM4 16v3h16v-3H4zm0-2h16V7H4v7zM9 3v2h6V3H9zm2 8h2v2h-2v-2z"/></svg>--}}
                {{--                            </div>--}}

                {{--                            <p>--}}
                {{--                                <span class="title">Products</span>--}}
                {{--                                <span class="number">{{ $products }}</span>--}}
                {{--                            </p>--}}

                {{--                        </div>--}}

                {{--                    </div>--}}


                {{--                    <div class="col-md-3">--}}

                {{--                        <div class="metric" style="padding: 8.5rem 3rem">--}}

                {{--                            <div class="m-icon sales-icon">--}}
                {{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.5-6H14a.5.5 0 1 0 0-1h-4a2.5 2.5 0 1 1 0-5h1V6h2v2h2.5v2H10a.5.5 0 1 0 0 1h4a2.5 2.5 0 1 1 0 5h-1v2h-2v-2H8.5v-2z"/></svg>--}}
                {{--                            </div>--}}
                {{--                            <p>--}}
                {{--                                <span class="title">Total Sales</span>--}}
                {{--                                <span class="number">${{ $totalSales }}</span>--}}
                {{--                                <span class="title">Order</span>--}}
                {{--                                <span class="number">{{ $totalOrders }}</span>--}}

                {{--                            </p>--}}

                {{--                        </div>--}}

                {{--                    </div>--}}

                {{--                    <div class="col-md-3">--}}

                {{--                        <div class="metric" style="padding: 8.5rem 3rem">--}}

                {{--                             <div class="m-icon customer-icon">--}}
                {{--                                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-5-7h9v2h-4v3l-5-5zm5-4V6l5 5H8V9h4z"/></svg>--}}

                {{--                             </div>--}}

                {{--                            <p>--}}
                {{--                                <span class="title">Deals</span>--}}
                {{--                                <span class="number">{{ $totalDeals }}</span>--}}
                {{--                            </p>--}}

                {{--                        </div>--}}

                {{--                    </div>--}}

                {{--                    <div class="col-md-6">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-md-6">--}}
                {{--                                <div class="metric" style="padding: 2rem 3rem;">--}}

                {{--                                    <div class="m-icon brand-icon">--}}
                {{--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-5-7h9v2h-4v3l-5-5zm5-4V6l5 5H8V9h4z"/></svg>--}}

                {{--                                    </div>--}}

                {{--                                    <p>--}}
                {{--                                        <span class="title">Free Deals</span>--}}
                {{--                                        <span class="number">{{ $freedeals->deal_wallet }}</span>--}}
                {{--                                    </p>--}}

                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-md-6">--}}
                {{--                                <div class="metric" style="padding: 2rem 3rem;">--}}

                {{--                                    <div class="m-icon brand-icon">--}}
                {{--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-5-7h9v2h-4v3l-5-5zm5-4V6l5 5H8V9h4z"/></svg>--}}

                {{--                                    </div>--}}

                {{--                                    <p>--}}
                {{--                                        <span class="title">Subscription Status</span>--}}
                {{--                                        <span class="number">{{ $sub }}</span>--}}
                {{--                                    </p>--}}

                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <div class="metric" style="padding: 2rem 3rem;">--}}

                {{--                            <div class="m-icon customer-icon">--}}
                {{--                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-5-7h9v2h-4v3l-5-5zm5-4V6l5 5H8V9h4z"/></svg>--}}

                {{--                            </div>--}}

                {{--                            <p>--}}
                {{--                                <span class="title">Page Visitors</span>--}}
                {{--                                <span class="number">{{ $visitor }}</span>--}}
                {{--                            </p>--}}

                {{--                        </div>--}}

                {{--                    </div>--}}


            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="d-box text-center">
                        <h1 class="m-0" style="font-size: 5rem">NEW ORDERS</h1>
                        <h1 class="m-0" style="font-size: 5rem">&nbsp;</h1>
                        <span class="d-number">{{ $neworders }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-box text-center">
                        <h1 class="m-0" style="font-size: 5rem">ACTIVE DEALS</h1>
                        <h1 class="m-0" style="font-size: 5rem">&nbsp;</h1>
                        <span class="d-number">{{ $totalDeals }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-box text-center">
                        <h1 class="m-0" style="font-size: 5rem">FREE DEALS AVAILABLE</h1>
                        <span class="d-number">{{ $freedeals->deal_wallet }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="d-box text-center">
                        <h1 class="m-0" style="font-size: 5rem">ACTIVE ORDERS</h1>
                        <h1 class="m-0" style="font-size: 3rem">(ACCEPTED, NOT COMPLETED)</h1>
                        <h1 class="m-0" style="font-size: 2rem">&nbsp;</h1>
                        <span class="d-number">{{ $acceptorders }}</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-box text-center">
                        <h1 class="m-0" style="font-size: 5rem">REVIEWS</h1>
                        <h1 class="m-0" style="font-size: 5rem">&nbsp;</h1>
                        @if($reviews != null)
                            <span class="d-number">{{ $reviews }}</span>
                        @else
                            <span class="d-number">0</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-box text-center">
                        <h1 class="m-0" style="font-size: 5rem">SUBSCRIPTION STATUS</h1>
                        @if($sub == 'Active')
                            <h1 class="" style="font-size: 6rem; color: #339f33;">{{ $sub }}</h1>
                            <h1 class="" style="font-size: 3rem; color: #339f33;">ONLINE ORDERING (ENABLED)</h1>
                            <h1 class="" style="font-size: 3rem; color: #339f33;">MENU LIVE</h1>
                        @else
                            <h1 class="" style="font-size: 6rem; color: #e52222;">NOT ACTIVE</h1>
                            <h1 class="" style="font-size: 3rem; color: #e52222;">ONLINE ORDERING (DISABLED)</h1>
                            <h1 class="" style="font-size: 3rem; color: #e52222;">MENU LIVE</h1>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{--        <div class="row chart-row">--}}
    {{--            <div class="col-xs-12 col-md-8">--}}
    {{--                <div class="line-chart">--}}
    {{--                    {!! $chart->container() !!}--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--            <div class="col-xs-12 col-md-4">--}}
    {{--                <div class="pie-chart">--}}
    {{--                    {!! $pieChart->container() !!}--}}
    {{--                </div>--}}
    {{--            </div>--}}

    {{--        </div>--}}
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
            background-color: rgba(247,184,75,.18);
        }

        .metric .m-icon.customer-icon svg{
            fill: #f7b84be0;
        }

        .metric .m-icon.brand-icon {
            background-color: rgba(41,156,219,.18);
        }

        .metric .m-icon.brand-icon svg{
            fill: #299cdb;
        }

        .metric .m-icon.deal-icon {
            background-color: rgba(64,81,137,.18);
        }

        .metric .m-icon.deal-icon svg{
            fill: #405189;;
        }

        .metric .m-icon.sales-icon {
            background-color: rgba(10,179,156,.18)
        }

        .metric .m-icon.sales-icon svg{
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
@section('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    {{ $pieChart->script() }}
@endsection
