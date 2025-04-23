const gulp = require("gulp");
const postcss = require("gulp-postcss");
const sourcemaps = require("gulp-sourcemaps");
const browserSync = require("browser-sync").create();

// Paths
const paths = {
  css: {
    src: "static/css/tailwind.css",
    dest: "./",
  },
  twig: {
    src: "views/**/*.twig", // Path to all Twig files
  },
};

// PostCSS Task
gulp.task("build-css", function () {
  return gulp
    .src(paths.css.src)
    .pipe(sourcemaps.init()) // Initialize sourcemaps
    .pipe(postcss()) // Process CSS with PostCSS
    .pipe(sourcemaps.write(".")) // Write sourcemaps to the same directory
    .pipe(gulp.dest(paths.css.dest)); // Output the processed CSS
});

gulp.task("hot-reload", function (done) {
  browserSync.reload(); // Reload browser after clearing cache
});

// Watch Task
gulp.task("serve", function () {
  browserSync.init({
    proxy: "http://localhost:9090", // Replace with your local development URL
    notify: false,
  });
  gulp.watch(paths.css.src, gulp.series("build-css", "hot-reload")); // Watch for changes in CSS files
  gulp
    .watch(paths.twig.src)
    .on("change", gulp.series("build-css", "hot-reload")); // Reload browser on Twig changes
});

gulp.task("default", gulp.series("build-css", "serve")); // Default task to build and serve
