@extends('layouts.app')

@section('title')
    Inboxes
@endsection

@section('content')
    <!-- Bread crumb and right sidebar toggle -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">

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
                    <h4 class="card-title">Inboxes / Comments</h4>
                </div>

                <!-- Foods -->
                @if($messages -> count() > 0)

                    @foreach($messages as $message)
                        <div class="card" style="padding-bottom: 2%">
                            <div class="card-body">
                            </div>
                            <div class="comment-widgets">
                                <!-- Comment Row -->
                                <div class="d-flex flex-row  m-t-0">

                                    <div class="comment-text w-100">
                                        <h5 class="font-medium">
                                            From: <u style="color: blue">
                                                {{ $message->name }}
                                            </u>
                                        </h5>
                                        <span class="m-b-15 d-block text-justify mr-5" style="font-size: 15px">
                                            {{ $message->message }}
                                        </span>
                                        <div class="comment-footer">
                                            <span class="text-muted float-right mr-5">
                                                <a href="">
                                                    <u>{{ $message->email }}</u>
                                                </a>
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>No Comments yet.</h4>
                @endif

            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
@endsection
