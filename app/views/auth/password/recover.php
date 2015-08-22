{% extends 'templates/default.php' %}

{% block title %}Recover Password{% endblock %}

{% block content %}

	<h2>Recover Password</h2>

	<p>You forgot your password? You stupid motherfucker. Enter your email address to begin recovery (shakes head) ...</p>

	<form action="{{ urlFor('password.recover.post') }}" method="post" autocomplete="off">

		<div>
			<label for="Email">Email</label>
			<input type="text" name="Email" id="Email" {% if request.post('Email') %}value="{{ request.post('Email') }}"{% endif %}>
			{% if errors.has('Email') %}{{ errors.first('Email')}}{% endif %}
		</div>

		<div>
			<input type="submit" value="Recover Password">
		</div>

		<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

	</form>

{% endblock %}