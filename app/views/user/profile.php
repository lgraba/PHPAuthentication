{% extends 'templates/default.php' %}

{% block title %}{{ auth.getFullNameOrUsername }}{% endblock %}

{% block content %}

	<h2>{{ user.username }}'s Profile</h2>
	<img src="{{ user.getAvatarUrl({size: 90}) }}" alt="Profile picture for {{ user.getFullNameOrUsername }}">
	<dl>
		{% if  user.getFullName %}
			<dt>Full Name</dt>
			<dd>{{ user.getFullName }}</dd>
		{% endif %}

		<dt>Email Address</dt>
		<dd>{{ user.email }}</dd>
	</dl>

{% endblock %}