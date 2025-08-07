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
                            <li class="breadcrumb-item active">{{ $addgame->game_title }} Game Show</li>
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
                    <h4>{{ $addgame->game_title }} Game Show</h4>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $addgame->base_image }}" alt="" style="width: 30%;">
                    <p class="input-tips mb-3">{{ $addgame->game_description }}</p>
                    <br>
                    <br>

                    <div class="col-12">
                    @foreach($files_in_folder as $item)
                        @php
                            $file = pathinfo($item);
                            $dir = $file['dirname'];
                        @endphp
                        @if($file['extension'] == 'png' || $file['extension'] == 'ico')
                            <!-- Start file_name -->
                                <div class="form-group row">
                                    <label for="file_name" class="col-md-3 col-form-label text-md-right">{{ $file['basename'] }} : </label>

                                    <div class="col-md-8 text-left">
                                        <img src="{{ asset($dir).'/'.$file['basename'] }}" alt="" style="width: 100px;">
                                        <br>
                                        <br>
                                        <a href="{{ route('game_icon_edit', ['id' => $file['filename'], 'ex' => $file['extension'], 'game' => $addgame->game_file ]) }}" class="btn btn-primary"><i class="align-middle" data-feather="edit"></i></a>
                                    </div>
                                </div>
                                <!-- End file_name -->
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection
