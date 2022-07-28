<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Status</title>
</head>

<body>

    <div>
        <div style="width: 100%;
        max-width: 470px;
        text-align: left;
        border-radius: 8px;
        margin: 32px auto 0;
        padding: 0 20px;
        border: 1px solid #c9cccf;">
          <h3> Your order has been {{ $orderStatus }}</h3>
            <div>
                <h3 style="color: #202223;
                font-weight: 600;
                font-size: 16px;">Order Summary</h3>
            </div>

            <!-- Products Wrapper -->
            <div>
                <?php $total = 0?>
                @if(count($products) > 0)
                @foreach ($products as $product)
                <?php
                $productTotal = $product->price * $product->qty;
                $total = $total + $productTotal; ?>
                <div style="display: flex; justify-content: space-between;">
                    <div style="display: flex;">
                        <img src="{{ $product->image }}" alt="Product Image" style="height: 50px;
                        line-height: 0;
                        outline: none;
                        text-decoration: none;
                        vertical-align: top;
                        width: 50px;
                        margin-right: 16px;
                        border-radius: 4px;
                        border: 1px solid #c9cccf;">
                        <div>
                            <span style="display: block;">{{ $product->name }}</span>
                            <span>$ {{ $product->price }} x {{ $product->qty }}</span>
                        </div>
                    </div>
                    <div>
                        <span>$ {{ $productTotal }}</span>
                    </div>
                </div>
                @endforeach
                @endif

                @if(!is_null($orderDeals) && count($orderDeals) > 0)
                @foreach ($orderDeals as $deal)
                <?php $total = $total + $deal->deal_price; ?>
                <div style="display: flex; justify-content: space-between;">
                    <div style="display: flex;">
                        <img src="{{ json_decode($deal->picture)[0] }}" alt="Product Image" style="height: 50px;
                        line-height: 0;
                        outline: none;
                        text-decoration: none;
                        vertical-align: top;
                        width: 50px;
                        margin-right: 16px;
                        border-radius: 4px;
                        border: 1px solid #c9cccf;">
                        <div>
                            <span style="display: block;">{{ $deal->title }}</span>
                            <span>$ {{ $deal->deal_price }} x {{ $deal->qty }}</span>
                        </div>
                    </div>
                    <div>
                        <span>$ {{ $deal->deal_price }}</span>
                    </div>
                </div>
                @endforeach
                @endif

                @if((!is_null($orderDeals) && count($orderDeals) > 0) || count($products) > 0)
                <!-- Total -->
                <div style="display: flex;
                justify-content: space-between;
                margin-top: 1rem;
            ">
                    <span>Total</span>
                    <span>$ {{ number_format($total, 2) }}</span>
                </div>
                @endif

            </div>
            <!-- Products Wrapper Ends -->

            <div style="display: flex; justify-content: space-between; margin: 1rem 0;">
                <a href="https://www.420finder.net" style="margin: auto">
                    <img src="https://www.420finder.net/assets/img/logo.png" alt="Site Logo" style="width: 100px;
                    height: 57px;">
                </a>
            </div>

        </div>
    </div>

</body>

</html>
