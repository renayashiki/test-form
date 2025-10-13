@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="disabled">‹</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}">‹</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="current">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">›</a>
        @else
            <span class="disabled">›</span>
        @endif
    </div>
@endif
