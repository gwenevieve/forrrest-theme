/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function($) {
  // Site title and description.
  wp.customize("blogname", function(value) {
    value.bind(function(to) {
      $(".site-title a").text(to);
    });
  });
  wp.customize("blogdescription", function(value) {
    value.bind(function(to) {
      $(".site-description").text(to);
    });
  });

  // Header text color.
  wp.customize("header_textcolor", function(value) {
    value.bind(function(to) {
      if ("blank" === to) {
        $(".site-title, .site-description").css({
          clip: "rect(1px, 1px, 1px, 1px)",
          position: "absolute"
        });
      } else {
        $(".site-title, .site-description").css({
          clip: "auto",
          position: "relative"
        });
        $(".site-title a, .site-description").css({
          color: to
        });
      }
    });
  });

  // Page link color
  wp.customize("link_textcolor", function(value) {
    value.bind(function(newval) {
      $(".page-container a").css("color", newval);
    });
  });

  // Site navigation color
  wp.customize("nav_background", function(value) {
    value.bind(function(newval) {
      $(".site-header").css("background", newval);
    });
  });

  // Nav link color
  wp.customize("nav_link_textcolor", function(value) {
    value.bind(function(newval) {
      $(".primary-li a").css("color", newval);
    });
  });
})(jQuery);
