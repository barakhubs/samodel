@extends('app')

@section('title', 'Samodel &mdash; Security Awareness Model')

@section('content')
    <!-- Start retroy layout blog posts -->
    <section class="section bg-light">
        <div class="container">
            <div class="row align-items-stretch retro-layout">
                <div class="col-md-4">
                    @foreach ($random_posts as $item)
                    <a href="{{ route('single', $item->slug) }}" class="h-entry mb-30 v-height gradient">

                        <div class="featured-img" style="background-image: url('public/storage/{{ $item->featured_image }}');"></div>

                        <div class="text">
                            <span class="date">{{ date('M d Y', strtotime($item->created_at)) }}</span>
                            <h2>{{ $item->title }}</h2>
                        </div>
                    </a>
                    @endforeach
                </div>
                @foreach ($most_commented_posts as $item)
                <div class="col-md-4">
                    <a href="{{ route('single', $item->slug) }}" class="h-entry img-5 h-100 gradient">

                        <div class="featured-img" style="background-image: url('public/storage/{{ $item->featured_image }}');"></div>

                        <div class="text">
                            <span class="date">{{ date('M d Y', strtotime($item->created_at)) }}</span>
                            <h2>{{ $item->title }}</h2>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="col-md-4">
                    @foreach ($oldest_posts as $item)
                    <a href="{{ route('single', $item->slug) }}" class="h-entry mb-30 v-height gradient">

                        <div class="featured-img" style="background-image: url('public/storage/{{ $item->featured_image }}');"></div>

                        <div class="text">
                            <span class="date">{{ date('M d Y', strtotime($item->created_at)) }}</span>
                            <h2>{{ $item->title }}</h2>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End retroy layout blog posts -->

    <section class="section">
        <div class="container">

            <div class="row mb-4">
                <div class="col-sm-6">
                    <h2 class="posts-entry-title">All Posts</h2>
                </div>
            </div>

            <div class="row">
                @foreach ($posts as $item)
                <div class="col-lg-4 mb-4">
                    <div class="post-entry-alt">
                        <a href="single.html" class="img-link"><img
                                src="{{ asset('storage/'.$item->featured_image) }}" style="width: 700px; height: auto" alt="{{ $item->title }}"
                                class="img-fluid"></a>
                        <div class="excerpt">


                            <h2><a href="{{ route('single', $item->slug) }}">{{ $item->title }}</a></h2>
                            <div class="post-meta align-items-center text-left clearfix">
                                <figure class="author-figure mb-0 me-3 float-start"><img
                                        src="{{ asset('front/images/person_1.jpg') }}" alt="Image" class="img-fluid">
                                </figure>
                                <span class="d-inline-block mt-1">By <a href="#">Admin</a></span>
                                <span>&nbsp;-&nbsp; {{ date('M d Y', strtotime($item->created_at)) }}</span>
                            </div>

                            <p>{{ Str::limit($item->description, 100, '...') }}</p>
                            <p><a href="{{ route('single', $item->slug) }}" class="read-more">Continue Reading</a></p>
                        </div>
                    </div>
                </div>
                @endforeach

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


            </div>

        </div>
    </section>

@endsection
