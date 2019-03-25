@extends('adminlte::page')

@section('title', 'Create product')

@section('content_header')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-10">
            <a href="{{ route('products.index') }}" class="btn btn-block btn-primary">
                <i class="fa fa-arrow-circle-left"></i> Back to products list
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create new product</h3>
        </div>
        <form
            action="{{ route('products.store') }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <div class="box-body">
                <div class="form-group {{ $errors->has('category_id') ? ' has-error' : '' }}">
                    <label for="categoryId">Category</label>
                    <select name="category_id" id="categoryId">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                    <label>Name</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Name"
                        name="name"
                        value="{{old('name')}}"
                    />
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('code') ? ' has-error' : '' }}">
                    <label>Code</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Code"
                        name="code"
                        value="{{old('code')}}"
                    />
                    @if ($errors->has('code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('code') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                    <label>Description</label>
                    <textarea
                        name="description"
                        class="form-control"
                        placeholder="Description"
                    >{{old('description')}}</textarea>
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
                    <label>Price</label>
                    <input
                        id="price"
                        type="number"
                        class="form-control"
                        min="0"
                        onkeypress="return event.charCode !== 45" name="price"
                        placeholder="price"
                        value="{{old('price')}}"
                    />
                    @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('img_path') ? ' has-error' : '' }}">
                    <label>Image</label>
                    <input
                        type="file"
                        class="form-control"
                        name="img_path"
                        placeholder="img_path"
                    />
                    @if ($errors->has('img_path'))
                        <span class="help-block">
                            <strong>{{ $errors->first('img_path') }}</strong>
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

@section('js')
    <script type="text/javascript">
      $("#price").keyup(function() {
        const num = parseFloat($(this).val())
        if ( num >= 99999.99)
        {
          $(this).val("99999.99")
        }

        const number = ($(this).val().split('.'))
        if (number[1] && number[1].length > 2)
        {
          const salary = parseFloat($("#price").val())
          $("#price").val( salary.toFixed(2))
        }
      })
    </script>
@stop
