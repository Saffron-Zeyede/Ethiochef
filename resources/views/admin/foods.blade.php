@extends('layouts.app')

@section('title')
    Foods
@endsection

@section('content')

    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <a href="{{ route('foods.create') }}" class="btn btn-success" style="color: #fff">Add Food</a>
            </div>
        </div>
    </div>

    <!-- The Content -->
    <div class="container-fluid mt-3">
        <div class="row">
            <!-- column -->
            <div class="col-lg-1"></div>
            <div class="col-lg-10">

                <div class="card-body">
                    <h4 class="card-title">Foods</h4>
                </div>

                <!-- Foods -->
                @forelse($foods as $food)
                    <div class="card" style="padding-bottom: 2%">
                        <div class="card-body">
                        </div>
                        <div class="comment-widgets">
                            <!-- Comment Row -->
                            <div class="d-flex flex-row  m-t-0">
                                <div class="p-2">
                                    <img src="{{ asset('/storage/'.$food->image) }}" alt="user" width="100" class="rounded-circle">
                                </div>
                                <div class="comment-text w-100">

                                    <h5 class="font-medium">
                                        {{ $food->name }}
                                    </h5>
                                    <span class="m-b-15 d-block text-justify mr-5" style="font-size: 15px">
                                        {!! $food->instruction !!}
                                    </span>
                                    <div class="comment-footer">

                                        <a href="{{ route('foods.edit', $food->id) }}" type="button" class="btn btn-cyan btn-sm" style="color: #fff">Edit Food</a>

                                        <button style="display: none">
                                            <form action="{{ route('foods.destroy', $food->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning btn-sm ml-3">Trash Food</button>
                                            </form>
                                        </button>

                                    </div>
                                    <span class="text-muted float-right mr-5" style="padding-top: 5%">
                                        <a href="{{ route('categories.edit', $food->category->id) }}">
                                            {{ $food->category->name }}
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h4>No Food Items yet.</h4>
                @endforelse


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

