
module.exports = function(grunt) {

    grunt.initConfig({

        project: grunt.file.readJSON('package.json'),

        banner:
            '/*!\n' +
            ' * <%= project.name %> <%= project.version %>\n' +
            ' * File generated on <%= grunt.template.today("yyyy-mm-dd") %>\n' +
            ' */\n',


        copy: {
            select2: {
                expand : true,
                flatten: true,
                cwd: './bower_components/select2',
                src: '*.{png,jpg,jpeg,gif}',
                dest: './Assets/'
            }
        },

        less: {
            development: {
                options: {
                  compress: false
                },
                src: './Application/Assets/less/main.less',
                dest: './Assets/less.css'
            }
        },

        concat: {
            options: {
                stripBanners: { block: true }
            },
            js: {
                options: {
                    separator: ';'
                },
                src: [
                    './bower_components/jquery/dist/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    './bower_components/select2/select2.js',
                    './Application/Assets/js/main.js'
                ],
                dest: './Assets/app.js',
            },
            css: {
                options: {
                    separator: '\n',
                    banner: '<%= banner %>'
                },
                src: [
                    './Assets/less.css',
                    './bower_components/select2/select2.css',
                    './bower_components/select2/select2-bootstrap.css',
                    './Application/Assets/css/main.css'
                ],
                dest: './Assets/app.css'
            }
        },

        uglify: {
            options: {
                banner: '<%= banner %>'
            },
            dist: {
                src: './Assets/app.js',
                dest: './Assets/app.min.js'
            }
        },

        cssmin: {
            dist: {
                src: './Assets/app.css',
                dest: './Assets/app.min.css'
            }
        },

        watch: {
            css: {
                files: './Application/Assets/less/*.less',
                tasks: ['less', 'concat'],
                options: {
                    livereload: true,
                },
            },
        },
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

    // Task definition
    grunt.registerTask('assets', ['less', 'concat', 'uglify', 'cssmin', 'copy:select2']);
    grunt.registerTask('release', ['clean', 'assets', 'copy', 'archive']);
    grunt.registerTask('default', ['assets', 'watch']);

};
