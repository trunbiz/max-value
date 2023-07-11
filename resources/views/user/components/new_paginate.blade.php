@if ($news->hasPages())
    <!-- Pagination -->
    <div class="pull-right pagination">
        <ul class="filters-pagination">
            {{-- Previous Page Link --}}
            @if ($news->onFirstPage())
                <li class="filters-pagination__item">
                    <a href="#" class="filters-pagination__link">
                        <i class="filters-pagination__icon fas fa-chevron-left"></i>
                    </a>
                </li>
            @else
                <li class="filters-pagination__item active">
                    <a href="{{ $news->previousPageUrl() }}" class="filters-pagination__link">
                        <i class="filters-pagination__icon fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $news->currentPage())
                            <li class="filters-pagination__item active">
                                <a class="filters-pagination__link">
                                    <span>{{ $page }}</span>
                                </a>
                            </li>
                        @elseif (($page == $news->currentPage() + 1 || $page == $news->currentPage() + 2) || $page == $news->lastPage())
                            <li class="filters-pagination__item">
                                <a href="{{ $url }}" class="filters-pagination__link">
                                    {{ $page }}
                                </a>
                            </li>
                        @elseif ($page == $news->lastPage() - 1  )
                            <li class="filters-pagination__item">
                                <a  class="filters-pagination__link">
                                    <span><i class="fa fa-ellipsis-h"></i></span>
                                </a>

                            </li>
                        @endif

                    @endforeach
                @endif


            @endforeach

            {{-- Next Page Link --}}
            @if ($news->hasMorePages())
                <li class="filters-pagination__item">
                    <a href="{{ $news->nextPageUrl() }} " class="filters-pagination__link">
                        <i class="filters-pagination__icon fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li class="disabled">
                    <span><i class="filters-pagination__icon fas fa-chevron-right"></i></span>
                </li>
            @endif
        </ul>
    </div>
    <!-- Pagination -->
@endif
