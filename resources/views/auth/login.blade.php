
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="ThemeSelect">
    <title>User-Login/School Management Software</title>
    <link rel="apple-touch-icon" href="{{('backend/app-assets/images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{('backend/app-assets/images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/vendors/vendors.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/app-assets/css/themes/vertical-modern-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/app-assets/css/themes/vertical-modern-menu-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/pages/login.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link href="{{asset('backend/custom/css/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('backend/app-assets/css/custom/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/custom/css/custom.css')}}">
    <!-- END: Custom CSS-->
    <style>
        .login-bottom-button {
            display: flex;
            justify-content: center;
        }
        
        .login-bottom-button a{
            margin: 3px 5px;
            text-align: center;
            padding: 0px 35px;
        }

        .login-form .custom-form-input {
            margin-left: 50px !important;
        }
        
        .login-form .input-field label {
            margin-left: 3.5rem;
        }
        
        .login-form .input-field i {
            margin-top: -8px;
            margin-left: -10px;
            left: 12px;
            color: #6b6f82c9;
        }
       
        .login-form .input-field span {
            position: absolute;
            margin-top: 12px;
            margin-left: 20px;
        }

        @media (max-width: 768px) {
            /* Custom responsive css start... */
            .login-bottom-button a {
                padding: 0px 28px;
            }
        }
        
        @media (max-width: 575px) {
            /* Custom responsive css start... */
            .login-bottom-button a {
                padding: 0px 12px;
            }
        }

        @media (max-width: 350px) {

            iframe{
                width: 250px !important;
            }
        }
    </style>
</head>
<!-- END: Head-->

<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page"
    data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="login-page" class="row">
                    <div class="col s12 m10 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
                        <form class="login-form" method="POST" action="{{ route('login') }}">
                         @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5 class="ml-4" id="loginHeadingTitle">Login</h5>
                                </div>
                            </div>
                            <input type="hidden" name="role" id="role" value="superadmin">
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">person_outline</i> <span id="roleShortName">SP-</span>
                                    <input class="custom-form-input" id="login_id" name="login_id" type="text" value="{{ old('login_id') }}">
                                    <label for="login_id" class="center-align">Login Id</label>
                                </div>
                            </div>
                            <div class="row margin">
                                <div class="input-field col s12">
                                    <i class="material-icons prefix pt-2">lock_outline</i>
                                    <input class="custom-form-input" id="password" name="password" type="password" value="{{ old('password') }}">
                                    <label for="password">Password </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12 m12 l12 ml-2 mt-1">
                                    {{-- <p>
                                        <label>
                                            <input type="checkbox" />
                                            <span>Remember Me</span>
                                        </label>
                                    </p> --}}
                                    <div class="w-100" >
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                    
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block custom-text-danger">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6 m6 l6">
                                   
                                </div>
                                <div class="input-field col s6 m6 l6">
                                    <p class="margin right-align medium-small"><a
                                            href="{{ route('password.request') }}">Forgot password ?</a></p>
                                </div>
                            </div>
                        </form>

                        <div class="login-bottom-button d-flex">
                            <a onclick="adminListener()" class="btn waves-effect waves-light purple lightrn-1" type="submit"
                                >
                                Admin
                            </a>
                            
                            <a onclick="accountentListener()" class="btn waves-effect waves-light purple lightrn-1" type="submit"
                                >
                                Accountent
                            </a>
                            
                            <a onclick="librarianListener()" class="btn waves-effect waves-light purple lightrn-1" type="submit"
                                >
                                Librarian
                            </a>

                        </div>
                        <div class="login-bottom-button d-flex">
                            
                            <a onclick="teacherListener()" class="btn waves-effect waves-light purple lightrn-1" type="submit">
                                Teacher
                            </a>
                            
                            <a onclick="studentListener()" class="btn waves-effect waves-light purple lightrn-1" type="submit">
                                Student
                            </a>
                            
                            <a onclick="guardianListener()" class="btn waves-effect waves-light purple lightrn-1" type="submit"
                                >
                                Guardian
                            </a>
                        </div>

                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('backend/app-assets/js/vendors.min.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/plugins.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/search.js')}}"></script>
    <script src="{{asset('backend/app-assets/js/custom/custom-script.js')}}"></script>
    <script src="{{ asset('backend') }}/custom/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <!-- END VENDOR JS-->


    <script>
        function adminListener(){
            $("#login_id").focus();
            $("#login_id").val('202310002');
            $("#password").focus();
            $("#password").val('123');
            $("#role").val('admin'); 
            $("#loginHeadingTitle").text('Admin Login');
            $("#roleShortName").text('AD-');
        }
        
        function accountentListener(){
            $("#login_id").focus();
            $("#login_id").val('202310003');
            $("#password").focus();
            $("#password").val('123');
            $("#role").val('accountent');
            $("#loginHeadingTitle").text('Accountent Login');
            $("#roleShortName").text('AC-');
        }
        
        function librarianListener(){
            $("#login_id").focus();
            $("#login_id").val('202310004');
            $("#password").focus();
            $("#password").val('123');
            $("#role").val('librarian');
            $("#loginHeadingTitle").text('Librarian Login');
            $("#roleShortName").text('LB-');
        }

        function teacherListener(){
            $("#login_id").focus();
            $("#login_id").val('202310005');
            $("#password").focus();
            $("#password").val('123');
            $("#role").val('teacher');
            $("#loginHeadingTitle").text('Teacher Login');
            $("#roleShortName").text('TC-');
        }


        function studentListener(){
            $("#login_id").focus();
            $("#login_id").val('202310006');
            $("#password").focus();
            $("#password").val('123');
            $("#role").val('student');
            $("#loginHeadingTitle").text('Student Login');
            $("#roleShortName").text('ST-');
        }

        function guardianListener(){
            $("#login_id").focus();
            $("#login_id").val('202310007');
            $("#password").focus();
            $("#password").val('123');
            $("#role").val('guardian');
            $("#loginHeadingTitle").text('Guardian Login');
            $("#roleShortName").text('GD-');
        }
    </script>

</body>

</html>