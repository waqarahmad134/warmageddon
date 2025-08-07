@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')

@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Maintenance</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Maintenance</a></li>
                            <li class="breadcrumb-item active">Clear File Integrity List</li>
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
                <div class="card-header mb-3">
                    <h4>Clear File Integrity List</h4>
                </div>
                <div class="card-body float-left">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th class="btn-primary">Title</th>
                            <th class="btn-primary">Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>OS</td>
                            <td>Linux</td>
                        </tr>
                        <tr>
                            <td>Distibution</td>
                            <td>CentOS - 6.8 (Final)</td>
                        </tr>
                        <tr>
                            <td>Vertualization</td>
                            <td>Xen Guest</td>
                        </tr>
                        <tr>
                            <td>Server IP</td>
                            <td>185.24.97.234</td>
                        </tr>
                        <tr>
                            <td>Uptime</td>
                            <td>1 year, 156 days, 6 hours, 12 minutes, 10 seconds: booted 09/28/17</td>
                        </tr>
                        <tr>
                            <td>PHP Version</td>
                            <td>N/A in demo [newer version available]</td>
                        </tr>
                        <tr>
                            <td>MySQL Version</td>
                            <td>N/A in demo [newer version available]</td>
                        </tr>
                        <tr>
                            <td>MySQL DB Size</td>
                            <td>N/A in demo MiB</td>
                        </tr>
                        <tr>
                            <td>CPUs(2)</td>
                            <td>N/A in demo</td>
                        </tr>
                        <tr>
                            <td>Overall CPU Usage</td>
                            <td>0%</td>
                        </tr>
                        <tr>
                            <td>Architecture</td>
                            <td>x86_64</td>
                        </tr>
                        <tr>
                            <td>Load</td>
                            <td>N/A</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- COUPONS SECTION START -->
@endsection