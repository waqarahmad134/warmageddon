@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Content Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Content Management</a></li>
                            <li class="breadcrumb-item active">Web Template Map</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Web Template Map</h4>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/game-template.png') }}" alt="" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection