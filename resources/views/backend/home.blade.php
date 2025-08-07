@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')

    @php
        $earing = DB::table('prosix_user_wallets')->where('user_id',1)->first();
        $tok = DB::table('token_currencies')->where('doller',1)->where('status',1)->first();
        $game = DB::table('add_games')->count();
        $user = DB::table('users')->where('status',1)->where('access_status',1)->count();
        $total_games_played = DB::table('game_sessions')->count();
        $total_deposits = DB::table('deposits')->sum('amount');
        $total_deposits_requests = DB::table('deposits')->count();
        $total_withdraws = DB::table('withdraws')->where('status',1)->sum('amount');
        $total_withdraws_requests = DB::table('withdraws')->count();
        $tokencurrency = DB::table('token_currencies')->where('status',1)->first();
        $total_withdraws=$total_withdraws/$tokencurrency->pley6_token;
        //charts data
           $deposits          = DB::table('deposits')->select('deposits.*')->get();
            $withdraws  	   = DB::table('withdraws')->select('withdraws.*')->get();
            $add_games  	   = DB::table('add_games')
                ->select('add_games.*', \Illuminate\Support\Facades\DB::raw('count(game_id) as total_sessions'))
                ->join('game_sessions','game_sessions.game_id','=','add_games.id')
                ->groupBy('id')
                ->get();
            $child_games =  DB::table('add_games')
                ->select('add_games.*', DB::raw('SUM(bet_size*payline) as betsize'),DB::raw('count(game_id) as total_sessions'))
                ->join('game_session_childs','game_session_childs.game_id','=','add_games.id')
                ->groupBy('game_id')
                ->get();
    @endphp
    <!-- Home Page Header Section Start -->
    @can('Dashboard')
        <div class="row">
            <div class="col-12 col-md-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-2">{{ @$game }}</h3>
                                <div class="mb-0">Total Games</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-success" data-feather="play"></i>
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
                                <h3 class="mb-2">{{@$total_games_played}}</h3>
                                <div class="mb-0">Total Games Sessions</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-success" data-feather="play"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--         <div class="col-12 col-md-6 col-xl d-flex">
                        <div class="card flex-fill">
                            <div class="card-body py-4">
                                <div class="row">
                                    <div class="col-8">
                                        <h3 class="mb-2">0</h3>
                                        <div class="mb-0">Total Investors</div>
                                    </div>
                                    <div class="col-4 ml-auto text-right">
                                        <div class="d-inline-block mt-2">
                                            <i class="feather-lg text-success" data-feather="shopping-bag"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
            <div class="col-12 col-md-6 col-xl d-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-2">{{ @$user}}</h3>
                                <div class="mb-0">Total Players</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-success" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl d-none d-xxl-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-2">$ 0.00</h3>
                                <div class="mb-0">Total Invest</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-info" data-feather="dollar-sign"></i>
                                </div>
                            </div>
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
                                <h3 class="mb-2">{{@$total_deposits_requests}}</h3>
                                <div class="mb-0">Total Deposit Requests</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-info" data-feather="inbox"></i>
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
                                <h3 class="mb-2">{{ @$total_deposits }}</h3>
                                <div class="mb-0">Total Deposited Amount</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-info" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-xl d-none d-xxl-flex">
                <div class="card flex-fill">
                    <div class="card-body py-4">
                        <div class="row">
                            <div class="col-8">
                                <h3 class="mb-2">{{@$total_withdraws_requests}}</h3>
                                <div class="mb-0">Total Withdrawal Requests</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-info" data-feather="inbox"></i>
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
                                <h3 class="mb-2">{{ @$total_withdraws}}</h3>
                                <div class="mb-0">Total Withdrawl Amount</div>
                            </div>
                            <div class="col-4 ml-auto text-right">
                                <div class="d-inline-block mt-2">
                                    <i class="feather-lg text-info" data-feather="dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Home Page Header Section End -->

        <div class="row">
            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Deposit & Withdraw Records (Monthly)</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- LINE CHART -->
                <div class="card card-info" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title">Line Chart</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- STACKED BAR CHART -->
                <div class="card card-success" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title">Stacked Bar Chart</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="stackedBarChart" style="height:230px; min-height:230px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col (RIGHT) -->
            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Deposit & Withdraw Records (Weekly)</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart_weekly" style="height:230px; min-height:230px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>

            <div class="col-md-6">
                <!-- PIE CHART -->
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Games Overview</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart_total" style="height:630px; min-height:630px"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- AREA CHART -->
                <div class="card card-primary" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title">Area Chart</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="areaChart" style="height:250px; min-height:250px"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- DONUT CHART -->
                <div class="card card-danger" style="display: none;">
                    <div class="card-header">
                        <h3 class="card-title">Donut Chart</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <canvas id="donutChart" style="height:230px; min-height:230px"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Game Sessions</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <canvas id="pieChart_games" style="height:630px; min-height:630px"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Game Wise Number Of  Wagered Count</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <canvas id="child_sessions" style="height:630px; min-height:630px"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Game Wise Bet Amount</h3>

                        {{--                        <div class="card-tools">--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>--}}
                        {{--                            </button>--}}
                        {{--                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="card-body">
                        <canvas id="child_bestsize" style="height:430px; min-height:630px"></canvas>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col (LEFT) -->
        </div>
        <!-- /.row -->
    @endcan
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
            {{--            @foreach($deposits as $deposit)--}}
            {{--                var m = "{{date('M',strtotime($deposit->created_at))}}";--}}
            {{--                alert(m)--}}
            {{--                @endforeach--}}
            <?php
            $monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ];
            $WeeNames = ["","Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
            ?>
            //bar charts for deposits and withdraws
            var areaChartData = {
                labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','Sept','Oct','Nov','Dec'],
                datasets: [
                    {
                        label               : 'Deposits',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [
                            @for($i=0;$i<12;$i++)
                            <?php $counter = 0?>
                            @foreach($deposits as $deposit)
                            @if(date('Y',strtotime($deposit->created_at))==now()->year && date('M',strtotime($deposit->created_at))==$monthNames[$i])
                            <?php $counter+=$deposit->amount ?>
                            @endif
                            @endforeach
                            {{$counter}},
                            @endfor
                            // 28, 48, 40, 19, 86, 27, 90
                        ]
                    },
                    {
                        label               : 'Withdraws',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [
                            @for($i=0;$i<12;$i++)
                            <?php $counter = 0?>
                            @foreach($withdraws as $withdraw)
                            @if(date('Y',strtotime($withdraw->created_at))==now()->year && date('M',strtotime($withdraw->created_at))==$monthNames[$i])
                            <?php $counter+=$withdraw->amount ?>
                            @endif
                            @endforeach
                            {{$counter}},
                            @endfor
                            // 28, 48, 40, 19, 86, 27, 90
                        ]
                    },
                ]
            }
            var areaChartData1 = {
                <?php
                    $year        = now()->year;
                    $month       = now()->month;
                    $date        = \Carbon\Carbon::createFromDate($year,$month,1);
                    $days        = cal_days_in_month(CAL_GREGORIAN,$month,$year)
                    ?>
                labels  : [
                    @for($i=1;$i<=$days;$i+=7)
                        @if($i+7>=$days)
                        "{{$i}}-{{($i+7-$days)}}",
                    @else
                        "{{$i}}-{{$i+6}}",
                    @endif
                    @endfor
                ],
                datasets: [
                    {
                        label               : 'Deposits',
                        backgroundColor     : 'rgba(60,141,188,0.9)',
                        borderColor         : 'rgba(60,141,188,0.8)',
                        pointRadius          : false,
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : [
                            @for($i=1;$i<=$days;$i+=7)
                            <?php $counter = 0?>
                            @foreach($deposits as $deposit)
                            @if(date('Y',strtotime($deposit->created_at))==now()->year && date('M',strtotime($deposit->created_at))==$monthNames[$month-1] && ((date('d',strtotime($deposit->created_at)))>=$i && (date('d',strtotime($deposit->created_at))<$i+7)))
                            <?php $counter+=$deposit->amount ?>
                            @endif
                            @endforeach
                            {{$counter}},
                            @endfor
                            // 28, 48, 40, 19, 86, 27, 90
                        ]
                    },
                    {
                        label               : 'Withdraws',
                        backgroundColor     : 'rgba(210, 214, 222, 1)',
                        borderColor         : 'rgba(210, 214, 222, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(210, 214, 222, 1)',
                        pointStrokeColor    : '#c1c7d1',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [
                            @for($i=1;$i<=$days;$i+=7)
                            <?php $counter = 0?>
                            @foreach($withdraws as $withdraw)
                            @if(date('Y',strtotime($withdraw->created_at))==now()->year && date('M',strtotime($withdraw->created_at))==$monthNames[$month-1] && ((date('d',strtotime($withdraw->created_at)))>=$i && (date('d',strtotime($withdraw->created_at))<$i+7)))
                            <?php $counter+=$withdraw->amount ?>
                            @endif
                            @endforeach
                            {{$counter}},
                            @endfor
                            // 28, 48, 40, 19, 86, 27, 90
                        ]
                    },
                ]
            }
            var areaChartOptions = {
                maintainAspectRatio : false,
                responsive : true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }],
                    yAxes: [{
                        gridLines : {
                            display : false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            var areaChart       = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })

            //-------------
            //- LINE CHART -
            //--------------
            var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
            var lineChartData = jQuery.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            var lineChart = new Chart(lineChartCanvas, {
                type: 'line',
                data: lineChartData,
                options: lineChartOptions
            })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData        = {
                labels: [
                    'Game Sessions',
                    'Total Spins',
                    'Total Bet Size',
                ],
                datasets: [
                    {
                        data: [
                            {{$add_games->sum('total_sessions')}},{{$child_games->sum('total_sessions')}},{{$child_games->sum('betsize')}}

                        ],
                        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                    }
                ]
            }

            var games_data       = {
                labels: [
                    @foreach($add_games as $add_game)
                        '{{$add_game->game_title}}',
                    @endforeach
                ],
                datasets: [
                    {
                        data: [
                            @foreach($add_games as $add_game)
                                '{{$add_game->total_sessions}}',
                            @endforeach
                        ],
                        @php
                            $chars = "ABCDEF0123456789";
                             $size = strlen( $chars );
                        @endphp
                        backgroundColor : [
                            @for( $i = 0; $i < $add_games->count(); $i++ )
                                @php
                                    $color = "";
                                @endphp
                                @for( $j = 0; $j < 6; $j++ )
                                @php
                                    $color .=$chars[ rand( 0, $size - 1 ) ]
                                @endphp
                                @endfor
                                "#{{$color}}",
                            @endfor
                        ],
                    }
                ]

            }
            var child_sessions   = {
                labels: [
                    @foreach($child_games as $child_game)
                        '{{$child_game->game_title}}',
                    @endforeach
                ],
                datasets: [
                    {
                        data: [
                            @foreach($child_games as $add_game)
                                '{{$add_game->total_sessions}}',
                            @endforeach
                        ],
                        @php
                            $chars = "ABCDEF0123456789";
                             $size = strlen( $chars );
                        @endphp
                        backgroundColor : [
                            @for( $i = 0; $i < $child_games->count(); $i++ )
                                @php
                                    $color = "";
                                @endphp
                                @for( $j = 0; $j < 6; $j++ )
                                @php
                                    $color .=$chars[ rand( 0, $size - 1 ) ]
                                @endphp
                                @endfor
                                "#{{$color}}",
                            @endfor
                        ],
                    }
                ]
            }
            var child_betsize   = {
                labels: [
                    @foreach($child_games as $child_game)
                        '{{$child_game->game_title}}',
                    @endforeach
                ],
                datasets: [
                    {
                        data: [
                            @foreach($child_games as $add_game)
                                '{{$add_game->betsize}}',
                            @endforeach
                        ],
                        @php
                            $chars = "ABCDEF0123456789";
                             $size = strlen( $chars );
                        @endphp
                        backgroundColor : [
                            @for( $i = 0; $i < $child_games->count(); $i++ )
                                @php
                                    $color = "";
                                @endphp
                                @for( $j = 0; $j < 6; $j++ )
                                @php
                                    $color .=$chars[ rand( 0, $size - 1 ) ]
                                @endphp
                                @endfor
                                "#{{$color}}",
                            @endfor
                        ],
                    }
                ]
            }
            var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart_total').get(0).getContext('2d')
            var pieData        = donutData;
            var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            // pi chart game sessions
            var game_session_convas = $('#pieChart_games').get(0).getContext('2d')
            var pieData        = games_data;
            var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            var pieChart = new Chart(game_session_convas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })


            //pi chart child game sessions
            var child_session_convas = $('#child_sessions').get(0).getContext('2d')
            var pieData        = child_sessions;
            var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            var pieChart = new Chart(child_session_convas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })


            //pi chart child betsize
            var child_bestsize_convas = $('#child_bestsize').get(0).getContext('2d')
            var pieData        = child_betsize;
            var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            var pieChart = new Chart(child_bestsize_convas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartCanvas1 = $('#barChart_weekly').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var barChartData1 = jQuery.extend(true, {}, areaChartData1)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
            var barChart1 = new Chart(barChartCanvas1, {
                type: 'bar',
                data: barChartData1,
                options: barChartOptions
            })


            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = jQuery.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            var stackedBarChart = new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })
        })
        {{--function randColor($numColors ) {--}}
        {{--    @php--}}
        {{--        $chars = "ABCDEF0123456789";--}}
        {{--         $size = strlen( $chars );--}}
        {{--    @endphp--}}
        {{--        @for( $i = 0; $i < $child_games->count(); $i++ )--}}
        {{--    @php--}}
        {{--        $color = "";--}}
        {{--    @endphp--}}
        {{--            @for( $j = 0; $j < 6; $j++ )--}}
        {{--            @php--}}
        {{--                $color .=$chars[ rand( 0, $size - 1 ) ]--}}
        {{--            @endphp--}}
        {{--            @endfor--}}
        {{--          alert("{{$color}}")--}}
        {{--    @endfor--}}
        {{--}--}}
    </script>
@endsection
