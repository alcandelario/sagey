/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var SAGEY = {
  // All pages
  'common': {
    init: function() {
      console.log('The Sage Plugin JS is Loaded!');
    },
    finalize: function() {
      // JavaScript to be fired on all pages, after page specific JS is fired
    }
  },
  // Home page
  'home': {
    init: function() {
    

    },
    finalize: function() {
      // JavaScript to be fired on the home page, after the init JS
    }
  },
  // About us page, note the change from about-us to about_us.
  'about_us': {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  },
};