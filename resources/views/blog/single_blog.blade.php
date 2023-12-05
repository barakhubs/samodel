@extends('app')

@section('title', $post->title)

@section('content')
<div class="site-cover site-cover-sm same-height overlay single-page" style="background-image: url('storage/{{ $post->featured_image }}');">
    <div class="container">
      <div class="row same-height justify-content-center">
        <div class="col-md-10">
          <div class="post-entry text-center">
            <h1 class="mb-4">{{ $post->title }}</h1>
            <div class="post-meta align-items-center text-center">
              <figure class="author-figure mb-0 me-3 d-inline-block"><img src="{{ asset('front/images/person_1.jpg') }}" alt="Image" class="img-fluid"></figure>
              <span class="d-inline-block mt-1">By Admin</span>
              <span>&nbsp;-&nbsp; {{ date('M d Y', strtotime($post->created_at)) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="container">

      <div class="row blog-entries element-animate">

        <div class="col-md-12 col-lg-8 main-content">

          <div class="post-content-body">
            <p>{!! $post->description !!}</p>
          </div>


          <div class="pt-5">
            <p>Category:  <a href="#">{{ $post->category->name }}</a></p>
          </div>


          <div class="pt-5 comment-wrap">
            <h3 class="mb-5 heading">{{ $post->comments->count() }} Comments</h3>
            <ul class="comment-list">
                @foreach ($post->comments as $item)
                <li class="comment">
                    <div class="vcard">
                      <img src="{{ asset('front/images/person_1.jpg') }}" alt="Image placeholder">
                    </div>
                    <div class="comment-body">
                      <h3>{{ $item->name }}</h3>
                      <div class="meta">{{ date('M d Y h:ma', strtotime($item->created_at)) }}</div>
                      <p>{{ $item->comment }}</p>
                    </div>
                  </li>
                @endforeach
            </ul>
            <!-- END comment-list -->

            <div class="comment-form-wrap pt-5">
              <h3 class="mb-5">Leave a comment</h3>
              <form action="{{ route('comment.store', $post->id) }}" method="POST" class="p-5 bg-light">
                @csrf
                <div class="form-group">
                  <label for="name">Name *</label>
                  <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="form-group">
                  <label for="email">Email *</label>
                  <input type="email" name="email" class="form-control" id="email">
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="comment" id="message" cols="30" rows="10" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>

        </div>

        <!-- END main-content -->

        <div class="col-md-12 col-lg-4 sidebar">
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
          <!-- END sidebar-box -->
        </div>
        <!-- END sidebar -->

      </div>
    </div>
  </section>
@endsection
