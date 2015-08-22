{% extends 'email/templates/default.php' %}

{% block content %}
	<p>Your Authentication account password was reset on {{ date_time }} .</p>
	<p>You may now log in using your new password!</p>
{% endblock %}