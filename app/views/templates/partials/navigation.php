<div class="row">
	<div class="large-12 columns">

		<!-- HTML nav-bar using Foundation -->
		<nav class="top-bar" data-topbar role="navigation">

			<ul class="title-area">
				<li class="name">
				  <h1 class="authentication-title"><a href="{{ urlFor('home') }}">Authentication</a></h1>
				</li>
				 <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon">
					<a href="#"><span>Menu</span></a>
				</li>
			</ul>

			<section class="top-bar-section">

				<!-- Right Nav Section -->
				<ul class="right">
					<li class="divider"></li>
					<li><a href="{{ urlFor('user.all') }}">All Users</a></li>
					{% if auth %}
						{% if auth.isAdmin %}
							<li class="divider"></li>
							<li><a href="{{ urlFor('admin.example') }}">Admin Area</a></li>
						{% endif %}
						<li class="divider"></li>
						<li class="has-dropdown">
							<a href="#">Your Account</a>
							<ul class="dropdown">
								<li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Profile</a></li>
								<li><a href="{{ urlFor('account.profile') }}">Update Account</a></li>
								<li><a href="{{ urlFor('password.change') }}">Change Password</a></li>
							</ul>
						</li>
					{% else %}
						<li class="divider"></li>
						<li><a href="{{ urlFor('register') }}">Register</a></li>
						<li class="divider"></li>
						<li><a href="{{ urlFor('login') }}">Login</a></li>
					{% endif %}

				</ul>

			    <!-- Left Nav Section -->
			    <ul class="left">
			    	{% if auth %}
			    		<!-- Signed in notification -->
				      	<li class="active has-dropdown">				      		
					      	<a href="#">
								Signed in as {{ auth.getFullNameOrUsername }}
								<img src="{{ auth.getAvatarUrl({ size: 30 }) }}" alt="Your Avatar">
					      	</a>
					      	<ul class="dropdown">
								<!-- Log out -->
				      			<li>
					      			<a href="{{ urlFor('logout') }}">
						      		Logout
					      			</a>
				      			</li>
					      	</ul>
				      	</li>
			      	{% endif %}
			    </ul>

		 	</section>

		</nav>

	</div>
</div>