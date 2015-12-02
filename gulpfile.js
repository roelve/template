var gulp = require('gulp'),
    // Get packages from package.json
    plugins = require('gulp-load-plugins')();

// Set source paths
var src_paths = {
    sass: 'sass/**/*.scss',
    autoprefixer: '*.css',
    sprites: 'images-src/sprites/**/*.svg',
    functions: ['bower_components/picturefill/external/matchmedia.js',
                'bower_components/hideShowPassword/hideShowPassword.js',
                'bower_components/picturefill/picturefill.js',
                'bower_components/parsleyjs/dist/parsley.js',
                'bower_components/hoverintent/jquery.hoverIntent.js',
                'js-src/functions.js'],
    labjs: ['bower_components/labjs/LAB.min.js',
                'js-src/lab-loader.js'],
    javascript: 'js-src/*.*'
};


// Set destination paths
var dest_paths = {
    sass: '.',
    images: 'images',
    javascript: 'js'
};


// CSS sassing
gulp.task('sass', function() {
    gulp.src(src_paths.sass)
    
        .pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%= error.message %>')}))
        
        .pipe(plugins.sass({ outputStyle: 'compressed', includePaths: 'bower_components/normalize.scss'}))
		.pipe(gulp.dest(dest_paths.sass))
		
        .pipe(plugins.livereload())
        .pipe(plugins.notify({ message: 'sassing complete' }));
});


// Autoprefix this shit!
gulp.task('autoprefixer', function () {
    var autoprefixer = require('autoprefixer');

    return gulp.src(src_paths.autoprefixer)
        .pipe(plugins.postcss([ autoprefixer({ browsers: ['last 2 versions', 'ie 9', 'ios 6', 'android 4'], cascade: false }) ]))
        .pipe(gulp.dest('.'));
});


// Uglify
gulp.task('uglify', function() {
    
    gulp.src(src_paths.functions)
    
        .pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%= error.message %>')}))
    
        .pipe(plugins.concat('functions.min.js'))
        .pipe(plugins.uglify({
            compress: false
        }))
        .pipe(gulp.dest(dest_paths.javascript))
        
        .pipe(plugins.livereload())
        .pipe(plugins.notify({ message: 'Uglify complete' }))
        
    gulp.src(src_paths.labjs)
    
        .pipe(plugins.plumber({errorHandler: plugins.notify.onError('Error: <%= error.message %>')}))
    
        .pipe(plugins.concat('lab.min.js'))
        .pipe(plugins.uglify({
            compress: false
        }))
        .pipe(gulp.dest(dest_paths.javascript))
        
        .pipe(plugins.livereload())
        .pipe(plugins.notify({ message: 'Uglify complete' }))
});


// SVG sprites
gulp.task('sprites', function () {
    
    return gulp.src(src_paths.sprites)
    
        .pipe(plugins.plumber())
        .pipe(plugins.svgo())
        .pipe(plugins.svgSprite({
            "mode": {
                "css": {
                    "spacing": {
                        "padding": 10
                    },
                    "dest": "./",
                    "layout": "vertical",
                    "sprite": "sprite.svg",
                    "bust": false,
                    "render": {
                        "scss": {
                            "dest": "../sass/sprites/_sprites.scss",
                            "template": "build/tpl/sprite-template.scss"
                        }
                    }
                }
            }
        })).on('error', function(error){
            /* Do some awesome error handling ... */
        })
        .pipe(gulp.dest(dest_paths.images))
        
        .pipe(plugins.livereload())
        .pipe(plugins.notify({ message: 'Svg sprite complete' }))
            
});

// SCSS lint
gulp.task('lint', function() {
    gulp.src(src_paths.sass)
        .pipe(plugins.scssLint())
});


// Watch
gulp.task('watch', function(ev) {
    plugins.livereload.listen();
	gulp.watch(src_paths.sass, ['sass']);
	gulp.watch(src_paths.autoprefixer, ['autoprefixer']);
	gulp.watch(src_paths.javascript, ['uglify']);
    gulp.watch(src_paths.sprites, ['sprites']);
});


// Default
gulp.task('default', ['watch']);
