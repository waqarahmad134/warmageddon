@extends('backend.layouts.app')

@section('title', 'Admin | Edit Permission')

@section('content')

    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 " style="margin-top: 30px;margin-left: 70px">

                    <div class="header">
                        <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
                    </div>
                    <div class="body">

                        {{-- @include ('errors.list') --}}
                        {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}

                        <div class="form-group">
                            {{ Form::label('name', 'Permission Name') }}
                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                        </div>
                        <br>
                        <a class="btn btn-primary" href="{{route('permissions.index')}}">Back</a>


                        {{ Form::close() }}

                    </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </div>

@endsection
