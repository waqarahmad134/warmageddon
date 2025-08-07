@extends('backend.layouts.app')
@section('title', 'Dashboard || Admin')
@section('style')
    <style>
        .files input {
            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 120px 0px 85px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;
        }
        .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
        }
        .files{ position:relative}
        .files:after {  pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            content: "";
            background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .color input{ background-color:#f1f1f1;}
        .files:before {
            position: absolute;
            bottom: 5px;
            left: 0;  pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: " or drag it here. ";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
        .dropzone {
            text-align: center;
            background: #eee;
            padding: 50px;
        }
        .dropzone h1{
            font-weight: 400;
            font-size: 50px;
            color: #ccc;
        }
        .dropzone.is-dragover {
            background-color: #e6ecef;
        }
        .dragover {
            background-color: red;
        }
        textarea#editor{
            background: #eee;
            border: none;
            width: 100%;
        }
        .price {
            list-style-type: none;
            border: 1px solid #eee;
            margin: 0;
            padding: 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }
        .price .header-mid{
            background: #028482;
            color: white;
            font-size: 25px;
        }
        .price:hover {
            box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
        }
        .price .header {
            background-color: #7aba7a;
            color: white;
            font-size: 25px;
        }
        .price li {
            border-bottom: 1px solid #eee;
            padding: 10px;
            text-align: center;
        }
        .price .grey {
            background-color: #eee;
            font-size: 16px;
        }
        .btn.btn-post {
            display: inline-block;
            border-style: none;
            border: none;
            border: 1px solid #028482;
            width: 200px;
            height: auto;
            padding: 15px 10px;
            text-align: center;
            font-weight: lighter;
            background: #028482;
            border-radius: 3px;
            color: #fff;
            /* text-transform: uppercase; */
            margin-top: 30px;
            margin-bottom: 20px;
        }
        body{
            background-color: #eee;
        }
        .btn.btn-post {
            display: inline-block;
            border-style: none;
            border: none;
            border: 1px solid #028482;
            width: 200px;
            height: auto;
            padding: 15px 10px;
            text-align: center;
            font-weight: lighter;
            background: #028482;
            border-radius: 3px;
            color: #fff;
            /* text-transform: uppercase; */
            margin-top: 30px;
            margin-bottom: 20px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9">
                                <h3>Manage FAQ</h3>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('Admin.FAQS') }}" class="btn btn-sm btn-primary pull-right float-right">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Edit FAQ</h4>
                        <form action="{{route('Admin.UpdateHelp')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="category" class="col-md-3 col-form-label text-md-right">Category <span style="color: red;">*</span> : </label>

                                <div class="col-md-8">
                                    <select id="category" type="text" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" required>
                                       @foreach($categories as $row)
                                           <option value="{{$row->id}}" @if($row->id==$faq->category) selected @endif>{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="question" class="col-md-3 col-form-label text-md-right">Question <span style="color: red">*</span> : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="hidden" value="{{$faq->id}}" name="faqID">
                                        <input id="question" type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" name="question" value="{{$faq->question!=null?$faq->question:old('question')}}" required>
                                    </div>
                                    @if ($errors->has('question'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('question') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="answer" class="col-md-3 col-form-label text-md-right">Answer <span style="color: red">*</span> : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="answer" type="text" class="form-control {{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" value="{{$faq->answer!=null?$faq->answer:old('answer')}}" required>
                                    </div>
                                    @if ($errors->has('answer'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('answer') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="order_no" class="col-md-3 col-form-label text-md-right">Order No <span style="color: red">*</span> : </label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="order_no" type="number" class="form-control {{ $errors->has('order_no') ? ' is-invalid' : '' }}" name="order_no" value="{{$faq->order_no!=null?$faq->order_no:old('order_no')}}" required>
                                    </div>
                                    @if ($errors->has('order_no'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('order_no') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-3 col-form-label text-md-right">Status <span style="color: red;">*</span> : </label>

                                <div class="col-md-8">
                                    <select id="status" type="text" class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}" name="status" required>
                                          <option value="1" @if($faq->status==1) selected @endif>Active</option>
                                         <option value="0" @if($faq->status==0) selected @endif>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="price" class="col-md-3 col-form-label text-md-right">Files : </label>
                                <div class="col-md-8">
                                    <div class="form-group files">
                                        <label>Attach video/images </label>
                                        <input type="file" name="files[]" class="form-control" multiple="">
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="offset-6 col-md-6">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @if(!is_null($faq->media))
        <div class="row">
            <h3>Uploaded Files </h3>
        </div>
        <div class="row">
            @foreach($faq->media as $row)
                    <figure class="col-md-2">
                        <a href="{{asset('backend/faq/media/'.$row->src)}}" data-toggle="open_document"><img src="{{asset('backend/faq/media/'.$row->src)}}" height="160" width="160" style="border: solid 2px goldenrod;"></a>
                        <br /><br />
                       <a href="{{url('dash-panel/delete-faq-media/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a>
                    </figure>
            @endforeach
        </div>
            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="image-gallery-title">View Attachment</h4>
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        <iframe src="" height="850" width="850" id="Iframe" frameborder="0" scrolling="auto" class="iframe-full-height"></iframe>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('script')
    <script src="{{asset('backend/js/sweetaler2.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script type="text/javascript">
        // MDB Lightbox Init
        $(function () {
            $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
        });
        // open attachment
        $(document).on('click','a[data-toggle=open_document]',function (e){
           e.preventDefault();
           $('#image-gallery').find('#Iframe').attr('src',$(this).attr('href'));
           $('#image-gallery').modal('show');
        });

    </script>
@endsection
