<nav class="navbar navbar-expand navbar-light bg-white sticky-top">
    <a class="sidebar-toggle d-flex mr-3">
        <i class="align-self-center" data-feather="menu"></i>
    </a>

    <div class="form-inline d-none d-sm-inline-block" data-toggle="modal" data-target="#defaultModalSuccess">
        {{-- <img src="{{ asset('backend/country100/se.png') }}" alt="" style="width: 35px;"> --}}
        {{-- <span>(Click to change)</span> --}}

    </div>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                @if(Auth::user()->hasRole('Affiliate'))
                    @php
                        $amount = DB::table('prosix_user_wallets')->where('user_id',Auth::user()->id)->first();
                    @endphp
                    <span class="btn btn-success">$ {{round($amount->usd)}} ({{round($amount->token)}} Tokens)</span>
                @endif
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle ml-2" href="#" id="alertsDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell"></i>
                    </div>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                    </div>
                    <div class="list-group">
                        @php
                            $notifications = DB::table('notifications')->where('user_id', @Auth::user()->id)->where('status',0)->orderBy('id', 'desc')->take(5)->get();
                        @endphp
                        @if(count($notifications))
                            @foreach ($notifications as $item)
                                <a href="#" class="list-group-item">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-2">
                                            {{--
                                                                                   <i class="text-danger" data-feather="alert-circle"></i>
                                            --}}
                                        </div>
                                        <div class="col-10">
                                            <div class="text-dark">Status Update</div>
                                            <div class="text-muted small mt-1">{{ $item->message }}</div>
                                            <div class="text-muted small mt-1">{{ date('d/m/y', strtotime($item->created_at)) }}</div>
                                        </div>
                                    </div>
                                </a>

                            @endforeach
                        @else
                            <tr>
                                <td class="text-center">
                                    <p>No New Notifications</p>
                                </td>
                            </tr>
                        @endif


                    </div>

                    <div class="dropdown-menu-footer">
                        {{--
                                           <a href="#" class="text-muted">Show all notifications</a>
                        --}}
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle ml-2 d-inline-block d-sm-none" href="#" id="userDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle mt-n1" data-feather="settings"></i>
                    </div>
                </a>
                @php
                    $auth = \Auth::user();
                    $user_info = \App\UserProfile::where('user_id', $auth->id)->first();

                @endphp
                <a class="nav-link nav-link-user dropdown-toggle d-none d-sm-inline-block" href="#" id="userDropdown" data-toggle="dropdown">
                    @if ($user_info)
                        <img style="border-radius: 50%;" src="{{ $user_info->base_image!=null?asset('backend/profile').'/'. $user_info->base_image:asset('backend/profile/1583882583.avatar.png') }}" class="avatar img-fluid rounded mr-1"/>
                    @endif
                    <span class="text-dark">{{ $auth->first_name }} {{ $auth->last_name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ route('user-profile.index') }}">Profile</a>
                    {{-- <a class="dropdown-item" href="#">Analytics</a> --}}
                    <div class="dropdown-divider"></div>
                    {{-- <a class="dropdown-item" href="#">Settings & Privacy</a> --}}
                    {{-- <a class="dropdown-item" href="#">Help</a> --}}
                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        Sign out
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                </div>
            </li>

           {{--  <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle ml-2" href="#" id="messagesDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="message-square"></i>
                        <span class="indicator">4</span>
                    </div>
                </a>

           <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown">
               <div class="dropdown-menu-header">
                   <div class="position-relative">
                       4 New Messages
                   </div>
               </div>
               <div class="list-group">
                  <a href="#" class="list-group-item">
                       <div class="row no-gutters align-items-center">
                           <div class="col-2">
                               <img src="{{ asset('backend/all/docs/img/avatar-5.jpg') }}" class="avatar img-fluid rounded-circle" alt="Kathy Davis">
                           </div>
                           <div class="col-10 pl-2">
                               <div class="text-dark">Kathy Davis</div>
                               <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                               <div class="text-muted small mt-1">15m ago</div>
                           </div>
                       </div>
                   </a>
               </div>
               <div class="dropdown-menu-footer">
                   <a href="#" class="text-muted">Show all messages</a>
               </div>
           </div>
       </li>--}}



        </ul>
    </div>
</nav>
