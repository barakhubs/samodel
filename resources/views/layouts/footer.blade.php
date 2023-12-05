<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget">
                    <h3 class="mb-4">About</h3>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                        there live the blind texts.</p>
                </div> <!-- /.widget -->
                <div class="widget">
                    <h3>Social</h3>
                    <ul class="list-unstyled social">
                        <li><a href="#"><span class="icon-instagram"></span></a></li>
                        <li><a href="#"><span class="icon-twitter"></span></a></li>
                        <li><a href="#"><span class="icon-facebook"></span></a></li>
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
            <div class="col-lg-4 ps-lg-5">
                <div class="widget">
                    <h3 class="mb-4">Tools</h3>
                    <ul class="list-unstyled float-start links">
                        <li><a href="#">Password Strength Checker</a></li>
                        <li><a href="#">Password Generator</a></li>
                        <li><a href="#">Site Checker</a></li>
                        <li><a href="#">File Scanner</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <div class="widget">
                    <h3 class="mb-4">Recent Post Entry</h3>
                    <div class="post-entry-footer">
                        <ul>
                            @foreach (App\Models\Post::orderBy('created_at', 'desc')->paginate(3) as $item)
                            <li>
                                <a href="{{ route('single', $item->slug) }}">
                                    <img src="{{ asset('storage/'.$item->featured_image) }}" alt="Image placeholder"
                                        class="me-4 rounded">
                                    <div class="text">
                                        <h4>{{ $item->title }}</h4>
                                        <div class="post-meta">
                                            <span class="mr-2">{{ date('M d Y', strtotime($item->created_at)) }} </span>
                                        </div>
                                    </div>
                                </a>
                            </li>

                            @endforeach
                        </ul>
                    </div>


                </div> <!-- /.widget -->
            </div> <!-- /.col-lg-4 -->
        </div> <!-- /.row -->

        <div class="row mt-2">
            <div class="col-12 text-center">
                <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. </p>
                </p>
            </div>
        </div>
    </div> <!-- /.container -->
</footer> <!-- /.site-footer -->
