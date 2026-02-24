@extends('layouts.app')

@section('title')
    Food Categories
@endsection

@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <a href="{{ route('categories.create') }}" class="btn btn-success" style="color: #fff">Add Food Category</a>
            </div>
        </div>
    </div>

    <!-- The Content  -->
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- column -->
            <div class="col-lg-1"></div>
            <div class="col-lg-10">

                <div class="">
                    <h4 class="card-title">Food Menus</h4>
                </div>

                <!-- Categories -->
                @if($categories -> count() > 0)

                    @foreach($categories as $category)
                        <div class="card" style="padding-bottom: 2%">
                            <div class="card-body"></div>
                            <div class="comment-widgets">

                                    <div class="d-flex flex-row  m-t-0">
                                        <div class="p-2"><img src="{{ asset('/storage/'.$category->image) }}" alt="user" width="100" class="rounded-circle"></div>
                                        <div class="comment-text w-100">
                                            <h5 class="font-medium">
                                                {{ $category -> name }}
                                            </h5>
                                            <span class="m-b-15 d-block text-justify mr-5" style="font-size: 15px">
                                                {!! $category -> description !!}
                                            </span>
                                            <div class="comment-footer">
                                                <a href="{{ route('categories.edit', $category->id) }}" type="button" class="btn btn-cyan btn-sm" style="color: #fff">Edit Category</a>
                                                <button type="button" class="btn btn-danger btn-sm ml-3" onclick="handleDelete({{ $category->id }})">Delete Category</button>
                                            </div>
                                        </div>
                                    </div>



                            </div>
                        </div>
                    @endforeach

                @else
                    <h4>No Food Category yet</h4>
                @endif

                <form action="" method="POST" id="deleteCategoryForm">

                    @csrf
                    @method('DELETE')
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center text-bold">
                                        Are you sure you want to delete this category?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Go back</button>
                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function handleDelete(id) {

            var form = document.getElementById('deleteCategoryForm');

            form.action= 'categories/' + id;
            // console.log("deleting", form);

            $('#deleteModal').modal('show');
        }
    </script>
@endsection
