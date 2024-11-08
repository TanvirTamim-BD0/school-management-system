
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>School Management Software</title>
    <link rel="stylesheet" href="{{asset('frontend')}}/school/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/school/assets/fonts/fontawesome-all.min.css">
    {{-- <link rel="stylesheet" href="{{asset('frontend')}}/school/assets/css/Corporate-Footer-Clean.css"> --}}

    <link rel="stylesheet" href="{{asset('frontend')}}/school/assets/css/styles.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/school/assets/css/media.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/school/assets/css/Table-With-Search-search-table.css">
    <link rel="stylesheet" href="{{asset('frontend')}}/school/assets/css/Table-With-Search.css">
</head>

<body>

    <!-- header section start here -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xl-12 offset-xl-0">
                    <img class="header-img" style="padding-right: 0px;" width="100%" height="" src="{{asset('frontend')}}/school/assets/img/logo2.png">
                </div>
            </div>
        </div>
    </header>
    <!-- header section ending here -->

    <!-- Menu-Start -->
    <section class="main-menu">
        <div class="container">
            <nav class="navbar navbar-light navbar-expand-md">
                <div class="container-fluid"><button data-bs-toggle="collapse" class="navbar-toggler"
                        data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <ul class="navbar-nav school-menu">
                            <li class="nav-item"><a class="nav-link active" href="{{url('/')}}">প্রথম পাতা</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">প্রতিষ্ঠানের তথ্য</a></li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarStudentInfo" role="button"
                                    aria-expanded="false">
                                    শিক্ষকমণ্ডলীর তথ্য
                                </a>
                                <ul class="dropdown-menu s-dropdown-custom" aria-labelledby="navbarStudentInfo">
                                    <li><a class="dropdown-item" href="{{route('head-teacher')}}">প্রধান শিক্ষক</a></li>
                                    <li><a class="dropdown-item" href="{{route('assistant-head-teacher')}}">সহকারী প্রধান শিক্ষক</a></li>
                                    <li><a class="dropdown-item" href="{{route('all-teachers')}}">শিক্ষক</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarStudentInfo" role="button"
                                    aria-expanded="false">
                                    শিক্ষার্থী তথ্য
                                </a>
                                <ul class="dropdown-menu s-dropdown-custom" aria-labelledby="navbarStudentInfo">
                                    <li><a class="dropdown-item" href="#">বর্তমান শিক্ষার্থী তথ্য</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarStudentInfo" role="button"
                                    aria-expanded="false">
                                    ফলাফল
                                </a>
                                <ul class="dropdown-menu s-dropdown-custom" aria-labelledby="navbarStudentInfo">
                                    <li><a class="dropdown-item" href="#">ভর্তি ফলাফল</a></li>
                                    <li><a class="dropdown-item" href="#">পরীক্ষার ফলাফল</a></li>
    
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">ভর্তি সংক্রান্ত তথ্য</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarStudentInfo" role="button"
                                    aria-expanded="false">
                                    একাডেমিক তথ্য
                                </a>
                                <ul class="dropdown-menu s-dropdown-custom" aria-labelledby="navbarStudentInfo">
                                    <li><a class="dropdown-item" href="#">ক্লাস রুটিন</a></li>
    
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">লগইন</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </section>
    <!-- Menu-End -->


    @yield('content')

    <!-- Footer Section Start Here -->
    <footer class="page-footer ">
        <div class="footer-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-12 col-md-6">
                        <div class="single-footer">
                            <div class="sf-img">
                                <img src="{{asset('frontend')}}/school/assets/img/jggSchool-logo.png" alt="jggSchoolLogo">
                            </div>
                            <ul class="footer-list f-add">
                                <li><i class="fas fa-map-marker-alt"></i>Jessore, Shahid Sarak Rd, Khulna 7400</li>
                                <li><i class="fas fa-envelope"></i>Email: school@name.edu.bd</li>
                                <li><i class="fas fa-phone-alt"></i>Phone: 0421-65786</li>
                                <li><i class="fas fa-phone-alt"></i>Phone: +88010421-657860</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 col-md-6">
                        <div class="single-footer">
                            <h3>ভর্তি সংক্রান্ত তথ্য</h3>
                            <ul class="footer-list footer-links">
                                <li><a href="#">ভর্তি পরীক্ষার ফরম বিতরণ শুরু: প্রতিবছর ০১ নভেম্বর থেকে।</a></li>
                                <li><a href="#">প্রশ্নেরধরন: MCQ/এক কথায়প্রকাশ।</a></li>
                                <li><a href="#">পরীক্ষার নম্বর: ৭০ নম্বর (বাংলা-২০, ইংরেজি-২০, গণিত-২০ ও সাধারণ
                                        জ্ঞান-১০)</a></li>
                                <li><a href="#">সময়- ১:০০ ঘন্টা।</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 col-md-6">
                        <div class="single-footer">
                            <h3>বিদ্যালয়-সংক্রান্ত</h3>
                            <ul class="footer-list footer-links">
                                <li><a href="#">বিজ্ঞপ্তি </a></li>
                                <li><a href="#">শিক্ষা বর্ষপঞ্জি</a></li>
                                <li><a href="#">পাঠ্যক্রম</a></li>
                                <li><a href="#">একাডেমিক পারফরম্যান্স</a></li>
                                <li><a href="#">স্কুল সুবিধা</a></li>
                                <li><a href="#">পদ্ধতি এবং নীতি</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 col-md-6">
                        <div class="single-footer">
                            <h3>নীতিমালা</h3>
                            <ul class="footer-list footer-links">
                                <li><a href="#">টিউশন ফি এবং অন্যান্য পেমেন্ট</a></li>
                                <li><a href="#">উপস্থিতি</a></li>
                                <li><a href="#">পোষাক কোড এবং স্বাস্থ্যবিধি</a></li>
                                <li><a href="#">অভিভাবক-স্কুল যোগাযোগ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="copy-text">
                            <p class="mb-0">Copyright ©2021 WB SOFTWARES. All Rights Reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section Ending Here -->


    <!-- Footer-End -->
    <script src="{{asset('frontend')}}/school/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend')}}/school/assets/js/Table-With-Search-search-table.js"></script>
    </body>
    <script>
    </script>
    
    </html>