@extends('frontend.master')
@section('content')
@section('styles')
@endsection

	
   <!-- Page Header section start here -->
    <div class="pageheader-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader-content text-center">
                        <h2>নোটিশ ডিটেইলস </h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">হোম</a></li>
                                <li class="breadcrumb-item active" aria-current="page">নোটিশ ডিটেইলস </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->


     <!-- blog section start here -->
    <div class="blog-section blog-single padding-tb section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <article>
                        <div class="section-wrapper">
                            <div class="row row-cols-1 justify-content-center g-4">
                                <div class="col">

                                    <div class="post-item style-2">
                                        <div class="post-inner">
                                            <div class="post-thumb">
                                                <img src="{{ asset('uploads/blog_img/'.$blog->photo) }}" alt="blog thumb rajibraj91" class="w-60" style="height: 500px;">
                                            </div>
                                            <div class="post-content">
                                                <h2>{{$blog->title}}</h2>
                                                <div class="meta-post">
                                                    <ul class="lab-ul">
                                                        <li><a href="#"><i class="icofont-calendar"></i>{{date('d F,Y',strtotime($blog->created_at))}}</a></li>
                                                    </ul>
                                                </div>
                                                <p>{{$blog->post}}</p>

                                                
                                            </div>
                                        </div>
                                    </div>

                        


                                </div>
                            </div>
                        </div>
                    </article>
                </div>


                <div class="col-lg-4 col-12">
                   
                </div>
            </div>
        </div>
    </div>
    <!-- blog section ending here -->

@endsection
