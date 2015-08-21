{% extends 'email/templates/default.php' %}

{% block content %}
	<p>You have registered with Authentication!</p>
	<p><a href="{{ baseUrl }}{{ urlFor('activate') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}" >Activate your account</a></p>
{% endblock %}