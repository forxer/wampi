
module.exports = function(grunt) {

    /* 1. Configuration des tâches Grunt
     * ----------------------------------------------------------- */

    grunt.initConfig({

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

            // Copie des fichiers de jQuery Select2
            select2: {
                expand : true,
                flatten: true,
                cwd: 'bower_components/select2',
                src: '*.{png,jpg,jpeg,gif}',
                dest: 'Assets/'
            },

            // Copie des fichiers d'une release
            release: {
                expand : true,
                src: [
                    '**/*',
                    '!release/**',
                    '!node_modules/**'
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
                src: 'Application/Assets/less/main.less',
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
                src: [
                    'bower_components/jquery/dist/jquery.js',
                    'bower_components/bootstrap/dist/js/bootstrap.js',
                    'bower_components/select2/select2.js',
                    'Application/Assets/js/main.js'
                ],
                dest: 'Assets/app.js',
            },

            // Concaténation des fichiers JS pour IE < 9
            ie_js: {
                src: [
                    'bower_components/html5shiv/dist/html5shiv.min.js',
                    'bower_components/respond/dest/respond.min.js'
                ],
                dest: 'Assets/ie.js',
            },

            // Concaténation des principaux fichiers CSS
            css: {
                options: {
                    separator: '\n',
                    stripBanners: { block: true },
                    banner: '<%= banner %>'
                },
                src: [
                    'Assets/less.css',
                    'bower_components/select2/select2.css',
                    'bower_components/select2/select2-bootstrap.css',
                    'Application/Assets/css/main.css'
                ],
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
            assets: {
                files: 'Application/Assets/**/*',
                tasks: ['assets'],
        //        options: {
        //            livereload: true,
        //        },
            },
        },
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

    // Tâche utilisée pour la release d'une nouvelle version (pléonasme ? probably...)
    grunt.registerTask('release', [
        'assets',
        'clean',
        'copy:release',
 //       'archive'
    ]);

};
