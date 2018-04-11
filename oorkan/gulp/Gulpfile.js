/*! use cleanCSS instead of gulp-cssmin to support correct sourcemaps on minification
  of the final style */

const 	gulp = require("gulp"),
		sass = require("gulp-sass"),
    sourcemaps = require("gulp-sourcemaps"),
		concat = require("gulp-concat"),
		cssmin = require("gulp-clean-css"),
		uglify = require("gulp-uglify-es").default,
		eslint = require("gulp-eslint"),
		imagemin = require("gulp-imagemin"),
		watch = require("gulp-watch"),
		cwd = "./lib/build",
		fwd = "./lib/deploy";


gulp.task("sass", function () {
  return gulp.src(`${cwd}/scss/**/*.scss`)
    .pipe(sourcemaps.init())
    .pipe(sass().on("error", sass.logError))
    .pipe(concat("style.css"))
    .pipe(cssmin())
    .pipe(sourcemaps.write("."))
    .pipe(gulp.dest(`../../`));
});

gulp.task("js", function () {
  return gulp.src(`${cwd}/js/**/*.js`)
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError())
  	.pipe(concat("main.js"))
  	.pipe(uglify())
  	.pipe(gulp.dest(`${fwd}/js/`));
});

gulp.task("watch", function () {
  gulp.watch(`${cwd}/scss/**/*.scss`, ['sass']);
  gulp.watch(`${cwd}/js/**/*.js`, ["js"]);

  return;
});



gulp.task("default", ["sass", "js", "watch"]);
