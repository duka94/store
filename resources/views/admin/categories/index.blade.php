@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <div class="row">
        <div class="col-sm-2 col-sm-offset-10">
            <a href="{{ route('categories.create') }}" class="btn btn-block btn-primary"><i class="fa fa-plus-circle"></i> Add new</a>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Categories</h3>
                </div>
                @if(session('status'))
                    <div class="alert @if(session('type') === 'success') { alert-success } @elseif(session('type') === 'warning') { alert-warning } @endif alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa @if(session('type') === 'success') { fa-check } @elseif(session('type') === 'warning') { fa-exclamation-triangle } @endif"></i> {{ session('title') }}</h4>
                        {{ session('status') }}
                    </div>
                @endif
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="categories" class="table table-bordered table-hover dataTable" role="grid"
                                       aria-describedby="blog_info">
                                    <thead>
                                    <tr role="row">
                                        <th
                                            class="sorting_asc"
                                            tabindex="0"
                                            aria-controls="blog"
                                            rowspan="1"
                                            colspan="1"
                                            aria-sort="ascending"
                                            aria-label="Image: activate to sort column descending"
                                        >
                                            Name
                                        </th>
                                        <th
                                            class="sorting_asc"
                                            tabindex="0"
                                            aria-controls="product"
                                            rowspan="1"
                                            colspan="1"
                                            aria-sort="ascending"
                                            aria-label="Subtitle engine: activate to sort column descending">
                                            Created by
                                        </th>
                                        <th
                                            class="sorting_asc"
                                            tabindex="0"
                                            aria-controls="product"
                                            rowspan="1"
                                            colspan="1"
                                            aria-sort="ascending"
                                            aria-label="Subtitle engine: activate to sort column descending">
                                            Created at
                                        </th>
                                        <th
                                            class="sorting_asc"
                                            tabindex="0"
                                            aria-controls="product"
                                            rowspan="1"
                                            colspan="1"
                                            aria-sort="ascending"
                                            aria-label="Subtitle engine: activate to sort column descending">
                                            Updated by
                                        </th>
                                        <th
                                            class="sorting_asc"
                                            tabindex="0"
                                            aria-controls="product"
                                            rowspan="1"
                                            colspan="1"
                                            aria-sort="ascending"
                                            aria-label="Subtitle engine: activate to sort column descending">
                                            Updated at
                                        </th>
                                        <th
                                            class="sorting"
                                            tabindex="0"
                                            aria-controls="product"
                                            rowspan="1"
                                            colspan="1"
                                            aria-label="Actions: activate to sort column ascending">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr role="row" class="odd" id="item-{{ $category->id }}">
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->createdBy->name }}</td>
                                            <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                            <td>@if($category->updatedBy) {{ $category->updatedBy->name }} @endif</td>
                                            <td>@if($category->updatedBy){{ $category->updated_at->format('d/m/Y') }} @endif</td>
                                            <td>
                                                <div class="data-table-actions">
                                                    <div class="col-xs-4">
                                                        <a
                                                            href="{{ route('categories.show', $category->id) }}"
                                                            class="btn btn-block btn-flat btn-xs action-btn"
                                                            title="Show product"
                                                        >
                                                            <i class="fa fa-window-maximize"></i>
                                                        </a>
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <a
                                                            href="{{ route('categories.edit', $category->id) }}"
                                                            class="btn btn-block btn-flat btn-xs action-btn"
                                                            title="Edit product"
                                                        >
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </div>
                                                    <form action="{{ route('categories.destroy', $category->id)  }}" method="post" class="col-xs-4">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button
                                                            class="btn btn-block btn-flat btn-xs action-btn delete-btn"
                                                            title="Delete product"
                                                            data-blog-title="{{ $category->name }}"
                                                        >
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Created by</th>
                                            <th rowspan="1" colspan="1">Created at</th>
                                            <th rowspan="1" colspan="1">Updated by</th>
                                            <th rowspan="1" colspan="1">Updated at</th>
                                            <th rowspan="1" colspan="1">Actions</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
      $(function () {
        $('#categories').DataTable({
          "drawCallback": function () {
            $('.delete-btn').off('click')
            $('.delete-btn').on('click', function (e) {
              e.preventDefault()

              let categiryTitle = $(e.currentTarget).data('blogTitle')
              if (confirm('Are you sure you want to delete "' + categiryTitle + '"? You will also delete all products with '+ categiryTitle +' category.')) {
                $(e.currentTarget).closest('form').submit()
              }
            })
          }
        });
      })
    </script>
@stop
