@extends('adminlte::page')

@section('title', 'Create category')

@section('content_header')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-10">
            <a href="{{ route('sales.index') }}" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to sales list</a>
        </div>
    </div>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit sale: {{$sale->title}}</h3>
        </div>
        <form id="form" action="{{ route('sales.update', $sale->id) }}" method="post">
            <input name="_method" type="hidden" value="PUT">
            @csrf
            <div class="box-body">
                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Title" name="title" value="{{$sale->title}}" />
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('date_to') ? ' has-error' : '' }}">
                    <label>Date to</label>
                    <input type="date" class="form-control" placeholder="Date To" name="date_to" value="{{$sale->date_to->format('Y-m-d') }}" />
                    @if ($errors->has('date_to'))
                        <span class="help-block">
                            <strong>{{ $errors->first('date_to') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Products</label>
                    @foreach($products as $product)
                        <div>
                            <div class="col-md-4">
                                <label for="{{str_replace(' ', '-', $product->name)}}">{{$product->name}}</label>
                                <input type="checkbox" @if($product->checked) checked @endif id="{{str_replace(' ', '-', $product->name)}}" name="products[{{$product->id}}]" />
                            </div>
                            <div class="col-md-8">
                                <label for="">discount (%)</label>
                                <input type="number" name="discount[{{$product->id}}]" min="0" max="100" onkeypress="return event.charCode !== 45" @if($product->discount) value="{{$product->discount}}" @endif/>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
@stop
