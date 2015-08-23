// gulpfile.js
// Run this in shell: 'gulp'

// Require in gulp, set to gulp variable (already installed via npm)
var gulp = require('gulp');
// Require in gulp-sass
var sass = require('gulp-sass');
// Require in gulp-concat
var concat = require('gulp-concat');

// Styles task
gulp.task('styles', function() {
	// console.log('You ran styles task!');
	
	return gulp.src([													// Source Files
		'./assets/styles/app.scss'
	])
	.pipe(sass({														// Compile SASS with
		includePaths: [													// Foundation include path as object
			'./vendor/zurb/foundation/scss'
		]
	}))											
	.pipe(concat('app.css'))											// Concatenate all into app.css
	.pipe(gulp.dest('./public/css'));									// Place app.css into the specified directory
});

// Scripts task
// Question: Why didn't composer automatically install dependencies
// for Foundation like JQuery and Modernizr?
// Answer: I guess they were in the components directory
// FUCK IT I'm just going to copy over foundation.min.js to the vendor/foundation directory and include it here wtf
gulp.task('scripts', function() {
	gulp.src([
		'./vendor/components/jquery/jquery.js',								// Used composer to install JQuery component (COMPONENTS)
		'./vendor/zurb/foundation/js/foundation/foundation.js',					// Foundation.js only for loading plugins individually?
		'./vendor/zurb/foundation/js/foundation/foundation.alert.js',	// Foundation.alert.js (alert boxes)
		'./vendor/zurb/foundation/js/foundation/foundation.dropdown.js',	// Foundation drop downs
		'./vendor/zurb/foundation/js/foundation/foundation.min.js',			// CANT BELIEVE I had to include this shit
		'./assets/scripts/app.js'										// Our Foundation initializer script
	])
	.pipe(concat('app.js'))
	.pipe(gulp.dest('./public/js'));									// Output in our js directory

	return gulp.src('./vendor/components/modernizr/modernizr.js')				// Modernizr best included in header of document (COMPONENTS)
		.pipe(gulp.dest('./public/js'));
});

// Watch task
gulp.task('watch', function() {
	gulp.watch('./assets/styles/**/*.scss', ['styles']);
	gulp.watch('./assets/scripts/**/*.js', ['scripts']);
});

// Default task - runs the tasks within []
gulp.task('default', ['styles','scripts']);
