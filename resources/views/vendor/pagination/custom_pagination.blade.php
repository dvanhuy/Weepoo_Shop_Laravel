<style>
.footer_main{
    text-align: center;
    margin-top: 20px;
    margin-bottom: 30px;
    user-select: none;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
}

.pagination a:hover:not(.active) {background-color: #ddd;}
.disabled_a {
    pointer-events: none;
    cursor: default;
    opacity: 0.6;
}
.cant_click {
    pointer-events: none;
}
</style>
@if ($paginator->hasPages())
    <div class="footer_main">
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <a class="disabled_a" href="#">&lsaquo;</a>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
            @endif
            
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="disabled_a" style="opacity: 1;">
                        {{ $element }}
                    </a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="active cant_click">{{ $page }}</a>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
            @else
                <a class="disabled_a">&rsaquo;</a>
            @endif
        </div>
    </div>
@endif
