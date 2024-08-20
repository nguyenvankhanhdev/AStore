@if ($paginator->hasPages())
    <div class="pages">
        <ul class="pagination pagination-space">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link"><i class="ic-angle-left"></i></span>
                </li>
            @else
                <li class="pagination-item">
                    <a class="pagination-link" href="#" data-url="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="ic-angle-left"></i></a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="pagination-item disabled" aria-disabled="true">
                        <span class="pagination-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="pagination-item active" aria-current="page">
                                <span class="pagination-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="pagination-item">
                                <a class="pagination-link" href="#" data-url="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination-item">
                    <a class="pagination-link" href="#" data-url="{{ $paginator->nextPageUrl() }}" rel="next"><i class="ic-angle-right"></i></a>
                </li>
            @else
                <li class="pagination-item disabled" aria-disabled="true">
                    <span class="pagination-link"><i class="ic-angle-right"></i></span>
                </li>
            @endif
        </ul>
    </div>
@endif
