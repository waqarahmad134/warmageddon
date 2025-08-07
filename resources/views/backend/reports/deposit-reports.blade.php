@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')
@section('style')
<style>
    .nav-tabs .nav-link.active {
        background-color: goldenrod !important;
        color: black !important;
    }
    .btn:focus, .btn:active, button:focus, button:active {
        outline: none !important;
        box-shadow: none !important;
    }

    #image-gallery .modal-footer{
        display: block;
    }

    .thumb{
        margin-top: 15px;
        margin-bottom: 15px;
    }
</style>
@endsection
@section('content')
<!-- Home Page Header Section Start -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-9">
                        <h3>Deposits Report</h3>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="dt-buttons btn-group">
                            <a href="{{ route('generate_deposit_report') }}" class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="datatables-buttons" type="button">
                                <span>Download CSV</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="mytable" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>TO</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($deposits as $key => $item)
                                                <tr>
                                                    <td>{{ $item->from }}</td>
                                                    <td>{{ $item->to }}</td>
                                                    <td>{{ $item->type }}</td>
                                                    <td>{{ $item->amount }}</td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- Home Page Header Section End -->
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatables-buttons1').DataTable({
            "order": [[ 4, "desc" ]] // Order on init. # is the column, starting at 0
        });
        $('#mytable').DataTable({
            "order": [[ 5, "desc" ]] // Order on init. # is the column, starting at 0
        });
    });
</script>
@endsection
