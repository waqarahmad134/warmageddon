@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('style')
    <style>
        #isavailable {
            padding: 5px 0px;
            margin-bottom: 0px;
        }
    </style>
@endsection

@section('content')
    <!-- Progress  Bar Start-->
    <div class="row section-prograss">
        <div class="col-12">
            <div class="progress-section">
                <img src="{{ asset('images/pre1.gif') }}" alt="">
            </div>
        </div>
    </div>
    <!-- Progress  Bar End-->

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
                            <li class="breadcrumb-item active">Add Game</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Add Game</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('add-games.store') }}" method="post" id="gameUpload" enctype="multipart/form-data">
                    @csrf

                    <!-- Start game_title -->
                        <div class="form-group row">
                            <label for="game_title" class="col-md-3 col-form-label text-md-right">Game Title : </label>

                            <div class="col-md-8">
                                <input id="game_title" type="text" class="form-control {{ $errors->has('game_title') ? ' is-invalid' : '' }}" name="game_title" value="{{ old('game_title') }}" required>
                                <p class="input-tips" id="titleunique">Game title must be unique.</p>
                                <p id="isavailable"></p>
                                @if ($errors->has('game_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_title -->

                        <!-- Start game_description -->
                        <div class="form-group row">
                            <label for="game_description" class="col-md-3 col-form-label text-md-right">Game Description : </label>

                            <div class="col-md-8">
                                <textarea id="game_description" type="text" class="form-control {{ $errors->has('game_description') ? ' is-invalid' : '' }}" name="game_description" cols="30" rows="10">{{ old('game_description') }}</textarea>
                                @if ($errors->has('game_description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_description -->

                        <!-- Start game_meta -->
                        <div class="form-group row">
                            <label for="game_meta" class="col-md-3 col-form-label text-md-right">Game Meta : </label>

                            <div class="col-md-8">
                                <textarea id="game_meta" type="text" class="form-control {{ $errors->has('game_meta') ? ' is-invalid' : '' }}" name="game_meta" cols="30" rows="4">{{ old('game_meta') }}</textarea>
                                @if ($errors->has('game_meta'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_meta') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_meta -->

                        <!--  Base Image Start -->
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right pt-sm-0">Banner Image :</label>
                            <div class="col-sm-9">
                                <input name="base_image" type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" required accept="image/*">
                                <p class="input-tips">upload only .png, .jpeg, .jpg file</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto" style="width: 250px;">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="blah" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Base Image End -->

                        <!-- Start game_category -->
                        <div class="form-group row">
                            <label for="game_category" class="col-md-3 col-form-label text-md-right">Game Category : </label>
                            <div class="col-md-8">
                                <select id="game_category" type="text" class="form-control {{ $errors->has('game_category') ? ' is-invalid' : '' }}" name="game_category" required>
                                    <option>Black Jack</option>
                                    <option>Craps</option>
                                    <option value="slots">slots</option>
                                    <option>Roulette Online</option>
                                    <option>Poker Games</option>
                                    <option>Bingo</option>
                                    <option>Sic Bo</option>
                                    <option>Keno</option>
                                    <option>Scratch</option>
                                    <option>Baccarat</option>
                                    <option>Other</option>
                                </select>
                                @if ($errors->has('game_category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_category -->
                        <!-- Start game_category -->
                        <div class="form-group row">
                            <label for="game_type" class="col-md-3 col-form-label text-md-right">Game Mode : </label>
                            <div class="col-md-8">
                                <select id="game_type" type="text" class="form-control {{ $errors->has('game_type') ? ' is-invalid' : '' }}" name="game_type" required>
                                    <option value="2">Both</option>
                                    <option value="1">Demo</option>
                                    <option value="3">Real</option>
                                </select>
                                @if ($errors->has('game_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Start game_file -->
                        <div class="form-group row">
                            <label for="game_file" class="col-md-3 col-form-label text-md-right">Game Files : </label>

                            <div class="col-md-8">
                                <input id="game_file" type="file" class="form-control {{ $errors->has('game_file') ? ' is-invalid' : '' }}" name="game_file" value="{{ old('game_file') }}" accept=".zip">
                                <p class="input-tips">Upload only .zip file here</p>
                                @if ($errors->has('game_file'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('game_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- End game_file -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-3">
                                <button type="submit" id="submit" class="btn btn-primary float-left mr-3">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("#game_title").keyup(function(){
                var gTitle = $(this).val();

                $.ajax({
                    type:'POST',
                    url:'/game-title',
                    data: {
                        id : gTitle,
                        _token: "{{ csrf_token() }}",
                    },
                    datatype: 'html',
                    success:function(response){
                        console.log(response);
                        $('#isavailable').html(response);
                        $('#titleunique').hide();
                    }
                });
            });

        });
    </script>
@endsection
