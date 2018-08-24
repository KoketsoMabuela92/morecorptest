<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        * {
            box-sizing: border-box;
        }

        /* Create two equal columns that floats next to each other */
        .column {
            float: left;
            width: 50%;
            padding: 10px;
        }

        /* Clear floats after the columns */
        .row:after {
            display: table;
            clear: both;
        }

        .row {
            display: flex;
        }

        .column {
            flex: 50%;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="title m-b-md">
            Bid
        </div>
        <div class="row">
            @if (!empty($product[0]))
                <div class="column">
                    <img src="../../{{ $product[0]['fullPath'] }}}" alt="logo"/>
                    <br>
                    Name: {{ $product[0]['name'] }}
                    <br>
                    Price: ZAR{{ $product[0]['price'] }}
                    <br>
                    Description: {{ $product[0]['description'] }}
                    <br>
                    Number of views: {{ $product[0]['viewCount'] }}
                    <br>
                    Number of bids: {{ $product[0]['bidCount'] }}
                    <br>
                    Highest bid: ZAR{{ $product[0]['highestBid'] }}
                    <br>
                    Lowest bid: ZAR{{ $product[0]['lowestBid'] }}
                    <br>
                </div>
            @endif
        </div>

        <br>

        <div class="card-body card-padding">

            <form role="form" action="/place-bid" method="post">
                <div class="form-group fg-line">
                    <label for="user_email">Email:<span style="color: #ff142b">*</span></label>
                    <input type="email" name="user_email" class="form-control input-sm" autocomplete="off" id="user_email"
                           placeholder="Enter your email address">
                </div>
                <div class="form-group fg-line">
                    <label for="bid_price">Bid Price:<span style="color: #ff142b">*</span></label>
                    <input type="number" name="bid_price" class="form-control input-sm" autocomplete="off" id="bid_price"
                           placeholder="Enter your bid price e.g. 1500">
                </div>

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="submit" class="btn btn-primary btn-sm m-t-10">Submit bid</button>
            </form>
        </div>

        <br>

        <div class="links">
            <a href="/">Back</a>
        </div>
    </div>
</div>
</body>
</html>
