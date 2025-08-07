@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endsection
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Add Bonus</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Bonuses</a></li>
                            <li class="breadcrumb-item active">Add Bonus</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->


    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-10 offset-md-1 col-12">
            <div class="card p-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Select Bonus Type</h4>
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('list-bonuses.index') }}" class="btn btn-primary float-right">Bonus list</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.BonusTypeCheck') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Type : </label>

                            <div class="col-md-8">
                                <select id="status" type="text" class="form-control {{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                    <option value="0" {{ @Session::get('bonus_type') == 0 ?'selected':''}} >Registration Bonus</option>
                                    <option value="1" {{ @Session::get('bonus_type') == 1 ?'selected':''}}>Login Bonus</option>
                                    <option value="2" {{ @Session::get('bonus_type') == 2 ?'selected':''}}>Deposit Bonus</option>
                                    <option value="3" {{ @Session::get('bonus_type') == 3 ?'selected':''}}>Bonus Code</option>
                                    {{-- <option value="4" {{ @Session::get('bonus_type') == 4 ?'selected':''}}>Payment Method bonus</option>
                                    <option value="5" {{ @Session::get('bonus_type') == 5 ?'selected':''}}>Cashback Bonus</option> --}}
                                </select>
                                <small style="color:green">select bonus type from drop down befor adding and submit to show realevant form</small>
                                @if ($errors->has('bonus_name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bonus_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if(Session::get('bonus_type') == 0)
                    <div class="card-body">
                        <div class="card-header mb-3">
                            <h4>Add Registration Bonus</h4>
                        </div>
                        <form action="{{ route('Registration_Bonus') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Name : </label>

                                <div class="col-md-8">
                                    <input id="bonus_name" type="text" class="form-control {{ $errors->has('bonus_name') ? ' is-invalid' : '' }}" name="bonus_name" value="{{ old('bonus_name') }}" required>
                                    <small style="color:green">enter bonus title</small>
                                    @if ($errors->has('bonus_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-3 col-form-label text-md-right">Free Tokens : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="bonus_amount" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}" required>
                                    </div>
                                    <small style="color:green">enter number of free tokens</small>
                                    @if ($errors->has('bonus_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End bonus_code -->

                            <!-- Start bonus_amount -->
                            <div class="form-group row">
                                <label for="free_spin" class="col-md-3 col-form-label text-md-right">Free Spins : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="free_spin" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('free_spin') ? ' is-invalid' : '' }}" name="free_spin" value="{{ old('free_spin') }}" required>
                                    </div>
                                    <small style="color:green">enter number of free spins</small>
                                    @if ($errors->has('free_spin'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('free_spin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--    <div class="form-group row">
                                   <label for="games" class="col-md-3 col-form-label text-md-right">Games : </label>
                                   <div class="col-md-8">
                                       <div class="input-group">
                                           <select class="form-control" id="multi_Game" name="games[]"  multiple="multiple">
                                               @foreach ($games as $item)
                                                   <option value="{{ $item->id }}">{{ $item->game_title }}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       @if ($errors->has('games'))
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $errors->first('games') }}</strong>
                                           </span>
                                       @endif
                                   </div>
                               </div> --}}
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Bet Size : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" min="0" name="bet_size">
                                    </div>
                                    @if ($errors->has('bet_size'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bet_size') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Lines : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" min="0" name="lines">
                                    </div>
                                    @if ($errors->has('lines'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lines') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Wagering requirement  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <div class="input-group">
                                            <input TYPE="NUMBER" min="0" min="0" class="form-control" min="0" name="wagering_req">
                                        </div>
                                        <small style="color:green">enter number of wagering amount in tokens</small>
                                    </div>
                                    @if ($errors->has('wagering_req'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wagering_req') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_cat" class="col-md-3 col-form-label text-md-right">Bonus Time Category </label>
                                <div class="col-md-8">
                                    <select id="bonus_cat" type="text" class="form-control " name="bonus_cat" >
                                        <option value="specific_date"   selected >Specific Date</option>
                                        <option value="from_till"  >From Till</option>
                                        <option value="recurring"   >Recuring</option>
                                    </select>
                                    <small style="color:green">in case of specific date bonus select "Specific Date. "</small>
                                    <small style="color:green">in case of start and end date select "From Till. "</small>
                                    <small style="color:green">in case of recurring bonus select "Recurring"</small>
                                </div>
                            </div>
                            <div id="from_till" class="group" >
                                <div class="form-group row">
                                    <label for="from" class="col-md-3 col-form-label text-md-right">from : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                        <small style="color:green">select start date</small>
                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="till" class="col-md-3 col-form-label text-md-right">Till : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="till">
                                        </div>
                                        <small style="color:green">select end date</small>
                                        @if ($errors->has('till'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('till') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="specific_date" class="group" >
                                <div class="form-group row">
                                    <label for="specific_day" class="col-md-3 col-form-label text-md-right">Specific Day  : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="specific_day">
                                        </div>
                                        <small style="color:green">select specific date</small>
                                        @if ($errors->has('specific_day'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('specific_day') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="recurring" class="group" >
                                <div class="form-group row">
                                    <label for="Recurring_w" class="col-md-3 col-form-label text-md-right">Recurring   : </label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select name="recurring" id="Recurring_w" class="form-control">
                                                <option value="w">Weekly</option>
                                                <option value="m">Monthly</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select weekly or monthly date</small>
                                        @if ($errors->has('recurring'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('recurring') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" id="_Day">
                                        <div class="input-group">
                                            <select name="w_2" id="day_"  class="form-control">
                                                <option value="01">Sat</option>
                                                <option value="02">Sun</option>
                                                <option value="03">Mon</option>
                                                <option value="04">Tue</option>
                                                <option value="05">Wed</option>
                                                <option value="06">Thu</option>
                                                <option value="07">Fri</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select day</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 d-none" id="_Date">
                                        <div class="input-group">
                                            <select name="w_2" id="_montly" class="form-control"></select>
                                        </div>
                                        <small style="color:green">select day of month</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>




                            <div class="form-group row">
                                <label for="ex_country" class="col-md-3 col-form-label text-md-right">Excluded countries : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @php
                                            $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <select class="form-control" id="multi_country" multiple="multiple" name="ex_country[]">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">select excluded countries from bonus</small>
                                    @if ($errors->has('ex_country'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ex_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aff_source" class="col-md-3 col-form-label text-md-right">Affiliate source : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="aff_source">
                                    </div>
                                    @if ($errors->has('aff_source'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('aff_source') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--    <div class="form-group row">
                                   <label for="users" class="col-md-3 col-form-label text-md-right">Customer list : </label>
                                   <div class="col-md-8">
                                       <div class="input-group">
                                           <select class="form-control" id="multi_User" multiple="multiple" name="users[]">
                                               @foreach ($user as $item)
                                                   <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       @if ($errors->has('users'))
                                           <span class="invalid-feedback" role="alert">
                                               <strong>{{ $errors->first('users') }}</strong>
                                           </span>
                                       @endif
                                   </div>
                               </div> --}}
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    <small style="color:green">select bonus status</small>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                                    <small style="color:green">click to "Add" button to save bonus</small>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                @if(Session::get('bonus_type') == 1)
                    <div class="card-body">
                        <div class="card-header mb-3">
                            <h4>Add Login Bonus</h4>
                        </div>
                        <form action="{{ route('admin.login_Bonus') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Name : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="bonus_name" type="text" class="form-control {{ $errors->has('bonus_name') ? ' is-invalid' : '' }}" name="bonus_name" value="{{ old('bonus_name') }}" required>
                                    </div>
                                    <small style="color:green">enter bonus name</small>
                                    @if ($errors->has('bonus_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-3 col-form-label text-md-right">Free Tokens : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="bonus_amount" TYPE="NUMBER" min="0" min="0"  min="0" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}" required>
                                    </div>
                                    <small style="color:green">enter amount of free tokens</small>
                                    @if ($errors->has('bonus_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End bonus_code -->

                            <!-- Start bonus_amount -->
                            <div class="form-group row">
                                <label for="free_spin" class="col-md-3 col-form-label text-md-right">Free Spins : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="free_spin" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('free_spin') ? ' is-invalid' : '' }}" name="free_spin" value="{{ old('free_spin') }}" required>
                                    </div>
                                    <small style="color:green">enter number of free spins</small>
                                    @if ($errors->has('free_spin'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('free_spin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Games : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_Game" name="games[]"  multiple="multiple">
                                            @foreach ($games as $item)
                                                <option value="{{ $item->id }}">{{ $item->game_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">select games</small>
                                    @if ($errors->has('games'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('games') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Bet Size : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" min="0" class="form-control" name="bet_size">
                                    </div>
                                    @if ($errors->has('bet_size'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bet_size') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Lines : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" min="0" class="form-control" name="lines">
                                    </div>
                                    @if ($errors->has('lines'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lines') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Wagering requirement  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" name="wagering_req">
                                    </div>
                                    @if ($errors->has('wagering_req'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wagering_req') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_cat" class="col-md-3 col-form-label text-md-right">Bonus Date Category </label>
                                <div class="col-md-8">
                                    <select id="bonus_cat" type="text" class="form-control " name="bonus_cat" >
                                        <option value="specific_date"   selected >Specific Date</option>
                                        <option value="from_till"  >From Till</option>
                                        <option value="recurring"   >Recuring</option>
                                    </select>
                                    <small style="color:green">in case of specific date bonus select "Specific Date. "</small>
                                    <small style="color:green">in case of start and end date select "From Till. "</small>
                                    <small style="color:green">in case of recurring bonus select "Recurring"</small>
                                </div>
                            </div>
                            <div id="from_till" class="group" >
                                <div class="form-group row">
                                    <label for="from" class="col-md-3 col-form-label text-md-right">From : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                        <small style="color:green">select start date</small>
                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="till" class="col-md-3 col-form-label text-md-right">Till : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="till">
                                        </div>
                                        <small style="color:green">select end date</small>
                                        @if ($errors->has('till'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('till') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="specific_date" class="group" >
                                <div class="form-group row">
                                    <label for="specific_day" class="col-md-3 col-form-label text-md-right">Specific Day  : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="specific_day">
                                        </div>
                                        <small style="color:green">select specific date</small>
                                        @if ($errors->has('specific_day'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('specific_day') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="recurring" class="group" >
                                <div class="form-group row">
                                    <label for="Recurring_w" class="col-md-3 col-form-label text-md-right">Recurring   : </label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select name="recurring" id="Recurring_w" class="form-control">
                                                <option value="w">Weekly</option>
                                                <option value="m">Monthly</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select weekly or monthly date</small>
                                        @if ($errors->has('recurring'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('recurring') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" id="_Day">
                                        <div class="input-group">
                                            <select name="w_2" id="day_"  class="form-control">
                                                <option value="01">Sat</option>
                                                <option value="02">Sun</option>
                                                <option value="03">Mon</option>
                                                <option value="04">Tue</option>
                                                <option value="05">Wed</option>
                                                <option value="06">Thu</option>
                                                <option value="07">Fri</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select day of week</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 d-none" id="_Date">
                                        <div class="input-group">
                                            <select name="w_2" id="_montly" class="form-control">
                                            </select>
                                        </div>
                                        <small style="color:green">select date of month</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        <!-- <div class="form-group row">
                            <label for="users" class="col-md-3 col-form-label text-md-right">VIP level : </label>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <select class="form-control" id="multi_Vip" multiple="multiple" name="vip_level[]">
                                        @foreach ($user as $item)
                            <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                        @endforeach
                            </select>
                        </div>
@if ($errors->has('vip_level'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('vip_level') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->
                            <div class="form-group row">
                                <label for="ex_country" class="col-md-3 col-form-label text-md-right">Excluded countries : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @php
                                            $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <select class="form-control" id="multi_country" multiple="multiple" name="ex_country[]">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">select excluded countries from bonus if any</small>
                                    @if ($errors->has('ex_country'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ex_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aff_source" class="col-md-3 col-form-label text-md-right">Affiliate source : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="aff_source">
                                    </div>
                                    @if ($errors->has('aff_source'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('aff_source') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">Customer list : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_User" multiple="multiple" name="users[]">
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">if bonus needed to be sent to specific users select users otherwise leave this blank</small>
                                    @if ($errors->has('users'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('users') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                @if(Session::get('bonus_type') == 2)
                    <div class="card-body">
                        <div class="card-header mb-3">
                            <h4>Add Deposit Bonus</h4>
                        </div>
                        <form action="{{ route('admin.deposit_Bonus') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Name : </label>

                                <div class="col-md-8">
                                    <input id="bonus_name" type="text" class="form-control {{ $errors->has('bonus_name') ? ' is-invalid' : '' }}" name="bonus_name" value="{{ old('bonus_name') }}" required>
                                    <small style="color:green">enter bonus title</small>
                                    @if ($errors->has('bonus_name'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('bonus_name') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-3 col-form-label text-md-right">Bonus Code : </label>

                                <div class="col-md-8">
                                    <input id="bonus_code" type="text" class="form-control {{ $errors->has('bonus_code') ? ' is-invalid' : '' }}" name="bonus_code" value="{{ old('bonus_code') }}" required>
                                    <small style="color:green">enter bonus code.minimum 6 characters</small>
                                    @if ($errors->has('bonus_code'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('bonus_code') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End bonus_code -->
                            <div class="form-group row">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Bonus Amount Type : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select id="bo_am_type" class="form-control">
                                            <option value="a">Amount</option>
                                            <option value="p">Percentage</option>
                                        </select>
                                    </div>
                                    <small style="color:green">for fixed free tokens select amount.for percentage of deposiited amount select percentage</small>
                                </div>
                            </div>
                            <div class="form-group row" id="_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Bonus Amount : </label>
                                <div class="col-md-8" >
                                    <div class="input-group">
                                        <input id="bonus_amount" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}">
                                    </div>
                                    <small style="color:green">enter fixed free tokens amount</small>
                                    @if ($errors->has('bonus_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-none" id="_percent_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Percentage Amount : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="percent_amount" placeholder="amount percentage" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('percent_amount') ? ' is-invalid' : '' }}" name="percent_amount" value="{{ old('percent_amount') }}">
                                        <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$ / %</button>
                                    </span>
                                    </div>
                                    <small style="color:green">enter percentage of deposited amount</small>
                                    @if ($errors->has('percent_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('percent_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-none" id="_max_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Minimum Deposit Amount $ : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="max_amount" placeholder="minimum deposit amount" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('max_amount') ? ' is-invalid' : '' }}" name="max_amount" value="{{ old('max_amount') }}">
                                    </div>
                                    <small style="color:green">enter enter minimum deposit amount</small>
                                    @if ($errors->has('max_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Start bonus_amount -->
                            <div class="form-group row">
                                <label for="free_spin" class="col-md-3 col-form-label text-md-right">Amount of Free Spins : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="free_spin" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('free_spin') ? ' is-invalid' : '' }}" name="free_spin" value="{{ old('free_spin') }}" required>
                                    </div>
                                    <small style="color:green">enter free spins</small>
                                    @if ($errors->has('free_spin'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('free_spin') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Games : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_Game" name="games[]"  multiple="multiple">
                                            @foreach ($games as $item)
                                                <option value="{{ $item->id }}" >{{ $item->game_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('games'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('games') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> --}}
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Bet Size : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" name="bet_size" value="{{ old('bet_size') }}">
                                    </div>
                                    @if ($errors->has('bet_size'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('bet_size') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Lines : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" name="lines" value="{{ old('lines') }}">
                                    </div>
                                    @if ($errors->has('lines'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('lines') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Wagering requirement  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" name="wagering_req" value="{{ old('wagering_req') }}">
                                    </div>
                                    <small style="color:green">enter minimum amount of tokens wagered to avail bonus</small>
                                    @if ($errors->has('wagering_req'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('wagering_req') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_cat" class="col-md-3 col-form-label text-md-right">Bonus Date Category </label>
                                <div class="col-md-8">
                                    <select id="bonus_cat" type="text" class="form-control " name="bonus_cat" >
                                        <option value="specific_date"   selected >Specific Date</option>
                                        <option value="from_till"  >From Till</option>
                                        <option value="recurring"   >Recuring</option>
                                    </select>
                                    <small style="color:green">in case of specific date bonus select "Specific Date. "</small>
                                    <small style="color:green">in case of start and end date select "From Till. "</small>
                                    <small style="color:green">in case of recurring bonus select "Recurring"</small>
                                </div>
                            </div>
                            <div id="from_till" class="group" >
                                <div class="form-group row">
                                    <label for="from" class="col-md-3 col-form-label text-md-right">From : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                        <small style="color:green">select start date</small>
                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="till" class="col-md-3 col-form-label text-md-right">Till : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="till">
                                        </div>
                                        <small style="color:green">select end date</small>
                                        @if ($errors->has('till'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('till') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="specific_date" class="group" >
                                <div class="form-group row">
                                    <label for="specific_day" class="col-md-3 col-form-label text-md-right">Specific Day  : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="specific_day">
                                        </div>
                                        <small style="color:green">select specific date</small>
                                        @if ($errors->has('specific_day'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('specific_day') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="recurring" class="group" >
                                <div class="form-group row">
                                    <label for="Recurring_w" class="col-md-3 col-form-label text-md-right">Recurring   : </label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select name="recurring" id="Recurring_w" class="form-control">
                                                <option value="w">Weekly</option>
                                                <option value="m">Monthly</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select weekly or monthly date</small>
                                        @if ($errors->has('recurring'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('recurring') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" id="_Day">
                                        <div class="input-group">
                                            <select name="w_2" id="day_"  class="form-control">
                                                <option value="01">Sat</option>
                                                <option value="02">Sun</option>
                                                <option value="03">Mon</option>
                                                <option value="04">Tue</option>
                                                <option value="05">Wed</option>
                                                <option value="06">Thu</option>
                                                <option value="07">Fri</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select day</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 d-none" id="_Date">
                                        <div class="input-group">
                                            <select name="w_2" id="_montly" class="form-control">
                                            </select>
                                        </div>
                                        <small style="color:green">select date of month</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">Chained  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control"   name="chained[]">
                                            <option value="0">Select One</option>
                                            @foreach ($deposit_bonus as $item)
                                                <option value="{{ $item->id }}">{{ $item->bonus_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('chained'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('chained') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">Expiration on chain  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" name="ex_chain" class="form-control">
                                    </div>
                                    @if ($errors->has('ex_chain'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ex_chain') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">VIP level : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @php
                                            $viplevel = DB::table('loyalities')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <select class="form-control" id="multi_Vip" multiple="multiple" name="vip_level[]">
                                            @foreach ($viplevel as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">select vip level to give bonus to.otherwise leave empty</small>
                                    @if ($errors->has('vip_level'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vip_level') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ex_country" class="col-md-3 col-form-label text-md-right">Excluded countries : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @php
                                            $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <select class="form-control" id="multi_country" multiple="multiple" name="ex_country[]">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">selec countries to exclude from this deposit bonus if any.other wise leave blank</small>
                                    @if ($errors->has('ex_country'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('ex_country') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="aff_source" class="col-md-3 col-form-label text-md-right">Affiliate source : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="aff_source">
                                    </div>
                                    @if ($errors->has('aff_source'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('aff_source') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">Customer list : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_User" multiple="multiple" name="users[]">
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">select user if you want to give bonus to specific user.otherwise leave empty</small>
                                    @if ($errors->has('users'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('users') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    <small style="color:green">select status of bonus</small>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('status') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                @if(Session::get('bonus_type') == 3)
                    <div class="card-body">
                        <div class="card-header mb-3">
                            <h4>Add Bonus Code</h4>
                        </div>
                        <form action="{{ route('admin.code_Bonus') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Name : </label>

                                <div class="col-md-8">
                                    <input id="bonus_name" type="text" class="form-control {{ $errors->has('bonus_name') ? ' is-invalid' : '' }}" name="bonus_name" value="{{ old('bonus_name') }}" required>
                                    <small style="color:green">enter bonus name</small>
                                    @if ($errors->has('bonus_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_code" class="col-md-3 col-form-label text-md-right">Bonus Code : </label>
                                <div class="col-md-8">
                                    <input id="bonus_code" type="text" class="form-control {{ $errors->has('bonus_code') ? ' is-invalid' : '' }}" name="bonus_code" value="{{ old('bonus_code') }}" required>
                                    <small style="color:green">enter bonus code.minimum 6 characters</small>
                                    @if ($errors->has('bonus_code'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-3 col-form-label text-md-right">Free tokens : </label>

                                <div class="col-md-8">
                                    <input id="bonus_amount" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}" required>
                                    <small style="color:green">enter number of free tokens</small>
                                    @if ($errors->has('bonus_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End bonus_code -->

                            <!-- Start bonus_amount -->
                            <div class="form-group row">
                                <label for="free_spin" class="col-md-3 col-form-label text-md-right">Free Spins : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="free_spin" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('free_spin') ? ' is-invalid' : '' }}" name="free_spin" value="{{ old('free_spin') }}" required>
                                    </div>
                                    <small style="color:green">enter number of free spins</small>
                                    @if ($errors->has('free_spin'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('free_spin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{--  <div class="form-group row">
                                 <label for="games" class="col-md-3 col-form-label text-md-right">Games : </label>
                                 <div class="col-md-8">
                                     <div class="input-group">
                                         <select class="form-control" id="multi_Game" name="games[]"  multiple="multiple">
                                             @foreach ($games as $item)
                                                 <option value="{{ $item->id }}">{{ $item->game_title }}</option>
                                             @endforeach
                                         </select>
                                     </div>
                                     @if ($errors->has('games'))
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('games') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div> --}}
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Bet Size : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" name="bet_size">
                                    </div>
                                    @if ($errors->has('bet_size'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bet_size') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div style="display: none" class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Lines : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" name="lines">
                                    </div>
                                    @if ($errors->has('lines'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lines') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Wagering requirement  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" name="wagering_req">
                                    </div>
                                    <small style="color:green">enter wagering amount in tokens if any.otherwise leave empty</small>
                                    @if ($errors->has('wagering_req'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wagering_req') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bonus_cat" class="col-md-3 col-form-label text-md-right">Bonus Date Category </label>
                                <div class="col-md-8">
                                    <select id="bonus_cat" type="text" class="form-control " name="bonus_cat" >
                                        <option value="specific_date"   selected >Specific Date</option>
                                        <option value="from_till"  >From Till</option>
                                        <option value="recurring"   >Recuring</option>
                                    </select>
                                    <small style="color:green">in case of specific date bonus select "Specific Date. "</small>
                                    <small style="color:green">in case of start and end date select "From Till. "</small>
                                    <small style="color:green">in case of recurring bonus select "Recurring"</small>
                                </div>
                            </div>
                            <div id="from_till" class="group" >
                                <div class="form-group row">
                                    <label for="from" class="col-md-3 col-form-label text-md-right">From : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="from">
                                        </div>
                                        <small style="color:green">select start date</small>
                                        @if ($errors->has('from'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('from') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="till" class="col-md-3 col-form-label text-md-right">Till : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="till">
                                        </div>
                                        <small style="color:green">select end date</small>
                                        @if ($errors->has('till'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('till') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="specific_date" class="group" >
                                <div class="form-group row">
                                    <label for="specific_day" class="col-md-3 col-form-label text-md-right">Specific Day  : </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <input type="date" class="form-control" name="specific_day">
                                        </div>
                                        <small style="color:green">select specific date</small>
                                        @if ($errors->has('specific_day'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('specific_day') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div id="recurring" class="group" >
                                <div class="form-group row">
                                    <label for="Recurring_w" class="col-md-3 col-form-label text-md-right">Recurring   : </label>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <select name="recurring" id="Recurring_w" class="form-control">
                                                <option value="w">Weekly</option>
                                                <option value="m">Monthly</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select weekly or monthly</small>
                                        @if ($errors->has('recurring'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('recurring') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4" id="_Day">
                                        <div class="input-group">
                                            <select name="w_2" id="day_"  class="form-control recurring_options"  >
                                                <option value="Sat">Sat</option>
                                                <option value="Sun">Sun</option>
                                                <option value="Mon">Mon</option>
                                                <option value="Tue">Tue</option>
                                                <option value="Wed">Wed</option>
                                                <option value="Thu">Thu</option>
                                                <option value="Fri">Fri</option>
                                            </select>
                                        </div>
                                        <small style="color:green">select day of week</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4 d-none" id="_Date">
                                        <div class="input-group">
                                            <select name="w_2" id="_montly" class="form-control"  >
                                            </select>
                                        </div>
                                        <small style="color:green">select date of month</small>
                                        @if ($errors->has('w_2'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('w_2') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ex_country" class="col-md-3 col-form-label text-md-right">Excluded countries : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @php
                                            $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <select class="form-control" id="multi_country" multiple="multiple" name="ex_country[]">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <small style="color:green">select excluded countries from bonus if any.otherwise leave empty</small>
                                    @if ($errors->has('ex_country'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('ex_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    <small style="color:green">select bonus status</small>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                @if(Session::get('bonus_type') == 4)
                    <div class="card-body">
                        <div class="card-header mb-3">
                            <h4>Payment Method Bonus</h4>
                        </div>
                        <form action="{{ route('admin.method_Bonus') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Name : </label>

                                <div class="col-md-8">
                                    <input id="bonus_name" type="text" class="form-control {{ $errors->has('bonus_name') ? ' is-invalid' : '' }}" name="bonus_name" value="{{ old('bonus_name') }}" required>
                                    @if ($errors->has('bonus_name'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('bonus_name') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-3 col-form-label text-md-right">Deposit method : </label>

                                <div class="col-md-8">
                                    <input id="deposit_method" type="text" class="form-control {{ $errors->has('deposit_method') ? ' is-invalid' : '' }}" name="deposit_method" value="{{ old('deposit_method') }}" required>
                                    @if ($errors->has('deposit_method'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('deposit_method') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <!-- End bonus_code -->
                            <div class="form-group row">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Bonus Amount Type : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select id="bo_am_type" class="form-control">
                                            <option value="a">Amount</option>
                                            <option value="p">Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Bonus Amount : </label>
                                <div class="col-md-8" >
                                    <div class="input-group">
                                        <input id="bonus_amount" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}">
                                    </div>
                                    @if ($errors->has('bonus_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-none" id="_percent_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Percentage Amount : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="percent_amount" placeholder="amount percentage" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('percent_amount') ? ' is-invalid' : '' }}" name="percent_amount" value="{{ old('percent_amount') }}">
                                        <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$ / %</button>
                                    </span>
                                    </div>
                                    @if ($errors->has('percent_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('percent_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-none" id="_max_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Max Amount : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="max_amount" placeholder="Max amount" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('max_amount') ? ' is-invalid' : '' }}" name="max_amount" value="{{ old('max_amount') }}">
                                    </div>
                                    @if ($errors->has('max_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Start bonus_amount -->
                            <div class="form-group row">
                                <label for="free_spin" class="col-md-3 col-form-label text-md-right">Amount of Free Spins : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="free_spin" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('free_spin') ? ' is-invalid' : '' }}" name="free_spin" value="{{ old('free_spin') }}" required>

                                    </div>
                                    @if ($errors->has('free_spin'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('free_spin') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Games : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_Game" name="games[]"  multiple="multiple">
                                            @foreach ($games as $item)
                                                <option value="{{ $item->id }}" >{{ $item->game_title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('games'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('games') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Bet Size : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" min="0" name="bet_size" value="{{ old('bet_size') }}">
                                    </div>
                                    @if ($errors->has('bet_size'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('bet_size') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Lines : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" min="0" name="lines" value="{{ old('lines') }}">
                                    </div>
                                    @if ($errors->has('lines'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('lines') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="games" class="col-md-3 col-form-label text-md-right">Wagering requirement  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input TYPE="NUMBER" min="0" min="0" class="form-control" min="0" name="wagering_req" value="{{ old('wagering_req') }}">
                                    </div>
                                    @if ($errors->has('wagering_req'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('wagering_req') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="from" class="col-md-3 col-form-label text-md-right">From : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="from">
                                    </div>
                                    @if ($errors->has('from'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('from') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="till" class="col-md-3 col-form-label text-md-right">Till : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="till">
                                    </div>
                                    @if ($errors->has('till'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('till') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specific_day" class="col-md-3 col-form-label text-md-right">Specific Day  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="specific_day">
                                    </div>
                                    @if ($errors->has('specific_day'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('specific_day') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Recurring_w" class="col-md-3 col-form-label text-md-right">Recurring   : </label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select name="recurring" id="De_Recurring_w" class="form-control">
                                            <option value="w">Weekly</option>
                                            <option value="m">Monthly</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('recurring'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('recurring') }}</strong>
                                     </span>
                                    @endif
                                </div>
                                <div class="col-md-4" id="_de_Day">
                                    <div class="input-group">
                                        <select name="w_2"  class="form-control">
                                            <option value="Sat">Sat</option>
                                            <option value="Sun">Sun</option>
                                            <option value="Mon">Mon</option>
                                            <option value="Tue">Tue</option>
                                            <option value="Wed">Wed</option>
                                            <option value="Thu">Thu</option>
                                            <option value="Fri">Fri</option>
                                        </select>
                                    </div>
                                    <small style="color:green">select day</small>
                                    @if ($errors->has('w_2'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('w_2') }}</strong>
                                     </span>
                                    @endif
                                </div>
                                <div class="col-md-4 d-none" id="_de_Date">
                                    <div class="input-group">
                                        <select name="w_2" id="_Ddate" class="form-control">
                                        </select>
                                    </div>
                                    @if ($errors->has('w_2'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('w_2') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">VIP level : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_Vip" multiple="multiple" name="vip_level[]">
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('vip_level'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vip_level') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ex_country" class="col-md-3 col-form-label text-md-right">Excluded countries : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @php
                                            $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <select class="form-control" id="multi_country" multiple="multiple" name="ex_country[]">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('ex_country'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('ex_country') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aff_source" class="col-md-3 col-form-label text-md-right">Affiliate source : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="aff_source">
                                    </div>
                                    @if ($errors->has('aff_source'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('aff_source') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">Customer list : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_User" multiple="multiple" name="users[]">
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('users'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('users') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('status') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                @if(Session::get('bonus_type') == 5)
                    <div class="card-body">
                        <div class="card-header mb-3">
                            <h4>Cashback Bonus</h4>
                        </div>
                        <form action="{{ route('admin.cashback_Bonus') }}" method="post"  enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="bonus_name" class="col-md-3 col-form-label text-md-right">Bonus Name : </label>

                                <div class="col-md-8">
                                    <input id="bonus_name" type="text" class="form-control {{ $errors->has('bonus_name') ? ' is-invalid' : '' }}" name="bonus_name" value="{{ old('bonus_name') }}" required>
                                    @if ($errors->has('bonus_name'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('bonus_name') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>

                            <!-- End bonus_code -->
                            <div class="form-group row">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Bonus Amount Type : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select id="bo_am_type" class="form-control">
                                            <option value="a">Amount</option>
                                            <option value="p">Percentage</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Bonus Amount : </label>
                                <div class="col-md-8" >
                                    <div class="input-group">
                                        <input id="bonus_amount" TYPE="NUMBER" min="0" min="0" min="0" class="form-control {{ $errors->has('bonus_amount') ? ' is-invalid' : '' }}" name="bonus_amount" value="{{ old('bonus_amount') }}">
                                    </div>
                                    @if ($errors->has('bonus_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bonus_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-none" id="_percent_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Percentage Amount : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="percent_amount" placeholder="amount percentage" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('percent_amount') ? ' is-invalid' : '' }}" name="percent_amount" value="{{ old('percent_amount') }}">
                                        <span class="input-group-append">
                                        <button class="btn btn-secondary" type="button">$ / %</button>
                                    </span>
                                    </div>
                                    @if ($errors->has('percent_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('percent_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-none" id="_max_amount">
                                <label for="_amount_type" class="col-md-3 col-form-label text-md-right">Max Amount : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="max_amount" placeholder="Max amount" TYPE="NUMBER" min="0" min="0" class="form-control {{ $errors->has('max_amount') ? ' is-invalid' : '' }}" name="max_amount" value="{{ old('max_amount') }}">
                                    </div>
                                    @if ($errors->has('max_amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('max_amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-3 col-form-label text-md-right">Minimum Loss : </label>

                                <div class="col-md-8">
                                    <input id="min_loss" type="text" class="form-control {{ $errors->has('min_loss') ? ' is-invalid' : '' }}" name="min_loss" value="{{ old('min_loss') }}" required>
                                    @if ($errors->has('min_loss'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('min_loss') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="from" class="col-md-3 col-form-label text-md-right">From : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="from">
                                    </div>
                                    @if ($errors->has('from'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('from') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="till" class="col-md-3 col-form-label text-md-right">Till : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="till">
                                    </div>
                                    @if ($errors->has('till'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('till') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specific_day" class="col-md-3 col-form-label text-md-right">Specific Day  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="specific_day">
                                    </div>
                                    @if ($errors->has('specific_day'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('specific_day') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Recurring_w" class="col-md-3 col-form-label text-md-right">Recurring   : </label>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <select name="recurring" id="De_Recurring_w" class="form-control">
                                            <option value="w">Weekly</option>
                                            <option value="m">Monthly</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('recurring'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('recurring') }}</strong>
                                     </span>
                                    @endif
                                </div>
                                <div class="col-md-4" id="_de_Day">
                                    <div class="input-group">
                                        <select name="w_2"  class="form-control">
                                            <option value="Sat">Sat</option>
                                            <option value="Sun">Sun</option>
                                            <option value="Mon">Mon</option>
                                            <option value="Tue">Tue</option>
                                            <option value="Wed">Wed</option>
                                            <option value="Thu">Thu</option>
                                            <option value="Fri">Fri</option>
                                        </select>
                                    </div>
                                    <small style="color:green">select day</small>
                                    @if ($errors->has('w_2'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('w_2') }}</strong>
                                     </span>
                                    @endif
                                </div>
                                <div class="col-md-4 d-none" id="_de_Date">
                                    <div class="input-group">
                                        <select name="w_2" id="_Ddate" class="form-control">
                                        </select>
                                    </div>
                                    @if ($errors->has('w_2'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('w_2') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">VIP level : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_Vip" multiple="multiple" name="vip_level[]">
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('vip_level'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('vip_level') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ex_country" class="col-md-3 col-form-label text-md-right">Excluded countries : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        @php
                                            $countries = DB::table('countries')->orderBy('name', 'asc')->get();
                                        @endphp
                                        <select class="form-control" id="multi_country" multiple="multiple" name="ex_country[]">
                                            @foreach ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('ex_country'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('ex_country') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="aff_source" class="col-md-3 col-form-label text-md-right">Affiliate source : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="aff_source">
                                    </div>
                                    @if ($errors->has('aff_source'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('aff_source') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="users" class="col-md-3 col-form-label text-md-right">Customer list : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" id="multi_User" multiple="multiple" name="users[]">
                                            @foreach ($user as $item)
                                                <option value="{{ $item->id }}">{{ $item->user_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if ($errors->has('users'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('users') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status  : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">inactive</option>
                                        </select>
                                    </div>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $errors->first('status') }}</strong>
                                     </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-8 offset-md-3">
                                    <button type="submit" class="btn btn-primary float-left mr-3">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->


@endsection
@section('script')
    <script src="{{ asset('backend/js/bonus.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.group').hide();
            $('#specific_date').show();
            $('#bonus_cat').change(function () {
                $('.group').hide();
                $('#'+$(this).val()).show();
            })
        });
    </script>
@endsection
