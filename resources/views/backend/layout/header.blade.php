<!-- BEGIN: Header-->
<header class="page-topbar custom-page-header" id="header">
	<div class="navbar navbar-fixed">

		@if(Request::is('payment-of-student/account-section'))
		<nav
			class="navbar-main navbar-color nav-collapsible navbar-dark gradient-45deg-indigo-purple no-shadow nav-collapsed">
			@else
			<nav
				class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
				@endif

				<div class="nav-wrapper">

					<ul class="navbar-list right">

						<li class="hide-on-med-and-down"><a
								class="waves-effect waves-block waves-light toggle-fullscreen"
								href="javascript:void(0);"><i class="material-icons">settings_overscan</i></a></li>
						<li class="hide-on-large-only search-input-wrapper"><a
								class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i
									class="material-icons">search</i></a></li>

						<li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
								data-target="profile-dropdown"><span class="avatar-status avatar-online">
									@if(isset(Auth::user()->image))
									<img src="{{asset('uploads/user_img/'.Auth::user()->image)}}" alt=""
										class="circle z-depth-2 responsive-img">
									@else
									<img src="{{ asset('backend/app-assets/images/user/male.png') }}" alt=""
										class="circle z-depth-2 responsive-img">
									@endif
									<i></i></span></a>
						</li>

					</ul>


					<!-- profile-dropdown-->
					<ul class="dropdown-content" id="profile-dropdown">
						<li><a class="grey-text text-darken-1" href="{{route('profile')}}"><i
									class="material-icons">person_outline</i> Profile</a></li>
						<li>
							<a class="grey-text text-darken-1" href="{{ route('logout') }}" onclick="event.preventDefault();
						document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						</li>
					</ul>

				</div>

			</nav>
	</div>
</header>
<!-- END: Header-->