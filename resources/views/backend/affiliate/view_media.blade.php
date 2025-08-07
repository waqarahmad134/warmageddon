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
        /* image modal */
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
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary pull-right float-right">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4>Add Media Files</h4>
                        <form action="{{route('affiliate.saveMedia')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="price" class="col-md-3 col-form-label text-md-right">Name : </label>

                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="hidden" value="{{$media->id}}" name="parent_media">
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
                                    <select id="prize" type="text" class="form-control {{ $errors->has('prize') ? ' is-invalid' : '' }}" name="type" required>
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
                                            <input type="file" name="files[]" class="form-control" multiple="">
                                        </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="price" class="col-md-3 col-form-label text-md-right">Text (if any) : </label>
                                <div class="col-md-8">
                                    <textarea id="editor" name="promotional_text" rows="10" cols="100" required>{{old('promotional_text')}}</textarea>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="offset-6 col-md-6">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <h3>Uploaded Files </h3>
                        </div>
                        <div class="row">
                            @if($media->getMediaFiles!=null)
                            @foreach($media->getMediaFiles as $row)
                                @if($row->type=="image")
                                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                    <a class="thumbnail" href="#" data-image-id="" data-task="{{$row->id}}" data-toggle="modal" data-title=""
                                       data-image="{{asset('/backend/affiliate/media/'.$row->source)}}"
                                       data-target="#image-gallery">
                                        <img class="img-thumbnail"
                                             src="{{asset('/backend/affiliate/media/'.$row->source)}}"
                                             alt="{{$row->name}}">
                                    </a><br /><br />
                                    <a href="{{url('dash-panel/edit-media_icon/'.$row->id)}}" class="btn btn-info btn-sm">Edit</a> |
                                    <a href="{{url('dash-panel/delete-media_icon/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                </div>

                                @else
                                    <figure class="col-md-4">
                                        @if($row->type=="text")
                                            <a data-toggle="open_txt" class="black-text" href="#" data-task1="{{$row->name}}" data-task="{!!$row->source!!}"
                                               data-size="1600x1067">
                                                <img alt="picture" src="{{asset('/backend/affiliate/media/text.png')}}"
                                                     class="img-fluid" height="230" width="230"/>
                                                <h3 class="text-center my-3">{{$row->name}}</h3>
                                            </a>
                                            <br />
                                            <a href="{{url('dash-panel/edit-media_icon/'.$row->id)}}" class="btn btn-info btn-sm">Edit</a> |
                                            <a href="{{url('dash-panel/delete-media_icon/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                        @else
                                            @if($row->type=="document")
                                            <a class="black-text" target="_blank" href="{{url('/backend/affiliate/media/'.$row->source)}}"
                                               data-size="1600x1067">.
                                                    <img alt="picture" src="{{asset('/backend/affiliate/media/document.png')}}"
                                                         class="img-fluid" />

                                                @elseif($row->type=="image")
                                                    <a class="black-text" href="{{url('/backend/affiliate/media/'.$row->source)}}"
                                                       data-size="1600x1067">.
                                                    <img alt="picture" src="{{asset('/backend/affiliate/media/'.$row->source)}}"
                                                         class="img-fluid" />
                                                @elseif($row->type=="video")
                                                            <a class="black-text" href="{{url('/backend/affiliate/media/'.$row->source)}}"
                                                               data-size="1600x1067">.
                                                    <video width="320" height="210" controls>
                                                        <source src="{{asset('/backend/affiliate/media/'.$row->source)}}" type="video/mp4">
                                                        <source src="{{asset('/backend/affiliate/media/'.$row->source)}}" type="video/ogg">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                @endif
                                                <h3 class="text-center my-3">{{$row->name}}chameleon_d
                                            </a>
                                            <br /><br />
                                            <a href="{{url('dash-panel/edit-media_icon/'.$row->id)}}" class="btn btn-info btn-sm">Edit</a> |
                                            <a href="{{url('dash-panel/delete-media_icon/'.$row->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                        @endif
                                    </figure>
                                @endif
                            @endforeach
                                @endif
                                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                                </button>
                                                 <a href="#" target="_blank" id="download_btn" class="btn btn-success" style="margin-left: 190px;">Download</a>
                                                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                                </button>
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
@endsection
<div id="show_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Header</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="hidden_content">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="copy_btn" onclick="myFunction()">Copy</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
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
        //image modal
        let modalId = $('#image-gallery');

        $(document)
            .ready(function () {

                loadGallery(true, 'a.thumbnail');

                //This function disables buttons when needed
                function disableButtons(counter_max, counter_current) {
                    $('#show-previous-image, #show-next-image')
                        .show();
                    if (counter_max === counter_current) {
                        $('#show-next-image')
                            .hide();
                    } else if (counter_current === 1) {
                        $('#show-previous-image')
                            .hide();
                    }
                }

                /**
                 *
                 * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
                 * @param setClickAttr  Sets the attribute for the click handler.
                 */

                function loadGallery(setIDs, setClickAttr) {
                    let current_image,
                        selector,
                        counter = 0;

                    $('#show-next-image, #show-previous-image')
                        .click(function () {
                            if ($(this)
                                .attr('id') === 'show-previous-image') {
                                current_image--;
                            } else {
                                current_image++;
                            }

                            selector = $('[data-image-id="' + current_image + '"]');
                            updateGallery(selector);
                        });

                    function updateGallery(selector) {
                        let $sel = selector;
                        $('#download_btn').attr('href','/dash-panel/download/image/'+$sel.attr('data-task'))
                        current_image = $sel.data('image-id');
                        $('#image-gallery-title')
                            .text($sel.data('title'));
                        $('#image-gallery-image')
                            .attr('src', $sel.data('image'));
                        disableButtons(counter, $sel.data('image-id'));
                    }

                    if (setIDs == true) {
                        $('[data-image-id]')
                            .each(function () {
                                counter++;
                                $(this)
                                    .attr('data-image-id', counter);
                            });
                    }
                    $(setClickAttr)
                        .on('click', function () {
                            updateGallery($(this));
                        });
                }
            });

        // build key actions
        $(document)
            .keydown(function (e) {
                switch (e.which) {
                    case 37: // left
                        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
                            $('#show-previous-image')
                                .click();
                        }
                        break;

                    case 39: // right
                        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
                            $('#show-next-image')
                                .click();
                        }
                        break;

                    default:
                        return; // exit this handler for other keys
                }
                e.preventDefault(); // prevent the default action (scroll / move caret)
            });
        // text popup
        $(document).on('click','a[data-toggle=open_txt]',function () {
            event.preventDefault();
            $('#show_modal').find('.modal-title').html($(this).attr('data-task1'));
            $('#show_modal').find('.modal-body').html($(this).attr('data-task'));
            $('#show_modal').modal('show');
        })
        function myFunction() {

            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($('#hidden_content').text()).select();
            document.execCommand("copy");
            $temp.remove();

            /* Alert the copied text */
            var btn_text  = document.getElementById('copy_btn');
            btn_text.innerHTML = "Copied";

        }
    </script>
@endsection
