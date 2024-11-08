@extends('frontend.master')
@section('content')
@section('styles')
@endsection

    <!-- Slider-Start -->
    <section class="slider">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel slide" data-bs-ride="false" id="carousel-1">
                        <div class="carousel-inner custom-carousel-inner">
                            <div class="carousel-item active"><img class="w-100 d-block"
                                    src="{{asset('frontend')}}/school/sliders/2.jpg" alt="Slide Image"></div>
                            <div class="carousel-item"><img class="w-100 d-block"
                                    src="{{asset('frontend')}}/school/sliders/1.jpg" alt="Slide Image"></div>
                            <div class="carousel-item"><img class="w-100 d-block"
                                    src="{{asset('frontend')}}/school/sliders/3.jpg" alt="Slide Image"></div>
                        </div>
                        <div><a class="carousel-control-prev" href="#carousel-1" role="button" data-bs-slide="prev"><span
                                    class="carousel-control-prev-icon"></span><span
                                    class="visually-hidden">Previous</span></a><a class="carousel-control-next"
                                href="#carousel-1" role="button" data-bs-slide="next"><span
                                    class="carousel-control-next-icon"></span><span class="visually-hidden">Next</span></a>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Slider-End -->
    <!-- Title-Start -->
    <section class="title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="scroll-title ">Title</h4>
                    <marquee behavior="scroll" direction="left" onmouseover="this.stop()" onmouseout="this.start()"
                        id="scrollTitle" class="scroll-efect">
    
                        <ul class="text-scroll">
                            <li><i class="fas fa-stop"></i><a href="">৩য় শ্রেণির প্রভাতী শাখার ভর্তির লটারীর-২০২৩ শিক্ষা
                                    বর্ষের ফলাফল</a></li>
                            <li><i class="fas fa-stop"></i><a href="">২০২৩ সালে ভর্তির বিজ্ঞপ্তি</a></li>
                            <li><i class="fas fa-stop"></i><a href="">সেশনচার্জ সহ জানুয়ারী মাসের বেতন আদায় সংক্রান্ত
                                    নোটিশ</a></li>
                        </ul>
                    </marquee>
                </div>
            </div>
        </div>
    </section>
    <!-- Title-End -->
    <!-- Body-Content-Start -->
    <section class="main-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-body-content dialog">
                                <div class="dialog-header custom-dialog-bg-color">
                                    <h2 class="msg text-white">সভাপতির বাণী</h2>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <div class="school-info">
                                            <p class="school-info-p"> বিদ্যালয়ের তথ্য: ১৯৩৫ সালে তৎকালীন জেলা ম্যাজিস্ট্রেট
                                                জনাব মোঃ মোমিন উদ্দীনের ঐকান্তিক প্রচেষ্টা ও যশোর ঘোপ নিবাসী জনাব ইয়াহিয়া
                                                খানসহ আগ্রহী শিক্ষনুরাগী ব্যক্তিবর্গের ঐকান্তিক সহযোগিতায় ‘‘মোমিন গার্লস
                                                স্কুল’’
                                                নামে এ প্রতিষ্ঠানটি স্থাপিত হয়। সূচনালগ্ন থেকে ১৯৬২ সাল পর্যন্ত ‘‘মোমিন
                                                গার্লস স্কুল’’ স্থানীয় জনমানুষের প্রচেষ্টায় হাজার সীমাবদ্ধতার উর্ধ্বে
                                                সুচারুভাবে এ অঞ্চলের অবহেলিত নারীদেরকে শিক্ষয় উদ্বুদ্ধ করেছেন।
                                                <a href="#" class=" btn-custom btn-bg-slide" type="button">Read More</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="school-info-img">
                                            <img src="{{asset('frontend')}}/school/assets/img/school1.png" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Facility-Inform-Section-Start -->
                    <div class="inform mt-4">
                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="facility-details dialog">
                                    <div class="dialog-header custom-dialog-bg-color">
                                        <h2 class="msg text-white">সভাপতির বাণী</h2>
                                    </div>
                                    <div class="facility-content mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="facility-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/facility.png" width="100%" height="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="facility-list">
                                                    <li class="facility-item"><a href="#">ডাউনলোড</a></li>
                                                    <li class="facility-item"><a href="#">মাল্টিমিডিয়া ক্লাস</a></li>
                                                    <li class="facility-item"><a href="#">ই-কন্টেন্ট</a></li>
                                                    <li class="facility-item"><a href="#">ভর্তি সংক্রান্ত তথ্য</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6 ">
                                <div class="facility-details dialog">
                                    <div class="dialog-header custom-dialog-bg-color">
                                        <h2 class="msg text-white">সভাপতির বাণী</h2>
                                    </div>
                                    <div class="facility-content mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="facility-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/facility.png" width="100%" height="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="facility-list">
                                                    <li class="facility-item"><a href="#">ডাউনলোড</a></li>
                                                    <li class="facility-item"><a href="#">মাল্টিমিডিয়া ক্লাস</a></li>
                                                    <li class="facility-item"><a href="#">ই-কন্টেন্ট</a></li>
                                                    <li class="facility-item"><a href="#">ভর্তি সংক্রান্ত তথ্য</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6 ">
                                <div class="facility-details dialog">
                                    <div class="dialog-header custom-dialog-bg-color">
                                        <h2 class="msg text-white">সভাপতির বাণী</h2>
                                    </div>
                                    <div class="facility-content mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="facility-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/facility.png" width="100%" height="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="facility-list">
                                                    <li class="facility-item"><a href="#">ডাউনলোড</a></li>
                                                    <li class="facility-item"><a href="#">মাল্টিমিডিয়া ক্লাস</a></li>
                                                    <li class="facility-item"><a href="#">ই-কন্টেন্ট</a></li>
                                                    <li class="facility-item"><a href="#">ভর্তি সংক্রান্ত তথ্য</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6 ">
                                <div class="facility-details dialog">
                                    <div class="dialog-header custom-dialog-bg-color">
                                        <h2 class="msg text-white">সভাপতির বাণী</h2>
                                    </div>
                                    <div class="facility-content mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="facility-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/facility.png" width="100%" height="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="facility-list">
                                                    <li class="facility-item"><a href="#">ডাউনলোড</a></li>
                                                    <li class="facility-item"><a href="#">মাল্টিমিডিয়া ক্লাস</a></li>
                                                    <li class="facility-item"><a href="#">ই-কন্টেন্ট</a></li>
                                                    <li class="facility-item"><a href="#">ভর্তি সংক্রান্ত তথ্য</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6 ">
                                <div class="facility-details dialog">
                                    <div class="dialog-header custom-dialog-bg-color">
                                        <h2 class="msg text-white">সভাপতির বাণী</h2>
                                    </div>
                                    <div class="facility-content mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="facility-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/facility.png" width="100%" height="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="facility-list">
                                                    <li class="facility-item"><a href="#">ডাউনলোড</a></li>
                                                    <li class="facility-item"><a href="#">মাল্টিমিডিয়া ক্লাস</a></li>
                                                    <li class="facility-item"><a href="#">ই-কন্টেন্ট</a></li>
                                                    <li class="facility-item"><a href="#">ভর্তি সংক্রান্ত তথ্য</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-md-6 ">
                                <div class="facility-details dialog">
                                    <div class="dialog-header custom-dialog-bg-color">
                                        <h2 class="msg text-white">সভাপতির বাণী</h2>
                                    </div>
                                    <div class="facility-content mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="facility-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/facility.png" width="100%" height="">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <ul class="facility-list">
                                                    <li class="facility-item"><a href="#">ডাউনলোড</a></li>
                                                    <li class="facility-item"><a href="#">মাল্টিমিডিয়া ক্লাস</a></li>
                                                    <li class="facility-item"><a href="#">ই-কন্টেন্ট</a></li>
                                                    <li class="facility-item"><a href="#">ভর্তি সংক্রান্ত তথ্য</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                        </div>
                    </div>
    
                </div>
                <!-- Right-Bar-Start -->
                <div class="col-md-4">
                    <div class="right-bar">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="dialog">
                                    <div class="dialog-header custom-dialog-bg-color-right">
                                        <h2 class="msg text-white">সভাপতির বাণী</h2>
                                    </div>
                                    <div class="dialog-box">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="dialog-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/male.png" class="img-fluid" width="150">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="msg-des">দক্ষিণবঙ্গের অন্যতম শ্রেষ্ঠ বিদ্যাপীঠ যশোর সরকারি বালিকা
                                                    উচ্চ বিদ্যালয়। ১৯৩৫
                                                    <a href="#" class=" btn-custom btn-bg-slide" type="button">Read More</a>
                                                </p>
    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="dialog">
                                    <div class="dialog-header custom-dialog-bg-color-right">
                                        <h2 class="msg text-white">প্রধান শিক্ষক বাণী</h2>
                                    </div>
                                    <div class="dialog-box">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="dialog-img">
                                                    <img src="{{asset('frontend')}}/school/assets/img/female.png" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="quetation-block">
                                                    <p class="msg-des">নারী শিক্ষার প্রসারে ১৯৩৫ সালে তৎকালীন জেলা
                                                        ম্যাজিষ্ট্রেট জনাব মোঃ
                                                    </p>
                                                    <a href="#" class=" btn-custom btn-bg-slide custom-btn-bg-slide"
                                                        type="button">Read More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="dialog">
                                    <div class="dialog-header custom-dialog-bg-color-right">
                                        <h2 class="msg text-white">Title</h2>
                                    </div>
                                    <div class="dialog-box">
                                        <ul class="bialog-menu title-menu">
                                            <li><i class="fas fa-angle-double-right"></i><a>৩য় শ্রেণির প্রভাতী শাখার ভর্তির
                                                    লটারীর-২০২৩ শিক্ষা বর্ষের ফলাফল</a></li>
                                            <li><i class="fas fa-angle-double-right"></i><a>৩য় শ্রেণির দিবা শাখার ভর্তির
                                                    লটারীর-২০২৩ এর ফলাফল</a></li>
                                            <li><i class="fas fa-angle-double-right"></i><a>২০২৩ সালে ভর্তির বিজ্ঞপ্তি-</a>
                                            </li>
                                            <li><i class="fas fa-angle-double-right"></i><a>৮৭তম বার্ষিক ক্রীড়া
                                                    প্রতিযোগিতা-২০২২</a></li>
                                            <li><i class="fas fa-angle-double-right"></i><a>আগামী ০১/০১/২০২১ তারিখে
                                                    পাঠ্যপুস্তক বিতরণের নোটিশ</a></li>
                                            <li><i class="fas fa-angle-double-right"></i><a>৪৩ তম জাতীয় বিজ্ঞান ও প্রযুক্তি
                                                    সপ্তাহে অংশগ্রহণ করতে ইচ্ছুক সংক্রান্ত নোটিশ-</a></li>
                                            <li><i class="fas fa-angle-double-right"></i><a>জাতীর পিতা বঙ্গবন্ধু শেখ মুজিবুর
                                                    রহমানের ১০১তম জন্মবার্ষিকী ও জাতীয় শিশু দিবস ২০২১ উদ্যাপন উপলক্ষে রচনা ও
                                                    চিত্রাঙ্কন প্রতিযোগিতা প্রসঙ্গে ।</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="dialog">
                                    <div class="dialog-header custom-dialog-bg-color-right">
                                        <h2 class="msg text-white">Important Link</h2>
                                    </div>
                                    <div class="dialog-box">
                                        <ul class="bialog-menu importent-menu">
                                            <li><i class="far fa-hand-point-right"></i><a>ই-কন্টেন্ট</a></li>
                                            <li><i class="far fa-hand-point-right"></i><a>একাডেমিক তথ্য</a></li>
                                            <li><i class="far fa-hand-point-right"></i><a>ক্লাস রুটিন</a></li>
                                            <li><i class="far fa-hand-point-right"></i><a>ডাউনলোড</a></li>
                                            <li><i class="far fa-hand-point-right"></i><a>পরীক্ষার ফলাফল</a></li>
                                            <li><i class="far fa-hand-point-right"></i><a>প্রতিষ্ঠানের তথ্য</a></li>
                                            <li><i class="far fa-hand-point-right"></i><a>ফলাফল</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Right-Bar-End -->
            </div>
        </div>
    </section>
    <!-- Body-Content-End   -->
    <!-- Recent-Section-Start -->
    <section class="recent">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 style="background: #dedede;color: #d27314;padding: 20px;"><i class="fas fa-plug"
                            style="color: #049f17;transform: translate(0px) rotate(51deg);"></i>&nbsp; Recent Event</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Recent-Section-End -->
    <!-- News-Section-Start -->
    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- 1st-news-col -->
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="news-main">
                                <div class="row">
                                    <h2 class="news-header dialog-header custom-dialog-bg-color-lettest-event">News</h2>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/result_sheet.png" />
                                            </div>
                                            <a href="#" class="news-intro">Result Sheet</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/result.png" />
                                            </div>
                                            <a href="#" class="news-intro">SSC Result</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/student_management.png" />
                                            </div>
                                            <a href="#" class="news-intro">Student Portal</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/head.png" />
                                            </div>
                                            <a href="#" class="news-intro">Teacher Portal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 2nd-news-col -->
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="news-main">
                                <div class="row">
                                    <h2 class="news-header dialog-header custom-dialog-bg-color-lettest-event">News</h2>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/bookcase.png" />
                                            </div>
                                            <a href="#" class="news-intro">Library</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/date.png" />
                                            </div>
                                            <a href="#" class="news-intro">Exam Notice</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/chart_bar.png" />
                                            </div>
                                            <a href="#" class="news-intro">Student Attendance</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/oaf.png" />
                                            </div>
                                            <a href="#" class="news-intro">Scholarship</a>
                                        </div>
    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- 3rd-news-col -->
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="news-main">
                                <div class="row">
                                    <h2 class="news-header dialog-header custom-dialog-bg-color-lettest-event">News</h2>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/oemscp_button.png" />
                                            </div>
                                            <a href="#" class="news-intro">Student Club</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/otp.png" />
                                            </div>
                                            <a href="#" class="news-intro">Progress Report</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/rich_text_format.png" />
                                            </div>
                                            <a href="#" class="news-intro">Scout Team</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-12">
                                        <div class="news-one">
                                            <div class="news-img">
                                                <img src="{{asset('frontend')}}/school/assets/img/oaf.png" />
                                            </div>
                                            <a href="#" class="news-intro">Management</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News-Section-End -->


@endsection
