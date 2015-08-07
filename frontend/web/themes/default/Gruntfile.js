module.exports = function(grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        //压缩js
        uglify: {
            options: {
                banner: '/* create at <%= grunt.template.today("yyyy-mm-dd")%> */\n'
            },
            my_target: {
                options: {
                    mangle: false
                },
                files: {
                    'js/main.min.js': ['src/js/main.js'],
					'js/css3-mediaqueries.js': ['src/js/css3-mediaqueries.js'],
                }
            }
        },
		concat: {
			options: {
				//separator: ';',
				stripBanners: true,
			},
			dist: {
				src: ['js/html5shiv.js', 'js/selectivizr-min.js', 'js/css3-mediaqueries.js'],
				dest: 'js/base.min.js',
			},
		},
        //压缩css
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                //把css目录下的所以css合并压缩
                files: {
                    'css/main.min.css': 'src/css/*.css'
                }
                //分别压缩css目录下的各个css
                // files: [{
                //     expand: true,
                //     cwd: 'css',
                //     src: '*.css',
                //     dest: 'dest',
                //     ext: '.min.css'
                // }]
            }
        },
		imagemin: {
			static: {                          // Target 
				options: {                       // Target options 
					optimizationLevel: 3,
					pngquant: true
				},
				files: [{
					expand: true,                  // Enable dynamic expansion 
					cwd: 'src/images',                   // Src matches are relative to this path 
					src: ['**/*.{png,jpg,gif}'],   // Actual patterns to match 
					dest: 'images/'                  // Destination path prefix 
				}]
			}
		},
        //js代码检查
        jshint: {
            all: ['Gruntfile.js', 'js/main.js']
        },
        //自动监视文件变化
        watch: {
            scripts: {
                files: ['src/js/*.js', 'src/css/*.css'],
                tasks: ['uglify', 'cssmin'],
                options: {
                  spawn: false,
                }
            }
        }
    });
    //加载npm的插件
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-imagemin');
	grunt.loadNpmTasks('grunt-contrib-concat');

    grunt.registerTask('default', ['jshint', 'uglify', 'concat', 'cssmin', 'imagemin', 'watch']);
//    grunt.registerTask('watch', ['watch']);
};