'use strict';

var gulp = require('gulp');

var sass = require('gulp-sass');
var uglify = require('gulp-uglify');
var rename = require("gulp-rename");
var sourcemaps = require('gulp-sourcemaps');

/**
 *
 */
gulp.task('sass', function(){
    return gulp.src('template/assets/sass/app.scss')
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(sourcemaps.write())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/css/'));
});

/**
 *
 */
gulp.task('js', function(){
    return gulp.src('template/assets/js/*.js')
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('public/js/'));
});

/**
 *
 */
gulp.task('watch', function(){
    gulp.watch('template/assets/sass/app.scss', ['sass']);
    gulp.watch('template/assets/js/*.js', ['js']);
});
