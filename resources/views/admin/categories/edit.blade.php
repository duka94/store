@extends('adminlte::page')

@section('title', "Edit category $category->name")

@section('content_header')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-10">
            <a href="{{ route('categories.index') }}" class="btn btn-block btn-primary"><i class="fa fa-arrow-circle-left"></i> Back to categories list</a>
        </div>
    </div>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit category: {{ $category->name }}</h3>
        </div>
        <form id="form" action="{{ route('categories.update', $category->id) }}" method="post">
            <input name="_method" type="hidden" value="PUT">
            @csrf
            <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>Name</label>
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{$category->name}}" />
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
@stop
