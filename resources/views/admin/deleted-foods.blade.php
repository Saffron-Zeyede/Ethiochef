@extends('layouts.app')

@section('title')
    Deleted Foods
@endsection

@section('content')
    <!-- The Contents  -->
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-lg-1"></div>
            <div class="col-lg-10">

                <div class="card-body">
                    <h4 class="card-title">Deleted Foods</h4>
                </div>

                <!-- Trashed Foods -->

                @if($foods -> count() > 0)
                    @foreach($foods as $food)
                        <div class="card" style="padding-bottom: 2%">
                            <div class="card-body"></div>
                            <div class="comment-widgets">
                                <div class="d-flex flex-row  m-t-0">
                                    <div class="p-2"><img src="{{ asset('/storage/'.$food->image) }}" alt="user" width="100" class="rounded-circle"></div>
                                    <div class="comment-text w-100">
                                        <h5 class="font-medium">
                                            {{ $food -> name }}
                                        </h5>
                                        <span class="m-b-15 d-block text-justify mr-5" style="font-size: 15px">
                                            {!! $food -> instruction !!}
                                        </span>
                                        <div class="comment-footer">

                                            <a href="{{ route('restore-food', $food->id) }}" type="button" class="btn btn-cyan btn-sm">Restore </a>


                                            <button style="display: none">
                                                <form action="{{ route('foods.destroy', $food->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm ml-3">Delete Permanently</button>
                                                </form>
                                            </button>
                                        </div>

                                        <span class="text-muted float-right mr-5" style="padding-top: 5%">
                                            <a href="">
                                                {{ $food->category->name }}
                                            </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>No Trashed Food items.</h4>
                @endif

            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
@endsection
