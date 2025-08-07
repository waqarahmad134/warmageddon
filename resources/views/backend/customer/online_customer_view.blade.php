@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')

@php
     $tok = DB::table('token_currencies')->where('doller',1)->where('status',1)->first();
     $_total = isset($user->payment) ? $user->payment->count() : 0;
@endphp
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Customer Profile</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer_info') }}">Customer Information</a></li>
                            <li class="breadcrumb-item active">Customer Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <center>
                    <img src="{{@$user->profile->base_image?url(@$user->profile->base_image):asset('frontend/images/avater.png')}}" name="aboutme" width="140" height="140" border="0" class="img-circle"></a>
                     <h3 class="media-heading text-capitalize">{{ @$user->profile->first_name}} {{ @$user->profile->last_name}} <small>{{ @$user->user_name }}</small></h3>
                     <span>
                        @if (@$user->isOnline())
                        Online <i class="fas fa-circle text-primary"></i>
                        @else
                         Offline <i class="fas fa-circle text-danger"></i>
                       @endif
                     </span>
                     <div class="mt-4"><strong></strong></div>
                     <a type="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="To email the customer"  href="mailto:{{env('MAIL_USERNAME')}}">Email</a>
                     <button type="button" class="btn btn-outline-success" data-placement="top" title="To apply bonuses" data-toggle="modal" data-target="#bonus">Bonus</button>
                     <!-- <button type="button" class="btn btn-outline-danger"  data-placement="top" title="To leave a note" data-toggle="modal" data-target="#leave">Leave a note</button> -->
                     <a type="button" class="btn btn-outline-danger"  data-placement="top" title="To leave a note"  href="{{route('UsaerMessage',$user->id)}}">Leave a note</a>
                     <button type="button" class="btn btn-outline-info" data-toggle="tooltip" data-placement="top" title="To call a customer" href="callto:{{ @$user->country_code }} {{ @$user->phone }}">Call </button>
                     <div class="mb-4"><strong></strong></div>
                     <div class="row">
                        <div class="col-12 col-md-6 col-xl d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="col-8">
                                        <h3 class="mb-2">${{ floatval(@$user->account->total) / floatval($tok->pley6_token) }}</h3>
                                            <div class="mb-0">Real money balance</div>
                                        </div>
                                        <div class="col-4 ml-auto text-right">
                                            <div class="d-inline-block mt-2">
                                                <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="col-8">
                                        <h3 class="mb-2">${{ @$user->bonus->sum('amount') / floatval($tok->pley6_token) }}</h3>
                                            <div class="mb-0">Promo Balance</div>
                                        </div>
                                        <div class="col-4 ml-auto text-right">
                                            <div class="d-inline-block mt-2">
                                                <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl d-flex">
                            <div class="card flex-fill">
                                <div class="card-body py-4">
                                    <div class="row">
                                        <div class="col-8">
                                        <h3 class="mb-2">65</h3>
                                            <div class="mb-0">Rewards points</div>
                                        </div>
                                        <div class="col-4 ml-auto text-right">
                                            <div class="d-inline-block mt-2">
                                                <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                    </center>
                    <hr>
                    <center>
                        <p class="text-left"><b>GENERAL INFORMATION : </b><br>
                            <div class="ml-4 text-left">
                                <ul>
                                    <li><p>Account Status    : 
                                        @if ($user->access_status == 0)
                                             <a class="btn btn-danger btn-sm text-white">Block</a>                                                                                             
                                            @endif
                                            @if ($user->access_status == 1 && $user->status == 0)
                                            <a class="btn btn-warning btn-sm text-white">Pending</a>                                                                                             
                                            @endif
                                            @if ($user->access_status == 1 && $user->status == 1)
                                            <a class="btn btn-primary btn-sm text-white">Active</a> 
                                            @endif
                                        </a>
                                        </p></li>
                                        <li><p>Last login     : {{ isset($user->last_login_at) ? \Carbon\Carbon::parse($user->last_login_at)->diffforhumans() :''}}</p></li>
                                        <li><p>Account number    : 6666-0{{ @$user->account->id }}</p></li>
                                        <li><p>Username            : {{ @$user->user_name  }}</p></li>
                                        <li><p>Name              :{{ @$user->profile->first_name}} {{ @$user->profile->last_name}} </p> </li>
                                        <li><p>Email  : {{ $user->email }}</p></li>
                                        <li><p>Phone number : +{{ @$user->country_code }}{{ @$user->phone }}</p></li>
                                        <li><p>Date of birth            : {{ @$user->profile->date_of_birth  }}</p></li>
                                        <li><p>Age     : {{ \Carbon\Carbon::parse($user->profile->date_of_birth)->age }}</p></li>
    
                                        <li><p>Gender         :  @if (@$user->profile->gender == 'M')
                                                                    Male
                                                                    @endif
                                                                    @if (@$user->profile->gender == 'F')
                                                                    Female                                         
                                                                    @endif
                                                                </p>
                                                                </li>
    
                                        <li><p>Country     : {{ @$user->Country->name}}</p></li>
                                        <li><p>Player Level      : VIP level</p></li>
                                        <li><p>Currency      : Dollar</p></li>
                                        <li><p>Social media: 
                                                <ul>
                                                    <li><a href="">facebook</a></li>
                                                    <li><a href="">Instagram</a></li>
                                                    <li><a href="">LinkedIn</a></li>
                                                </ul>
                                            </p>
                                        </li>
                                    <li><p>Document Status: <button class="btn btn-warning btn-sm" >Pending</button></p></li>
                                </ul>
                            </div>
                        </p>
                        <br>
                    </center>
                    <center>
                        <p class="text-left"><b>FINANCIAL INFORMATION : </b><br>
                            <div class="ml-4 text-left">
                                <ul>
                                    <li><p>Real Balance              : ${{ floatval(@$user->account->total) / floatval($tok->pley6_token) }} </p> </li>
                                    <li><p>Promo Balance             : ${{ @$user->bonus->sum('amount') / floatval($tok->pley6_token) }}</p></li>
                                    <li><p>Total Payments            : ${{ @$user->payment->sum('amount')  }}</p></li>
                                    <li><p>Last payment sent         : ${{ isset($last_payment)? $last_payment->amount : 0   }} </p></li>
                                    <li><p>First purchase date       : {{ isset($first_payment) ? \Carbon\Carbon::parse($first_payment->created_at)->diffforhumans() :''  }}</p></li>
                                    <li><p>Last purchase date       : {{ isset($last_payment) ? \Carbon\Carbon::parse($last_payment->created_at)->diffforhumans() :''  }}</p></li>
                                    <li><p>Average purchase amount   : ${{ isset($user->payment) ? $user->payment->sum('amount') != 0 ? $user->payment->sum('amount') / $_total: 0 : 0 }}</p></li>
                                    <li><p>Deposit methods available : Stripe</p></li>
                                    <li><p>Withdraw methods available : Bank</p></li>
                                </ul>
                            </div>
                        </p>
                        <br>
                    </center>
                    
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Withdraw History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                              <td>ID</td>
                              <td>Date</td>
                              <td>Amount</td>
                              <td>Status</td>
                            </tr>
                            </thead>
                            <tbody>                             
                              <tr>
                                  <td>PS106901</td>
                                  <td> 2020-01-12 </td>
                                  <td>$50</td>
                                  <td><button class="btn btn-success btn-sm" >Approved</button></td>
                              </tr>
                              <tr>
                                  <td>PS106902</td>
                                  <td> 2020-01-12 </td>
                                  <td>$100</td>
                                  <td><button class="btn btn-warning btn-sm" >Pending</button></td>
                              </tr>
                              <tr>
                                  <td>PS106903</td>
                                  <td> 2020-01-12 </td>
                                  <td>$30</td> 
                                  <td><button class="btn btn-danger btn-sm" >Rejected</button></td>
                              </tr>
                              <tr>
                                  <td>PS106904</td>
                                  <td>2020-01-11 </td>
                                  <td>$70</td>
                                  <td><button class="btn btn-warning btn-sm" >Pending</button></td>
                              </tr>
                              <tr>
                                  <td>PS106905</td>
                                  <td> 2020-01-10 </td>
                                  <td>$80</td>
                                  <td><button class="btn btn-success btn-sm" >Approved</button></td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header text-center">
                    <h3>Deposit History</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                              <td>ID</td>
                              <td>Date</td>
                              <td>Amount</td>
                              <td>TYPE</td>
                              <td>Status</td>
                            </tr>
                            </thead>
                            <tbody>                             
                              @foreach (@$user->transaction as $key => $item)
                              @if ($item->type == 'deposit')                                                                               
                              <tr>
                                  <td>PS1069{{$key+1}}</td>
                                  <td> {{ date('y-m-d',strtotime($item->created_at)) }} </td>
                                  <td>${{ $item->amount}}</td>
                                  <td>{{ $item->type }}</td>
                                  <td><button class="btn btn-success btn-sm" >Successful</button></td>
                              </tr> 
                              @endif 
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
          <div class="row">
              <div class="col-12 col-md-6 col-xl d-flex">
              <div class="card flex-fill">
                  <div class="card-body py-4">
                      <div class="row">
                          <div class="col-8">
                          <h3 class="mb-2">${{ isset($user->payment) ? $user->payment->sum('amount') != 0 ? $user->payment->sum('amount') / $_total: 0 : 0 }}</h3>
                              <div class="mb-0">Total purchases</div>
                          </div>
                          <div class="col-4 ml-auto text-right">
                              <div class="d-inline-block mt-2">
                              <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                              
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-12 col-md-6 col-xl d-flex">
              <div class="card flex-fill">
                  <div class="card-body py-4">
                      <div class="row">
                          <div class="col-8">
                              @php
                                  $total_Rev = $user->balance->where('type','game lost')->sum('balance');
                              @endphp
                          <h3 class="mb-2">${{  @$total_Rev }}</h3>
                              <div class="mb-0">Total net revenue</div>
                          </div>
                          <div class="col-4 ml-auto text-right">
                              <div class="d-inline-block mt-2">
                              <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-12 col-md-6 col-xl d-flex">
              <div class="card flex-fill">
                  <div class="card-body py-4">
                      <div class="row">
                          <div class="col-8">
                          <h3 class="mb-2">12%</h3>
                              <div class="mb-0">Net Revenue %</div>
                          </div>
                          <div class="col-4 ml-auto text-right">
                              <div class="d-inline-block mt-2">
                              <i class="feather-lg text-success" data-feather="dollar-sign"></i>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
          <div class="row">
              <div class="col-md-6">
                  <h3 class="pt-3 pb-3">Favorite category </h3>
                  <canvas id="myChart"></canvas>
              </div>
              <script type="text/javascript">
                  var ctx = document.getElementById("myChart").getContext('2d');
                      var myChart = new Chart(ctx, {
                      type: 'pie',
                      data: {
                          labels: ["Black jack", "Craps", "Roulette online", "Bingo"],
                          datasets: [{
                          backgroundColor: [
                              "#2ecc71",
                              "#3498db",
                              "#95a5a6",
                              "#9b59b6"
                          ],
                          data: [12, 19, 3, 17]
                          }]
                      }
                      });
                </script>
  
              <div class="col-md-6">
                  <h3 class="pt-3 pb-3">Money wagered</h3>
                  <canvas id="Money_wagered"></canvas>
              </div>
              <script type="text/javascript">
                  var mon = document.getElementById("Money_wagered").getContext('2d');
                      var myChar = new Chart(mon, {
                      type: 'pie',
                      data: {
                          labels: ["Casino Craps", "Pirates Slots", "Hunted Slots"],
                          datasets: [{
                          backgroundColor: [
                              "#f1c40f",
                              "#e74c3c",
                              "#34495e"
                          ],
                          data: [12, 19, 3]
                          }]
                      }
                      });
                </script>
          </div>

    <div class="modal fade" id="bonus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Bonus</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('UsaerBonus',$user->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Bonus Code</label>
                      <input type="text" name="bonus_code" class="form-control" min="6" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter code">
                      <small id="emailHelp" class="form-text text-muted">min 6 digit</small>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Bonus Type</label>
                       <select name="bonus_type" class="form-control">
                             <option value="1">Token</option>
                             <option value="2">Spin</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Bonus</label>
                        <input type="text" min="1" name="bonus" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter bonus">
                        <small id="emailHelp" class="form-text text-muted">min 1 bonus</small>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Valid Date</label>
                      <input type="date" name="valid_date" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Leave to note</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('UsaerLeaveMessage',$user->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail1">Body</label>
                      <textarea name="body" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
@endsection    