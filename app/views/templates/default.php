<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<title>Authentication | {% block title %}{% endblock %}</title>
		
		<!-- Compiled/concatenated stylesheet app.css -->
		<link rel="stylesheet" href="{{ baseUrl }}{{ urlFor('home') }}css/app.css">

		<!-- Modernizr.js -->
		<script src="{{ baseUrl }}{{ urlFor('home') }}js/modernizr.js"></script>

	</head>
	<body>
		{% include 'templates/partials/navigation.php' %}
		{% include 'templates/partials/messages.php' %}
		{% block content %}{% endblock %}

		<!-- Include app.js -->
		<script src="{{ baseUrl }}{{ urlFor('home') }}js/app.js"></script>

	</body>
</html>