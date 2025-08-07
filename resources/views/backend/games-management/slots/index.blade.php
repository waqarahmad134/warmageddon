@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Games Management</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Games Management</a></li>
                            <li class="breadcrumb-item active">{{ $game->game_title }} Game</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>{{ $game->game_title }} Game</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $game->base_image }}" alt="" style="width: 100%;">
                    <br>
                    <br>
                    <p class="input-tips mb-3">{{ $game->game_description }}</p>

                    <a href="{{ route('play_game', strtolower($game->game_title)) }}" target="_blank" class="btn btn-primary">Play</a>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection
