@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <form id="statistic-report" method="post" action="{{url('dash-panel/statistic-filter')}}">
        @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
              <input type="date" class="form-control" name="start_date">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : ''}}">
                <input type="date" class="form-control" name="end_date">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <button type="submit" value="Filter" class="btn btn-info">Filter Result</button>
                </div>
            </div>
                </div>
            </div>
    </div>
    </div>
    </form>
    <div class="row">
        <div class="col-12 col-md-6 col-xl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-2">
                                @php
                                $total_requests = 0;
                                @endphp
                                @foreach($result as $row)
                                    @foreach ($row->stats as $item)
                                   @php $total_requests+= $item->metrics->requests @endphp
                                    @endforeach
                                @endforeach
                                {{$total_requests}}
                            </h3>
                            <div class="mb-0">Total Email Requests</div>
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
                            <h3 class="mb-2">
                                @php
                                    $delivered = 0;
                                @endphp
                                @foreach($result as $row)
                                    @foreach ($row->stats as $item)
                                        @php $delivered+= $item->metrics->delivered @endphp
                                    @endforeach
                                @endforeach
                                {{$delivered}}
                            </h3>
                            <div class="mb-0">Delivered Emails</div>
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
                            <h3 class="mb-2">
                                @php
                                    $deferred = 0;
                                @endphp
                                @foreach($result as $row)
                                    @foreach ($row->stats as $item)
                                        @php $deferred+= $item->metrics->deferred @endphp
                                    @endforeach
                                @endforeach
                                {{$deferred}}
                            </h3>
                            <div class="mb-0">Deferred Emails</div>
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
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-xl d-flex">
            <div class="card flex-fill">
                <div class="card-body py-4">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-2">
                                @php
                                    $invalid_emails = 0;
                                @endphp
                                @foreach($result as $row)
                                    @foreach ($row->stats as $item)
                                        @php $invalid_emails+= $item->metrics->invalid_emails @endphp
                                    @endforeach
                                @endforeach
                                {{$invalid_emails}}
                            </h3>
                            <div class="mb-0">Invalid Emails</div>
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
                            <h3 class="mb-2">
                                @php
                                    $spam_reports = 0;
                                @endphp
                                @foreach($result as $row)
                                    @foreach ($row->stats as $item)
                                        @php $spam_reports+= $item->metrics->spam_reports @endphp
                                    @endforeach
                                @endforeach
                                {{$spam_reports}}
                            </h3>
                            <div class="mb-0">Marked As Spams</div>
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
                            <h3 class="mb-2">
                                @php
                                    $unsubscribes = 0;
                                @endphp
                                @foreach($result as $row)
                                    @foreach ($row->stats as $item)
                                        @php $unsubscribes+= $item->metrics->unsubscribes @endphp
                                    @endforeach
                                @endforeach
                                {{$unsubscribes}}
                            </h3>
                            <div class="mb-0">Total Un-subscribers</div>
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
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Marketing Emails Statistics</h3>
                </div>
                <div class="card-body">
                    <canvas id="pieChart" style="height:630px; min-height:630px"></canvas>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function (){
            var pieData       = {
                labels: [
                    'Total Requests','Delivered Emails','Deferred Emails','Invalid Emails','Marked As Spams','Total Un-subscribers'
                ],
                datasets: [
                    {
                        data: [
                            @php
                                $total_requests = 0;
                            @endphp
                            @foreach($result as $row)
                            @foreach ($row->stats as $item)
                            @php $total_requests+= $item->metrics->requests @endphp
                            @endforeach
                            @endforeach
                            {{$total_requests}},
                            @php
                                $delivered = 0;
                            @endphp
                            @foreach($result as $row)
                            @foreach ($row->stats as $item)
                            @php $delivered+= $item->metrics->delivered @endphp
                            @endforeach
                            @endforeach
                            {{$delivered}},
                            @php
                                $deferred = 0;
                            @endphp
                            @foreach($result as $row)
                            @foreach ($row->stats as $item)
                            @php $deferred+= $item->metrics->deferred @endphp
                            @endforeach
                            @endforeach
                            {{$deferred}},
                            @php
                                $invalid_emails = 0;
                            @endphp
                            @foreach($result as $row)
                            @foreach ($row->stats as $item)
                            @php $invalid_emails+= $item->metrics->invalid_emails @endphp
                            @endforeach
                            @endforeach
                            {{$invalid_emails}},
                            @php
                                $spam_reports = 0;
                            @endphp
                            @foreach($result as $row)
                            @foreach ($row->stats as $item)
                            @php $spam_reports+= $item->metrics->spam_reports @endphp
                            @endforeach
                            @endforeach
                            {{$spam_reports}},
                            @php
                                $unsubscribes = 0;
                            @endphp
                            @foreach($result as $row)
                            @foreach ($row->stats as $item)
                            @php $unsubscribes+= $item->metrics->unsubscribes @endphp
                            @endforeach
                            @endforeach
                            {{$unsubscribes}}
                        ],
                        @php
                            $chars = "ABCDEF0123456789";
                             $size = strlen( $chars );
                        @endphp
                        backgroundColor : [
                            @for( $i = 0; $i < 6; $i++ )
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
            var chart_convas = $('#pieChart').get(0).getContext('2d')
            var pieOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            }
            var pieChart = new Chart(chart_convas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        });
    </script>
@endsection
