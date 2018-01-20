const gulp = require('gulp');
const sass = require('gulp-sass');
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS = require('gulp-clean-css');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');

const js_src = 'resource/js';
const js_dest = 'resource/dist/js';
const sass_src = 'resource/css';
const css_src = 'resource/dist/css';	// = sass_dest, css_dest

gulp.task('default', ['css', 'js']);

gulp.task('css', ['sass'], () => {
	gulp.src(`${css_src}/**/*.css`, {base: './'})
		.pipe(autoprefixer({
            browsers: ['last 2 versions']
        }))
		// .pipe(cleanCSS({compatibility: 'ie8'}))
		.pipe(gulp.dest('./'));
});

gulp.task('sass', () => {
	gulp.src(`${sass_src}/**/*.scss`)
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest(css_src));
});

gulp.task('js', () => {
	gulp.src(`${js_src}/**/*.js`)
		.pipe(babel())
		.pipe(uglify())
		.pipe(gulp.dest(js_dest));
});

gulp.task('watch', ['sass:watch', 'js:watch']);

gulp.task('sass:watch', () => {
	gulp.watch(`${sass_src}/**/*.scss`, ['css']);
});

gulp.task('js:watch', () => {
	gulp.watch(`${js_src}/**/*.js`, ['js']);
});
