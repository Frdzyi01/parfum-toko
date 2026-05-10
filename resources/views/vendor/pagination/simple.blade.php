@if ($paginator->hasPages())
    <div class="pagination__option">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a style="opacity:0.5; cursor:not-allowed;"><i class="fa fa-angle-left"></i></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <a style="cursor:default;">{{ $element }}</a>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active" style="background:#ca1515; color:#fff;">{{ $page }}</a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
        @else
            <a style="opacity:0.5; cursor:not-allowed;"><i class="fa fa-angle-right"></i></a>
        @endif
    </div>
@endif
