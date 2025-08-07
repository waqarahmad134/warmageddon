@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Multi Slot Tournaments</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Multi Slot Tournaments</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tournament-gameplays.index') }}">Tournament Gameplays</a></li>
                            <li class="breadcrumb-item active">Show</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>tournament Gameplays</h3>
                </div>
                <div class="card-body">
                    <div class="col-8">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $x = 1;
                                @endphp
                                <tr class="payment-show">
                                    <td>Gameplay ID:</td>
                                    <td>45</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Tournament ID:</td>
                                    <td>#1</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>User:</td>
                                    <td>jostest</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Game:</td>
                                    <td>Bitcoin Billion</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Date Started</td>
                                    <td>2019-02-28 12:34:32</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Player Cash BEFORE Gameplay:</td>
                                    <td>763,555.48$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Player Cash AFTER Gameplay:</td>
                                    <td>99,370.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>IP:</td>
                                    <td>103.88.77.2</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Player Bet (place mouse over bet for details):</td>
                                    <td>10.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Player Won :</td>
                                    <td>0.00$</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Gameplay Status:</td>
                                    <td>ok</td>
                                </tr>
                                <tr class="payment-show">
                                    <td>Gameplay hand log:</td>
                                    <td>&bet=1&betLines=10&symbols=9+12+10+9</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection