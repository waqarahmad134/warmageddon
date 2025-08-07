<header>
    <nav id="header-top" class="navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://proper6.com"><img src="{{ URL::asset('assets/frontend/img//icon/logo.png')}}" alt="logo" class="img-responsive"></a>
            </div>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="nav navbar-nav">
                    
                    <li class=""><a href="{{ URL('/')}}">Home</a></li>
                    <li class=""><a href="{{ URL('about-us')}}">About us</a></li>
                    <li class="dropdown">
                        <a style="background-color: #1b181800;" class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Games
                          <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a style="padding-left:15px;" class="dropdown-item text-black" href="{{ route('allgame')}}">All Game</a><hr>
                          @role('User')
                          <a style="padding-left:15px" class="dropdown-item text-black" data-toggle="modal" data-target="#game_history" href="#">Gameplay history</a>
                          @endrole
                        </div>
                      </li>
                      <!--<li ><a class="navbar-brand" href="#"><img src="{{ URL::asset('assets/frontend/img/icon/logo.png')}}" alt="logo" class="img-responsive"></a></li>-->
                      @role('User')
                      @else
                      <li><a href="#">Getting Started</a></li>
                      <li class=""><a href="{{ URL('contact-us')}}">Contact</a></li>
                      @endrole                                         
                      
                      @role('User')
                        <li class="dropdown">
                          <a style="background-color: #1b181800;" class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Banking
                            <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a style="padding-left:15px;" class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#banking">Transaction history</a><hr>
                            <a style="padding-left:15px" class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#withdraw_b">Withdraw</a><hr>
                            <a style="padding-left:15px" class="dropdown-item text-black" href="#" id="deposit_form">Deposit</a><hr>
                            <a style="padding-left:15px" class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#Account_statement">Account statement</a><hr>
                          </div>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#affiliate">Affiliate center</a></li>
                        <li class="dropdown">
                          <a style="background-color: #1b181800;" class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              My Account
                            <span class="caret"></span>
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a style="padding-left:15px;" class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#modalLoginAvatar"><i class="fas fa-user"></i> Profile</a><hr>
                            <a style="padding-left:15px" class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#profiledit"><i class="fas fa-user-edit"></i> Profile edit</a><hr>
                            <a style="padding-left:15px" class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#nitification"><i class="fas fa-envelope"></i> Notification <span class="badge">{{@count($user->notifications->where('status',0))}}</span></a><hr>
                            <a style="padding-left:15px;" class="dropdown-item text-black" href="#" data-toggle="modal" data-target="#rgc"><i class="fas fa-doller-sign"></i> RGC option</a>
                          </div>
                        </li>                     
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                        </li>
                      @else                   
                       <li><a class="download-btn" href="#" data-toggle="modal" data-target="#exampleModal">Login/ Register</a></li>
                      
                      @endrole
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content log">

            <!--Modal cascading tabs-->
            <div class="modal-c-tabs card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-2 light-blue darken-3 bg-dang" role="tablist">
                    <li class="nav-item waves-effect waves-light active">
                        <a class="nav-link modal-top-btn" data-toggle="tab" href="#panel17" role="tab" aria-selected="true">
                            <i class="fa fa-user mr-1"></i> Login</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link modal-top-btn" data-toggle="tab" href="#panel18" role="tab" aria-selected="false">
                            <i class="fa fa-user-plus mr-1"></i> Register</a>
                    </li>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">×</span>
                    </button>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content t">
                    <!--Panel 17-->
                    <div class="tab-pane fade in active" id="panel17" role="tabpanel">

                        <div class="modal-body mb-1 logi">
                       <div class="card-body">
                       <form class="form-horizontal" action="{{route('login')}}" method="POST"  id="">
                        @csrf
                                    <div class="form-group row"> 
                                      <div class="col-md-12 inputGroupContainer">
                                      <div class="input-group">
                                      <span class="input-group-addon"><i class="fas fa-user-lock"></i></span>
                                      <input  name="email" placeholder="E.G: Tom@example.com" class="form-control"  type="text">
                                        </div>
                                      </div>
                                    </div>                                
                                    <div class="form-group row">
                                        <div class="col-md-12 inputGroupContainer">
                                        <div class="input-group">
                                      <span class="input-group-addon"><i class="fas fa-lock"></i></span>
                                      <input name="password" placeholder="E.G: *********" class="form-control"  type="text">
                                        </div>
                                      </div>
                                    </div> 
                                    <div class="form-group">
                                      <label class="col-md-4 control-label"></label>
                                      <div class="col-md-4"><br>
                                        <button type="submit" class="btn btn-success" >Sign in</button>
                                      </div>
                                    </div>
                                    
                            </form>
                         </div>
                        
                        </div>
                    </div>
                    <div class="tab-pane fade" id="panel18" role="tabpanel">
                     <div class="card-body p-6">
                     <form class="form-horizontal" action="{{route('register')}}" method="POST"  id="contact_form">
                          @csrf
                               <div class="form-group row">
                                  <div class="col-md-12 inputGroupContainer">
                                  <div class="input-group">
                                  <span class="input-group-addon"><i class="fas fa-user-alt"></i></span>
                                      <input  name="user_name" placeholder="Username" class="form-control"  type="text">
                                    </div>
                                  </div>
                                </div>                             
                               <div class="form-group row">
                                  <div class="col-md-12 inputGroupContainer">
                                  <div class="input-group">
                                  <span class="input-group-addon"><i class="fas fa-user-alt"></i></span>
                                     <input  name="first_name" placeholder="First name" class="form-control"  type="text">
                                    </div>
                                  </div>
                                </div>                             
                               <div class="form-group row">
                                  <div class="col-md-12 inputGroupContainer">
                                  <div class="input-group">
                                  <span class="input-group-addon"><i class="fas fa-user-alt"></i></span>
                                  <input  name="last_name" placeholder="Last name" class="form-control"  type="text">
                                    </div>
                                  </div>
                                </div>                            
                                  
                                  <div class="form-group row">
                                    <div class="col-md-12 inputGroupContainer">
                                      <div class="input-group select-style">
                                        <span class="input-group-addon"><i class="fas fa-globe-americas"></i></span>
                                        <select id="country" type="text" class="form-control select2"  name="country" data-toggle="select2">
                                          <option value="0">Select Countries</option>
                                          @php
                                              $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                          @endphp
                                          
                                          @foreach($countries as $item)
                                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                                          @endforeach
                                      </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                        <div class="col-md-12 inputGroupContainer">
                                          <div class="input-group">
                                              <span class="input-group-addon"><i class="fas fa-calendar-minus"></i></span>
                                              <input name="dob"  class="form-control" type="date">
                                          </div>
                                        </div>
                                  </div>
                                  <div class="form-group row">
                                    <div class="col-md-12 inputGroupContainer">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-key"></i></span>
                                     <input name="password" placeholder="Password" class="form-control"  type="password">
                                    </div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 inputGroupContainer">
                                    <div class="input-group">
                                  <span class="input-group-addon"><i class="fas fa-key"></i></span>
                                  <input name="password_confirmation" placeholder="Confirm Password" class="form-control"  type="password">
                                    </div>
                                  </div>
                                </div>

                                   <div class="form-group row">
                                      <div class="col-md-12 inputGroupContainer">
                                      <div class="input-group">
                                          <span class="input-group-addon"><i class="far fa-envelope"></i></span>
                                        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
                                        </div>
                                      </div>
                                   </div>
                                   <div class="form-group row"> 
                                    <div class="col-md-12 selectContainer">
                                    <div class="input-group select-style">
                                        <span class="input-group-addon"><i class="far fa-question-circle"></i></span>
                                    <select name="question" class="form-control selectpicker">
                                      <option value="0">Select  secret Question??</option>
                                      <option value="What is the hidden name of my mother?">What's my mother's hidden name?</option>
                                      <option value="What is my favourite hobby?">What's my favourite hobby?</option>
                                      <option value="What is my favourite sport club?" >What's my favourite sport club?</option>
                                      <option value="What is the name of my favourite book?">What's the name of my favourite book?</option>
                                      <option value="Who was my childhood hero?">Who was my childhood hero?</option>
                                      <option value="What is the name of my pet?" >What's the name of my pet?</option>
                                      <option value="What is my nickname?">What's my nickname?</option>
                                      <option value="What was the make of my first car?" >What was the make of my first car?</option>
                                      <option value="What is my secret code?">What's my secret code?</option>
                                    </select>
                                    </div>
                                   </div>
                                  </div>
                               
                                   <div class="form-group row">
                                  <div class="col-md-12 inputGroupContainer">
                                  <div class="input-group">
                                  <span class="input-group-addon"><i class="fas fa-reply"></i></span>
                                  <input  name="ans" placeholder="" class="form-control"  type="text">
                                    </div>
                                  </div>
                                </div>
                                
                                
                                 <div class="form-group row">
                                        <div class="col-md-12 text-center">
                                          <button type="submit" class="btn btn-success" >Sign up</button>
                                        </div>
                                      </div>
                                
                           </form>
                    </div>
                </div>

            </div>
                    <!--/.Panel 8-->
            </div>

            </div>
        </div>
    </div>
</div>
@if(Auth::check())
<?php
$user=\App\User::findOrFail(Auth::user()->id);
?>
<div class="modal fade" id="modalLoginAvatar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
          <!--Content-->
          <div class="modal-content">

       <div class="row">
          <div class="col-lg-12 col-sm-12">

                  <div class="card hovercard">
                      <div class="cardheader">

                      </div>
                      <div class="avatar">
                          <img alt="" src="{{@Auth::user()->image?url('user/profile/'.Auth::user()->image):asset('assets/frontend/img/profile/user.png')}}">
                      </div>
                      <div class="info">
                          <div class="title">
                              <a target="_blank">{{$user->profile->username}}</a>
                          </div>
                          <div class="desc">{{$user->email}}</div>
                          <div class="desc">{{$user->phone}}</div>
                      </div>
                      <div class="bottom text-align-justify">
                        <div class="desc">Full Name : {{$user->first_name}} {{$user->last_name}}</div>                       
                        <div class="desc">Street : {{$user->street}}</div>                          
                        <div class="desc">City : {{$user->city}}</div>                          
                        <div class="desc">Country : {{$user->country}}</div>                          
                        <div class="desc">Date Of Birth : {{$user->dob}}</div>                          
                      </div>
                      <div class="share-icon">
                      @foreach ($share as $key => $value)
                      @if ($key == 'facebook')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-facebook-f"></i></a>
                      @endif
                      @if ($key == 'linkedin')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-linkedin"></i></a>
                      @endif
                      @if ($key == 'twitter')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-twitter"></i></a>
                      @endif
                      @if ($key == 'pinterest')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-pinterest"></i></a>
                      @endif
                      @if ($key == 'tumblr')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-tumblr"></i></a>
                      @endif
                      @if ($key == 'delicious')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-delicious"></i></a>
                      @endif
                      @if ($key == 'digg')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-digg"></i></a>
                      @endif
                      @if ($key == 'reddit')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-reddit"></i></a>
                      @endif
                      @if ($key == 'vk')                          
                      <a target="_blank" href="{{$value}}"><i class="fab fa-vk"></i></a>
                      @endif
                     @endforeach
                      </div>
                  </div>

              </div>

        </div>

          </div>
          <!--/.Content-->
        </div>
 </div>
