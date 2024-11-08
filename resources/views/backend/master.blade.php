<!DOCTYPE html>

<html lang="en">
	<!--begin::Head-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta name="author" content="ThemeSelect">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>School Management Software</title>
		<link rel="apple-touch-icon" href="{{ asset('backend') }}/app-assets/images/favicon/apple-touch-icon-152x152.png">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend') }}/app-assets/images/favicon/favicon-32x32.png">

		<!-- BEGIN: CSS-->
			@include('backend.layout.partial.style')
		<!-- END: CSS-->

		@yield('styles')

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body
		class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns"
		data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

		@include('backend.layout.header')
		@include('backend.layout.sidebar')

		<!-- BEGIN: Page Main-->
			@if(Request::is('payment-of-student/account-section'))
				<div id="main" class="main-full">
			@else
				<div id="main">
			@endif

			<div class="row">
				<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
				<!-- BEGIN: Content Section-->
					@yield('content')
				<!-- END: Content Section-->
			</div>
		</div>
		<!-- END: Page Main-->

		<!-- BEGIN: Page Footer-->
			@include('backend.layout.footer')
		<!-- END: Footer-->
	
		<!-- BEGIN: Script-->
			@include('backend.layout.partial.script')
		<!-- END: Footer-->
		@yield('scripts')
	</body>
	<!--end::Body-->
</html>