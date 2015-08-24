{% extends 'templates/default.php' %}

{% block title %}Administrator{% endblock %}

{% block content %}
	<h2>Example Administrator Page</h2>
	<a href="{{ urlFor('user.all') }}">View all users here!</a>
{% endblock %}