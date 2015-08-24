{% extends 'templates/default.php' %}

{% block title %}{{ auth.getFullNameOrUsername }}{% endblock %}

{% block content %}

	<div class="row">
		<div class="large-12 columns">

			<div class="row">
				<div class="large-12 columns">
						
					<h2 class="subheader">{{ user.username }}'s Profile</h2>
					<a href="{{ urlFor('account.profile') }}">Update Account</a> |
					<a href="{{ urlFor('password.change') }}">Change Password</a>
				</div>
			</div>

			<div class="row">

				<div class="large-2 columns">
					<img src="{{ user.getAvatarUrl({size: 140}) }}" alt="Profile picture for {{ user.getFullNameOrUsername }}">
				</div>

				<div class="large-10 columns">
					<div class="profile">
						<dl>
							{% if  user.getFullName %}
								<dt>Full Name</dt>
								<dd>{{ user.getFullName }}</dd>
							{% endif %}

							<dt>Email Address</dt>
							<dd>{{ user.email }}</dd>
						</dl>
					</div>
				</div>
			</div>

		</div>
	</div>
{% endblock %}