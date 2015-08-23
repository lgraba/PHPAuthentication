<!-- HTML nav-bar using Foundation -->
<nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">
    <li class="name">
      <h1><a href="#">Authentication</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li class="active"><a href="#">Right Button Active</a></li>
      <li class="has-dropdown">
        <a href="#">Right Button Dropdown</a>
        <ul class="dropdown">
          <li><a href="#">First link in dropdown</a></li>
          <li class="active"><a href="#">Active link in dropdown</a></li>
        </ul>
      </li>
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
      <li><a href="#">Left Nav Button</a></li>
    </ul>
  </section>
</nav>

{% if auth %}
	Signed in as {{ auth.getFullNameOrUsername }}
	<img src="{{ auth.getAvatarUrl({ size: 30 }) }}" alt="Your Avatar">
{% endif %}
<ul>
	<li><a href="{{ urlFor('home') }}">Home</a></li>
	
	{% if auth %}

		<li><a href="{{ urlFor('logout') }}">Logout</a></li>
		<li><a href="{{ urlFor('user.profile', {username: auth.username}) }}">Your Profile</a></li>
		<li><a href="{{ urlFor('account.profile') }}">Update Your Profile</a></li>
		<li><a href="{{ urlFor('password.change') }}">Change Password</a></li>

			{% if auth.isAdmin %}
				<li><a href="{{ urlFor('admin.example') }}">Admin Area</a></li>
			{% endif %}

	{% else %}
		<li><a href="{{ urlFor('register') }}">Register</a></li>
		<li><a href="{{ urlFor('login') }}">Login</a></li>
	{% endif %}

	<li><a href="{{ urlFor('user.all') }}">All Users</a></li>

</ul>