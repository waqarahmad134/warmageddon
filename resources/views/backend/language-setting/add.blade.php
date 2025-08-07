@extends('backend.layouts.app')

@section('title', 'Dashboard || Admin')
@section('content')
    <!-- Home Page Header Section Start -->
    <div class="row">
        <div class="col-12">
            <div class="row ">
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Language Settings</li>
                            <li class="breadcrumb-item active"><a href="{{route('language-settings.index')}}">Language Rows</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Home Page Header Section End -->

    <!-- SEARCH SECTION START -->
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card p-4">
                <div class="card-header mb-3">
                    <h4>Add New Language Row</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('language-settings.save') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="rows_counter" value="1">
                        <div id="row1">
                        <div class="form-group row">
                            <label for="lang" class="col-md-4 col-form-label text-md-right">Language : </label>
                            <div class="col-md-7">
                                <select class="form-control {{ $errors->has('lang') ? ' is-invalid' : '' }} multi_select" id="lang" name="lang[]"  required>
                                    <option value="en">English</option>
                                    <option value="az">Azerbaijani</option>
                                </select>
                               @if ($errors->has('lang'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lang_key" class="col-md-4 col-form-label text-md-right">Key : </label>
                            <div class="col-md-7">
                                <select class="form-control {{ $errors->has('lang_key') ? ' is-invalid' : '' }} multi_select" id="lang_key"   name="lang_key[]"  required>
                                   @foreach($lang_keys as $row)
                                       <option value="{{$row->id}}">{{$row->key_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('lang_key'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_key') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lang_original_text" class="col-md-4 col-form-label text-md-right">Original Text : </label>
                            <div class="col-md-7">
                                <textarea id="lang_original_text" name="lang_original_text[]"  class="form-control {{ $errors->has('lang_original_text') ? ' is-invalid' : '' }}" cols="40" rows="10" required></textarea>
                                @if ($errors->has('lang_original_text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_original_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lang_translated_text" class="col-md-4 col-form-label text-md-right">Translated Text : </label>
                            <div class="col-md-7">
                                <textarea id="lang_translated_text" name="lang_translated_text[]"  class="form-control {{ $errors->has('lang_translated_text') ? ' is-invalid' : '' }}" cols="40" rows="10" required></textarea>
                                @if ($errors->has('lang_translated_text'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lang_translated_text') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">Status : </label>
                            <div class="col-md-7">
                                <select class="form-control {{ $errors->has('key_status') ? ' is-invalid' : '' }}" name="status[]"  required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2 float-right">
                                <a data-toggle="add_new_row" class="btn btn-info" style="color: white;">Add New</a>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 offset-md-4">
                                <button type="submit" class="btn btn-primary float-left">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- SEARCH SECTION START -->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.multi_select').select2({
                allowClear: false,
                minimumResultsForSearch: 1,

            });

            $("select").on("select2:select", function(evt) {
                var element = evt.params.data.element;
                var $element = $(element);
                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });
        });
    </script>
<script type="text/javascript">
    $(document).on('click','a[data-toggle=add_new_row]',function () {
        event.preventDefault();
        var rowslength = parseInt($('#rows_counter').val());
        var str= ' <div id="row'+(rowslength+1)+'"><hr style="border: solid 2px black;" ><div class="form-group row"><div class="col-xs-9"><a href="javascript:void()" onclick="remove_section('+(rowslength+1)+')" class="pull-right">Remove Section</a></div></div>\n' +
            '                                                    <div class="form-group row">\n' +
            '                                                             <label for="lang" class="col-md-4 col-form-label text-md-right">Language : </label>\n' +
            '                                                            <div class="col-md-7">\n' +
            '                                                                <select class="form-control {{ $errors->has('lang') ? ' is-invalid' : '' }} multi_select" id="lang" name="lang[]"  required>\n' +
            '                                                                 <option value="en">English</option>\n' +
            '                                                                 <option value="az">Azerbaijani</option>\n' +
            '                                                                </select>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="form-group row">\n' +
            '                                                            <label for="lang_key" class="col-md-4 col-form-label text-md-right">Key : </label>\n' +
            '                                                            <div class="col-md-7">\n' +
            '                                                                 <select class="form-control {{ $errors->has('lang_key') ? ' is-invalid' : '' }} multi_select" id="lang_key'+(rowslength+1)+'" name="lang_key[]"  required>\n' +
            '                                                                  @foreach($lang_keys as $row)\n' +
            '                                                                 <option value="{{$row->id}}">{{$row->key_name}}</option>\n' +
            '                                                                 @endforeach\n' +
            '                                                                 </select>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="form-group row">\n' +
            '                                                            <label for="lang_original_text" class="col-md-4 col-form-label text-md-right">Original Text : </label>\n' +
            '                                                            <div class="col-md-7">\n' +
            '                                                                <textarea id="lang_original_text" name="lang_original_text[]"  class="form-control {{ $errors->has('lang_original_text') ? ' is-invalid' : '' }}" cols="40" rows="10" required></textarea>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="form-group row">\n' +
            '                                                            <label for="lang_translated_text" class="col-md-4 col-form-label text-md-right">Translated Text : </label>\n' +
            '                                                            <div class="col-md-7">\n' +
            '                                                                <textarea id="lang_translated_text" name="lang_translated_text[]"  class="form-control {{ $errors->has('lang_translated_text') ? ' is-invalid' : '' }}" cols="40" rows="10" required></textarea>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                        <div class="form-group row">\n' +
            '                                                            <label for="status" class="col-md-4 col-form-label text-md-right">Status : </label>\n' +
            '                                                            <div class="col-md-7">\n' +
            '                                                                <select class="form-control {{ $errors->has('key_status') ? ' is-invalid' : '' }}" name="status[]"  required>\n' +
            '                                                                <option value="1">Active</option>\n' +
            '                                                                <option value="0">Inactive</option>\n' +
            '                                                                </select>\n' +
            '                                                            </div>\n' +
            '                                                        </div>\n' +
            '                                                    </div>';
        $('#row'+rowslength).after(str);
        $('#rows_counter').val(rowslength+1);
        $('.multi_select').select2({
            allowClear: false,
            minimumResultsForSearch: 1,

        });
    });
    function remove_section(id) {
        $('#row'+id).remove();
        var rowslength = parseInt($('#rows_counter').val());
        $('#rows_counter').val(rowslength-1);
    }
</script>
@endsection
