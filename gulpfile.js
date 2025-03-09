const gulp = require('gulp');
const uglify = require('gulp-uglify');
const cssnano = require('gulp-cssnano');
const rename = require('gulp-rename');
const touch = require('gulp-touch-fd'); // Add this package

// Task to minify JavaScript files individually
gulp.task('minify-js', () => {
  return gulp.src('static/js/*.js') // Adjust the source path to your scripts directory
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' })) // Append .min to each file
    .pipe(gulp.dest('dist/scripts')) // Output to a separate directory
    .pipe(touch()); // Updates file modification time
});

// Task to minify CSS files individually
gulp.task('minify-css', () => {
  return gulp.src('static/css/*.css') // Adjust the source path to your styles directory
    .pipe(cssnano())
    .pipe(rename({ suffix: '.min' })) // Append .min to each file
    .pipe(gulp.dest('dist/styles')) // Output to a separate directory
    .pipe(touch()); // Updates file modification time
});

// Watch task to automatically process changed files
gulp.task('watch', () => {
    gulp.watch('static/js/*.js', gulp.series('minify-js'));
    gulp.watch('static/css/*.css', gulp.series('minify-css'));
  });

// Default task to run both minify tasks in parallel
gulp.task('default', gulp.series(
  gulp.parallel('minify-js', 'minify-css'),
  'watch'
));