@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Backups</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Database Management</a></li>
                            <li class="breadcrumb-item active">Backups List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3 class="float-left">Database Backups List</h3>
                    <a href="{{ url('dash-panel/take-backup') }}" class="btn btn-primary float-right">Take Latest Backup</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Download/Restore</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!is_null($backups))
                                @php
                                $sl = 1;
                                @endphp
                                @foreach($backups as $row)
                                    <tr>
                                        <td>{{$sl}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->created_at->toDateString()}}</td>
                                        <td>
                                            <a href="{{url($row->src)}}" title="Download Backup"><i class="fa fa-download"></i></a>
                                            &nbsp;&nbsp;&nbsp;<a href="{{url('dash-panel/database-restore/'.$row->id)}}" title="Restore Backup"><i class="fa fa-sync-alt"></i></a>
                                        </td>
                                    </tr>
                                    @php
                                        $sl++;
                                    @endphp
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
