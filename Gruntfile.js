/*global module:false*/
module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    concat: {
      options: {
        stripBanners: true
      },
      dist: {
        src: [
          'app/webroot/js/jquery-1.5.2.min.js',
          'app/webroot/js/jquery-ui-1.8.14.custom.min.js',
          'app/webroot/js/tiny_mce/tiny_mce.js',
          'app/webroot/js/UI-Core-Menu.js',
          'app/webroot/js/UI-Core-Tabs.js',
          'app/webroot/js/UI-Core-Cart.js',
          'app/webroot/js/Core.js',
          'app/webroot/js/scrollbar.js',
          // 'app/webroot/js/',
        ],
        dest: 'app/webroot/js/app.js'
      }
    },
    uglify: {
      dist: {
        src: '<%= concat.dist.dest %>',
        dest: 'app/webroot/js/app.min.js',
        // dest: 'dist/FILE_NAME.min.js'
      }
    }
  });

  // These plugins provide necessary tasks.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  // Default task.
  grunt.registerTask('default', ['concat', 'uglify']);

};
