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
	
	return gulp.src([							// Source Files
		'./assets/styles/app.scss'
	])
	.pipe(sass({								// Compile SASS with
		includePaths: [							// Foundation include path as object
			'./vendor/zurb/foundation/scss'
		]
	}))											
	.pipe(concat('app.css'))					// Concatenate all into app.css
	.pipe(gulp.dest('./public/css'));			// Place app.css into the specified directory
});

// Default task - runs the tasks within []
gulp.task('default', ['styles']);
