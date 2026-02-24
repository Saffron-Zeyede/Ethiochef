@extends('layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- The Contents  -->
    <div class="container-fluid">
        <div class="row">
            <!-- column -->
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="">
                    <div class="mt-5">
                        <h4 class="card-title text-center">
                            {{ Auth::user()->name }}
                        </h4>
                    </div>
                    <div class="comment-widgets">
                        <!-- Comment Row -->
                        <div class="">
                            <div class="comment-text w-100">
                                <h5 class="font-medium text-center">Welcome, here you can manipulate the contents of the website</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2"></div>

        </div>
    </div>
@endsection
