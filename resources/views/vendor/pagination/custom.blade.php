<div class="col-md-12">
    <div class="custom-pagination">
        @if ($posts->currentPage() > 1)
            <span><a href="{{ $posts->previousPageUrl() }}">{{ $posts->currentPage() - 1 }}</a></span>
        @endif

        <span class="active">{{ $posts->currentPage() }}</span>

        @if ($posts->currentPage() < $posts->lastPage())
            <span><a href="{{ $posts->nextPageUrl() }}">{{ $posts->currentPage() + 1 }}</a></span>
        @endif

        @if ($posts->currentPage() < $posts->lastPage() - 1)
            <span>...</span>
            <span><a href="{{ $posts->url($posts->lastPage()) }}">{{ $posts->lastPage() }}</a></span>
        @endif
    </div>
</div>
