
module.exports = function(grunt) {

    grunt.initConfig({

        project: grunt.file.readJSON('package.json'),

        concat: {
            options: {
                separator: ';',
            },
            dist: {
                src: [
                    './bower_components/jquery/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    './app/assets/javascript/frontend.js'
                ],
                dest: './public/assets/javascript/frontend.js',
            },
        },
        less: {
            development: {
                options: {
                  compress: false,
                  banner:
                        '/*!\n'
                      + ' * <%= project.name %> <%= project.version %>\n'
                      + ' * File generated on <%= grunt.template.today("yyyy-mm-dd") %>\n'
                      + ' */\n'
                },
                files: {
                  "./Assets/css/main.css": "./Assets/less/main.less"
                }
            }
        },
        uglify: {
          //...
        },
        phpunit: {
          //...
        },
        watch: {
          //...
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
 //   grunt.loadNpmTasks('grunt-phpunit');
 //   grunt.loadNpmTasks('grunt-contrib-copy');

    // Task definition
    grunt.registerTask('init', ['copy', 'less', 'concat', 'uglify']);
    grunt.registerTask('default', ['watch']);
};
