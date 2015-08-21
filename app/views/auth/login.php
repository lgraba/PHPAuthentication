{% extends 'templates/default.php' %}

{% block title %}Login{% endblock %}

{% block content %}

<form action="{{ urlFor('login.post') }}" method="post" autocomplete="off">

	<div>
		<label for="identifier">Username/Email</label>
		<input type="text" name="identifier" id="identifier">
		{% if errors.first('Identifier') %}{{ errors.first('Identifier') }}{% endif %}
	</div>

	<div>
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
		{% if errors.first('Password') %}{{ errors.first('Password')}}{% endif %}
	</div>

	<div>
		<input type="submit" value="Login">	
	</div>

	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>

{% endblock %}