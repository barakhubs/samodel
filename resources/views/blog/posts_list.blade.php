@extends('app')

@section('title', $category->name)

@section('content')
<div class="section search-result-wrap">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="heading">Category: {{ $category->name }}</div>
            </div>
        </div>
        <div class="row posts-entry">
            <div class="col-lg-8">
                @foreach ($category->posts as $item)
                <div class="blog-entry d-flex blog-entry-search-item">
                    <a href="single.html" class="img-link me-4">
                        <img src="{{ asset('storage/'.$item->featured_image) }}" alt="Image" class="img-fluid">
                    </a>
                    <div>
                        <span class="date">{{ date('M d Y', strtotime($item->created_at)) }} &bullet; <a href="{{ route('category.single', $item->slug) }}">{{ $category->name }}</a></span>
                        <h2><a href="{{ route('single', $item->slug) }}">{{ $item->title }}</a></h2>
                        <p>{{ Str::limit($item->description, 100, '...') }}</p>
                        <p><a href="{{ route('single', $item->slug) }}" class="btn btn-sm btn-outline-primary">Read More</a></p>
                    </div>
                </div>
                @endforeach

            </div>

            <div class="col-lg-4 sidebar">

                <div class="sidebar-box search-form-wrap">
                    <form action="#" class="sidebar-search-form">
                      <span class="bi-search"></span>
                      <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                    </form>
                  </div>
                  <!-- END sidebar-box -->
                  <div class="sidebar-box">
                    <h3 class="heading">Popular Posts</h3>
                    <div class="post-entry-sidebar">
                      <ul>
                        @foreach ($latest_posts as $item)
                        <li>
                            <a href="{{ route('single', $item->slug) }}">
                              <img src="{{ asset('storage/'.$item->featured_image) }}" alt="Image placeholder" class="me-4 rounded">
                              <div class="text">
                                <h4>{{ Str::limit($item->title, 50, '...') }}</h4>
                                <div class="post-meta">
                                  <span class="mr-2">{{ date('M d Y', strtotime($item->created_at)) }} </span>
                                </div>
                              </div>
                            </a>
                          </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  <!-- END sidebar-box -->

                  <div class="sidebar-box">
                    <h3 class="heading">Categories</h3>
                    <ul class="categories">
                        @foreach ($categories as $item)
                        <li><a href="{{ route('category.single', $item->slug) }}">{{ $item->name }} <span>({{ $item->posts->count() }})</span></a></li>
                        @endforeach
                    </ul>
                  </div>

            </div>
        </div>
    </div>
</div>
@endsection
