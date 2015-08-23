<!-- HTML nav-bar using Foundation -->
<nav class="top-bar" data-topbar role="navigation">

	<ul class="title-area">
		<li class="name">
		  <h1><a href="{{ urlFor('home') }}">Authentication</a></h1>
		</li>
		 <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
		<li class="toggle-topbar menu-icon">
			<a href="#"><span>Menu</span></a>
		</li>
	</ul>

	<section class="top-bar-section">

		<!-- Right Nav Section -->
		<ul class="right">
			<li><a href="{{ urlFor('user.all') }}">All Users</a></li>
			{% if auth %}
				{% if auth.isAdmin %}
					<li><a href="{{ urlFor('admin.example') }}">Admin Area</a></li>
				{% endif %}
				<li class="has-dropdown">
					<a href="#">Your Account</a>
					<ul class="dropdown">
						<li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Profile</a></li>
						<li><a href="{{ urlFor('account.profile') }}">Update Account</a></li>
						<li><a href="{{ urlFor('password.change') }}">Change Password</a></li>
					</ul>
				</li>
			{% else %}
				<li><a href="{{ urlFor('register') }}">Register</a></li>
				<li><a href="{{ urlFor('login') }}">Login</a></li>
			{% endif %}

		</ul>

	    <!-- Left Nav Section -->
	    <ul class="left">
	    	{% if auth %}
	    		<!-- Signed in notification -->
		      	<li class="active">
			      	<a href="#">
						Signed in as {{ auth.getFullNameOrUsername }}
						<img src="{{ auth.getAvatarUrl({ size: 30 }) }}" alt="Your Avatar">
			      	</a>
		      	</li>
		      	<!-- Log out -->
		      	<li>
			      	<a href="{{ urlFor('logout') }}">
				      	Logout
			      	</a>
		      	</li>
	      	{% endif %}
	    </ul>

 	</section>

</nav>