{% extends 'templates/default.php' %}

{% block title %}Update Profile{% endblock %}

{% block content %}

<h2> Update Profile</h2>
<p>From here you can update your profile blah blah Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo, quo vitae ratione velit soluta corporis quae nisi unde cumque praesentium animi laboriosam aspernatur! Quisquam, voluptatem sunt vitae. Molestiae, rerum repudiandae!</p>
<div class="section-container tabs" data-section>
            <section class="section">
              <h5 class="title"><a href="#panel1">Update your profile</a></h5>
              <div class="content" data-slug="panel1">
                <form>
                  <div class="row collapse">
                    <div class="large-2 columns">
                      <label class="inline">Your Name</label>
                    </div>
                    <div class="large-10 columns">
                      <input type="text" id="yourName" placeholder="Jane Smith">
                    </div>
                  </div>
                  <div class="row collapse">
                    <div class="large-2 columns">
                      <label class="inline"> Your Email</label>
                    </div>
                    <div class="large-10 columns">
                      <input type="text" id="yourEmail" placeholder="jane@smithco.com">
                    </div>
                  </div>
                  <label>What's up?</label>
                  <textarea rows="4"></textarea>
                  <button type="submit" class="radius button">Submit</button>
                </form>
              </div>
            </section>

<form action="{{ urlFor('account.profile.post') }}" method="post" autocomplete="off">
	
	<div>
		<label class="inline" for="email">Email</label>
		<input type="text" name="email" id="email" value="{{ request.post('email') ? request.post('email') : auth.email }}">
		{% if errors.has('Email') %}{{ errors.first('Email')}}{% endif %}
	</div>

	<div>
		<label class="inline" for="first_name">First Name</label>
		<input type="text" name="first_name" id="first_name" value="{{ request.post('first_name') ? request.post('first_name') : auth.first_name }}">
		{% if errors.has('First Name') %}{{ errors.first('First Name')}}{% endif %}
	</div>

	<div>
		<label class="inline" for="last_name">Last Name</label>
		<input type="text" name="last_name" id="last_name" value="{{ request.post('last_name') ? request.post('last_name') : auth.last_name }}">
		{% if errors.has('Last Name') %}{{ errors.first('Last Name')}}{% endif %}
	</div>

	<input class="button" type="submit" value="Update Profile">

	<input type="hidden" name="{{ csrf_key }}" value="{{ csrf_token }}">

</form>

{% endblock %}