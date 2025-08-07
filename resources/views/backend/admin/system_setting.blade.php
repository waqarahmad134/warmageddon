@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>System Settings</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">System Settings</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <center>
                <p class="text-left"><b></b><br>
                    <div class="ml-4 text-left">
                         <div class="form-group row">
                            <div class="col-md-4">Email Validation</div>
                            <div class="col-md-8">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">                                        
                              </div>
                            </div>
                          </div>
                         <div class="form-group row">
                            <div class="col-md-4">Email Subscription</div>
                            <div class="col-md-8">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">                                        
                              </div>
                            </div>
                          </div>
                         <div class="form-group row">
                            <div class="col-md-4">Phone Contact Allowed</div>
                            <div class="col-md-8">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">                                        
                              </div>
                            </div>
                          </div>
                         <div class="form-group row">
                            <div class="col-md-4">SMS Allowed</div>
                            <div class="col-md-8">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">                                        
                              </div>
                            </div>
                          </div>
                         <div class="form-group row">
                            <div class="col-md-4">Social Media Allowed</div>
                            <div class="col-md-8">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="gridCheck1">                                        
                              </div>
                            </div>
                          </div>
                    </div>
                </p>
                <br>
            </center>
        </div>
    </div>
@endsection    