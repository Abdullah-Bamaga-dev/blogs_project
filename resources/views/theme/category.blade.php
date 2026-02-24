@extends('theme.master')
@section('title', 'category')
@section('categories-active', 'active')

@section('content')
    @include('theme.partisal.hero', [
        'title' => $categoryName
    ])



    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        @if (isset($blogs) && count($blogs) > 0)
                            @foreach ($blogs as $blog)
                                <div class="col-md-6">
                                    <div class="single-recent-blog-post card-view">
                                        <div class="thumb">
                                            <img class="card-img rounded-0" src="{{ asset("storage/blogs/$blog->image") }}"
                                                alt="">
                                            <ul class="thumb-info">
                                                <li><a href="#"><i class="ti-user"></i>{{ $blog->user->name }}</a>
                                                </li>
                                                <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                                            </ul>
                                        </div>
                                        <div class="details mt-20">
                                            <a href="blog-single.html">
                                                <h3>{{ $blog->name }}</h3>
                                            </a>
                                            <p>{{ $blog->description }}</p>
                                            <a class="button" href="#">Read More <i class="ti-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endif
                    </div>
                    <div class="row">
                        @if (isset($blogs) && count($blogs) > 0)
                            {{ $blogs->render('pagination::bootstrap-4') }}
                        @endif
                    </div>
                </div>
                @include('theme.partisal.siddebar')
            </div>
        </div>
    </section>
    <!--================ End Blog Post Area =================-->
@endsection
