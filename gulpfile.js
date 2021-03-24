'use strict';

const { series, watch, src, dest, parallel } = require('gulp');

// Gulp plugins & utilities
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const del = require('del');
const zip = require('gulp-zip');
const wpPot = require('gulp-wp-pot');
const rtlcss = require('gulp-rtlcss');
const Fiber = require('fibers');
const rename = require('gulp-rename');
const prettier = require('gulp-prettier');
const sassUnicode = require('gulp-sass-unicode');

// PostCSS plugins
const autoprefixer = require('autoprefixer');

// SASS compiler
sass.compiler = require('sass');

/**
 * Browser sync
 */
function serve(done) {
  browserSync.init({
    proxy: 'idenovasi.local/velove',
    open: false,
  });
  done();
}

/**
 * Sass compiler
 */
function css() {
  return src('sass/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        fiber: Fiber,
        outputStyle: 'expanded',
      }).on('error', sass.logError)
    )
    .pipe(sassUnicode())
    .pipe(sourcemaps.write('.'))
    .pipe(dest('.'))
    .pipe(browserSync.stream());
}

/**
 * PostCSS plugins
 */
function cssFinal() {
  return src('*.css')
    .pipe(postcss([autoprefixer()]))
    .pipe(prettier({ singleQuote: true }))
    .pipe(dest('.'));
}

/**
 * Copy files for production
 */
function copyFiles() {
  return src([
    '**',
    '!*.map',
    '!node_modules/**',
    '!dist/**',
    '!sass/**',
    '!.git/**',
    '!gulpfile.js',
    '!package.json',
    '!package-lock.json',
    '!.editorconfig',
    '!.gitignore',
    '!.jshintrc',
    '!.DS_Store',
    '!*.map',
  ]).pipe(dest('dist/velove/'));
}

/**
 * Clean folder
 */
function clean() {
  return del(['dist/**', 'dist'], { force: false });
}

/**
 * Zip folder
 */
function zipped() {
  return src(['dist/**']).pipe(zip('velove.zip')).pipe(dest('dist/'));
}

/**
 * Generate .pot file
 */
function language() {
  return src(['**/*.php', '!dist/**/*'])
    .pipe(
      wpPot({
        domain: 'velove',
        package: 'Velove',
      })
    )
    .pipe(dest('languages/velove.pot'));
}

/**
 * Generate RTL CSS
 */
function rtlCss() {
  return src('style.css')
    .pipe(rtlcss())
    .pipe(rename({ suffix: '-rtl' }))
    .pipe(dest('.'));
}

/**
 * Files to watch
 */
const cssWatcher = () => watch('sass/**/*.scss', css);
const watcher = cssWatcher;

/**
 * Tasks
 */
// exports.default = parallel(serve, watcher);
exports.default = watcher;
exports.sass = css;
exports.build = series(cssFinal, rtlCss, language, copyFiles, zipped);
exports.clean = clean;
