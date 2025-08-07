@if ($paginator->hasPages())
    <ul role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"><a class="arrow" href="#"><i
                class="fa fa-caret-left"></i></a></li>
        @else
            <li class="page-item">
                <a class="arrow" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i
                    class="fa fa-caret-left"></i></a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span >{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><a class="active">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a  href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="arrow"  href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"> @if ($paginator->lastItem())<i class="fa fa-caret-right"></i> @endif</a>
            </li>
        @else
           
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')"><a class="arrow" href="#"><i
                class="fa fa-caret-right"></i></a></li>
        @endif
    </ul>
@endif
