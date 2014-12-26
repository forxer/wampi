
module.exports = function(grunt) {

    grunt.initConfig({

        project: grunt.file.readJSON('package.json'),

        projectBanner:
            '/*!\n'
            + ' * <%= project.name %> <%= project.version %>\n'
            + ' * File generated on <%= grunt.template.today("yyyy-mm-dd") %>\n'
            + ' */\n',

        less: {
            development: {
                options: {
                  compress: false
                },
                files: {
                  "./Assets/css/main.css": "./Assets/less/main.less"
                }
            }
        },

        concat: {
            options: {
                separator: ';',
            },
            js: {
                src: [
                    './Components/jquery/dist/jquery.js',
                    './Components/bootstrap/dist/js/bootstrap.js',
                    './Components/select2/select2.js',
                    './Assets/js/main.js'
                ],
                dest: './Assets/prod/app.js',
            },
            css: {
                options: {
                    banner: '<%= projectBanner%>'
                },
                src: [
           //         './Components/bootstrap/dist/css/bootstrap.min.css',
           //         './Components/bootstrap/dist/css/bootstrap-theme.min.css',
                    './Components/fontawesome/css/font-awesome.css',
                    './Components/select2/select2.css',
                    './Components/select2/select2-bootstrap.css',
                    './Assets/css/main.css'
                ],
                dest: './Assets/prod/app.css'
            }
        },

        uglify: {
            options: {
                banner: '<%= projectBanner%>'
            },
            dist: {
                files: {
                    './Assets/prod/app.js': './Assets/prod/app.js'
                }
            }
        },

        cssmin: {
            dist: {
                files: {
                    './Assets/prod/app.css': './Assets/prod/app.css'
                }
            }
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Task definition
    grunt.registerTask('default', ['less', 'concat', 'uglify', 'cssmin']);

};
