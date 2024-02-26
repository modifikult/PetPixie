"use strict";

const gulp            = require('gulp');
const sass            = require('gulp-sass');
const concat          = require('gulp-concat');
const prefix          = require('gulp-autoprefixer');
const cssnano         = require('gulp-cssnano');
const rename          = require('gulp-rename');
const webpack         = require('webpack');
const webpackStream   = require('webpack-stream');
const browserSync     = require('browser-sync');
const babel           = require('gulp-babel');
const plumber         = require("gulp-plumber");
const server          = browserSync.create();

//env variables
const themeName = 'PetPixies';

function compileCss() {
  return gulp
    .src("src/scss/main.scss")
    .pipe(sass().on('error', sass.logError))
    .pipe(cssnano())
    .pipe(concat('main.css'))
    .pipe(rename({suffix: '.min'}))
    .pipe(prefix('last 2 versions'))
    .pipe(gulp.dest("dist"))
    .pipe(server.stream());
};

function compileJs() {
  return gulp.src('src/js/main.js')
    .pipe(webpackStream({
      output: {
        filename: "main.min.js",
      },
      module: {
        rules: [
          {
            test: /\.(js|jsx)$/,
            exclude: /(node_modules)/,
            loader: "babel-loader",
            query: {
              presets: ["@babel/preset-env"],
            },
          },
        ],
      },
    }), webpack)
    .pipe(gulp.dest('dist'));
  
}

function compileVendorCss() {
  return gulp.src('assets/styles/libs/*.css')
        .pipe(concat('vendors.min.css'))
        .pipe(gulp.dest('dist'));
}

function compileVendorJs () {
  return gulp.src('js/vendors/*.js')
        .pipe(concat('vendors.min.js'))
        .pipe(gulp.dest('dist'));
}

function watchFiles() {
  gulp.watch('src/scss/**/*.scss', compileCss);
  gulp.watch('src/js/**/*.js', compileJs);
  gulp.watch('**/*.php').on('change', server.reload);
}

const build = gulp.series(compileCss,compileJs, watchFiles);
const watch = gulp.parallel(watchFiles);

// export tasks

exports.compileCss = compileCss;
exports.compileJs = compileJs;
exports.compileVendorJs = compileVendorJs;
exports.compileVendorCss = compileVendorCss;
exports.watch = watchFiles;
exports.build = build;
exports.default = build;