<div class="modal fade transaction-style" id="profiledit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header">
      <img src="{{@Auth::user()->image?url('user/profile/'.Auth::user()->image):asset('assets/frontend/img/profile/user.png')}}" alt="avatar" width="25%" class="img-responsive center-block img-circle">
      </div>
      <!--Body-->
      <div class="modal-body text-center mb-1"> 
               <form class="form-horizontal edit-form" action="{{route('user.update',$user->id)}}" method="POST"  id="contact_form" enctype="multipart/form-data">
                          @csrf
                        <div class="form-group row m-r-l-0"> 
                            <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                    <input  name="image" value="" placeholder="First name" class="form-control"  type="file">
                                </div>
                              </div>
                        </div>                                
                        <div class="form-group row m-r-l-0"> 
                            <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                    <input  name="first_name" value="{{$user->first_name}}" placeholder="First name" class="form-control"  type="text">
                                </div>
                              </div>
                        </div>                                
                        <div class="form-group row m-r-l-0">
                            <div class="col-md-12 inputGroupContainer">
                            <div class="input-group">
                          <span class="input-group-addon"><i class="fas fa-user"></i></span>
                          <input name="last_name" value="{{$user->last_name}}" class="form-control" placeholder="Last name"  type="text">
                            </div>
                          </div>
                        </div>                                
                        <div class="form-group row m-r-l-0"> 
                          <div class="col-md-12 selectContainer">
                          <div class="input-group select-style">
                              <span class="input-group-addon"><i class="far fa-question-circle"></i></span>
                          <select name="question" class="form-control selectpicker">
                            <option value="0">Select  secret Question??</option>
                            <option {{$user->question =='What is the hidden name of my mother?'?'selected':''}} value="What is the hidden name of my mother?">What's my mother's hidden name?</option>
                            <option {{$user->question =='What is my favourite hobby?'?'selected':''}} value="What is my favourite hobby?">What's my favourite hobby?</option>
                            <option {{$user->question =='What is my favourite sport club?'?'selected':''}} value="What is my favourite sport club?" >What's my favourite sport club?</option>
                            <option {{$user->question =='What is the name of my favourite book?'?'selected':''}} value="What is the name of my favourite book?">What's the name of my favourite book?</option>
                            <option {{$user->question =='Who was my childhood hero?'?'selected':''}} value="Who was my childhood hero?">Who was my childhood hero?</option>
                            <option {{$user->question =='What is the name of my pet?'?'selected':''}} value="What is the name of my pet?" >What's the name of my pet?</option>
                            <option {{$user->question =='What is my nickname?'?'selected':''}} value="What is my nickname?">What's my nickname?</option>
                            <option {{$user->question =='What was the make of my first car?'?'selected':''}} value="What was the make of my first car?" >What was the make of my first car?</option>
                            <option {{$user->question =='What is my secret code?'?'selected':''}} value="What is my secret code?">What's my secret code?</option>
                          </select>
                          </div>
                          </div>
                       </div>
                        <div class="form-group row m-r-l-0">
                            <div class="col-md-12 inputGroupContainer">
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-reply"></i></span>
                            <input  name="ans" value="{{$user->ans}}" class="form-control"  type="text">
                              </div>
                            </div>
                        </div>
                        <div class="form-group row m-r-l-0">
                          <div class="col-md-12 inputGroupContainer">
                          <div class="input-group">
                          <span class="input-group-addon"><i class="fas fa-user-alt"></i></span>
                             <input  name="user_name" value="{{$user->user_name}}" class="form-control"  type="text">
                            </div>
                          </div>
                        </div>
                        <div class="form-group row m-r-l-0">
                            <div class="col-md-12 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="far fa-envelope"></i></span>
                                <input name="email" value="{{$user->email}}" class="form-control"  type="text">
                            </div>
                          </div>
                        </div> 
                        <div class="form-group row m-r-l-0">
                            <div class="col-md-12 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                            <input name="phone" class="form-control" value="{{$user->phone}}" placeholder="Phone"  type="number">
                            </div>
                          </div>
                        </div> 
                        <div class="form-group row m-r-l-0">
                            <div class="col-md-12 inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-road"></i></span>
                            <input name="street" value="{{$user->street}}" placeholder="Street" class="form-control" type="text">
                            </div>
                          </div>
                          </div>                                
                            <div class="form-group row m-r-l-0">
                              <div class="col-md-12 inputGroupContainer">
                              <div class="input-group select-style">
                                  <span class="input-group-addon"><i class="fas fa-globe-americas"></i></span>
                                  <select name="country" id="country" class="form-control selectpicker">
                                          <option value="0">Select your Country</option>
                                          @php
                                        $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                    @endphp
                                    
                                    @foreach($countries as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                  </select>
                                </div>
                               </div>
                            </div>
                                 {{-- <div class="form-group row m-r-l-0">
                                  <div class="col-md-12 inputGroupContainer">
                                  <div class="input-group">
                                      <select id="city" type="text" class="form-control select2 {{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" data-toggle="select2">
                                          @if(isset($user_info))
                                              @php
                                                  $city = DB::table('states')->where('id' , $user_info->city)->first();
                                              @endphp
                                              <option value="{{ (isset($city)) ? $city->id : '' }}">{{ (isset($city)) ? $city->name : '' }}</option>
                                          @else
                                              <option value="">Select City</option>
                                          @endif
                                      </select>    
                                  </div>
                                </div>
                               </div> --}}
                            <div class="form-group row m-r-l-0">
                                <div class="col-md-12 inputGroupContainer">
                                <div class="input-group select-style">
                                    <span class="input-group-addon"><i class="fas fa-city"></i></span>
                                <input name="city" value="{{$user->city}}" placeholder="City" class="form-control" type="text">
                                </div>
                              </div>
                            </div>
                              <div class="form-group row m-r-l-0">
                                 <div class="col-md-12 inputGroupContainer">
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-calendar-minus"></i></span>
                                   <input name="dob" value="{{$user->dob}}" class="form-control" type="date">
                                 </div>
                                </div>
                              </div>
                              <div class="form-group row m-r-l-0">
                                    <div class="col-md-12 text-center">
                                      <button type="submit" class="btn btn-success" >Update</button>
                                    </div>
                              </div>
                                
                           </form>
      </div>

    </div>
    <!--/.Content-->
  </div>
</div>
<div class="modal fade right" id="nitification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info model-nootify-style" style="width:220px;position:absolute;right:10px"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <p>
            <strong style="color:green">You have {{@count($user->notifications->where('status',0))}} new notification !</strong>
          </p>
          @foreach (@$user->notifications as $item)
          @if ($item->status==0)           
          <div class="list-group text-justify not_all_after ">        
           <a href="#" data-toggle="modal" data-id="{{$item->id}}"  id="notifications" class="not not_all list-group-item list-group-item-success">{{str_limit($item->message,'25')}}</a>
          </div> 
          @endif  
          @endforeach
          
        </div>        
      </div>
    </div>
  </div>
</div>

<div class="modal fade right transaction-style" id="notification_view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info" style="width:420px;position:absolute;left:300px"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" id="clost" class="close x" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="card">
            <h4 class="text-white text-center">Notification</h4>
          <div class="card-body">
            <blockquote class="mb-0">
              <p class="notif"></p>
              <footer class="blockquote-footer text-right"><cite title="Source Title" class="time"></cite></footer>
            </blockquote>
          </div>
        </div>   
      </div>
    </div>
  </div>
</div>

<div class="modal fade right transaction-style" id="rgc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info" style="width:520px;position:absolute;right:150px"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <div class="">
            <div class="row pt-1 m-r-l-0">
              <div class="col-md-12 text-center">
              </div>
                <div class="col-md-8">
                  <p style="color:red" class="until_limit"><b>Remaining until reach wager limit : </b>No limit $</p> 
                  <p style="color:red" class="until_loss_limit"><b>Remaining until reach loss limit : </b>No limit $</p> 
                  <p style="color:green" class="loss_amount"><b>Amount lost today : </b>0.00 $</p> 
                  <p style="color:#9b9b12" class="s_session"><b>Time since session start : </b>46 min and 29 sec</p> 
                  <p style="color:green"><b>Daily Wager limit : </b><a class="lim wager_limit">{{$user->wagers?$user->wagers->wager_limit:'Not set'}}</a> $</p> 
                  <p style="color:green"><b>Daily Loss limit : </b><a class="lim loss_limit">{{$user->wagers?$user->wagers->los_limit:'Not set'}}</a> $</p> 
                  <p style="color:green"><b>Daily Deposit limit : </b><a class="lim deposit_limit">{{$user->wagers?$user->wagers->deposit_limit:'Not set'}}</a> $</p> 
                  <p style="color:#9b9b12"><b>Session duration limit : </b><a class="lim s_limit">{{$user->wagers?$user->wagers->session_limit:'Not set'}}</a> min</p> 
                </div>
                <div class="col-md-4">
                    <div class="btn-group-vertical" role="group">
                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#limit">Change Limit</button><br>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#account">Exclude Account</button><br>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#support">Support</button><br>
                      </div>
                </div>
              </div>
        </div>        
      </div>
    </div>
  </div>
</div>
<div class="modal fade right transaction-style" id="limit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info" style="width:420px;position:absolute;left:300px"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" id="clos" class="close x" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
      <form style="width: 330px;padding-left: 53px;">
        @csrf
          <div class="input-group">
              <label for="password">Password*             </label>
              <input type="text" class="form-control" id="password" name="password">
            </div>
            <div class="input-group">
                <label for="daily">Daily Wager limit*     </label>
                <input type="text" id="wager" name="wager" class="form-control">
            </div>
            <div class="input-group">
                <label for="loss">Daily loss limit*       </label>
                <input type="text" id="loss" class="form-control" name="loss">
            <input type="text" id="id" name="id" hidden value="{{@Auth::user()->id}}">
            </div>
            <div class="input-group">
                <label for="deposit">Daily Deposit limit*  </label>
                <input type="text" id="deposit" class="form-control" name="deposit">
            </div>
            <div class="input-group">
                <label for="session">Session durition limit*</label>
                <input type="text" id="session" class="form-control" name="session">
            </div><br>
            <div class="input-group">
                <button type="submit" id="btn_wager" class="btn btn-success">submit</button>
            </div>
        </form>      
      </div>
    </div>
  </div>
</div>
<div class="modal fade right transaction-style" id="account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info" style="width:420px;position:absolute;left:300px"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <form style="width: 330px;padding-left: 53px;">
          @csrf
          <div class="input-group">
              <label for="password">Password*             </label>
              <input type="text" class="form-control" id="pass" name="password">
            </div>
            <div class="input-group">
            <label for="daily">{{@Auth::user()->question}}</label>
                <input type="text" name="question" id="question" class="form-control">
            </div>
            <div class="input-group">
                <label for="loss">Exclude account for how many days?</label>
                <input type="text" class="form-control" id="time" name="time">
               <input type="text" hidden value="{{@Auth::user()->id}}" id="id" name="id">
            </div>
            <div class="input-group">
                <label for="deposit">Reason</label>
                <textarea type="text" class="form-control" id="reason"  name="reason"></textarea>
            </div><br>
            <div class="input-group">
                <button type="submit" id="btn_account_deactivate" class="btn btn-success">submit</button>
            </div>
        </form>      
      </div>
    </div>
  </div>
</div>
<div class="modal fade right transaction-style" id="support" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info" style="width:420px;position:absolute;left:300px"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
        <form style="width: 313px;padding-left: 59px;">
          @csrf
          <div class="input-group  text-white">
              <label for="password">Email*</label>
            <input type="text" class="form-control" name="email" id="email" value="{{@Auth::user()->email}}" name="email">
            </div>
            <div class="input-group text-white">
                <span id="comment"><div class="Lable">Please give the correct answer to the sum</div></span>
                <span style="color:red" id="num1" data-id="<?php echo rand(1,4) ?>"><?php echo rand(1,4) ?></span>  +  
                <span style="color:red" id="num2" data-id="<?php echo rand(1,4) ?>"><?php echo rand(1,4) ?></span>
                <input type="text" id="sum" name="ans" class="form-control">
            </div><br>
            <div class="input-group text-white select-style">
                <label for="priority">Priority</label>
                <select name="priority" id="priority" class="form-control">
                  <option value="low">Low</option>
                  <option value="medium">Medium</option>
                  <option value="high">High</option>
                  <option value="urgent">Urgent</option>
                </select>
            </div>
            <div class="input-group  text-white">
              <label for="Message">Message</label>
              <textarea name="message" id="message" class="form-control"></textarea>
            </div>
            <br>
            <div class="input-group text-center">
                <button id="btn_support" class="btn btn-success">submit</button>
            </div>
        </form>      
      </div>
    </div>
  </div>
</div>
<div class="modal fade right transaction-style" id="banking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info bank"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">        
       <div class="button-group text-center">
         <button class="btn btn-default" data-toggle="modal" id="all_transaction" style="display:none">All transaction</button>
         <button class="btn btn-default" data-toggle="modal" id="deposit_">Deposits</button>
         <button class="btn btn-default" data-toggle="modal" id="withdraw">Withdrawls</button>
         <button class="btn btn-default" data-toggle="modal" id="transfer">Others transfers</button>
       </div>
       <div class="panel panel-default">
          <div class="panel-heading text-center"><h3>Transaction history</h3></div>
          <table class="table table-responsive" id="history">
            <thead>
              <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>PAYMENT METHOD</th>
                <th>TYPE</th>
                <th>OTHER DETAILS</th>
                <th>BALANCE CHANGES</th>
                <th>FROM</th>
                <th>TO</th>
              </tr>
            </thead>
            <tbody>

              @foreach (@Auth::user()->balance as $item)
              <tr>
                <td>PS1069{{$item->id}}</td>
                <td>{{$item->created_at}}</td>
                <td><span>BONUS -</span> {{$item->type}}</td>
                <td>{{$item->type}}</td>
                <td></td>
                <td>{{$item->balance}}</td>
                <td>{{$item->from}}</td>
                <td>{{$item->to}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <table class="table" id="depositt" style="display:none">
            <thead>
              <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>PAYMENT METHOD</th>
                <th>TYPE</th>
                <th>OTHER DETAILS</th>
                <th>BALANCE CHANGES</th>
                <th>FROM</th>
                <th>TO</th>
              </tr>
            </thead>
            <tbody>
                @foreach (@Auth::user()->deposit as $item)
                <tr>
                  <td>PS1069{{$item->id}}</td>
                  <td>{{$item->created_at}}</td>
                  <td><span>BONUS -</span> {{$item->type}}</td>
                  <td>{{$item->type}}</td>
                  <td></td>
                  <td>{{$item->amount}}</td>
                  <td>{{$item->from}}</td>
                  <td>{{$item->to}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <table class="table" id="withdraww" style="display:none">
            <thead>
              <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>PAYMENT METHOD</th>
                <th>TYPE</th>
                <th>OTHER DETAILS</th>
                <th>BALANCE CHANGES</th>
                <th>FROM</th>
                <th>TO</th>
              </tr>
            </thead>
            <tbody>
                @foreach (@Auth::user()->withdraw as $item)
                <tr>
                  <td>PS1069{{$item->id}}</td>
                  <td>{{$item->created_at}}</td>
                  <td><span>BONUS -</span> {{$item->type}}</td>
                  <td>{{$item->type}}</td>
                  <td></td>
                  <td>{{$item->amount}}</td>
                  <td>{{$item->from}}</td>
                  <td>{{$item->to}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <table class="table" id="transferr" style="display:none">
            <thead>
              <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>PAYMENT METHOD</th>
                <th>TYPE</th>
                <th>OTHER DETAILS</th>
                <th>BALANCE CHANGES</th>
                <th>FROM</th>
                <th>TO</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade right transaction-style" id="Account_statement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info bank"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">
       <div class="panel panel-default">
          <div class="panel-heading text-center"><h3>Account statement</h3></div>
          <table class="table table-responsive" id="history">
            <thead>
              <tr>
                <th>ID</th>
                <th>DATE</th>
                <th>Desscription</th>
                <th>BALANCE CHANGES</th>
                <th>NEW BALANCE</th>
              </tr>
            </thead>
            <tbody>
              <?php $balance=0?>
              @foreach (@Auth::user()->balance as $item)
              <tr>
                <td>PS1069{{$item->id}}</td>
                <td>{{$item->created_at}}</td>
                <td><span>BONUS -</span> {{$item->type}}</td>
                <td>{{$item->balance}}</td>
                <td>+{{$balance=$item->balance+$balance}}</td>
              </tr>
              @endforeach
              <?php $balance++?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade right transaction-style" id="affiliate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info aff"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">        
       <div class="button-group text-center">
         <button class="btn btn-default" id="affiliate_list" style="display:none">List affiliate</button>
         <button class="btn btn-default" id="nickname">Set nickname</button>
         <button class="btn btn-default" id="invite">Invite friend</button>
       </div><br>
       <div class="panel panel-default" id="list">
          <div class="panel-heading text-center"><h3>List affiliate</h3></div>
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>B10150</td>
                <td>Rayan</td>
              </tr>
              <tr>
                <td>B10150</td>
                <td>tomwxsmith</td>
              </tr>
              <tr>
                <td>33456</td>
                <td>John</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="panel panel-default nik" style="display:none">
            <div class="panel-heading text-center"><h3>Set affiliate nickname</h3></div>
            <form action="#">
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="input-group form">
                        <label for="name" style="color:#fff;">*Affiliate nickname</label>
                        <input type="text" class="form-control" name="nickname">
                   </div>
                    <div class="form text-center">
                        <button type="submit" class="btn btn-info">Submit</button>
                   </div>
                </div>
                <div class="col-md-3"></div>
              </div>
            </form>
        </div>
        <div class="panel panel-default inv" style="display:none">
            <div class="panel-heading text-center"><h3>Invite friend</h3></div>
            <form action="#" class="text-center">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="input-group form">
                            <label for="name" style="color:#fff;">*Email</label>
                            <input type="email" class="form-control" name="email">
                       </div>
                        <div class="form text-center">
                            <button type="submit" class="btn btn-success">send</button>
                       </div>
                    </div>
                    <div class="col-md-3"></div>
                  </div>
            </form>
        </div>

      </div>
    </div>
  </div>
</div>

<div class="modal fade right transaction-style" id="game_history" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info bank"  role="document">
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body">        
       <div class="button-group text-center">
        <div class="input-group select-style">
            <?php
            $game=\App\AddGame::latest()->get();
            ?>
            @if (count($game)>0)               
            
               <label for="name" style="left: 0">All Game</label>
                  <select name="" class="form-control" id="all_game">
                    <option value="all">All games</option>
                      @foreach ($game as $item)
                       <option value="{{$item->game_title}}">{{$item->game_title}}</option>
                       @endforeach
                  </select>                       
                @endif
        </div>
        <div class="input-group" style="padding-top: 10px">          
         <button class="btn btn-default" data-toggle="modal" id="">Search</button>
        </div>
       </div><br>
       <div class="panel panel-default">
          <div class="panel-heading text-center"><h3>Transaction history</h3></div>
          <table class="table" >
            <thead>
              <tr>
                <th>ID</th>
                <th>Game</th>
                <th>START DATE END DATE</th>
                <th>MODE</th>
                <th>CREDIT BEFORE GAMEPLAY CREDIT AFTER GAMEPLAY</th>
                <th>TOTAL BET </th>
                <th>TOTAL WIN </th>
                <th>PROFIT</th>
                <th>PROVABLY FAIR</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>No data</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade right transaction-style" id="withdraw_b" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-right modal-notify modal-info bank"  role="document">
    <div class="modal-content deposit">
      <!--Header-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text" style="color:#fff">×</span>
        </button>
      </div>
      <!--Body-->
      <div class="modal-body text-center">
           <form class="form-horizontal">
                      @csrf
                            {{-- <div class="form-group row m-r-l-0"> 
                                  <div class="col-md-12 inputGroupContainer">
                                    <div class="input-group">
                                    <span class="input-group-addon">*Availabe balance</span>
                                </div>
                              </div>
                            </div> --}} 
                            <div class="form-group row m-r-l-0">
                                <div class="col-md-12 inputGroupContainer">
                                <div class="input-group select-style">
                                    <span class="input-group-addon">*Method</span>
                                    <select name="method" class="form-control selectpicker">
                                            <option value="0">No method selected</option>
                                            <option value="propersix">ProperSix Token</option>
                                            <option value="usd">USD</option>
                                          </select>
                                </div>
                              </div>
                             </div>
                            <div class="form-group row m-r-l-0">
                              <div class="col-md-12 inputGroupContainer">
                              <div class="input-group">
                              <span class="input-group-addon">*Email</i></span>
                              <input  name="email" class="form-control"  type="email">
                                </div>
                              </div>
                            </div>
                            <div class="form-group row m-r-l-0">
                              <div class="col-md-12 inputGroupContainer">
                              <div class="input-group">
                              <span class="input-group-addon">Benificiary name</span>
                              <input  name="name" class="form-control"  type="text">
                                </div>
                              </div>
                            </div>
                            <div class="form-group row m-r-l-0">
                                <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">*Amount</span>
                                  <input name="amount" class="form-control"  type="number">
                                </div>
                              </div>
                            </div> 
                            {{-- <div class="form-group row m-r-l-0">
                                <div class="col-md-12 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon">What's my mother's maiden name?:</span>
                                      <input name="phone" class="form-control"  type="text">
                                </div>
                              </div>
                            </div> --}}
                             <div class="form-group row m-r-l-0">
                                    <div class="col-md-4" style="left:50px">
                                      <button id="withdraw_balance" class="btn btn-success" >withdraw</button>
                                    </div>
                                    <div class="col-md-4" style="left:50px">
                                        <button type="button"  class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                              </div>
                            
                       </form>
  </div>
    </div>
  </div>
</div>
@endif
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
  $(document).ready(function () {
      $('#country').on('change', function (e) {
          var coun = $(this).val();
          console.log(com);
          

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
  $('#btn_support').click(function(e){
    e.preventDefault();
    var num1 = $('#num1').text();
    var num2 = $('#num2').text();    
    var message = $('#message').val();    
    var priority = $('#priority').val(); 
    var email = $('#email').val(); 
    var id = $('#id').val(); 
    var formData = new FormData();
    formData.append('message', message);
    formData.append('priority', priority);
    formData.append('email', email);
    formData.append('id', id);   
    var ans =$('#sum').val();
     if (message== '') {
      toastr.error("Please enter message");
      toastr.options.timeOut = 600;
     }       
     if (email== '') {
      toastr.error("Please enter email");
      toastr.options.timeOut = 600;
     }       
     if (priority== '') {
      toastr.error("Please enter priority");
      toastr.options.timeOut = 600;
     }
    if((parseInt(num1) + parseInt(num2)) == ans){      
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'POST',
				url:'{{route('user.support')}}',
				contentType: false,
				processData: false,
				data:formData,
				success:function(data){
          console.log(data);
          
          $('#support').each(function(){
                    $(this).modal('hide');
                });
       /*    toastr.success('Wager limit changed');
					toastr.options.timeOut = 600; */
         
				},
				error: function(data){
					toastr.error(data.responseText);
					toastr.options.timeOut = 600;
				}
			});	
      
    }
    else{
      toastr.error("Wrong value of sum");
      toastr.options.timeOut = 600;
    }
    
  });
  

  $('#nickname').click(function(){
    $('.nik').removeAttr('style');
    $('#affiliate_list').removeAttr('style');
    $('#invite').removeAttr('style');
    $('#list').css("display","none");
    $('#nickname').css("display","none");
    $('.inv').css("display","none");
  });
  $('#invite').click(function(){
    $('.inv').removeAttr('style');
    $('#affiliate_list').removeAttr('style');
    $('#nickname').removeAttr('style');
    $('#list').css("display","none");
    $('#invite').css("display","none");
    $('.nik').css("display","none");
  });
  $('#affiliate_list').click(function(){
    $('#list').removeAttr('style');
    $('#invite').removeAttr('style');
    $('#nickname').removeAttr('style');
    $('.nik').css("display","none");
    $('.inv').css("display","none");
    $('#affiliate_list').css("display","none");
  });
  $('#all_transaction').click(function(){
    $('#history').removeAttr('style');
    $('#deposit_').removeAttr('style');
    $('#withdraw').removeAttr('style');
    $('#transfer').removeAttr('style');
    $('#transferr').css("display","none");
    $('#withdraww').css("display","none");
    $('#depositt').css("display","none");
    $('#all_transaction').css("display","none");
  });
  $('#deposit_').click(function(){
    $('#depositt').removeAttr('style');
    $('#all_transaction').removeAttr('style');
    $('#withdraw').removeAttr('style');
    $('#transfer').removeAttr('style');
    $('#history').css("display","none");
    $('#withdraww').css("display","none");
    $('#deposit_').css("display","none");
    $('#transferr').css("display","none");
  });
  $('#withdraw').click(function(){
    $('#withdraww').removeAttr('style');
    $('#transfer').removeAttr('style');
    $('#all_transaction').removeAttr('style');
    $('#deposit_').removeAttr('style');
    $('#history').css("display","none");
    $('#depositt').css("display","none");
    $('#transferr').css("display","none");
    $('#withdraw').css("display","none");
  });
  $('#transfer').click(function(){
    $('#transferr').removeAttr('style');
    $('#deposit_').removeAttr('style');
    $('#all_transaction').removeAttr('style');
    $('#withdraw').removeAttr('style');
    $('#history').css("display","none");
    $('#withdraww').css("display","none");
    $('#depositt').css("display","none");
    $('#transfer').css("display","none");
  });
  $('#withdraw_balance').click(function(e){
    e.preventDefault();
    toastr.success('Coming soon');
    toastr.options.timeOut = 600;
    $('.modal').each(function(){
         $(this).modal('hide');
      });
  });
  $('#deposit_form').click(function(e){
    e.preventDefault();
    toastr.success('Coming soon');
    toastr.options.timeOut = 600;
    $('.modal').each(function(){
         $(this).modal('hide');
      });
  });

$("#btn_wager").click(function(e){	
    e.preventDefault();
	var password = document.getElementById("password").value;
	var wager = document.getElementById("wager").value;
	var loss = document.getElementById("loss").value;
	var deposit = document.getElementById("deposit").value;
	var session = document.getElementById("session").value;
	var id = document.getElementById("id").value;
	var formData = new FormData();
	formData.append('password', password);
	formData.append('wager', wager);
	formData.append('loss', loss);
	formData.append('deposit', deposit);
	formData.append('session', session);
	formData.append('id', id);
	
	if(password == "") {
	toastr.error("Please enter password");
      toastr.options.timeOut = 600;
    }	
	if(wager == "") {
	toastr.error("Please enter wager limit");
      toastr.options.timeOut = 600;
      return false;
    }	
	if(loss == "") {
	toastr.error("Please enter daily loss limit");
      toastr.options.timeOut = 600;
      return false;
    }		
    $('.wager_limit').html("");           
    $('.loss_limit').html("");
    $('.deposit_limit').html(""); 
    $('.s_limit').html("");
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'POST',
				url:'{{route('user.wager_limit')}}',
				contentType: false,
				processData: false,
				data:formData,
				success:function(response){
          console.log(response.deposit_limit);
          
          $('#limit').css("display","none");
          $('.wager_limit').append(response.wager_limit);           
          $('.loss_limit').append(response.los_limit); 
          $('.deposit_limit').append(response.deposit_limit); 
          $('.s_limit').append(response.session_limit); 

          toastr.success('Wager limit changed');
					toastr.options.timeOut = 600;
         
				},
				error: function(data){
					toastr.error(data.responseText);
					toastr.options.timeOut = 600;
				}
			});	
});
$("#btn_account_deactivate").click(function (e) {
  e.preventDefault();
	var password = document.getElementById("pass").value;  
	var question = document.getElementById("question").value;  
	var time = document.getElementById("time").value;  
	var id = document.getElementById("id").value;  
	var reason = document.getElementById("reason").value;  
  var formData = new FormData();
	formData.append('password', password);
	formData.append('question', question);
	formData.append('time', time);
	formData.append('id', id);
	formData.append('reason', reason);
	if(password == "") {
	toastr.error("Please enter password");
      toastr.options.timeOut = 600;
    }	
	if(question == "") {
	toastr.error("Please enter your memories");
      toastr.options.timeOut = 600;
      return false;
    }	
	if(time == "") {
	toastr.error("Please enter hoaw many days?");
      toastr.options.timeOut = 600;
      return false;
    }		
	if(reason == "") {
	toastr.error("Please enter acount deactivate reason");
      toastr.options.timeOut = 600;
      return false;
    }		
	
			$.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type:'POST',
				url:'{{route('user.account_deactivate')}}',
				contentType: false,
				processData: false,
				data:formData,
				success:function(data){
          console.log(data);
          
          $('.modal').each(function(){
                    $(this).modal('hide');
                });
       /*    toastr.success('Wager limit changed');
					toastr.options.timeOut = 600; */
         
				},
				error: function(data){
					toastr.error(data.responseText);
					toastr.options.timeOut = 600;
				}
			});	

});

$(".not").click(function(e){
  $('.notif').html('');           
    $('.time').html(''); 
  var not_id =$(this).data("id");
    
  $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      type:'POST',
      url:'/user/notification-view/'+not_id,      
      data: {},
      success:function(response){       
        $('#notification_view').modal({
            show: 'true'
         });
          $('.notif').append(response.message);           
          $('.time').append(response.created_at);  
         
      },
      error: function(data){
      }
    });
   })
   
   $("#clost").click(function(e){
    e.preventDefault();
    location.reload();     
   });
</script>