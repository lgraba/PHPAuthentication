{% extends 'email/templates/default.php' %}

{% block content %}
	<p><a href="{{ baseUrl }}{{ urlFor('password.reset') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}" >Reset your Authentication account password.</a></p>
{% endblock %}