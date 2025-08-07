@extends('backend.layouts.app')
@if(Auth::user()->hasRole('Affiliate'))
    @section('title', 'Dashboard || Affiliate')
@else
    @section('title', 'Dashboard || Admin')
@endif
@section('style')
<style>
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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @php
                                $count = 0;
                            @endphp
                            @foreach($media as $tab)
                                <li class="nav-item">
                                    <a class="nav-link @if($count==0) active @endif" id="tablist{{$tab->id}}" data-toggle="tab" href="#tab{{$tab->id}}" role="tab" aria-controls="tab{{$tab->id}}"
                                       aria-selected="true">{{$tab->name}}</a>
                                </li>
                                @php
                                    $count++;
                                @endphp
                            @endforeach
                        </ul>
                        @php
                            $count = 0;
                        @endphp
                        <div class="tab-content" id="myTabContent">
                            @foreach($media as $tab)
                                @php
                                    $content  = DB::table('affiliate_media_files')->where('parent_media',$tab->id)->get();
                                @endphp
                                <div class="tab-pane fade show @if($count==0)  active @endif" id="tab{{$tab->id}}" role="tabpanel" aria-labelledby="tab{{$tab->id}}">
                                    <div class="row">
                                        @foreach($content as $row)
                                            @if($row->type=="image")
                                                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-task="{{$row->id}}" data-task1="{{$row->source}}" data-title=""
                                                       data-image="{{asset('/backend/affiliate/media/'.$row->source)}}"
                                                       data-target="#image-gallery">
                                                        <img class="img-thumbnail"
                                                             src="{{asset('/backend/affiliate/media/'.$row->source)}}"
                                                             alt="{{$row->name}}">
                                                    </a>
                                                </div>
                                            @else
                                            <figure class="col-md-4">
                                                @if($row->type=="text")
                                                    <a data-toggle="open_txt" class="black-text" href="#" data-task1="{{$row->name}}" data-task="{!!$row->source!!}"
                                                       data-size="1600x1067">
                                                    <img alt="picture" src="{{asset('/backend/affiliate/media/text.png')}}"
                                                         class="img-fluid" />
                                                        <h3 class="text-center my-3">{{$row->name}}</h3>
                                                    </a>
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
                                                    <h3 class="text-center my-3">{{$row->name}}</h3>
                                                </a>
                                                    @endif
                                            </figure>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @php
                                    $count+=1;
                                @endphp
                            @endforeach
                                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6" style="border: solid 1px black;">
                                                        <xmp id="source_cod" style="white-space: pre-wrap;">
                                                        </xmp>
                                                        <hr>
                                                        <p id="reference_link">

                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img id="image-gallery-image" class="img-responsive col-md-12" src="" alt="Affiliate Marketing Image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="row">
                                                    <div class="col-md-6" style="border: solid 1px black;">
                                                        <xmp id="source_cod" style="white-space: pre-wrap;">
                                                        </xmp>
                                                        <hr>
                                                        <p id="reference_link">

                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <img id="image-gallery-image" class="img-responsive col-md-12" src="" alt="Affiliate Marketing Image">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="#" target="_blank" id="download_btn" class="btn btn-success" style="text-align: center;">Download</a>
                                                    </div>
                                                    <div class="col-md-2">
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
        </div>
    </div>
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
@endsection
@section('script')
    <script src="{{asset('backend/js/sweetaler2.js')}}"></script>

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
                        $('#source_cod').html('<img id="image-gallery-image" class="img-responsive col-md-12" src="'+$sel.data('image')+'" alt="Affiliate Marketing Image">')
                        var link = "{{url('/'.Auth::user()->pusher_token)}}/image/"+$sel.attr('data-task1');
                        $('#reference_link').html(link)
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
