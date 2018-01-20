const gulp = require('gulp');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

gulp.task('default', ['js']);

gulp.task('js', () => {
	gulp.src('resource/js/**/*.js')
		.pipe(babel())
		.pipe(uglify())
		.pipe(gulp.dest('resource/dist/js/'));
});
