@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Site Setting</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">CMS</a></li>
                            <li class="breadcrumb-item active">Site Content</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- COUPONS SECTION START -->
    <div class="row">
        <div class="col-md-8 offset-md-2 col-12">
            <div class="card p-4">
                <div class="card-body">
                    <form action="{{ route('site.settings') }}" method="post" id="form-id" enctype="multipart/form-data">
                    @csrf
                    <!-- Start username -->
                        <div class="form-group row">
                            <label for="username" class="col-md-3 col-form-label text-md-right">*Site Title : </label>
                            <div class="col-md-8">
                                <input id="site_title" type="text" class="form-control {{ $errors->has('site_title') ? ' is-invalid' : '' }}" name="site_title" required @if($data!=null) value="{{ $data->site_title}}" @else value="{{ old('site_title') }}"  @endif>
                                @if ($errors->has('site_title'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('site_title') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <!-- End username -->

                        <!-- Start password -->
                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">Site Icon* : </label>
                            <div class="col-md-8">
                                <input id="site_icon" type="file" class="form-control {{ $errors->has('site_icon') ? ' is-invalid' : '' }}" name="site_icon" value="{{ isset($data) ? $data->site_icon :""}}" onchange="document.getElementById('siteIcon').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('site_icon'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('site_icon') }}</strong>
                                    </small>
                                    <small style="color:red">Upload an icon of (270x295)</small>
                                @else
                                    <small style="color:green">Upload an icon of (270x295)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('site_icon') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="siteIcon" src="{{ isset($data) ? $data->site_icon :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->site_icon!=null)
                                        <br><a href="{{url('dash-panel/remove_img/site_icon')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <!-- End password -->

                        <!-- Start email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Logo* : </label>

                            <div class="col-md-8">
                                <input id="logo" type="file" class="form-control {{ $errors->has('logo') ? ' is-invalid' : '' }}" name="logo"  value="{{ isset($data) ? $data->logo :old('logo') }}"  onchange="document.getElementById('logo_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('logo'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </small>
                                    <small style="color: red">upload a logo of (1326x304)</small>
                                @else
                                    <small style="color: green">upload a logo of (1326x304)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('logo') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="logo_display" src="{{ isset($data) ? $data->logo :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->logo!=null)
                                        <br><a href="{{url('dash-panel/remove_img/logo')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <!-- End email -->

                        <!-- Header Section -->
                        <hr><strong>Header/Menu Bar</strong>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">Menu Text 1 : </label>

                            <div class="col-md-8">
                                <input id="menu_text1" type="text" class="form-control {{ $errors->has('menu_text1') ? ' is-invalid' : '' }}" name="menu_text1"   @if($data!=null) value="{{ $data->menu_text1}}" @else value="{{ old('menu_text1') }}"  @endif>
                                @if ($errors->has('menu_text1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('menu_text1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">Menu Text 2 : </label>

                            <div class="col-md-8">
                                <input id="menu_text2" type="text" class="form-control {{ $errors->has('menu_text2') ? ' is-invalid' : '' }}" name="menu_text2"  @if($data!=null) value="{{ $data->menu_text2}}" @else value="{{ old('menu_text2') }}" @endif>
                                @if ($errors->has('menu_text2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('menu_text2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">Menu Text 3 : </label>

                            <div class="col-md-8">
                                <input id="menu_text3" type="text" class="form-control {{ $errors->has('menu_text3') ? ' is-invalid' : '' }}" name="menu_text3"  @if($data!=null) value="{{ $data->menu_text3}}" @else value="{{ old('menu_text3') }}"  @endif>
                                @if ($errors->has('menu_text3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('menu_text3') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">Menu Text 4 : </label>

                            <div class="col-md-8">
                                <input id="menu_text4" type="text" class="form-control {{ $errors->has('menu_text4') ? ' is-invalid' : '' }}" name="menu_text4"   @if($data!=null) value="{{ $data->menu_text4}}" @else value="{{ old('menu_text4') }}"  @endif>
                                @if ($errors->has('menu_text4'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('menu_text4') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="first_name" class="col-md-3 col-form-label text-md-right">Menu Text 5 : </label>

                            <div class="col-md-8">
                                <input id="menu_text5" type="text" class="form-control {{ $errors->has('menu_text5') ? ' is-invalid' : '' }}" name="menu_text5"  @if($data!=null) value="{{ $data->menu_text5}}" @else value="{{ old('menu_text5') }}"  @endif>
                                @if ($errors->has('menu_text5'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('menu_text5') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="menu_btn1" class="col-md-3 col-form-label text-md-right">Menu Button 1 Text : </label>

                            <div class="col-md-8">
                                <input id="menu_btn1" type="text" class="form-control {{ $errors->has('menu_btn1') ? ' is-invalid' : '' }}" name="menu_btn1"  @if($data!=null) value="{{ $data->menu_btn1}}" @else value="{{ old('menu_btn1') }}"  @endif>
                                @if ($errors->has('menu_btn1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('menu_btn1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="menu_btn2" class="col-md-3 col-form-label text-md-right">Menu Button 2 Text : </label>

                            <div class="col-md-8">
                                <input id="menu_btn2" type="text" class="form-control {{ $errors->has('menu_btn2') ? ' is-invalid' : '' }}" name="menu_btn2"  @if($data!=null) value="{{ $data->menu_btn2}}" @else value="{{ old('menu_btn2') }}"  @endif>
                                @if ($errors->has('menu_btn1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('menu_btn2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <!-- Main Banner -->
                        <hr><strong>Main Banner/Slider</strong>
                        <div class="form-group row">
                            <label for="banner_side_img" class="col-md-3 col-form-label text-md-right">Banner Side Image : </label>

                            <div class="col-md-8">
                                <input id="banner_side_img" type="file" class="form-control {{ $errors->has('banner_side_img') ? ' is-invalid' : '' }}" name="banner_side_img" value="{{ isset($data) ? $data->banner_side_img :old('banner_side_img') }}"  onchange="document.getElementById('banner_side_img_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('banner_side_img'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('banner_side_img') }}</strong>
                                    </small>
                                    <small style="color: red">upload a side image of (601x867)</small>
                                @else
                                    <small style="color: green">upload a side image of (601x867)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('banner_side_img') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="banner_side_img_display" src="{{ isset($data) ? $data->banner_side_img :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="banner_bg_img" class="col-md-3 col-form-label text-md-right">Banner Background Image : </label>
                            <div class="col-md-8">
                                <input id="banner_bg_img" type="file" class="form-control {{ $errors->has('banner_bg_img') ? ' is-invalid' : '' }}" name="banner_bg_img" value="{{ isset($data) ? $data->banner_bg_img :old('banner_bg_img') }}"  onchange="document.getElementById('banner_bg_img_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('banner_bg_img'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('banner_bg_img') }}</strong>
                                    </small>
                                    <small style="color: red">upload a background image of (1920x1080)</small>
                                @else
                                    <small style="color: green">upload a background image of (1920x1080)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('banner_bg_img') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="banner_bg_img_display" src="{{ isset($data) ? $data->banner_bg_img :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->banner_bg_img!=null)
                                        <br><a href="{{url('dash-panel/remove_img/banner_bg_img')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="banner_bg_img" class="col-md-3 col-form-label text-md-right">Banner Heading Text : </label>

                            <div class="col-md-8">
                                <input id="banner_heading" type="text" class="form-control {{ $errors->has('banner_heading') ? ' is-invalid' : '' }}" name="banner_heading" @if($data!=null) value="{{ $data->banner_heading}}" @else value="{{ old('banner_heading') }}"  @endif>
                                @if ($errors->has('banner_heading'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('banner_heading') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="banner_text" class="col-md-3 col-form-label text-md-right">Banner Text : </label>

                            <div class="col-md-8">
                                <input id="banner_text" type="text" class="form-control {{ $errors->has('banner_text') ? ' is-invalid' : '' }}" name="banner_text" @if($data!=null) value="{{ $data->banner_text}}" @else value="{{ old('banner_text') }}"  @endif>
                                @if ($errors->has('banner_text'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('banner_text') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="banner_btn" class="col-md-3 col-form-label text-md-right">Banner Button Text image: </label>

                            <div class="col-md-8">
                                <input id="banner_btn" type="file" class="form-control {{ $errors->has('banner_btn') ? ' is-invalid' : '' }}" name="banner_btn"  value="{{ isset($data) ? $data->banner_btn :old('banner_btn') }}"  onchange="document.getElementById('banner_btn_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('banner_btn'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('banner_btn') }}</strong>
                                    </small>
                                    <small style="color: red">upload a button image of (446x129)</small>
                                @else
                                    <small style="color: green">upload a button image of (446x129)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('banner_btn') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="banner_btn_display" src="{{ isset($data) ? $data->banner_btn :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->banner_btn!=null)
                                        <br><a href="{{url('dash-panel/remove_img/banner_btn')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <hr><strong>Getting Started/Welcome Section</strong>
                        <div class="form-group row">
                            <label for="welcome_bg" class="col-md-3 col-form-label text-md-right">Starting Background Image  : </label>

                            <div class="col-md-8">
                                <input id="welcome_bg" type="file" class="form-control {{ $errors->has('welcome_bg') ? ' is-invalid' : '' }}" name="welcome_bg"   value="{{ isset($data) ? $data->welcome_bg :old('welcome_bg') }}"  onchange="document.getElementById('welcome_bg_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('welcome_bg'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('welcome_bg') }}</strong>
                                    </small>
                                    <small style="color: red">upload background image of (1920x301)</small>
                                @else
                                    <small style="color: green">upload background image of (1920x301)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('welcome_bg') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="welcome_bg_display" src="{{ isset($data) ? $data->welcome_bg :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->welcome_bg!=null)
                                        <br><a href="{{url('dash-panel/remove_img/welcome_bg')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="banner_bg_img" class="col-md-3 col-form-label text-md-right">Starting Heading Text : </label>

                            <div class="col-md-8">
                                <input id="welcome_heading" type="text" class="form-control {{ $errors->has('welcome_heading') ? ' is-invalid' : '' }}" name="welcome_heading" @if($data!=null) value="{{ $data->welcome_heading}}" @else value="{{ old('welcome_heading') }}"  @endif>
                                @if ($errors->has('welcome_heading'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('welcome_heading') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="welcome_text" class="col-md-3 col-form-label text-md-right">Starting/Welcome Text : </label>

                            <div class="col-md-8">
                                <input id="welcome_text" type="text" class="form-control {{ $errors->has('welcome_text') ? ' is-invalid' : '' }}" name="welcome_text" @if($data!=null) value="{{ $data->welcome_text}}" @else value="{{ old('welcome_text') }}"  @endif>
                                @if ($errors->has('welcome_text'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('welcome_text') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="welcome_btn" class="col-md-3 col-form-label text-md-right">Starting/Welcome Button Image  : </label>

                            <div class="col-md-8">
                                <input id="welcome_btn" type="file" class="form-control {{ $errors->has('welcome_btn') ? ' is-invalid' : '' }}" name="welcome_btn"   value="{{ isset($data) ? $data->welcome_btn :old('welcome_btn') }}" onchange="document.getElementById('welcome_btn_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('welcome_btn'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('welcome_btn') }}</strong>
                                    </small>
                                    <small style="color: red">upload a button image of (374x135)</small>
                                @else
                                    <small style="color: green">upload a button image of (374x135)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('welcome_btn') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="welcome_btn_display" src="{{ isset($data) ? $data->welcome_btn :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->welcome_btn!=null)
                                        <br><a href="{{url('dash-panel/remove_img/welcome_btn')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <hr><strong>Game Winners/History Section</strong>
                        <div class="form-group row">
                            <label for="winner_bg" class="col-md-3 col-form-label text-md-right">Game Winner Background Image  : </label>

                            <div class="col-md-8">
                                <input id="winner_bg" type="file" class="form-control {{ $errors->has('winner_bg') ? ' is-invalid' : '' }}" name="winner_bg"  value="{{ isset($data) ? $data->winner_bg :old('winner_bg') }}" onchange="document.getElementById('winner_bg_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('winner_bg'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_bg') }}</strong>
                                    </small>
                                    <small style="color: red">upload a background image of (1920x650)</small>
                                @else
                                    <small style="color: green">upload a background image of (1920x650)</small>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('winner_bg') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="winner_bg_display" src="{{ isset($data) ? $data->winner_bg :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->winner_bg!=null)
                                        <br><a href="{{url('dash-panel/remove_img/winner_bg')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="winner_side_image" class="col-md-3 col-form-label text-md-right">Game Winner Side Image  : </label>

                            <div class="col-md-8">
                                <input id="winner_side_imag" type="file" class="form-control {{ $errors->has('winner_side_image') ? ' is-invalid' : '' }}" name="winner_side_image"  value="{{ isset($data) ? $data->winner_bg :old('winner_side_image') }}" onchange="document.getElementById('winner_side_image_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('winner_side_image'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_side_image') }}</strong>
                                    </small>
                                    <small style="color: red">upload a side image of (620x563)</small>
                                @else
                                    <small style="color: green">upload a side image of (620x563)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('winner_side_image') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="winner_side_image_display" src="{{ isset($data) ? $data->winner_side_image :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->winner_side_image!=null)
                                        <br><a href="{{url('dash-panel/remove_img/winner_side_image')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="winner_btn" class="col-md-3 col-form-label text-md-right">Game Winner Button Image  : </label>

                            <div class="col-md-8">
                                <input id="winner_btn" type="file" class="form-control {{ $errors->has('winner_btn') ? ' is-invalid' : '' }}" name="winner_btn"  value="{{ isset($data) ? $data->winner_btn :old('winner_btn') }}" onchange="document.getElementById('winner_btn').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('winner_btn'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_btn') }}</strong>
                                    </small>
                                    <small style="color: red">upload a button image of (374x135)</small>
                                @else
                                    <small style="color: green">upload a button image of (374x135)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('winner_btn') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="winner_btn_display" src="{{ isset($data) ? $data->winner_btn :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->winner_btn!=null)
                                        <br><a href="{{url('dash-panel/remove_img/winner_btn')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="winner_heading" class="col-md-3 col-form-label text-md-right">Winner Section Heading/Text : </label>

                            <div class="col-md-8">
                                <input id="winner_heading" type="text" class="form-control {{ $errors->has('winner_heading') ? ' is-invalid' : '' }}" name="winner_heading" @if($data!=null) value="{{ $data->winner_heading}}" @else value="{{ old('winner_heading') }}"  @endif>
                                @if ($errors->has('winner_heading'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_heading') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_theading1" class="col-md-3 col-form-label text-md-right">Winner Table Cell1 Heading : </label>

                            <div class="col-md-8">
                                <input id="winner_theading1" type="text" class="form-control {{ $errors->has('winner_theading1') ? ' is-invalid' : '' }}" name="winner_theading1" @if($data!=null) value="{{ $data->winner_theading1}}" @else value="{{ old('winner_theading1') }}"  @endif>
                                @if ($errors->has('winner_theading1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_theading1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_theading2" class="col-md-3 col-form-label text-md-right">Winner Table Cell2 Heading : </label>

                            <div class="col-md-8">
                                <input id="winner_theading1" type="text" class="form-control {{ $errors->has('winner_theading2') ? ' is-invalid' : '' }}" name="winner_theading2" @if($data!=null) value="{{ $data->winner_theading2}}" @else value="{{ old('winner_theading2') }}"  @endif>
                                @if ($errors->has('winner_theading2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_theading2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_theading3" class="col-md-3 col-form-label text-md-right">Winner Table Cell3 Heading : </label>

                            <div class="col-md-8">
                                <input id="winner_theading3" type="text" class="form-control {{ $errors->has('winner_theading3') ? ' is-invalid' : '' }}" name="winner_theading3" @if($data!=null) value="{{ $data->winner_theading3}}" @else value="{{ old('winner_theading3') }}"  @endif>
                                @if ($errors->has('winner_theading3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_theading3') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <u><strong>Table Ist Row Data</strong></u>
                        <div class="form-group row">
                            <label for="winner_tdata1" class="col-md-3 col-form-label text-md-right"> Row (1) data (1) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata1" type="text" class="form-control {{ $errors->has('winner_tdata1') ? ' is-invalid' : '' }}" name="winner_tdata1" @if($data!=null) value="{{ $data->winner_tdata1}}" @else value="{{ old('winner_tdata1') }}"  @endif>
                                @if ($errors->has('winner_tdata1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata2" class="col-md-3 col-form-label text-md-right">Row (1) data (2) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata2" type="text" class="form-control {{ $errors->has('winner_tdata2') ? ' is-invalid' : '' }}" name="winner_tdata2" @if($data!=null) value="{{ $data->winner_tdata2}}" @else value="{{ old('winner_tdata2') }}"  @endif>
                                @if ($errors->has('winner_tdata2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata1" class="col-md-3 col-form-label text-md-right">Row (1) data (3) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata3" type="text" class="form-control {{ $errors->has('winner_tdata3') ? ' is-invalid' : '' }}" name="winner_tdata3" @if($data!=null) value="{{ $data->winner_tdata3}}" @else value="{{ old('winner_tdata3') }}"  @endif>
                                @if ($errors->has('winner_tdata3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata3') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <u><strong>Table 2nd Row Data</strong></u>
                        <div class="form-group row">
                            <label for="winner_tdata4" class="col-md-3 col-form-label text-md-right">Row (2) data (1) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata4" type="text" class="form-control {{ $errors->has('winner_tdata4') ? ' is-invalid' : '' }}" name="winner_tdata4" @if($data!=null) value="{{ $data->winner_tdata4}}" @else value="{{ old('winner_tdata4') }}"  @endif>
                                @if ($errors->has('winner_tdata4'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata4') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata5" class="col-md-3 col-form-label text-md-right">Row (2) data (2) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata5" type="text" class="form-control {{ $errors->has('winner_tdata5') ? ' is-invalid' : '' }}" name="winner_tdata5" @if($data!=null) value="{{ $data->winner_tdata5}}" @else value="{{ old('winner_tdata5') }}"  @endif>
                                @if ($errors->has('winner_tdata5'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata5') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata6" class="col-md-3 col-form-label text-md-right">Row (2) data (3) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata6" type="text" class="form-control {{ $errors->has('winner_tdata6') ? ' is-invalid' : '' }}" name="winner_tdata6" @if($data!=null) value="{{ $data->winner_tdata6}}" @else value="{{ old('winner_tdata6') }}"  @endif>
                                @if ($errors->has('winner_tdata6'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata6') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <u><strong>Table 3rd Row Data</strong></u>
                        <div class="form-group row">
                            <label for="winner_tdata7" class="col-md-3 col-form-label text-md-right">Row (3) data (1) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata7" type="text" class="form-control {{ $errors->has('winner_tdata7') ? ' is-invalid' : '' }}" name="winner_tdata7" @if($data!=null) value="{{ $data->winner_tdata7}}" @else value="{{ old('winner_tdata7') }}"  @endif>
                                @if ($errors->has('winner_tdata7'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata7') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata8" class="col-md-3 col-form-label text-md-right">Row (3) data (2) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata8" type="text" class="form-control {{ $errors->has('winner_tdata8') ? ' is-invalid' : '' }}" name="winner_tdata8" @if($data!=null) value="{{ $data->winner_tdata8}}" @else value="{{ old('winner_tdata8') }}"  @endif>
                                @if ($errors->has('winner_tdata8'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata8') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata9" class="col-md-3 col-form-label text-md-right">Row (3) data (3) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata6" type="text" class="form-control {{ $errors->has('winner_tdata9') ? ' is-invalid' : '' }}" name="winner_tdata9" @if($data!=null) value="{{ $data->winner_tdata9}}" @else value="{{ old('winner_tdata9') }}"  @endif>
                                @if ($errors->has('winner_tdata9'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata9') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <u><strong>Table 4th Row Data</strong></u>
                        <div class="form-group row">
                            <label for="winner_tdata10" class="col-md-3 col-form-label text-md-right">Row (4) data (1) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata10" type="text" class="form-control {{ $errors->has('winner_tdata10') ? ' is-invalid' : '' }}" name="winner_tdata10" @if($data!=null) value="{{ $data->winner_tdata10}}" @else value="{{ old('winner_tdata10') }}"  @endif>
                                @if ($errors->has('winner_tdata10'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata10') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata8" class="col-md-3 col-form-label text-md-right">Row (4) data (2) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata11" type="text" class="form-control {{ $errors->has('winner_tdata11') ? ' is-invalid' : '' }}" name="winner_tdata11" @if($data!=null) value="{{ $data->winner_tdata11}}" @else value="{{ old('winner_tdata11') }}"  @endif>
                                @if ($errors->has('winner_tdata11'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata11') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="winner_tdata12" class="col-md-3 col-form-label text-md-right">Row (4) data (3) : </label>

                            <div class="col-md-8">
                                <input id="winner_tdata12" type="text" class="form-control {{ $errors->has('winner_tdata12') ? ' is-invalid' : '' }}" name="winner_tdata12" @if($data!=null) value="{{ $data->winner_tdata12}}" @else value="{{ old('winner_tdata12') }}"  @endif>
                                @if ($errors->has('winner_tdata12'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('winner_tdata12') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Promotion Top Section</strong>
                        <div class="form-group row">
                            <label for="promotion_bg" class="col-md-3 col-form-label text-md-right">Promotion Top Background Image  : </label>

                            <div class="col-md-8">
                                <input id="promotion_bg" type="file" class="form-control {{ $errors->has('promotion_bg') ? ' is-invalid' : '' }}" name="promotion_bg" value="{{ isset($data) ? $data->promotion_bg :old('promotion_bg') }}" onchange="document.getElementById('promotion_bg_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion_bg'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion_bg') }}</strong>
                                    </small>
                                    <small style="color: red">upload a background image of (1920x1080)</small>
                                @else
                                    <small style="color: green">upload a background image of (1920x1080)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion_bg') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion_bg_display" src="{{ isset($data) ? $data->promotion_bg :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion_bg!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion_bg')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion_side_img" class="col-md-3 col-form-label text-md-right">Promotion (Top) Side Image  : </label>

                            <div class="col-md-8">
                                <input id="promotion_side_img" type="file" class="form-control {{ $errors->has('promotion_side_img') ? ' is-invalid' : '' }}" name="promotion_side_img"  value="{{ isset($data) ? $data->promotion_side_img :old('promotion_side_img') }}" onchange="document.getElementById('promotion_side_img_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion_side_img'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion_side_img') }}</strong>
                                    </small>
                                    <small style="color: red">upload a side image of (665x778)</small>
                                @else
                                    <small style="color: green">upload a side image of (665x778)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion_side_img') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion_side_img_display" src="{{ isset($data) ? $data->promotion_side_img :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion_side_img!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion_side_img')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion_heading1" class="col-md-3 col-form-label text-md-right">Promotion Heading 1 : </label>

                            <div class="col-md-8">
                                <input id="promotion_heading1" type="text" class="form-control {{ $errors->has('promotion_heading1') ? ' is-invalid' : '' }}" name="promotion_heading1" @if($data!=null) value="{{ $data->promotion_heading1}}" @else value="{{ old('promotion_heading1') }}"  @endif>
                                @if ($errors->has('promotion_heading1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion_heading1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="promotion_text1" class="col-md-3 col-form-label text-md-right">Promotion Text 1 : </label>
                            <div class="col-md-8">
                                <textarea cols="10" rows="10" name="promotion_text1" placeholder="i.e <p>promotional text</p>" class="form-control">@if($data!=null) {{$data->promotion_text1}} @else {{old('promotion_text1')}} @endif </textarea>
                                {{--                                <input id="promotion_text1" placeholder="i.e <p>promotional text</p>" type="text" class="form-control {{ $errors->has('promotion_text1') ? ' is-invalid' : '' }}" name="promotion_text1" @if($data!=null) value="{{ $data->promotion_text1}}" @else value="{{ old('promotion_text1') }}"  @endif>--}}
                                <small style="color: green">embed your text inside p tag for more than 1 paragraph</small>
                                @if ($errors->has('promotion_text1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion_text1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="promotion_heading2" class="col-md-3 col-form-label text-md-right">Promotion Heading 2 Text : </label>

                            <div class="col-md-8">
                                <input id="promotion_heading2" type="text" placeholder="i.e welcome to casino" class="form-control {{ $errors->has('promotion_heading2') ? ' is-invalid' : '' }}" name="promotion_heading2" @if($data!=null) value="{{ $data->promotion_heading2}}" @else value="{{ old('promotion_heading2') }}"  @endif>
                                @if ($errors->has('promotion_heading2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion_heading2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="promotion_text2" class="col-md-3 col-form-label text-md-right">Promotion Text 2 : </label>
                            <div class="col-md-8">
                                <input id="promotion_text2" type="text" placeholder="i.e <p>you can use html tags</p>" class="form-control {{ $errors->has('promotion_text2') ? ' is-invalid' : '' }}" name="promotion_text2" @if($data!=null) value="{{ $data->promotion_text2}}" @else value="{{ old('promotion_text2') }}"  @endif>
                                <small style="color: green">embed your text inside p tag for more than 1 paragraph</small>
                                @if ($errors->has('promotion_text2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion_text2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Promotion Lower Section</strong>
                        <div class="form-group row">
                            <label for="promotion_bg" class="col-md-3 col-form-label text-md-right">Promotion Lower Background Image  : </label>

                            <div class="col-md-8">
                                <input id="promotion1_bg" type="file" class="form-control {{ $errors->has('promotion1_bg') ? ' is-invalid' : '' }}" name="promotion1_bg"  value="{{ isset($data) ? $data->promotion1_bg :old('promotion1_bg') }}" onchange="document.getElementById('promotion1_bg_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion1_bg'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_bg') }}</strong>
                                    </small>
                                    <small style="color: red">upload a background image of (1920x1080)</small>
                                @else
                                    <small style="color: green">upload a background image of (1920x1080)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion1_bg') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion1_bg_display" src="{{ isset($data) ? $data->promotion1_bg :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion1_bg!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion1_bg')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion1_icon1" class="col-md-3 col-form-label text-md-right">Promotion Lower Icon 1  : </label>

                            <div class="col-md-8">
                                <input id="promotion1_icon1" type="file" class="form-control {{ $errors->has('promotion1_icon1') ? ' is-invalid' : '' }}" name="promotion1_icon1" value="{{ isset($data) ? $data->promotion1_icon1 :old('promotion1_icon1') }}" onchange="document.getElementById('promotion1_icon1_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion1_icon1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_icon1') }}</strong>
                                    </small>
                                    <small style="color: red">upload an icon1  for promotion of (184x184)</small>
                                @else
                                    <small style="color: green">upload an icon1  for promotion of (184x184)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion1_icon1') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion1_icon1_display" src="{{ isset($data) ? $data->promotion1_icon1 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion1_icon1!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion1_icon1')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion_bg" class="col-md-3 col-form-label text-md-right">Promotion Lower Icon 2  : </label>

                            <div class="col-md-8">
                                <input id="promotion1_icon2" type="file" class="form-control {{ $errors->has('promotion1_icon2') ? ' is-invalid' : '' }}" name="promotion1_icon2"    value="{{ isset($data) ? $data->promotion1_icon2 :old('promotion1_icon2') }}" onchange="document.getElementById('promotion1_icon2_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion1_icon2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_icon2') }}</strong>
                                    </small>
                                    <small style="color: red">upload an icon2 for promotion of (184x184)</small>
                                @else
                                    <small style="color: green">upload an icon2 for promotion of (184x184)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion1_icon2') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion1_icon2_display" src="{{ isset($data) ? $data->promotion1_icon2 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion1_icon2!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion1_icon2')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion1_icon3" class="col-md-3 col-form-label text-md-right">Promotion Lower Icon 3 : </label>

                            <div class="col-md-8">
                                <input id="promotion1_icon3" type="file" class="form-control {{ $errors->has('promotion1_icon3') ? ' is-invalid' : '' }}" name="promotion1_icon3"   value="{{ isset($data) ? $data->promotion1_icon3 :old('promotion1_icon3') }}" onchange="document.getElementById('promotion1_icon3_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion1_icon3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_icon3') }}</strong>
                                    </small>
                                    <small style="color: red">upload an icon3  for promotion of (184x184)</small>
                                @else
                                    <small style="color: green">upload an icon3  for promotion of (184x184)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion1_icon3') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion1_icon3_display" src="{{ isset($data) ? $data->promotion1_icon3 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion1_icon3!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion1_icon3')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion1_icon4" class="col-md-3 col-form-label text-md-right">Promotion Icon 4  : </label>

                            <div class="col-md-8">
                                <input id="promotion1_icon4" type="file" class="form-control {{ $errors->has('promotion1_icon4') ? ' is-invalid' : '' }}" name="promotion1_icon4"  value="{{ isset($data) ? $data->promotion1_icon4 :old('promotion1_icon4') }}" onchange="document.getElementById('promotion1_icon4_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion1_icon4'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_icon4') }}</strong>
                                    </small>
                                @else
                                    <small style="color: green">upload an icon4 for promotion lower section of (184x184)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion1_icon4') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion1_icon4_display" src="{{ isset($data) ? $data->promotion1_icon4 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion1_icon4!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion1_icon4')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion1_icon5" class="col-md-3 col-form-label text-md-right">Promotion Lower Icon 5: </label>

                            <div class="col-md-8">
                                <input id="promotion1_icon5" type="file" class="form-control {{ $errors->has('promotion1_icon5') ? ' is-invalid' : '' }}" name="promotion1_icon5"  value="{{ isset($data) ? $data->promotion1_icon5 :old('promotion1_icon5') }}" onchange="document.getElementById('promotion1_icon5_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('promotion1_icon5'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_icon5') }}</strong>
                                    </small>
                                    <small style="color: red">upload an icon5 promotion of (184x184)</small>
                                @else
                                    <small style="color: green">upload an icon5 promotion of (184x184)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('promotion1_icon5') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="promotion1_icon5_display" src="{{ isset($data) ? $data->promotion1_icon5 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->promotion1_icon5!=null)
                                        <br><a href="{{url('dash-panel/remove_img/promotion1_icon5')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="promotion_heading1" class="col-md-3 col-form-label text-md-right">Promotion Lower Heading 1 Text : </label>

                            <div class="col-md-8">
                                <input id="promotion1_heading1" type="text" placeholder="i.e don't use html tags" class="form-control {{ $errors->has('promotion1_heading1') ? ' is-invalid' : '' }}" name="promotion1_heading1" @if($data!=null) value="{{ $data->promotion1_heading1}}" @else value="{{ old('promotion1_heading1') }}"  @endif>
                                @if ($errors->has('promotion1_heading1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_heading1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="promotion1_text1" class="col-md-3 col-form-label text-md-right">Promotion Lower Text 1 : </label>
                            <div class="col-md-8">
                                <input id="promotion1_text1" type="text" placeholder="i.e <p>use html tags</p>" class="form-control {{ $errors->has('promotion1_text1') ? ' is-invalid' : '' }}" name="promotion1_text1" @if($data!=null) value="{{ $data->promotion1_text1}}" @else value="{{ old('promotion1_text1') }}"  @endif>
                                <small style="color: green">embed your text inside p tag for more than 1 paragraph</small>
                                @if ($errors->has('promotion1_text1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_text1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="promotion1_heading2" class="col-md-3 col-form-label text-md-right">Promotion Heading 2 Text: </label>

                            <div class="col-md-8">
                                <input id="promotion1_heading2" type="text" placeholder="i.e don't use html tags" class="form-control {{ $errors->has('promotion1_heading2') ? ' is-invalid' : '' }}" name="promotion1_heading2" @if($data!=null) value="{{ $data->promotion1_heading2}}" @else value="{{ old('promotion1_heading2') }}"  @endif>
                                @if ($errors->has('promotion1_heading2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_heading2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="promotion1_text2" class="col-md-3 col-form-label text-md-right">Promotion Text 2 : </label>
                            <div class="col-md-8">
                                <input id="promotion1_text2" type="text" class="form-control {{ $errors->has('promotion1_text2') ? ' is-invalid' : '' }}" name="promotion1_text2" @if($data!=null) value="{{ $data->promotion1_text2}}" @else value="{{ old('promotion1_text2') }}"  @endif>
                                <small style="color: green">embed your text inside p tag for more than 1 paragraph</small>
                                @if ($errors->has('promotion1_text2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('promotion1_text2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Top Footer</strong>
                        <div class="form-group row">
                            <label for="top_footer_icon1" class="col-md-3 col-form-label text-md-right">Top Footer Background Image  : </label>

                            <div class="col-md-8">
                                <input id="top_footer_bg" type="file" class="form-control {{ $errors->has('top_footer_bg') ? ' is-invalid' : '' }}" name="top_footer_bg"  value="{{ isset($data) ? $data->top_footer_bg :old('top_footer_bg') }}" onchange="document.getElementById('top_footer_bg_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('top_footer_bg'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('top_footer_bg') }}</strong>
                                    </small>
                                    <small style="color: red">upload background image of (1920x888)</small>
                                @else
                                    <small style="color: green">upload background image of (1920x888)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('top_footer_bg') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="top_footer_bg_display" src="{{ isset($data) ? $data->top_footer_bg :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->top_footer_bg!=null)
                                        <br><a href="{{url('dash-panel/remove_img/top_footer_bg')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="top_footer_icon1" class="col-md-3 col-form-label text-md-right">Icon 1  : </label>

                            <div class="col-md-8">
                                <input id="top_footer_icon1" type="file" class="form-control {{ $errors->has('top_footer_icon1') ? ' is-invalid' : '' }}" name="top_footer_icon1"  value="{{ isset($data) ? $data->top_footer_icon1 :old('top_footer_icon1') }}" onchange="document.getElementById('top_footer_icon1_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('top_footer_icon1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('top_footer_icon1') }}</strong>
                                    </small>
                                    <small style="color: red">upload an icon 1 of (818x673)</small>
                                @else
                                    <small style="color: green">upload an icon 1 of (818x673)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('top_footer_icon1') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="top_footer_icon1_display" src="{{ isset($data) ? $data->top_footer_icon1 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->top_footer_icon1!=null)
                                        <br><a href="{{url('dash-panel/remove_img/top_footer_icon1')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="top_footer_text1" class="col-md-3 col-form-label text-md-right">Top Footer Text 1 : </label>
                            <div class="col-md-8">
                                <input id="top_footer_text1" type="text" placeholder="can use html tags" class="form-control {{ $errors->has('top_footer_text1') ? ' is-invalid' : '' }}" name="top_footer_text1" @if($data!=null) value="{{ $data->top_footer_text1}}" @else value="{{ old('top_footer_text1') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('top_footer_text1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('top_footer_text1') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="top_footer_icon2" class="col-md-3 col-form-label text-md-right">Icon 2  : </label>

                            <div class="col-md-8">
                                <input id="top_footer_icon2" type="file" class="form-control {{ $errors->has('top_footer_icon2') ? ' is-invalid' : '' }}" name="top_footer_icon2" value="{{ isset($data) ? $data->top_footer_icon2 :old('top_footer_icon2') }}" onchange="document.getElementById('top_footer_icon2_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('top_footer_icon2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('top_footer_icon2') }}</strong>
                                    </small>
                                    <small style="color: red">upload an icon2 of (818x673)</small>
                                @else
                                    <small style="color: green">upload an icon2 of (818x673)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('top_footer_icon2') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="top_footer_icon2_display" src="{{ isset($data) ? $data->top_footer_icon2 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->top_footer_icon2!=null)
                                        <br><a href="{{url('dash-panel/remove_img/top_footer_icon2')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="top_footer_text2" class="col-md-3 col-form-label text-md-right">Top Footer Text 2 : </label>
                            <div class="col-md-8">
                                <input id="top_footer_text2" type="text" placeholder="can use html tags"  class="form-control {{ $errors->has('top_footer_text2') ? ' is-invalid' : '' }}" name="top_footer_text2" @if($data!=null) value="{{ $data->top_footer_text2}}" @else value="{{ old('top_footer_text2') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and heder inside h1.. tags</small>
                                @if ($errors->has('top_footer_text2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('top_footer_text2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="top_footer_icon2" class="col-md-3 col-form-label text-md-right">Icon 3  : </label>

                            <div class="col-md-8">
                                <input id="top_footer_icon3" type="file" class="form-control {{ $errors->has('top_footer_icon3') ? ' is-invalid' : '' }}" name="top_footer_icon3"  value="{{ isset($data) ? $data->top_footer_icon3 :old('top_footer_icon3') }}" onchange="document.getElementById('top_footer_icon3_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('top_footer_icon3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('top_footer_icon3') }}</strong>
                                    </small>
                                @else
                                    <small style="color: green">upload an icon3 of (818x673)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('top_footer_icon3') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="top_footer_icon3_display" src="{{ isset($data) ? $data->top_footer_icon3 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->top_footer_icon3!=null)
                                        <br><a href="{{url('dash-panel/remove_img/top_footer_icon3')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="top_footer_text3" class="col-md-3 col-form-label text-md-right">Top Footer Text 3 : </label>
                            <div class="col-md-8">
                                <input id="top_footer_text3" type="text" placeholder="can use html tags"  class="form-control {{ $errors->has('top_footer_text3') ? ' is-invalid' : '' }}" name="top_footer_text3" @if($data!=null) value="{{ $data->top_footer_text3}}" @else value="{{ old('top_footer_text3') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('top_footer_text3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('top_footer_text3') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Footer Middle</strong>
                        <div class="form-group row">
                            <label for="footer_contact_header" class="col-md-3 col-form-label text-md-right">Footer Contact Header : </label>
                            <div class="col-md-8">
                                <input id="footer_contact_header" type="text" placeholder="can use html tags"  class="form-control {{ $errors->has('footer_contact_header') ? ' is-invalid' : '' }}" name="footer_contact_header" @if($data!=null) value="{{ $data->footer_contact_header}}" @else value="{{ old('footer_contact_header') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('footer_contact_header'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_contact_header') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_phone_no" class="col-md-3 col-form-label text-md-right">Footer Phone No : </label>
                            <div class="col-md-8">
                                <input id="footer_phone_no" type="text" placeholder="can use html tags"  class="form-control {{ $errors->has('footer_phone_no') ? ' is-invalid' : '' }}" name="footer_phone_no" @if($data!=null) value="{{ $data->footer_phone_no}}" @else value="{{ old('footer_phone_no') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('footer_phone_no'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_phone_no') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_email" class="col-md-3 col-form-label text-md-right">Footer Email : </label>
                            <div class="col-md-8">
                                <input id="footer_email" type="text" placeholder="can use html tags"  class="form-control {{ $errors->has('footer_email') ? ' is-invalid' : '' }}" name="footer_email" @if($data!=null) value="{{ $data->footer_email}}" @else value="{{ old('footer_email') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('footer_email'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_email') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_address" class="col-md-3 col-form-label text-md-right">Footer Address : </label>
                            <div class="col-md-8">
                                <input id="footer_address" placeholder="can use html tags"  type="text" class="form-control {{ $errors->has('footer_address') ? ' is-invalid' : '' }}" name="footer_address" @if($data!=null) value="{{ $data->footer_address}}" @else value="{{ old('footer_address') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('footer_address'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_address') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_address" class="col-md-3 col-form-label text-md-right">Payment Header : </label>
                            <div class="col-md-8">
                                <input id="footer_payment_header" type="text" placeholder="can use html tags"  class="form-control {{ $errors->has('footer_payment_header') ? ' is-invalid' : '' }}" name="footer_payment_header" @if($data!=null) value="{{ $data->footer_payment_header}}" @else value="{{ old('footer_payment_header') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('footer_payment_header'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_payment_header') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_payment_icon1" class="col-md-3 col-form-label text-md-right">Payment Icon 1  : </label>

                            <div class="col-md-8">
                                <input id="footer_payment_icon1" type="file" class="form-control {{ $errors->has('footer_payment_icon1') ? ' is-invalid' : '' }}" name="footer_payment_icon1"   value="{{ isset($data) ? $data->footer_payment_icon1 :old('footer_payment_icon1') }}" onchange="document.getElementById('footer_payment_icon1_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('footer_payment_icon1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_payment_icon1') }}</strong>
                                    </small>
                                    <small style="color: red">upload payment icon1 of (150x90)</small>
                                @else
                                    <small style="color: green">upload payment icon1 of (150x90)</small>

                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('footer_payment_icon1') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="footer_payment_icon1_display" src="{{ isset($data) ? $data->footer_payment_icon1 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->footer_payment_icon1!=null)
                                        <br><a href="{{url('dash-panel/remove_img/footer_payment_icon1')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="footer_payment_icon2" class="col-md-3 col-form-label text-md-right">Payment Icon 2  : </label>

                            <div class="col-md-8">
                                <input id="footer_payment_icon2" type="file" class="form-control {{ $errors->has('footer_payment_icon2') ? ' is-invalid' : '' }}" name="footer_payment_icon2"  value="{{ isset($data) ? $data->footer_payment_icon2 :old('footer_payment_icon2') }}" onchange="document.getElementById('footer_payment_icon2_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('footer_payment_icon2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_payment_icon2') }}</strong>
                                    </small>
                                    <small style="color: red">upload payment icon2 of (150x90)</small>
                                @else
                                    <small style="color: green">upload payment icon2 of (150x90)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('footer_payment_icon2') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="footer_payment_icon2_display" src="{{ isset($data) ? $data->footer_payment_icon2 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->footer_payment_icon2!=null)
                                        <br><a href="{{url('dash-panel/remove_img/footer_payment_icon2')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="footer_payment_icon3" class="col-md-3 col-form-label text-md-right">Payment Icon 3  : </label>

                            <div class="col-md-8">
                                <input id="footer_payment_icon3" type="file" class="form-control {{ $errors->has('footer_payment_icon3') ? ' is-invalid' : '' }}" name="footer_payment_icon3"  value="{{ isset($data) ? $data->footer_payment_icon3 :old('footer_payment_icon3') }}" onchange="document.getElementById('footer_payment_icon3_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('footer_payment_icon3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_payment_icon3') }}</strong>
                                    </small>
                                    <small style="color: red">upload payment icon3 of (150x90)</small>
                                @else
                                    <small style="color: green">upload payment icon3 of (150x90)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('footer_payment_icon3') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="footer_payment_icon3_display" src="{{ isset($data) ? $data->footer_payment_icon3 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->footer_payment_icon3!=null)
                                        <br><a href="{{url('dash-panel/remove_img/footer_payment_icon3')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="footer_payment_icon4" class="col-md-3 col-form-label text-md-right">Payment Icon 4  : </label>

                            <div class="col-md-8">
                                <input id="footer_payment_icon4" type="file" class="form-control {{ $errors->has('footer_payment_icon4') ? ' is-invalid' : '' }}" name="footer_payment_icon4"  value="{{ isset($data) ? $data->footer_payment_icon4 :old('footer_payment_icon4') }}" onchange="document.getElementById('footer_payment_icon4_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('footer_payment_icon4'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_payment_icon4') }}</strong>
                                    </small>
                                    <small style="color: red">upload payment icon4 of (150x90)</small>
                                @else
                                    <small style="color: green">upload payment icon4 of (150x90)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('footer_payment_icon4') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="footer_payment_icon4_display" src="{{ isset($data) ? $data->footer_payment_icon4 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->footer_payment_icon4!=null)
                                        <br><a href="{{url('dash-panel/remove_img/footer_payment_icon4')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="footer_fb_icon" class="col-md-3 col-form-label text-md-right">Facebook Icon & Link : </label>
                            <div class="col-md-8">
                                <input id="footer_fb_icon" type="text" placeholder="can use html tags" class="form-control {{ $errors->has('footer_fb_icon') ? ' is-invalid' : '' }}" name="footer_fb_icon" @if($data!=null) value="{{ $data->footer_fb_icon}}" @else value="{{ old('footer_fb_icon') }}"  @endif>
                                <small class="green">embed fa icon tag inside a tag</small>
                                @if ($errors->has('footer_fb_icon'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_fb_icon') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_contact_header" class="col-md-3 col-form-label text-md-right">Telegram Link : </label>
                            <div class="col-md-8">
                                <input id="footer_tel_icon" type="text" placeholder="can use html tags" class="form-control {{ $errors->has('footer_tel_icon') ? ' is-invalid' : '' }}" name="footer_tel_icon" @if($data!=null) value="{{ $data->footer_tel_icon}}" @else value="{{ old('footer_tel_icon') }}"  @endif>
                                <small class="green">embed fa icon tag inside a tag</small>
                                @if ($errors->has('footer_tel_icon'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_tel_icon') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_contact_header" class="col-md-3 col-form-label text-md-right">Twitter Icon : </label>
                            <div class="col-md-8">
                                <input id="footer_twit_icon" type="text" placeholder="can use html tags" class="form-control {{ $errors->has('footer_twit_icon') ? ' is-invalid' : '' }}" name="footer_twit_icon" @if($data!=null) value="{{ $data->footer_twit_icon}}" @else value="{{ old('footer_twit_icon') }}"  @endif>
                                <small class="green">embed fa icon tag inside a tag</small>
                                @if ($errors->has('footer_twit_icon'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_twit_icon') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_contact_header" class="col-md-3 col-form-label text-md-right">Twitter Icon : </label>
                            <div class="col-md-8">
                                <input id="footer_linked_icon" type="text" placeholder="can use html tags" class="form-control {{ $errors->has('footer_linked_icon') ? ' is-invalid' : '' }}" name="footer_linked_icon" @if($data!=null) value="{{ $data->footer_linked_icon}}" @else value="{{ old('footer_linked_icon') }}"  @endif>
                                <small class="green">embed fa icon tag inside a tag</small>
                                @if ($errors->has('footer_linked_icon'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_linked_icon') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_promo_statement" class="col-md-3 col-form-label text-md-right">Footer Promotional Statement : </label>
                            <div class="col-md-8">
                                <input id="footer_promo_statement" type="text" placeholder="can use html tags" class="form-control {{ $errors->has('footer_promo_statement') ? ' is-invalid' : '' }}" name="footer_promo_statement" @if($data!=null) value="{{ $data->footer_promo_statement}}" @else value="{{ old('footer_promo_statement') }}"  @endif>
                                <small class="green">embed fa icon tag inside a tag</small>
                                <small style="color: green"> embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('footer_promo_statement'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_promo_statement') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Client Icons</strong>
                        <div class="form-group row">
                            <label for="client_img1" class="col-md-3 col-form-label text-md-right">Client Image 1  : </label>
                            <div class="col-md-8">
                                <input id="client_img1" type="file" class="form-control {{ $errors->has('client_img1') ? ' is-invalid' : '' }}" name="client_img1"   value="{{ isset($data) ? $data->client_img1 :old('client_img1') }}" onchange="document.getElementById('client_img1_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('client_img1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_img1') }}</strong>
                                    </small>
                                    <small style="color: red">upload client image 1 of (101x68)</small>
                                @else
                                    <small style="color: green">upload client image 1 of (101x68)</small>

                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('client_img1') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="client_img1_display" src="{{ isset($data) ? $data->client_img1 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->client_img1!=null)
                                        <br><a href="{{url('dash-panel/remove_img/client_img1')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="client_img2" class="col-md-3 col-form-label text-md-right">Client Image 2  : </label>
                            <div class="col-md-8">
                                <input id="client_img2" type="file" class="form-control {{ $errors->has('client_img2') ? ' is-invalid' : '' }}" name="client_img2"  value="{{ isset($data) ? $data->client_img2 :old('client_img2') }}" onchange="document.getElementById('client_img2_display').src = window.URL.createObjectURL(this.files[0])">

                                @if ($errors->has('client_img2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_img2') }}</strong>
                                    </small>
                                    <small style="color: red">upload client image 2 of (101x68)</small>
                                @else
                                    <small style="color: green">upload client image 2 of (101x68)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('client_img2') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="client_img2_display" src="{{ isset($data) ? $data->client_img2 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->client_img2!=null)
                                        <br><a href="{{url('dash-panel/remove_img/client_img2')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="client_img3" class="col-md-3 col-form-label text-md-right">Client Image 3  : </label>
                            <div class="col-md-8">
                                <input id="client_img3" type="file" class="form-control {{ $errors->has('client_img3') ? ' is-invalid' : '' }}" name="client_img3"  value="{{ isset($data) ? $data->client_img3 :old('client_img3') }}" onchange="document.getElementById('client_img3_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('client_img3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_img3') }}</strong>
                                    </small>
                                    <small style="color: red">upload client image 3 of (101x68)</small>
                                @else
                                    <small style="color: green">upload client image 3 of (101x68)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('client_img3') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="client_img3_display" src="{{ isset($data) ? $data->client_img3 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->client_img3!=null)
                                        <br><a href="{{url('dash-panel/remove_img/client_img3')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="client_img4" class="col-md-3 col-form-label text-md-right">Client Image 4  : </label>
                            <div class="col-md-8">
                                <input id="client_img4" type="file" class="form-control {{ $errors->has('client_img4') ? ' is-invalid' : '' }}" name="client_img4"  value="{{ isset($data) ? $data->client_img4 :old('client_img4') }}" onchange="document.getElementById('client_img4_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('client_img4'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_img4') }}</strong>
                                    </small>
                                    <small style="color: red">upload client image 4 of (101x68)</small>
                                @else
                                    <small style="color: green">upload client image 4 of (101x68)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('client_img4') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="client_img4_display" src="{{ isset($data) ? $data->client_img4 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->client_img4!=null)
                                        <br><a href="{{url('dash-panel/remove_img/client_img4')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="client_img5" class="col-md-3 col-form-label text-md-right">Client Image 5  : </label>
                            <div class="col-md-8">
                                <input id="client_img5" type="file" class="form-control {{ $errors->has('client_img5') ? ' is-invalid' : '' }}" name="client_img5" value="{{ isset($data) ? $data->client_img5 :old('client_img5') }}" onchange="document.getElementById('client_img5_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('client_img5'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_img5') }}</strong>
                                    </small>
                                    <small style="color: red">upload client image 5 of (101x68)</small>
                                @else
                                    <small style="color: green">upload client image 5 of (101x68)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('client_img5') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="client_img5_display" src="{{ isset($data) ? $data->client_img5 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->client_img5!=null)
                                        <br><a href="{{url('dash-panel/remove_img/client_img5')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="client_img5" class="col-md-3 col-form-label text-md-right">Client Promo Icon  : </label>
                            <div class="col-md-8">
                                <input id="client_promo_icon1" type="file" class="form-control {{ $errors->has('client_promo_icon1') ? ' is-invalid' : '' }}" name="client_promo_icon1"  value="{{ isset($data) ? $data->client_promo_icon1 :old('client_promo_icon1') }}" onchange="document.getElementById('client_promo_icon1_display').src = window.URL.createObjectURL(this.files[0])">
                                @if ($errors->has('client_promo_icon1'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_promo_icon1') }}</strong>
                                    </small>
                                    <small style="color: red">upload client promo icon of (56x56)</small>
                                @else
                                    <small style="color: green">upload client promo icon of (56x56)</small>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <p class="col-form-label col-sm-3 text-sm-right pt-sm-0"></p>
                            <div class="col-sm-9 {{ $errors->has('client_promo_icon1') ? ' is-invalid' : '' }}">
                                <div class="single-image image-holder-wrapper clearfix">
                                    <div class="image-holder placeholder cursor-auto">
                                        <i class="align-middle icon-image" data-feather="image"></i>
                                        <img id="client_promo_icon1_display" src="{{ isset($data) ? $data->client_promo_icon1 :"" }}" style="max-width: 90%; max-height: 90%;"/>
                                    </div>
                                    @if($data->client_promo_icon1!=null)
                                        <br><a href="{{url('dash-panel/remove_img/client_promo_icon1')}}">Remove</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="footer_contact_header" class="col-md-3 col-form-label text-md-right">Client Promo Statement : </label>
                            <div class="col-md-8">
                                <input id="client_promo_statement" type="text" class="form-control {{ $errors->has('client_promo_statement') ? ' is-invalid' : '' }}" name="client_promo_statement" @if($data!=null) value="{{ $data->client_promo_statement}}" @else value="{{ old('client_promo_statement') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('client_promo_statement'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('client_promo_statement') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Footer Bottom</strong>
                        <div class="form-group row">
                            <label for="subscribe_header" class="col-md-3 col-form-label text-md-right">Header For Subscibe Section : </label>
                            <div class="col-md-8">
                                <input id="subscribe_header" type="text" class="form-control {{ $errors->has('subscribe_header') ? ' is-invalid' : '' }}" name="subscribe_header" @if($data!=null) value="{{ $data->subscribe_header}}" @else value="{{ old('subscribe_header') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('subscribe_header'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subscribe_header') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="subscribe_input_text" class="col-md-3 col-form-label text-md-right">Input Field Place Holder : </label>
                            <div class="col-md-8">
                                <input id="subscribe_input_text" type="text" class="form-control {{ $errors->has('subscribe_input_text') ? ' is-invalid' : '' }}" name="subscribe_input_text" @if($data!=null) value="{{ $data->subscribe_input_text}}" @else value="{{ old('subscribe_input_text') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('subscribe_input_text'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subscribe_input_text') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_contact_header" class="col-md-3 col-form-label text-md-right">Subscribe Button Text : </label>
                            <div class="col-md-8">
                                <input id="subscribe_btn" type="text" class="form-control {{ $errors->has('subscribe_btn') ? ' is-invalid' : '' }}" name="subscribe_btn" @if($data!=null) value="{{ $data->subscribe_btn}}" @else value="{{ old('subscribe_btn') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('subscribe_btn'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('subscribe_btn') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="copy_right_statement" class="col-md-3 col-form-label text-md-right">Copy Right Statement : </label>
                            <div class="col-md-8">
                                <input id="copy_right_statement" type="text" class="form-control {{ $errors->has('copy_right_statement') ? ' is-invalid' : '' }}" name="copy_right_statement" @if($data!=null) value="{{ $data->copy_right_statement}}" @else value="{{ old('copy_right_statement') }}"  @endif>
                                <small style="color: green">embed paragraph inside p and header inside h1.. tags</small>
                                @if ($errors->has('copy_right_statement'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('copy_right_statement') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_link" class="col-md-3 col-form-label text-md-right">Footer Link 1: </label>
                            <div class="col-md-8">
                                <input id="footer_link" type="text" class="form-control {{ $errors->has('footer_link') ? ' is-invalid' : '' }}" name="footer_link" @if($data!=null) value="{{ $data->footer_link}}" @else value="{{ old('footer_link') }}"  @endif>
                                <small style="color: green">use html a tag to define link</small>
                                @if ($errors->has('footer_link'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_link') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_link2" class="col-md-3 col-form-label text-md-right">Footer Link 2: </label>
                            <div class="col-md-8">
                                <input id="footer_link2" type="text" class="form-control {{ $errors->has('footer_link2') ? ' is-invalid' : '' }}" name="footer_link2" @if($data!=null) value="{{ $data->footer_link2}}" @else value="{{ old('footer_link2') }}"  @endif>
                                <small style="color: green">use html a tag to define link</small>
                                @if ($errors->has('footer_link2'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_link2') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_link3" class="col-md-3 col-form-label text-md-right">Footer Link 3: </label>
                            <div class="col-md-8">
                                <input id="footer_link3" type="text" class="form-control {{ $errors->has('footer_link3') ? ' is-invalid' : '' }}" name="footer_link3" @if($data!=null) value="{{ $data->footer_link3}}" @else value="{{ old('footer_link3') }}"  @endif>
                                <small style="color: green">use html a tag to define link</small>
                                @if ($errors->has('footer_link3'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_link3') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_link4" class="col-md-3 col-form-label text-md-right">Footer Link 4: </label>
                            <div class="col-md-8">
                                <input id="footer_link4" type="text" class="form-control {{ $errors->has('footer_link4') ? ' is-invalid' : '' }}" name="footer_link4" @if($data!=null) value="{{ $data->footer_link4}}" @else value="{{ old('footer_link4') }}"  @endif>
                                <small style="color: green">use html a tag to define link</small>
                                @if ($errors->has('footer_link4'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_link4') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_link5" class="col-md-3 col-form-label text-md-right">Footer Link 5: </label>
                            <div class="col-md-8">
                                <input id="footer_link5" type="text" class="form-control {{ $errors->has('footer_link5') ? ' is-invalid' : '' }}" name="footer_link5" @if($data!=null) value="{{ $data->footer_link5}}" @else value="{{ old('footer_link5') }}"  @endif>
                                <small style="color: green">use html a tag to define link</small>
                                @if ($errors->has('footer_link5'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_link5') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="footer_link6" class="col-md-3 col-form-label text-md-right">Footer Link 6: </label>
                            <div class="col-md-8">
                                <input id="footer_link6" type="text" class="form-control {{ $errors->has('footer_link6') ? ' is-invalid' : '' }}" name="footer_link6" @if($data!=null) value="{{ $data->footer_link6}}" @else value="{{ old('footer_link6') }}"  @endif>
                                <small style="color: green">use html a tag to define link</small>
                                @if ($errors->has('footer_link6'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footer_link6') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Chat Plugin Script</strong>
                        <div class="form-group row">
                            <label for="chat_script" class="col-md-3 col-form-label text-md-right">Chat Script: </label>
                            <div class="col-md-8">
                                <input id="chat_script" placeholder="i.e http://code.jivosite.com/widget.js" type="text" class="form-control {{ $errors->has('chat_script') ? ' is-invalid' : '' }}" name="chat_script" @if($data!=null) value="{{ $data->chat_script}}" @else value="{{ old('chat_script') }}"  @endif>
                                <small style="color: green">just enter script link</small>
                                @if ($errors->has('chat_script'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('chat_script') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Sendgrid Email Marketing</strong>
                        <div class="form-group row">
                            <label for="chat_script" class="col-md-3 col-form-label text-md-right">SendGrid API Key: </label>
                            <div class="col-md-8">
                                <input id="sendgrid_secret" placeholder="i.e http://code.jivosite.com/widget.js" type="text" class="form-control {{ $errors->has('sendgrid_secret') ? ' is-invalid' : '' }}" name="sendgrid_secret" @if($data!=null) value="{{ $data->sendgrid_secret}}" @else value="{{ old('sendgrid_secret') }}"  @endif>
                                <small style="color: green">just enter script link</small>
                                @if ($errors->has('sendgrid_secret'))
                                    <small class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sendgrid_secret') }}</strong>
                                    </small>
                                @endif
                            </div>
                        </div>
                        <hr><strong>Stripe Payment Form Setting</strong>
                        <div class="row form-group">
                            <label for="chat_script" class="col-md-6 col-form-label">Enable/Disable Stripe Form : </label>
                            <div class="col-md-6">
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="stripe_form" id="stripe_form" value="{{$data->stripe_form}}">
                                    <input name="stripBtn" type="checkbox" class="custom-control-input" id="customSwitches" @if($data->stripe_form==1) checked @endif @if($data->stripe_form) value="1" @else value="0" @endif>
                                    <label class="custom-control-label" for="customSwitches" style="color: white;">Bonus Offers</label>
                                </div>
                            </div>
                        </div>

                    {{--                        <hr><strong>Payment Gatway Keys</strong>--}}
                    {{--                        <div class="form-group row">--}}
                    {{--                            <label for="subscribe_header" class="col-md-3 col-form-label text-md-right">Stripe Secret key : </label>--}}
                    {{--                            <div class="col-md-8">--}}
                    {{--                                <input id="stripe_key" type="text" class="form-control {{ $errors->has('stripe_key') ? ' is-invalid' : '' }}" name="stripe_key" @if($data!=null) value="{{ $data->stripe_key}}" @else value="{{ old('stripe_key') }}"  @endif>--}}
                    {{--                                @if ($errors->has('stripe_key'))--}}
                    {{--                                    <small class="invalid-feedback" role="alert">--}}
                    {{--                                        <strong>{{ $errors->first('stripe_key') }}</strong>--}}
                    {{--                                    </small>--}}
                    {{--                                @endif--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="form-group row">--}}
                    {{--                            <label for="subscribe_header" class="col-md-3 col-form-label text-md-right">Coingate Auth Token : </label>--}}
                    {{--                            <div class="col-md-8">--}}
                    {{--                                <input id="coingate_token" type="text" class="form-control {{ $errors->has('coingate_token') ? ' is-invalid' : '' }}" name="coingate_token" @if($data!=null) value="{{ $data->coingate_token}}" @else value="{{ old('coingate_token') }}"  @endif>--}}
                    {{--                                @if ($errors->has('coingate_token'))--}}
                    {{--                                    <small class="invalid-feedback" role="alert">--}}
                    {{--                                        <strong>{{ $errors->first('coingate_token') }}</strong>--}}
                    {{--                                    </small>--}}
                    {{--                                @endif--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--  <!-- Start balance -->
                     <div class="form-group row">
                         <label for="balance" class="col-md-3 col-form-label text-md-right">Balance : </label>

                         <div class="col-md-8">
                             <div class="input-group">
                                 <input id="balance" type="text" class="form-control {{ $errors->has('balance') ? ' is-invalid' : '' }}" name="balance" value="{{ old('balance') }}" required>
                                 <small class="input-group-append">
                                     <button class="btn btn-secondary" type="button">$</button>
                                 </small>
                             </div>
                             @if ($errors->has('balance'))
                                 <small class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('balance') }}</strong>
                                 </small>
                             @endif
                         </div>
                     </div>
                     <!-- End balance --> --}}

                    <!-- Start revenue_percent -->
                    {{--  <div class="form-group row">
                          <label for="revenue_percent" class="col-md-3 col-form-label text-md-right">*Revenue Percent : </label>

                          <div class="col-md-8">
                              <div class="input-group">
                                  <input id="revenue_percent" type="text" class="form-control {{ $errors->has('revenue_percent') ? ' is-invalid' : '' }}" name="revenue_percent" value="{{ old('revenue_percent') }}" required>
                                  <small class="input-group-append">
                                      <button class="btn btn-secondary" type="button">%</button>
                                  </small>
                              </div>
                              @if ($errors->has('revenue_percent'))
                                  <small class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('revenue_percent') }}</strong>
                                  </small>
                              @endif
                          </div>
                      </div> --}}
                    <!-- End revenue_percent -->
                    {{--
                                            <!-- Start subagent -->
                                           <div class="form-group row">
                                                <label for="subagent" class="col-md-3 col-form-label text-md-right">Can he have subagent ? : </label>
                                                <div class="col-md-8">
                                                    <select id="subagent" type="text" class="form-control {{ $errors->has('subagent') ? ' is-invalid' : '' }}" name="subagent" required>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                    @if ($errors->has('subagent'))
                                                        <small class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('subagent') }}</strong>
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- End subagent --> --}}

                    {{--                    <!-- Start roles -->--}}
                    {{--                        <div class="form-group row">--}}
                    {{--                            <label for="roles" class="col-md-3 col-form-label text-md-right">Roles : </label>--}}
                    {{--                            <div class="col-md-8">--}}
                    {{--                                <select id="roles" type="text" class="form-control {{ $errors->has('roles') ? ' is-invalid' : '' }}" name="roles_id">--}}
                    {{--                                    @php--}}
                    {{--                                        $roles = DB::table('roles')->where('name','Agent')->orderBy('name', 'asc')->get();--}}
                    {{--                                    @endphp--}}
                    {{--                                    @foreach($roles as $item)--}}
                    {{--                                        <option value="{{ $item->id }}">{{ $item->name }}</option>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </select>--}}
                    {{--                                @if ($errors->has('roles'))--}}
                    {{--                                    <small class="invalid-feedback" role="alert">--}}
                    {{--                                        <strong>{{ $errors->first('roles') }}</strong>--}}
                    {{--                                    </small>--}}
                    {{--                                @endif--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <!-- End roles -->--}}

                    {{--                        <!-- Start status -->--}}
                    {{--                        <div class="form-group row">--}}
                    {{--                            <label for="status" class="col-md-3 col-form-label text-md-right">Status : </label>--}}
                    {{--                            <div class="col-md-8">--}}
                    {{--                                <select id="status" type="text" class="form-control {{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" required>--}}
                    {{--                                    <option value="1">Enabled</option>--}}
                    {{--                                    <option value="0">Disabled</option>--}}
                    {{--                                </select>--}}
                    {{--                                @if ($errors->has('status'))--}}
                    {{--                                    <small class="invalid-feedback" role="alert">--}}
                    {{--                                        <strong>{{ $errors->first('status') }}</strong>--}}
                    {{--                                    </small>--}}
                    {{--                                @endif--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    <!-- End status -->

                        <div class="form-group row">
                            <div class="col-sm-8 offset-sm-3">
                                <button type="submit" class="btn btn-primary float-left mr-3">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#country').on('change', function (e) {
                var coun = $(this).val();

                $.ajax({
                    type:'POST',
                    url: '/dash-panel/get-city',
                    data: {
                        id : coun,
                        _token: "{{ csrf_token() }}",
                    },
                    datatype: 'html',
                    success:function(response){
                        //console.log(response);
                        $('#city').html(response);
                    }
                });
            });
        });
        $('input[name="stripBtn"]').click(function () {
            var status = $(this).val()==1?0:1;
            swal({
                title: 'Are you sure?',
                text: "Click YES To perform and NO to abort",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                confirmButtonClass: 'btn',
                cancelButtonClass: 'btn',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    $(this).val(status);
                    $('#stripe_form').val(status)
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    if($(this).val()==1)
                    {
                        $(this).prop("checked", true)
                    }
                    else{
                        $(this).prop("checked", false)
                    }
                }
            })

        });
    </script>
@endsection
