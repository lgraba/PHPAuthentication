{% extends 'templates/default.php' %}

{% block title %}Update Profile{% endblock %}

{% block content %}

<h2> Update Profile</h2>

<form action="{{ urlFor('account.profile.post') }}" method="post" autocomplete="off">
	
	<div>
		<label for="email">Email</label>
		<input type="text" name="email" id="email" value="{{ request.post('email') ? request.post('email') : auth.email }}">
		{% if errors.has('Email') %}{{ errors.first('Email')}}{% endif %}
	</div>

	<div>
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" id="first_name" value="{{ request.post('first_name') ? request.post('first_name') : auth.first_name }}">
		{% if errors.has('First Name') %}{{ errors.first('First Name')}}{% endif %}
	</div>

	<div>
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" id="last_name" value="{{ request.post('last_name') ? request.post('last_name') : auth.last_name }}">
		{% if errors.has('Last Name') %}{{ errors.first('Last Name')}}{% endif %}
	</div>

	<input type="submit" value="Update Profile">

	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>

{% endblock %}