@extends('layouts.app')

@section('title')
    Create Category
@endsection

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title"></h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">

                    @include('partials.errors')

                    <form class="form-horizontal" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif
                        <div class="card-body mr-5">
                            <h4 class="card-title mb-5">
                                {{isset($category) ? 'Update Food Menu' : 'Create Food Menu'}}
                            </h4>

                            <!-- Name-->
                            <div class="form-group row mb-5">
                                <label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" style="border-color: #1a93ca" id="name" name="name" placeholder="Name" required value="{{ isset($category)? $category->name: '' }}" >
                                </div>
                            </div>

                            <div class="form-group row mb-5" >
                                <label for="image" class="col-sm-3 text-right control-label col-form-label">Image</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" style="border-color: #1a93ca" id="image" name="image">
                                    </div>
                                </div>
                            </div>

                            @if(isset($category))
                                <div class="form-group">
                                    <img src="{{ asset('/storage/'.$category->image) }}" alt="" style="width: 100%">
                                </div>
                            @endif

                            <!-- Description-->
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 text-right control-label col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input id="description" type="hidden" name="description" value="{{ isset($category)? $category->description:'' }}">
                                    <trix-editor input="description"></trix-editor>
                                </div>
                            </div>


                        </div>


                        <div class="border-top">
                            <div class="card-body">
                                <a href="{{ route('categories.index') }}" type="button" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary float-right">
                                    {{ isset($category)?'Update Category':'Create Category' }}
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

    <script src="{{ asset('js/admin/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('js/admin/mask.init.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/jquery.minicolors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
@endsection

