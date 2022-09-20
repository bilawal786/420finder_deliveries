<style>
    blink {
        animation: 2s linear infinite condemned_blink_effect;
        color: red;
        font-size: 20px;
    }
    @keyframes condemned_blink_effect {
        0% {
            visibility: hidden;
        }
        50% {
            visibility: hidden;
        }
        100% {
            visibility: visible;
        }
    }
    .d-box{
        padding: 2rem;
        box-shadow: 1px 1px 20px 0px rgb(0 0 0 / 19%);
        border: 0px;
        border-radius: 3px;
        margin-bottom: 30px;
        color: #000;
    }
    .d-number{
        font-size: 14rem;
    }
</style>
<nav class="navbar navbar-default navbar-fixed-top">

    <div class="brand" style="padding-right: 130px !important;">

        <a href="{{ asset('index') }}">
            <img style="padding: 0px" src="https://420finder.net/420finder_business_logo_transparent.png" alt="Klorofil Logo" class="img-responsive logo">
        </a>

    </div>

    <div class="container-fluid">

        @if(!request()->routeIs('approve.failed'))
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
        </div>
        @endif
            <?php  $date = DB::table('subscription_details')->orderBy('id', 'DESC')->where('retailer_id', '=', session('business_id'))->first();
            $state_name = DB::table('states')->where('id', '=', $date->state_id ?? 1)->first();
            $currentDate = date('Y-m-d');
            $currentDate = date('Y-m-d', strtotime($currentDate));
            $startDate = date('Y-m-d', strtotime($date->starting_date ?? '12-2-2021'));
            $endDate = date('Y-m-d', strtotime($date->ending_date ?? '12-2-2021'));
            $check = DB::table('businesses')->where('id', '=', session('business_id'))->where('latitude','=',null)->where('longitude','=',null)->first();
            $details = DB::table('details')->where('business_id', '=', session('business_id'))->where('about', '=', null)->where('introduction', '=', null)->where('customers','=',null)->where('announcement','=',null)->first();

            ?>
            @if(($currentDate >= $startDate) && ($currentDate <= $endDate))

                <div class="navbar-btn">

                    <p class="txt"><b>
                            @if($check )
                                Please Update Your Profile. <a href="{{route('accountsettings')}}">Click Here</a>
                            @endif
                            @if($details)

                                Please Add Details. <a href="{{route('detail.index')}}">Click Here</a>
                            @endif
                        </b>
                    </p>



                </div>

            @else
                <div class="navbar-btn">
                    <p class="txt"><b>
                            You dont have any subscription your product menu is no more available on website. <a href="{{route('subscription')}}">Please purchase a subscription</a>
                            @if($check)
                                Please Update Your Profile. <a href="{{route('accountsettings')}}">Click Here</a>
                            @endif
                            @if($details)
                                Please Add Details. <a href="{{route('detail.index')}}">Click Here</a>
                            @endif
                        </b>
                    </p>

                </div>

            @endif


            <div id="navbar-menu">

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <span>

                            @if (Session::has('business_name'))
                                {{ Session('business_name') }}
                            @endif

                        </span>
                        <i class="icon-submenu lnr lnr-chevron-down"></i>

                    </a>

                    <ul class="dropdown-menu">

                        <li><a href="#"><i class="lnr lnr-user"></i> <span>My Account</span></a></li>

                        <li>
                            <a class="dropdown-item" href="{{ route('logoutadmin') }}">
                                <i class="lnr lnr-exit"></i> <span>
                                {{ __('Logout') }}
                                </span>
                            </a>

                            <form id="logout-form" action="" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </div>

</nav>
