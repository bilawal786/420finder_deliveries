<div id="sidebar-nav" class="sidebar">

    <div class="sidebar-scroll">

        <nav>

            <ul class="nav">

                <li>
                    <a href="{{ route('index') }}" class=""><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                </li>

                <li>
                    <a href="{{ route('requestproducts') }}" class=""><i class="fa fa-check-circle" aria-hidden="true"></i> <span>Request Products</span></a>
                </li>

                <li>
                    <a href="{{ route('products') }}" class=""><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Products</span></a>
                </li>

                <li>
                    <a href="{{ route('deals') }}" class=""><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Deals</span></a>
                </li>

                {{-- <li>
                    <a href="{{ route('deal-product.index') }}" class=""><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Deals Product</span></a>
                </li> --}}

                <li>
                    <a href="{{ route('transaction.index') }}" class=""><i class="fa fa-sort" aria-hidden="true"></i> <span>Transactions</span></a>
                </li>

                <li>
                    <a href="{{ route('orders') }}" class=""><i class="fa fa-sort" aria-hidden="true"></i> <span style="position: relative">Orders

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
                    <a href="{{ route('detail.index') }}" class=""><i class="fa fa-sort" aria-hidden="true"></i> <span>Details</span></a>
                </li>

{{--                <li>--}}
{{--                    <a href="{{ route('otherlocations') }}" class=""><i class="fa fa-sort" aria-hidden="true"></i> <span>Other Store Locations</span></a>--}}
{{--                </li>--}}

                <li>
                    <a href="{{ route('accountsettings') }}" class=""><i class="fa fa-user" aria-hidden="true"></i> <span>Account Settings</span></a>
                </li>
                <li>
                    <a href="{{ route('subscription') }}" class=""><i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Subscription</span></a>
                </li>

            </ul>

        </nav>

    </div>

</div>
