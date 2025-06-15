const gulp = require('gulp');
const uglify = require('gulp-uglify');
const cssnano = require('gulp-cssnano');
const rename = require('gulp-rename');
const touch = require('gulp-touch-fd');
// Different approach for versioning
const hash = require('gulp-hash'); // You'll need to install this
const revReplace = require('gulp-rev-replace');

// Task to minify JavaScript files
gulp.task('minify-js', () => {
  return gulp.src('static/js/*.js')
    .pipe(uglify())
    .pipe(rename({ suffix: '.min' }))
    // Use hash instead of rev
    .pipe(hash()) // Generate a hash
    .pipe(gulp.dest('dist/scripts'))
    .pipe(hash.manifest('asset-manifest.json', {
      deleteOld: true,
      sourceDir: 'dist/scripts'
    }))
    .pipe(gulp.dest('dist/scripts'))
    .pipe(touch());
});

// Task to minify CSS files
gulp.task('minify-css', () => {
  return gulp.src('static/css/*.css')
    .pipe(cssnano({
        zindex: false,  // Prevent z-index from being altered
        discardComments: {
        removeAll: true
        }
    }))
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('dist/styles'))
    .pipe(touch())
    .pipe(rename({ suffix: '.min' }))
    // Use hash instead of rev
    .pipe(hash())
    .pipe(gulp.dest('dist/styles'))
    .pipe(hash.manifest('asset-manifest.json', {
      deleteOld: true,
      sourceDir: 'dist/styles'
    }))
    .pipe(gulp.dest('dist/styles'))
    .pipe(touch());
});

// Task to update HTML with versioned files
gulp.task('update-html', () => {
  const manifest = gulp.src('dist/scripts/asset-manifest.json');

  return gulp.src('path/to/your/html/files/*.php') // Adjust the path to your HTML/PHP files
    .pipe(revReplace({ manifest: manifest }))
    .pipe(gulp.dest('path/to/your/html/files'));
});

// Watch task to automatically process changed files
gulp.task('watch', () => {
  gulp.watch('static/js/*.js', gulp.series('minify-js', 'update-html'));
  gulp.watch('static/css/*.css', gulp.series('minify-css', 'update-html'));
});

// Default task to run all tasks in sequence
gulp.task('default', gulp.series(
  gulp.parallel('minify-js', 'minify-css'),
  'update-html',
  'watch'
));