{% extends 'templates/default.php' %}

{% block title %}All Users{% endblock %}

{% block content %}

	<h2>{{ users.count }} Users</h2>

	{% if users is empty %}
		<p>No registered users.</p>
	{% else %}
		{% for user in users %}
			<div class="userlist">

				<span class="username">
					<a href="{{ urlFor('user.profile', {username: user.username}) }}">{{ user.username|e }}</a>
				</span>

				<span class="fullname">
					{% if user.getFullName %}
						({{ user.getFullName }})
					{% endif %}
				</span>

				<span class="admin">
					{% if user.isAdmin %}
						{% if auth.isAdmin %}
							<a href="{{ urlFor('admin.example') }}">Admin</a>
						{% else %}
							<b>Admin</b>
						{% endif %}
					{% endif %}
				</span>

			</div>
		{% endfor %}
	{% endif %}

{% endblock %}