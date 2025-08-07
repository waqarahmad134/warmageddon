
@extends('frontend.layouts.front_app')


@section('content')


<section class="accout-bg-image">
    <div class="slider-overlay"></div>
</section>

<section class="account-info-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="welcome-title"><h2>Welcome <?php echo ($logged_in_user->gender == 'male') ? 'Mr. ' : 'Ms. ' ?><span>{{ $logged_in_user->name }}</span></h2></div>
            </div>
            <div class="col-md-4">
                <div class="account-boxes" data-aos="flip-left">
                    <div class="heading">
                        <h2>Personal <span>Information</span></h2>
                    </div>
                    <div class="info-box pt-20">
                        <p>User Name: <span><i>{{ $logged_in_user->name }}</i></span></p>
                        <p>Date of Birth: <span>{{ $logged_in_user->dob }}</span></p>
                        <p>Email: <span>{{ $logged_in_user->email }}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="account-boxes" data-aos="flip-left">
                    <div class="heading">
                        <h2>Status <span>Information</span></h2>
                    </div>
                    <div class="info-box pt-20">
                        <p>Status: <span>Active</span><a class="not-verified" href="#" data-toggle="modal" data-target="#verification">(Not verified)</a></p>
                        <p>Last Login: <span> {{ $logged_in_user->updated_at->diffForHumans() }}</span></p>
                        <p>Street: <span>3</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="account-boxes" data-aos="flip-left">
                    <div class="heading">
                        <h2>Contact <span>Information</span></h2>
                    </div>
                    <div class="info-box pt-20">
                        <p>Phone No: <span>012-123-1234</span></p>
                        <p>Registration City: <span>Abcd</span></p>
                        <p>Registration Country: <span>Canada</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- server messages -->
