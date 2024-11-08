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
                        <h2>নোটিশ</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center">
                                <li class="breadcrumb-item"><a href="#">হোম</a></li>
                                <li class="breadcrumb-item active" aria-current="page">নোটিশ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header section ending here -->

    <!-- blog section start here -->
    <div class="blog-section padding-tb section-bg">
        <div class="container">
            <div class="section-wrapper">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center g-4">

                	@foreach($blogs as $blog)
                    <div class="col">
                        <div class="post-item">
                            <div class="post-inner">
                                <div class="post-thumb">
                                    <a href="{{route('blog-details',$blog->id)}}"><img src="{{ asset('uploads/blog_img/'.$blog->photo) }}" alt="blog thumb"></a>
                                </div>
                                <div class="post-content">
                                    <a href="{{route('blog-details',$blog->id)}}"><h4>{{$blog->title}}</h4></a>
                                    <div class="meta-post">
                                        <ul class="lab-ul">
                                            <li><i class="icofont-calendar"></i>{{date('d F,Y',strtotime($blog->created_at))}}</li>
                                        </ul>
                                    </div>
                                    <p>{{ Str::limit($blog->post, 150) }} </p>
                                </div>
                                <div class="post-footer">
                                    <div class="pf-left">
                                        <a href="{{route('blog-details',$blog->id)}}" class="lab-btn-text">বিস্তারিত <i class="icofont-external-link"></i></a>
                                    </div>
                                    <div class="pf-right">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
                <!-- <ul class="default-pagination lab-ul">
                    <li>
                        <a href="#"><i class="icofont-rounded-left"></i></a>
                    </li>
                    <li>
                        <a href="#">01</a>
                    </li>
                    <li>
                        <a href="#" class="active">02</a>
                    </li>
                    <li>
                        <a href="#">03</a>
                    </li>
                    <li>
                        <a href="#"><i class="icofont-rounded-right"></i></a>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
    <!-- blog section ending here -->


@endsection
