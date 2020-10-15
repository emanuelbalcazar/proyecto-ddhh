module.exports = function(grunt) {

require('time-grunt')(grunt, (stats, done) => {
  /* Acá podemos hacer lo que queramos con los stats,
     pero no debemos olvidarnos de indicarle a Grunt,
     que terminamos, con done. */
    done();
});

  grunt.loadNpmTasks('grunt-shell');
  grunt.loadNpmTasks('grunt-jsbeautifier');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');

  grunt.initConfig({

    package: {
      name: 'DDHH'
    },

    shell: {
			options : {
				stdout: true
			},
			serve: {
				command: 'php artisan serve'
			},
      copy_fonts: {
				command:
          '\\cp -R resources/bower/bootstrap/fonts/* public/fonts/ &&' +
          '\\cp -R resources/bower/font-awesome/fonts/* public/fonts/ &&' +
          '\\cp -R resources/bower/flat-ui/fonts/* public/fonts/'
			},
      seed: {
        command: 'composer dump-autoload && php artisan db:seed'
      },
      migrate: {
        command: 'php artisan migrate'
      },
      test: {
        command: 'vendor/bin/phpunit'
      },
      routes: {
        command: 'php artisan route:list'
      }
		},

    jsbeautifier: {
      files : ["public/assets/app.min.js"]
    },

    concat: {
			styles: {
				dest: 'public/assets/app.css',
				src: [
		      'resources/bower/font-awesome/css/font-awesome.min.css',
		      'resources/bower/bootstrap/dist/css/bootstrap.min.css',
		      'resources/bower/flat-ui/dist/css/flat-ui.min.css',
          'resources/bower/ngImgCropFullExtended/compile/minified/ng-img-crop.css',
		      'public/css/*.css',
		      'public/css/*/*.css'
	      ]
			},
			scripts: {
				options: {
					separator: ';'
				},
				dest: 'public/assets/app.js',
				src: [
		      'resources/bower/jquery/jquery.min.js',
		      'resources/bower/angular/angular.min.js',
		      'resources/bower/angular-route/angular-route.min.js',
		      'resources/bower/angular-animate/angular-animate.min.js',
		      'resources/bower/angular-sanitize/angular-sanitize.min.js',
          'resources/bower/ng-file-upload-shim/ng-file-upload-shim.min.js',
          'resources/bower/ng-file-upload-shim/ng-file-upload.min.js',
          'resources/bower/ngImgCropFullExtended/compile/minified/ng-img-crop.js',
          'resources/bower/angular-dialog-service/dist/dialogs-default-translations.min.js',
					'resources/bower/angular-dialog-service/dist/dialogs.min.js',
					'resources/bower/angular-translate/angular-translate.min.js',
          'resources/bower/angular-bootstrap/ui-bootstrap-tpls.min.js',
          'resources/bower/bootstrap/dist/js/bootstrap.min.js',
		      'resources/bower/flat-ui/dist/js/flat-ui.min.js',

          'public/lib/angular-kevin-multiselect/angular-bootstrap-multiselect.js',
          'public/lib/custom.js',

		      'public/js/services/services.js',
		      'public/js/services/*Services.js',
		      'public/js/services/**/*.js',
          'public/js/directives/directives.js',
		      'public/js/controllers/controllers.js',
          'public/js/controllers/**/**/*.js',
          'public/js/controllers/**/*.js',
		      'public/js/controllers/*Ctrl.js',
          'public/js/config/routes.js',
		      'public/js/app.js'
	      ]
			}
		},

    cssmin: {
			options: {
				keepSpecialComments: 0,
        advanced: true,
        report: 'min'
			},
			minify: {
				src: ['public/assets/app.css'],
				dest: 'public/assets/app.min.css'
			}
		},

    uglify: {
			options: {
				mangle: false,
				compress: true,
				report: 'min',
				drop_console: true,
				preserveComments: false
			},
			my_target:{
				files: {
					'public/assets/app.min.js' : ['public/assets/app.js']
				}
			}
		},

    jshint: {
      options: {
        reporter: require('jshint-stylish'),
        jshintrc: "./.jshintrc",
        force: true // Muestra los problemas pero no finaliza las tareas con error.
      },
      all: ['./public/js/*.js', './public/js/**/*.js', './public/js/**/**/*.js', './public/lib/*.js']
    },

    watch: {
      scripts: {
        files: [
          './public/lib/**.js', './public/js/*.js', './public/js/**/*.js', './public/js/**/**/*.js',
          './public/css/*.css', './public/css/**/*.css'
        ],
        tasks: ['shell:copy_fonts', 'concat', 'cssmin', 'uglify', 'jsbeautifier', 'jshint'],
        options: {
          spawn: false
        }
      }
    }

	});

  grunt.registerTask('prod', ['shell:copy_fonts', 'concat', 'cssmin', 'uglify', 'jshint', 'shell:serve']);
  grunt.registerTask('default', ['shell:copy_fonts', 'concat', 'cssmin', 'uglify', 'jshint']);
  grunt.registerTask('migrate', ['shell:migrate']);
  grunt.registerTask('routes', ['shell:routes']);
  grunt.registerTask('serve', ['shell:serve']);
  grunt.registerTask('seed', ['shell:seed']);
  grunt.registerTask('test', ['shell:test']);
  grunt.registerTask('devel', ['watch']);
};