@include('includes.partials.messages')
<!-- server messages end-->
<!-- Account Detail start -->
<section class="accout-detail-section pb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-3"> <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav acc-detail">
                    <li class="active"><a href="#profile-v" data-toggle="tab">Profile</a></li>
                    <li><a href="#finance-v" data-toggle="tab">Finance</a></li>
                    <li><a href="#gameplay-history-v" data-toggle="tab">Gameplay History</a></li>
                    <li><a href="#affiliate-center-v" data-toggle="tab">Affiliate Center</a></li>
                    <li><a href="#rgc-option-v" data-toggle="tab">RGC Option</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <!-- Tab panes -->
                <div class="tab-content ">
                    <div class="tab-pane active" id="profile-v"> 
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#change-details">Change Details</a></li>
                            <li><a data-toggle="tab" href="#change-password">Change Password</a></li>
                            <li><a data-toggle="tab" href="#admin-messages">Admin Messages</a></li>
                            <li><a data-toggle="tab" href="#login-history">Login History</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="change-details" class="tab-pane fade in active">
                                @include('frontend.user.account.tabs.edit-name')


                            </div> 
                            <div id="change-password" class="tab-pane fade">
                                @include('frontend.user.account.tabs.edit-password')

                            </div>
                            <div id="admin-messages" class="tab-pane fade">
                                @include('frontend.user.account.tabs.admin-messages')

                            </div>
                            <div id="login-history" class="tab-pane fade">
                                @include('frontend.user.account.tabs.login-history')

                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="finance-v">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#current-details">Current Details</a></li>
                            <li><a data-toggle="tab" href="#deposit">Deposit</a></li>
                            <li><a data-toggle="tab" href="#withdraw">Withdrawals</a></li>
                            <li><a data-toggle="tab" href="#other-transactions">Other Transactions</a></li>
                            <li><a data-toggle="tab" href="#instant-bonuses">Instant Bonuses</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="current-details" class="tab-pane fade in active">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-4">
                                            <div class="current-details-box">
                                                <p>Bet: <span>0.00 $</span></p>
                                                <p>Won: <span>0.00 $</span></p>
                                                <p>VIP Points: <span>0<a class="vip-shop" href="#" >(VIP Shop)</a></span></p>
                                                <p>Profit: <span>0.00 $</span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="current-details-box">
                                                <p>Instant Bonuses: <span>100.00 $</span></p>
                                                <p>Total rollover requirement:<span>1,000.00 $</span><a class="instant-bonus-detail" href="#" data-toggle="modal" data-target="#rollover-check">(?)</a></p>
                                                <p>Total wagered for rollover: <span>0.00 $</span>(0.00%)</p>
                                                <p>Game Banned: <a class="game-banned-detail" href="#" data-toggle="modal" data-target="#game-banned">(View)</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="deposit" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Transactions history</h3></div>
                                        <table id="deposit-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Payment Method</th>
                                                    <th>Type</th>
                                                    <th>Other Details</th>
                                                    <th>Balance Changes</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="withdraw" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Transactions history</h3></div>
                                        <table id="withdraw-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Payment Method</th>
                                                    <th>Type</th>
                                                    <th>Other Details</th>
                                                    <th>Balance Changes</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="other-transactions" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Transactions history</h3></div>
                                        <table id="other-transactions-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Payment Method</th>
                                                    <th>Type</th>
                                                    <th>Other Details</th>
                                                    <th>Balance Changes</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="instant-bonuses" class="tab-pane fade">
                                <div class='row'>
                                    <div class="col-md-12 pt-20 text-right">
                                        <a class="edit-bonus-code" href="#" data-toggle="modal" data-target="#bonus-code">Edit Favorite Bonus Code</a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Active instant bonuses with rollover</h3></div>
                                        <table id="instant-bonuses-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Type</th>
                                                    <th>Deposit Value</th>
                                                    <th>Bonus Value</th>
                                                    <th>Amount Needed</th>
                                                    <th>Total Bet</th>
                                                    <th>Completed (%)</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Confirmation Status</th>
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
                    <div class="tab-pane" id="gameplay-history-v">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#single-player">Singleplayer Games</a></li>
                            <li><a data-toggle="tab" href="#multiplayer-bingo">Multiplayer Bingo</a></li>
                            <li><a data-toggle="tab" href="#multiplayer-lottery">Multiplayer Lottery</a></li>
                            <li><a data-toggle="tab" href="#multiplayer-racing">Multiplayer Racing</a></li>
                            <li><a data-toggle="tab" href="#multiplayer-scibo">Multiplayer Scibo</a></li>
                            <li><a data-toggle="tab" href="#multiplayer-am-roulette">Multiplayer AM Roulette</a></li>
                            <li><a data-toggle="tab" href="#multiplayer-eu-roulette">Multiplayer EU Roulette</a></li>
                            <li><a data-toggle="tab" href="#slots-tournament">Slots Tournaments</a></li>
                            <li><a data-toggle="tab" href="#prizes">prizes</a></li>

                        </ul>
                        <div class="tab-content">
                            <div id="single-player" class="tab-pane fade in active">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Game ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Game Name</label>
                                            <div class="col-sm-9 p-0">
                                                <select class="form-control" >
                                                    <option>All Games</option>
                                                    <option>Game 1</option>
                                                    <option>Game 2</option>
                                                    <option>Game 3</option>
                                                    <option>Game 4</option>
                                                    <option>Game 5</option>
                                                    <option>Game 6</option>

                                                </select>

                                            </div>
                                        </div> 
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-6 p-0 control-label">Game with Bets total only:</label>
                                            <div class="col-sm-6 p-0">
                                                <label class="cust-check">
                                                    <input type="checkbox" checked="checked">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Gameplay History</h3></div>
                                        <table id="single-player-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Game</th>
                                                    <th>Start Date/ End Date</th>
                                                    <th>Mode</th>
                                                    <th>Credit Before Gameplay /Credit After Gameplay</th>
                                                    <th>Total Bet</th>
                                                    <th>Total Win</th>
                                                    <th>Profit</th>
                                                    <th>Provably Fair</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="multiplayer-bingo" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Ticket ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Multiplayer Bingo - Gameplay history </h3></div>
                                        <table id="multiplayer-bingo-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Ticket ID</th>
                                                    <th>Draw ID</th>
                                                    <th>Ticket Number</th>
                                                    <th>Game Played</th>
                                                    <th>Date</th>
                                                    <th>Bet</th>
                                                    <th>Won</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="multiplayer-lottery" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Ticket ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Multiplayer Lottery - Gameplay history</h3></div>
                                        <table id="multiplayer-lottery-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Ticket ID</th>
                                                    <th>Lottery Name ID</th>
                                                    <th>Date</th>
                                                    <th>Lottery Draw Time</th>
                                                    <th>Bet</th>
                                                    <th>Won</th>
                                                    <th>Profit</th>
                                                    <th>Ticket Content</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="multiplayer-racing" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Gameplay ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Multiplayer Racing Games - Gameplay history</h3></div>
                                        <table id="multiplayer-racing-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Round ID</th>
                                                    <th>Podium</th>
                                                    <th>Game</th>
                                                    <th>Date</th>
                                                    <th>Bet</th>
                                                    <th>Won</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="multiplayer-scibo" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Gameplay ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Multiplayer Sic Bo - Gameplay history </h3></div>
                                        <table id="multiplayer-scibo-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Gameplay ID</th>
                                                    <th>Round ID</th>
                                                    <th>Dices</th>
                                                    <th>Date</th>
                                                    <th>Bet</th>
                                                    <th>Won</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="multiplayer-am-roulette" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Gameplay ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Multiplayer AM Roulette - Gameplay history</h3></div>
                                        <table id="multiplayer-am-roulette-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Gameplay ID</th>
                                                    <th>Round ID</th>
                                                    <th>Drawn Number</th>
                                                    <th>Date</th>
                                                    <th>Bet</th>
                                                    <th>Won</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="multiplayer-eu-roulette" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Gameplay ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Multiplayer EU Roulette - Gameplay history</h3></div>
                                        <table id="multiplayer-eu-roulette-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Gameplay ID</th>
                                                    <th>Round ID</th>
                                                    <th>Drawn Number</th>
                                                    <th>Date</th>
                                                    <th>Bet</th>
                                                    <th>Won</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="multiplayer-eu-roulette" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Gameplay ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Multiplayer EU Roulette - Gameplay history</h3></div>
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Gameplay ID</th>
                                                    <th>Round ID</th>
                                                    <th>Drawn Number</th>
                                                    <th>Date</th>
                                                    <th>Bet</th>
                                                    <th>Won</th>
                                                    <th>Profit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="slots-tournament" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Gameplay ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Slots Tournaments - Ticket Purchase History</h3></div>
                                        <table id="slots-tournament-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Ticket ID</th>
                                                    <th>Date</th>
                                                    <th>Tournament ID/ Name</th>
                                                    <th>Entry Fee</th>
                                                    <th>Type</th>
                                                    <th>Remaining Play Credit</th>
                                                    <th>Total Score</th>
                                                    <th>Price Collected</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> 
                            </div>
                            <div id="prizes" class="tab-pane fade">
                                <div class="top-bg">
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Start Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">End Date</label>
                                            <div class="col-sm-9 p-0">
                                                <div class="input-group date" data-provide="datepicker">
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='row'>
                                        <div class="col-md-6 pb-10">
                                            <label class="col-sm-3 p-0 control-label">Gameplay ID</label>
                                            <div class="col-sm-9 p-0">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div> 
                                        <div class="col-md-6 text-right pb-10">  
                                            <div class="search-btn">
                                                <button type="button" class="btn btn-primary">Reset</button> 
                                                <button type="button" class="btn btn-primary">Search</button> 
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 pt-50">
                                        <div class="table-title"><h3>Prizes History</h3></div>
                                        <table id="prizes-table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Date</th>
                                                    <th>Won</th>
                                                    <th>Type</th>
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
                    <div class="tab-pane" id="affiliate-center-v">Affiliate Center</div>
                    <div class="tab-pane" id="rgc-option-v">RGC Option</div>
                </div>
            </div>
        </div>
</section>
<!-- Account Detail End -->
<div class="modal fade" id="verification" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Your identity is not verified. Please read the terms and conditions section related to Account verification to avoid account termination.</p>
                <div class="text-right search-btn"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button></div>
            </div>
            <!--                    <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>-->
        </div>
    </div>
</div> 
@endsection 