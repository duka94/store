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
        <h2>Product: {{ $product->name }}</h2>
        <p><b>Code:</b> {{ $product->code }}</p>
        <p><b>Price:</b> {{ $product->price }}</p>
        <p><b>Img:</b> {{ $product->img_path }}</p>
        <p><b>Created by:</b> {{ $product->createdBy->name }}</p>
        <p><b>Created at:</b> {{ $product->created_at->format('d/m/Y') }}</p>
        @if($product->updatedBy)
        <p><b>Updated by:</b> {{ $product->updatedBy->name }}</p>
        <p><b>Updated at:</b> {{ $product->updated_at->format('d/m/Y') }}</p>
        @endif
        <p><b>Category:</b> {{ $product->category->name }}</p>
        <p><b>Description:</b> {{ $product->description }}</p>
        <p>
            <b>Image:</b>
            <img src="{{url("storage/{$product->img_path}")}}">
        </p>
    </div>
@stop
