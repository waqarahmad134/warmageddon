@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Sports Book</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Sports Book</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3 text-center">
                    <h4>
                        <button type="button" class="btn btn-primary mr-3">Barcelona U19</button>
                        VS.
                        <button type="button" class="btn btn-primary mr-3">Bayer Leverkusen U19</button>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="#" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">Final Time</button>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Draw - <button>4.41</button>
                            </div>
                            <div class="col-md-4">
                                Bayer Leverkusen U19 - <button>8.35</button>
                            </div>
                        </div>

                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">Double Chance</button>
                            <div class="col-md-4">
                                Barcelona U19or draw - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Bayer Leverkusen U19 - <button>1.083</button>
                            </div>
                            <div class="col-md-4">
                                Bayer Leverkusen draw - <button>2.42</button>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">1X2 First Half (First half winner)</button>
                            <div class="col-md-4">
                                D - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">Team to score first</button>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">Team to score last</button>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">Both Teams to Score</button>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">Over/Under 2.5 Goals - Final Time</button>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger mr-3 btn-block mb-3 mt-3">Over/ Under 2.5 Goals - 1st Half</button>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                            <div class="col-md-4">
                                Barcelona U19 - <button>1.35</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection