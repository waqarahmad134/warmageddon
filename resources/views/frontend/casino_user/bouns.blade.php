@extends('frontend.layouts.user')
@section('title','Bonuc code')
@section('content')
        <div class="container section-gap m-15">
            <div class="row">
                <div class="col-lg-8 cal-sm-10 m-auto">
                    <div class="affliate-comm-box wow zoomIn" data-wow-delay=".3s" data-wow-offset="30">
                        <div class="para-box">
                            <h4>Claim your bonus</h4>
                            <p>Claim your bonus now. your bonus is almost ready to play with !</p>
                            <p>please enter your voucher code in the field below and click on “Claim”. your bonus will be credited to your bonus list immediately.</p> 
                        </div>
                        <div class="invite-box">
                            <input type="text" class="form-control" placeholder="VOUCHER CODE">
                            <button type="button" class="btn">CLAIM</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection