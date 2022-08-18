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

</style>
<nav class="navbar navbar-default navbar-fixed-top">

    <div class="brand" style="padding-right: 130px !important;">

        <a href="{{ asset('index') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Klorofil Logo" class="img-responsive logo">
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
            ?>
            @if(($currentDate >= $startDate) && ($currentDate <= $endDate))
            @else
                <div class="navbar-btn">
                    <blink>You dont have any subscription your product menu is no more available on website. <a href="{{route('subscription')}}">Please purchase a subscription</a></blink>
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
