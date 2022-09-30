<div id="sidebar-nav" class="sidebar">

    <div class="sidebar-scroll">

        <nav>

            <ul class="nav">
                <li>
                    <a href="{{ route('index') }}" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                </li>
                <li>
                    @if(env('APP_ENV') === "local")
                        <a href="http://127.0.0.1:8002/redirect-to-brands/{{session('business_id')}}" class=""><i class="fa fa-home"></i> <span>Master Dashboard</span></a>
                    @else
                        <a href="https://brands.420finder.net/redirect-to-brands/{{session('business_id')}}" class=""><i class="fa fa-home"></i> <span>Master Dashboard</span></a>
                    @endif
                </li>
                <li>
                    <a href="{{ route('subscription') }}" class=""><i class="fa fa-repeat" aria-hidden="true"></i> <span>Subscription</span></a>
                </li>
                @php
                    $response = \App\Http\SubscriptionHelper::checkSubscription(session('business_id'));
                @endphp
                @if($response)
                    <li>
                        <a href="{{ route('state.areas') }}" class=""><i class="fa fa-area-chart" aria-hidden="true"></i>  <span>Sales+Marketing Products</span></a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('subscription') }}" class=""><i class="fa fa-line-chart" aria-hidden="true"></i>  <span>Sales+Marketing Products</span> </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('requestproducts') }}" class=""><i class="fa fa-check-circle" aria-hidden="true"></i> <span>Request Products</span></a>
                </li>

                <li>
                    <a href="{{ route('products') }}" class=""><i class="fa fa-dropbox" aria-hidden="true"></i> <span>Products</span></a>
                </li>
                @if($response)
                    <li>
                        <a href="{{ route('deals') }}" class=""><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Deals</span></a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('subscription') }}" class=""><i class="fa fa-handshake-o" aria-hidden="true"></i>  <span>Deals</span> </a>
                    </li>
                @endif
                {{-- <li>
                    <a href="{{ route('deal-product.index') }}" class=""><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Deals Product</span></a>
                </li> --}}

                <li>
                    <a href="{{ route('transaction.index') }}" class=""><i class="fa fa-dollar" aria-hidden="true"></i> <span>Transactions</span></a>
                </li>

                <li>
                    <a href="{{ route('orders') }}" class=""><i class="fa fa-retweet" aria-hidden="true"></i> <span style="position: relative">Orders

                        @if($unreadOrders > 0)
                                <span
                                    style="
                                position: absolute;
                                right: -15px;
                                top: -14px;
                                border-radius: 50%;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                background-color: red;
                                padding: 0rem 0.6rem;
                                font-size: 1.3rem;
                           "
                                >
                        {{ $unreadOrders }}
                        </span>
                            @endif

                    </span></a>
                </li>

                <li>
                    <a href="{{ route('detail.index') }}" class=""><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Details</span></a>
                </li>

                {{--                <li>--}}
                {{--                    <a href="{{ route('otherlocations') }}" class=""><i class="fa fa-sort" aria-hidden="true"></i> <span>Other Store Locations</span></a>--}}
                {{--                </li>--}}

                <li>
                    <a href="{{ route('gallery.index') }}" class=""><i class="fa fa-photo" aria-hidden="true"></i> <span>Gallery</span></a>
                </li>
                <li>
                    <a href="{{ route('accountsettings') }}" class=""><i class="fa fa-user" aria-hidden="true"></i> <span>Account Settings</span></a>
                </li>
            </ul>

        </nav>

    </div>

</div>
