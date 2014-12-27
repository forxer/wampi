
module.exports = function(grunt) {

    grunt.initConfig({

        project: grunt.file.readJSON('package.json'),

        banner:
            '/*!\n' +
            ' * <%= project.name %> <%= project.version %>\n' +
            ' * File generated on <%= grunt.template.today("yyyy-mm-dd") %>\n' +
            ' */\n',

        less: {
            development: {
                options: {
                  compress: false
                },
                src: './Application/Assets/less/main.less',
                dest: './Application/Assets/css/less.css'
            }
        },

        concat: {
            options: {
                separator: ';',
                stripBanners: { block: true }
            },
            js: {
                src: [
                    './Components/jquery/dist/jquery.js',
                    './Components/bootstrap/dist/js/bootstrap.js',
                    './Components/select2/select2.js',
                    './Application/Assets/js/main.js'
                ],
                dest: './Assets/app.js',
            },
            css: {
                options: {
                    banner: '<%= banner %>'
                },
                src: [
                    './Application/Assets/css/less.css',
                    './Components/fontawesome/css/font-awesome.css',
                    './Components/select2/select2.css',
                    './Components/select2/select2-bootstrap.css',
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
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Task definition
    grunt.registerTask('assets', ['less', 'concat', 'uglify', 'cssmin']);
    grunt.registerTask('release', ['clean', 'assets', 'copy', 'archive']);
    grunt.registerTask('default', ['assets']);

};
