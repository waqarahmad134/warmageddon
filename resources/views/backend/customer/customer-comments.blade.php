@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')

    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Customer Information</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Customer Information</a></li>
                            <li class="breadcrumb-item active"> Customers Comments</li>
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
                    <h3>Add Comments</h3>
                </div>
                <div class="card-body">
                    <div class="common-text-container">
                        <form action="{{route('UsaerLeaveMessage',$user->id)}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Add comment</label>
                                <textarea name="body" class="form-control" id="" cols="15" rows="4"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>All Comments</h3>
                </div>
                <div class="card-body">
                    <div class="common-text-container">
                        @foreach ( $commentsList  as $item)                                                                        
                            <div class="common-text-box {{ $item->status == 0 ? 'unread' :'' }}" id="allInbox{{ $item->id }}" onclick="ViewSms({{ $item->id }}, `{{ $item->body }}` , true);">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="agriment-check">
                                            <label for="checkbox" class="checkbox_label">
                                                <!-- <input type="checkbox" value="{{ $item->id }}" name="inbox" class="checkbox_input" id="checkbox"> -->
                                                <span class="just-grd">SUPPORT</span>
                                            </label>
                                        </div>
                                    <p class="badge badge-secondary" style="color: #040404;"  ><i>{{ date('d/m/y', strtotime($item->created_at)) }}</i></p>
                                    </div>
                                    <div class="col-lg-9">
                                        <p>{{ $item->body }}</p>
                                    </div>
                                </div>
                            </div>
                            <hr>                                                                    
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    @endsection