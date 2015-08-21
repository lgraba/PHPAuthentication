{% if auth %}
	<p>Signed in as {{ auth.getFullNameOrUsername }}</p>
{% endif %}
<ul>
	<li><a href="{{ urlFor('home') }}">Home</a></li>
	
	{% if auth %}
	<li><a href="{{ urlFor('logout') }}">Logout</a></li>
	{% else %}
	<li><a href="{{ urlFor('register') }}">Register</a></li>
	<li><a href="{{ urlFor('login') }}">Login</a></li>
	{% endif %}

</ul>