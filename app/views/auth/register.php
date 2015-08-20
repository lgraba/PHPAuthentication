{% extends 'templates/default.php' %}

{% block title %}Register{% endblock %}

{% block content %}

<form action="{{ urlFor('register.post') }}" method="post" autocomplete="off">

	<div>
		<label for="email">Email</label>
		<input type="text" name="email" id="email"{% if request.post('email') %} value="{{ request.post('email') }}"{% endif %}>
		{% if errors.first('Email') %}{{ errors.first('Email') }}{% endif %}
		{% if errors.first('Email') is same as('Email in use. ') %}<a href="#">Forgot Password?</a>{% endif %}
	</div>
	<div>
		<label for="username">Username</label>
		<input type="text" name="username" id="username"{% if request.post('username') %} value="{{ request.post('username') }}"{% endif %}>
		{% if errors.first('Username') %}{{ errors.first('Username')}}{% endif %}
	</div>
	<div>
		<label for="password">Password</label>
		<input type="password" name="password" id="password">
		{% if errors.first('Password') %}{{ errors.first('Password')}}{% endif %}
	</div>
	<div>
		<label for="password_confirm">Password Confirm</label>
		<input type="password" name="password_confirm" id="password_confirm">
		{% if errors.first('Password Confirmation') %}{{ errors.first('Password Confirmation')}}{% endif %}
	</div>

	<div>
		<input type="submit" value="Register">
	</div>

</form>

{% endblock %}