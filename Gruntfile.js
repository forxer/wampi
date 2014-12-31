
module.exports = function(grunt) {

    /* 1. Configuration des tâches Grunt
     * ----------------------------------------------------------- */

    grunt.initConfig({

        src: {
            js: [
                 'bower_components/jquery/dist/jquery.js',
                 'bower_components/bootstrap/dist/js/bootstrap.js',
                 'bower_components/mixitup/src/jquery.mixitup.js',
                 'bower_components/select2/select2.js',
                 'Application/Assets/js/main.js'
            ],

            ie_js: [
                'bower_components/html5shiv/dist/html5shiv.min.js',
                'bower_components/respond/dest/respond.min.js'
            ],

            less: 'Application/Assets/less/main.less',

            css: [
                'Assets/less.css',
                'bower_components/select2/select2.css',
                'bower_components/select2/select2-bootstrap.css',
                'Application/Assets/css/main.css'
            ],
        },

        // Lecture des données du fichier package.json
        project: grunt.file.readJSON('package.json'),

        // Template d'une bannière de fichier
        banner:
            '/*!\n' +
            ' * <%= project.name %> <%= project.version %>\n' +
            ' * File generated on <%= grunt.template.today("yyyy-mm-dd") %>\n' +
            ' */\n',

        /*
         * Copie de fichiers/dossiers
         */
        copy: {

            // Copie des images de jQuery Select2
            select2_img: {
                expand : true,
                flatten: true,
                cwd: 'bower_components/select2',
                src: '*.{png,jpg,jpeg,gif}',
                dest: 'Assets/'
            },

            // Copie des locales de jQuery Select2
            select2_locales: {
                expand : true,
                flatten: true,
                cwd: 'bower_components/select2',
                src: 'select2_locale_*.js',
                dest: 'Assets/select2/'
            },

            // Copie des fichiers d'une release
            release: {
                expand : true,
                src: [
                    '**/*',
                    '.htaccess',
                    '!release/**',
                    '!node_modules/**',
                    '!bower_components/**',
                    '!bower.json',
                    '!composer.*',
                    '!Gruntfile.js',
                    '!Application/Config/config.php',
                    '!Application/Config/installed',
                ],
                dest: 'release/tmp/'
            }
        },

        /*
         * Nettoyages de fichiers/dossiers
         */
        clean: {

            // Remove release directory for a new release
            release: [
                "release"
            ],

            // Cleanup cache
            cache: [
                "Application/Storage/Cache/**/*",
                "!Application/Storage/Cache/.gitkeep"
            ],

            // Cleanup logs
            logs: [
                "Application/Storage/Logs/**/*",
                "!Application/Storage/Logs/.gitkeep"
            ]
        },

        /*
         * LESS compilation
         */
        less: {
            dist: {
                options: {
                  compress: false
                },
                src: '<%= src.less %>',
                dest: 'Assets/less.css'
            }
        },

        /*
         * Concaténation de fichiers
         */
        concat: {

            // Concaténation des principaux fichiers JS
            js: {
                options: {
                    separator: ';',
                    stripBanners: { block: true }
                },
                src: '<%= src.js %>',
                dest: 'Assets/app.js',
            },

            // Concaténation des fichiers JS pour IE < 9
            ie_js: {
                src: '<%= src.ie_js %>',
                dest: 'Assets/ie.js',
            },

            // Concaténation des principaux fichiers CSS
            css: {
                options: {
                    separator: '\n',
                    stripBanners: { block: true },
                    banner: '<%= banner %>'
                },
                src: '<%= src.css %>',
                dest: 'Assets/app.css'
            }
        },

        /*
         * Minification JS
         */
        uglify: {

            // Minification des principaux fichiers JS
            js: {
                options: {
                    banner: '<%= banner %>'
                },
                src: 'Assets/app.js',
                dest: 'Assets/app.min.js'
            },

            // Minification des fichiers JS pour IE < 9
            ie_js: {
                options: {
                    banner: '<%= banner %>'
                },
                src: 'Assets/ie.js',
                dest: 'Assets/ie.min.js'
            }
        },

        /*
         * CSS autopréfixer
         */
        autoprefixer: {
            dist: {
                src: 'Assets/app.css'
            }
        },

        /*
         * Minification CSS
         */
        cssmin: {
            dist: {
                src: 'Assets/app.css',
                dest: 'Assets/app.min.css'
            }
        },

        /*
         * Surveillance...
         */
        watch: {
            js: {
                files: '<%= src.js %>',
                tasks: ['assets:js']
            },
            css: {
                files: ['<%= src.less %>', '<%= src.css %>', '!Assets/less.css'],
                tasks: ['assets:css']
            }
        },

        /*
         * Archive zip
         */
        zip: {
            release: {
                cwd: 'release/tmp',
                dot: true,
                src: 'release/tmp/**/*',
                dest: 'release/<%= project.name.toLowerCase() %>-<%= project.version %>.zip'
            }
        }
    });


    /* 2. Chargement des plugins Grunt
     * ----------------------------------------------------------- */

    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-zip');


    /* 3. Définition des tâches Grunt
     * ----------------------------------------------------------- */

    // La tâche par défaut reconstruit les assets et lance la surveillance
    grunt.registerTask('default', [
        'assets',
        'watch'
    ]);

    // Tâches de reconstruction des assests
    grunt.registerTask('assets', [
        'assets:js',
        'assets:css',
        'copy:select2'
    ]);
        grunt.registerTask('assets:js', [
            'concat:js',
            'concat:ie_js',
            'uglify'
        ]);
        grunt.registerTask('assets:css', [
            'less',
            'concat:css',
            'autoprefixer',
            'cssmin'
        ]);
        grunt.registerTask('copy:select2', [
            'copy:select2_img',
            'copy:select2_locales'
        ]);



    // Tâche utilisée pour la release d'une nouvelle version (pléonasme ? probably...)
    grunt.registerTask('release', [
        'clean',
        'copy:release',
        'zip'
    ]);

};
