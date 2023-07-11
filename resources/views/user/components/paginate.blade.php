<?php
// config
$link_limit = 10; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
    <ul class="pagination filters-pagination">
        <li class="filters-pagination__item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="filters-pagination__link" href="{{ $paginator->url(1) }}"><i class="filters-pagination__icon fas fa-chevron-left"></i></a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="filters-pagination__item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a class="filters-pagination__link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="filters-pagination__item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a class="filters-pagination__link" href="{{ $paginator->url($paginator->lastPage()) }}"><i class="filters-pagination__icon fas fa-chevron-right"></i></a>
        </li>
    </ul>
@endif
