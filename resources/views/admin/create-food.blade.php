@extends('layouts.app')

@section('title')
    Create Food
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">

                    @include('partials.errors')
                    <form class="form-horizontal" action="{{ isset($food) ? route('foods.update', $food->id) : route('foods.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($food))
                            @method('PUT')
                        @endif

                        <div class="card-body mr-5">
                            <h4 class="card-title mb-5">
                                {{isset($food) ? 'Update Food Item' : 'Create Food Item'}}
                            </h4>

                            <!-- Name-->
                            <div class="form-group row mb-5">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" style="border-color: #1a93ca" id="name" name="name" placeholder="Name" required value="{{ isset($food)? $food->name: '' }}">
                                </div>
                            </div>

                            <!-- Image-->
                            @if(isset($food))
                                <div class="form-group">
                                    <img src="{{ asset('/storage/'.$food->image) }}" alt="" style="width: 100%">
                                </div>
                            @endif

                            <div class="form-group row mb-5">
                                <label for="image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" style="border-color: #1a93ca" id="image" name="image">
                                    </div>
                                </div>
                            </div>

                            <!-- Video-->
                            @if(isset($food))
                                <div class="form-group">
                                    <video class="video-kitfo" width="100%" height="40%" controls >
                                        <source src="{{ asset('/storage/'.$food->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endif

                            <div class="form-group row mb-5">
                                <label for="video" class="col-sm-3 text-right control-label col-form-label">Video</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" style="border-color: #1a93ca" id="video" name="video">
                                    </div>
                                </div>
                            </div>

                            <!-- Category-->
                            <div class="form-group row mb-5">
                                <label class="col-sm-3 text-right control-label col-form-label">Food Category</label>
                                <div class="col-md-9">
                                    <select name="category" id="category" class="select2 form-control m-t-15" multiple="multiple" style="height: 36px;width: 100%; background-color: #2255a4">

                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if(isset($food))
                                                    @if($category->id == $food->category_id)
                                                        selected
                                                    @endif
                                                @endif
                                            >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- ingredients-->
                            <div class="form-group row mb-5">
                                <label for="ingredient" class="col-sm-2 text-right control-label col-form-label">Ingredients</label>
                                <div class="col-sm-10">
                                    <input id="ingredient" type="hidden" name="ingredient" value="{{ isset($food)? $food->ingredient:'' }}">
                                    <trix-editor class="trix-content" input="ingredient"></trix-editor>
                                </div>
                            </div>

                            <!-- Instructions-->
                            <div class="form-group row">
                                <label for="instruction" class="col-sm-2 text-right control-label col-form-label">Instructions</label>
                                <div class="col-sm-10">
                                    <input id="instruction" type="hidden" name="instruction" value="{{ isset($food)?$food->instruction:'' }}">
                                    <trix-editor input="instruction"></trix-editor>
                                </div>
                            </div>

                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <a href="{{ route('foods.index') }}" type="button" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary float-right">
                                    {{ isset($food)?'Update Food':'Create Food' }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>

    </div>
@endsection


@section('scripts')
    <!-- This Page JS -->
    <script src="{{ asset('js/admin/jquery-asColor.min.js') }}"></script>
    <script src="{{ asset('js/admin/jquery-asGradient.js') }}"></script>
    <script src="{{asset('js/admin/jquery-asColorPicker.min.js')}}"></script>
    <script src="{{ asset('js/admin/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('js/admin/mask.init.js') }}"></script>
    <script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>

    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

    </script>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
@endsection

