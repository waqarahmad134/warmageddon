@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6 cus_attr">
                    <p>Subscription List</p>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">All Subscribers List</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <form method="POST" action="{{url('dash-panel/send-email')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Send Email</div>
                <div class="card-body">

                        <div class="form-group {{ $errors->has('list') ? 'has-error' : ''}}">
                            <label for="name" class="control-label">Select List</label>
                            <select name="list" id="list" class="form-control">
                                <option value="">Select Contact List</option>
                                @if(!is_null($list_response))
                                    @foreach($list_response as $list)
                                        <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach
                                    @endif
                            </select>
                        </div>
                        <div class="form-group {{ $errors->has('template') ? 'has-error' : ''}}">
                            <label for="name" class="control-label">Select Template</label>
                            <select name="template" id="template" class="form-control">
                                @if(!is_null($template_response))
                                    @foreach($template_response as $template)
                                        <option value="{{$template->id}}">{{$template->name}}</option>
                                    @endforeach
                                @else
                                    <option value="">Select Dynamic Template</option>
                                @endif
                            </select>
                        </div>
{{--                        <div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">--}}
{{--                            <label for="name" class="control-label">Subject</label>--}}
{{--                            <input class="form-control" name="subject" type="text" id="name" value="{{old('subject')}}" >--}}
{{--                        </div>--}}
{{--                        <div class="form-group {{ $errors->has('message') ? 'has-error' : ''}}">--}}
{{--                            <label for="name" class="control-label">Message</label>--}}
{{--                            <textarea class="form-control" name="message" type="text" id="name" rows="8">{{old('message')}}</textarea>--}}
{{--                        </div>--}}
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Send Email">
                        </div>


                </div>
            </div>
        </div>
    </div><hr>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-center">
                    <h3>All Subscribers List</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatables-buttons" class="table table-striped">
                            <thead>
                            <tr>
                                {{--<th>ID.</th>
                                <th>Full Name</th>--}}
                                <th><input type="checkbox" name="checkAll" id="checkedAll"> Sr.No</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp

                            @foreach($result as $row)
                                <tr>
                                    <td><input type="checkbox" class="checkSingle" name="email[]" value="{{$row->email}}">&nbsp;&nbsp;{{$i}}</td>
                                    <td>{{$row->email}}</td>
                                    <td><a href="{{url('dash-panel/remove-email/'.$row->id)}}"><i class="fa fa-trash"></i></a> </td>
                               </tr>
                                @php
                                $i++;
                                @endphp
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#checkedAll").change(function () {
                if (this.checked) {
                    $(".checkSingle").each(function () {
                        this.checked = true;
                    });
                } else {
                    $(".checkSingle").each(function () {
                        this.checked = false;
                    });
                }
            });
        });
        $('#list').on('change',function (){
           event.preventDefault();
           // var selected_text = $(this).children(':selected').text();
            var list_id = $(this).val();
           $.ajax({
               url : 'all-contacts',
               type : 'post',
               data : {
                   '_token'     : '{{csrf_token()}}',
                   'list'       : list_id
               },
               dataType : 'json',
               success  : function (result){
                   $.each(result,function (i,item){
                       $(".checkSingle").each(function () {
                           if ($(this).val()==item.email)
                           {
                               $(this).prop("checked", true);
                           }
                       });
                   });
               },
               error     : function (result){
                   alert('in error')
               }
           })
        });
    </script>
@endsection
