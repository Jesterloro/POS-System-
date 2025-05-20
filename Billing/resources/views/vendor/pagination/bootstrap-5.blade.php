@if ($paginator->hasPages())
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" aria-hidden="true">&laquo; Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link animated-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" onclick="smoothPageTransition(event)">&laquo; Previous</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link animated-page-link" href="{{ $url }}" onclick="smoothPageTransition(event)">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link animated-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" onclick="smoothPageTransition(event)">Next &raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next &raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif

<!-- Additional CSS for Animations -->
<style>
    /* Smooth hover and transition effect */
    .animated-page-link {
        position: relative;
        overflow: hidden;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    /* Hover effect for previous/next links */
    .animated-page-link:hover {
        color: #fff !important;
        background-color: #007bff !important;
        box-shadow: 0px 4px 10px rgba(0, 123, 255, 0.5);
        border-radius: 4px;
    }

    /* Active page link styling */
    .pagination .active .page-link {
        background-color: #007bff;
        color: white;
        box-shadow: 0px 4px 10px rgba(0, 123, 255, 0.5);
        transition: box-shadow 0.3s ease;
    }

    /* Smooth transition on hover for pagination links */
    .pagination .page-link {
        transition: all 0.2s ease-in-out;
        padding: 0.6rem 1rem;
    }

    /* Hover transition effect on other page links */
    .pagination .page-item:not(.active):hover .page-link {
        color: #007bff;
        background-color: #e9ecef;
        border-radius: 4px;
        box-shadow: 0px 4px 8px rgba(0, 123, 255, 0.2);
    }

    /* Styling for disabled links */
    .pagination .disabled .page-link {
        color: #6c757d;
        cursor: not-allowed;
    }



</style>


