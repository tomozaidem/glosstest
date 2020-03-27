const gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    uglify      = require('gulp-uglify'),
    rename      = require('gulp-rename'),
    browserSync = require('browser-sync').create(),
    reload      = browserSync.reload;

// compile scss into css
function style() {
    return gulp.src('./sass/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('./css'))
}

// minify js
function js() {
    return gulp.src(['./js/*.js'])
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(gulp.dest('./js'));
}

function watch() {
    browserSync.init({
        files: ['./**/*.php'],
        proxy: 'http://localhost:8000',
    });
    gulp.watch('./sass/**/*.scss', style).on('change', reload);
    gulp.watch('./js/*.js', js).on('change', reload);
}

exports.style = style;
exports.js = js;
exports.watch = watch;