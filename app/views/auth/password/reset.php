{% extends 'templates/default.php' %}

{% block title %}Reset Password{% endblock %}

{% block content %}

<h2>Reset {{ user.getFullNameOrUsername }}'s Password</h2>

<form action="{{ urlFor('password.reset.post') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}" method="post" autocomplete="off">

	<div>
		<label for="new_password">New Password</label>
		<input type="password" name="new_password" id="new_password">
		{% if errors.has('new_password') %}{{ errors.first('new_password')}}{% endif %}
	</div>

	<div>
		<label for="new_password_confirm">New Password Confirmation</label>
		<input type="password" name="new_password_confirm" id="new_password_confirm">
		{% if errors.has('New Password Confirmation') %}{{ errors.first('New Password Confirmation')}}{% endif %}
	</div>

	<div>
		<input type="submit" value="Reset Password">
	</div>

	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>

{% endblock %}