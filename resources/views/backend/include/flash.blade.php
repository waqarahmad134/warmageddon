<!-- start: SECTION FLASH MESSAGE -->
@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has('alert-' . $msg))
        <p class="btn btn-block btn-lg btn-{{ $msg }}">
            {{ Session::get('alert-' . $msg) }}
            <a href="#" class="close pull-right" data-dismiss="alert" aria-label="close">&times;</a>
        </p>
    @endif
@endforeach
<!-- end: SECTION FLASH MESSAGE -->