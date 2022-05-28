@extends('layouts.app')
@section('title','PRODUCTS')
@section('top_scripts')
@endsection
@section('style')
@endsection
@include('layouts.admin.navigation')
@section('content')
<div class="main-body">
    <div class="container-fluid">
        <section>
            <div class="row">
                <div class="col-md-2">
                    @include('layouts.admin.sidebar')
                </div>
                <div class="col-md-10">
                    <div class="container mt-3">
                        <h2>Products Table</h2>
                        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add Product
                        </button>
                        <table class="table table-dark table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            foreach ($products as $product) {
                                ?>
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->product}}</td>
                                    <td>{{$product->slug}}</td>
                                    <td>{{$product->category}}</td>
                                    <td>@if($product->image)
                                        <img src="{{ route('displayimage',$product->image)}}"
                                            style="height:auto;width:30%;">
                                        @endif
                                    </td>
                                    <td>
                                        <a onclick="edit({{$product->id}});"
                                            class="btn btn-primary btn-block col-2 w-100"><b>Edit</b></a>
                                        <a onclick="cat_delete({{$product->id}});"
                                            class="btn btn-danger btn-block col-2 w-100"><b>Delete</b></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ProductForm">
                        <input type="hidden" id="Id" name="Id">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="Title" id="Title">
                            <span class="text-danger error-text Title_error"></span>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Category</label>
                            <select class="form-select" name="category" id="Category"
                                aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <?php
                            foreach ($categories as $category) {
                                ?>
                                <option value="{{$category->id}}">{{$category->title}}</option>
                                <?php
                            }
                            ?>

                            </select>
                            <span class="text-danger error-text category_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="Image" id="Image">
                                </div>
                            </div>
                            <span class="text-danger error-text Logo_error"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
    @section('bottom_scripts')
    <script>
        $(document).ready(function() {
            $("#ProductForm").submit(function(stay) {
                stay.preventDefault();
                var data_id = $('#Id').val();
                var formData = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (data_id) {
                    var url = '{{route("products.update",":id") }}';
                    url = url.replace(':id', data_id);
                    var type = 'PUT';
                } else {
                    var url = "{{route('products.store')}}";
                    var type = 'POST';
                }
                $.ajax({
                    type: type,
                    url: url,
                    data: formData,

                    cache: false,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('span.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {

                                $('span.' + prefix + '_error').text(val[0]);
                            });

                        } else {

                            $('.modal').modal('hide');
                            window.location.reload();
                        }
                    },
                    errors: function(e) {
                        alert(e.error);
                    },

                });


            });
        });

        function edit(id) {
            var url = '{{ route("products.show", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    $('.modal').modal('show');
                    $('#Id').val(data.id);
                    $('#Title').val(data.title);
                    $('#Category').val(data.category_id).attr('selected', true);
                }
            });
        }

        function cat_delete(id) {
            confirm('Are you sure want to remove the Product?');
            var url = '{{ route("products.destroy", ":id") }}';
            url = url.replace(':id', id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (confirm) {
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    success: function(data) {
                        alert(data.msg);
                        window.location.reload();
                    }
                });
            }
        }
    </script>
    @endsection