{% extends 'templates/default.php' %}

{% block title %}Change Password{% endblock %}

{% block content %}

<form action="{{ urlFor('password.change.post') }}" method="post" autocomplete="off">

	<div>
		<label for="current_password">Current Password</label>
		<input type="password" name="current_password" id="current_password">
		{% if errors.has('Current Password') %}{{ errors.first('Current Password')}}{% endif %}
	</div>

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
		<input type="submit" value="Change Password">	
	</div>

	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>

{% endblock %}