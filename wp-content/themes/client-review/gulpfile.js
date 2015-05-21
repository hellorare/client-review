// ==========================================================================
//
//  Gulp Config
//    Default build for development will watch and recompile, with debug
//    information on each change of local styleheets + javascript files.
//
// ==========================================================================


var gulp = require('gulp'),
		plugins = require('gulp-load-plugins')(),
		mainBowerFiles = require('main-bower-files')
		neat = require('node-neat').includePaths;


// --------------------------------------------------------------------------
//   Configuration
// --------------------------------------------------------------------------

var config = {
	stylesheets: 'scss',
	scripts: './js',
	images: './images',
	vendor: './js/vendor',
}

config.plugins = mainBowerFiles({
	paths: {
		bowerDirectory: config.vendor
	}
});

console.log(config.plugins);

var filterByExtension = function(extension){
	return plugins.filter(function(file){
		return file.path.match(new RegExp('.' + extension + '$'));
	});
};

// --------------------------------------------------------------------------
//   Remove all existing compiled files
// --------------------------------------------------------------------------

gulp.task('clean', function () {
	gulp.src(['./style.css'])
		.pipe(plugins.clean({ force: true, read: false }));
});


// --------------------------------------------------------------------------
//   Compile SCSS into CSS stylesheet
// --------------------------------------------------------------------------

gulp.task('styles', function () {
	gulp.src(config.stylesheets + '/style.scss')
		.pipe(plugins.changed('./'))
		.pipe(plugins.rubySass({
			style: 'expanded',
			quiet: true,
			sourcemap: false,
			sourcemapPath: '.',
			loadPath: ['styles'].concat(neat)
		}))
		.pipe(plugins.combineMediaQueries())
		.pipe(plugins.autoprefixer("last 3 version", "> 1%", "ie 8", "ie 7"))
		.pipe(gulp.dest('./'));
});


// --------------------------------------------------------------------------
//   Compile SCSS and minify into CSS stylesheet
// --------------------------------------------------------------------------

gulp.task('ugly-styles', function () {
	gulp.src(config.stylesheets + '/style.scss')
		.pipe(plugins.changed('./'))
		.pipe(plugins.rubySass({
			style: 'compressed',
			quiet: true,
			lineNumbers: true,
			sourcemap: false,
			sourcemapPath: '.',
			loadPath: ['styles'].concat(neat)
		}))
		.pipe(plugins.combineMediaQueries())
		.pipe(plugins.autoprefixer("last 3 version", "> 1%", "ie 8", "ie 7"))
		.pipe(plugins.minifyCss())
		.pipe(gulp.dest('./'));
});


// --------------------------------------------------------------------------
//   Concat all script files required into `all.min.js`
// --------------------------------------------------------------------------

gulp.task('scripts', function () {

	if(!config.plugins.length){
		// No main files found. Skipping....
		return;
	}

	var jsFilter = filterByExtension('js');

	gulp.src(config.plugins)
		.pipe(jsFilter)
		.pipe(plugins.concat('plugins.js'))
		.pipe(gulp.dest(config.scripts));
});


// --------------------------------------------------------------------------
//   Concat + uglify all script files required into `all.min.js`
// --------------------------------------------------------------------------

gulp.task('ugly-scripts', function () {

	if(!config.plugins.length){
		// No main files found. Skipping....
		return;
	}

	var jsFilter = filterByExtension('js');

	gulp.src(config.plugins)
		.pipe(jsFilter)
		.pipe(plugins.uglify({
			mangle: true,
			compress: true,
			preserveComments: false
		}))
		.pipe(plugins.concat('plugins.js'))
		.pipe(gulp.dest(config.scripts));
});


// --------------------------------------------------------------------------
//   Optimise all images
// --------------------------------------------------------------------------

gulp.task('images', function () {
	return gulp.src([
			config.images + "/*",
			config.images + "/**/*"])
		.pipe(plugins.imagemin({
			optimizationLevel: 5,
			progressive: true
		}))
		.pipe(gulp.dest(config.images));
});


// --------------------------------------------------------------------------
//   Run development level tasks, and watch for changes
// --------------------------------------------------------------------------

gulp.task('default', ['clean', 'styles', 'scripts'], function () {
	gulp.watch(config.scripts + '/**/*.js', ['scripts']);
	gulp.watch(config.stylesheets + '/**/*.scss', ['styles']);
});

// Run production tasks including minfication, and without watch
gulp.task('production', ['clean', 'ugly-styles', 'ugly-scripts', 'images']);
