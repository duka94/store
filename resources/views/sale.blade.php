<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .content {
            text-align: center;
            max-width: 1800px;
            width: 100%;
            margin: auto;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .flex {
            display: flex;
        }
        .flex-wrap {
            flex-wrap: wrap;
        }
        .product {
            padding: 20PX;
            border: 1px solid black;
            margin: 20px 20px;
            max-width: 500px;
            width: 100%;
        }
        .flex-column {
            flex-direction: column;
        }
        .product-information {
            padding: 20px;
            border-left: 1px solid black;
            margin-left: 25px;
            flex: 2;
        }
        .product-image {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="title m-b-md">
        Products on sale: {{$sale->title}}
    </div>
        <div class="flex flex-wrap">
            @foreach($sale->products as $product)
                <div class="product flex">
                    <div class="product-image">
                        <img src="{{url("storage/$product->img_path")}}" alt="" width="100px">
                    </div>
                    <div class="flex flex-column product-information">
                        <p><b>Code:</b>{{$product->code}}</p>
                        <p><b>Name:</b>{{$product->name}}</p>
                        <p><b>Price:</b>{{$product->price}}</p>
                        <p>{!! $product->description !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
</div>
</body>
</html>
