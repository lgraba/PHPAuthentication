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

		<div class="row">
			<div class="large-12 columns">

				{% include 'templates/partials/navigation.php' %}
				{% include 'templates/partials/messages.php' %}
				
				<div class="row">

					<div class="large-12 columns">
						{% block content %}{% endblock %}
					</div>

				</div>

				<footer class="row">
					<div class="large-12 columns"><hr/>
						<div class="row">

							<div class="large-6 medium-4 columns">
								<p>Logan Graba</p>
							</div>

							<div class="large-6 medium-8 columns">
								<ul class="inline-list right">
									<li><a href="https://github.com/lgraba/PHPAuthentication">PHPAuthentication on Github</a></li>
								</ul>
							</div>

						</div>
					</div>
				</footer>

			</div>
		</div>

		<!-- Include app.js -->
		<script src="{{ baseUrl }}{{ urlFor('home') }}js/app.js"></script>

	</body>
</html>