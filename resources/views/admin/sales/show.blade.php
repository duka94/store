@extends('adminlte::page')

@section('title', 'Show Product')

@section('content_header')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-10">
            <a href="{{ route('products.index') }}" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to products list</a>
        </div>
    </div>@stop

@section('content')
    <div>
        <h2>Category: {{ $category->name }}</h2>
        @if($category->products)
            <p><b>Products:</b></p>
            @foreach($category->products as $product)
                <div>
                    <p>{{$loop->iteration}}.<b>Name:</b> {{$product->name}}</p>
                </div>
            @endforeach
        @endif
    </div>
@stop
