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
                                <h3>Affiliate MultiMedia</h3>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('affiliate.showMedia',$media->parent_media)  }}" class="btn btn-sm btn-primary pull-right float-right">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Edit Media File</h4>
                        <form action="{{route('affiliate.updateMedia')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="price" class="col-md-3 col-form-label text-md-right">Name : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="hidden" value="{{$media->id}}" name="fileId">
                                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$media->name!=null?$media->name:old('name')}}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">Type : </label>

                                <div class="col-md-8">
                                    <select id="type" type="text" class="form-control {{ $errors->has('prize') ? ' is-invalid' : '' }}" name="type" required>
                                        <option value="document" @if($media->type=="document") selected @endif>Document</option>
                                        <option value="text" @if($media->type=="text") selected @endif>Text</option>
                                        <option value="image" @if($media->type=="image") selected @endif>Image</option>
                                        <option value="video" @if($media->type=="video") selected @endif>Video</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="price" class="col-md-3 col-form-label text-md-right">Files : </label>
                                <div class="col-md-8">
                                    <div class="form-group files">
                                        <label>Upload Your File </label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                </div>
                            </div>
                            @if($media->type!="text")
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <h6>Uploaded File </h6>
                                    <figure class="col-md-4">
                                        <a class="black-text" target="_blank" href="{{url('/backend/affiliate/media/'.$media->source)}}"
                                           data-size="1600x1067">.
                                            @if($media->type=="document")
                                                <img alt="picture" src="{{asset('/backend/affiliate/media/document.png')}}"
                                                     class="img-fluid" style="height: 50px;width: 50px;" />
                                            @elseif($media->type=="image")
                                                <img alt="picture" src="{{asset('/backend/affiliate/media/'.$media->source)}}"
                                                     class="img-fluid" style="height: 50px;width: 50px;" />
                                            @elseif($media->type=="video")
                                                <video width="50" height="50" controls>
                                                    <source src="{{asset('/backend/affiliate/media/'.$media->source)}}" type="video/mp4">
                                                    <source src="{{asset('/backend/affiliate/media/'.$media->source)}}" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @endif
                                            <br>
                                            {{$media->source}}
                                        </a>
                                    </figure>
                                </div>
                                @endif
                            <div class="row form-group">
                                <label for="price" class="col-md-3 col-form-label text-md-right">Text (if any) : </label>
                                <div class="col-md-8">
                                    <textarea id="editor" name="promotional_text" rows="10" cols="100" required>{{$media->type=="text"?$media->source:old('promotional_text')}}</textarea>
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
    </div>
@endsection
@section('script')
    <script src="{{asset('backend/js/sweetaler2.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

    <script>
        CKEDITOR.replace('editor', {
            skin: 'moono',
            enterMode: CKEDITOR.ENTER_BR,
            shiftEnterMode:CKEDITOR.ENTER_P,
            toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
                { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
                { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
                { name: 'links', items: [ 'Link', 'Unlink' ] },
                { name: 'insert', items: [ 'Image'] },
                { name: 'spell', items: [ 'jQuerySpellChecker' ] },
                { name: 'table', items: [ 'Table' ] }
            ],
        });
    </script>
    <script type="text/javascript">
        // MDB Lightbox Init
        $(function () {
            $("#mdb-lightbox-ui").load("mdb-addons/mdb-lightbox-ui.html");
        });
    </script>
@endsection
