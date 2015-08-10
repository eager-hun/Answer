/**
 * @file
 * Custom feature detects.
 *
 * Currently, this file helps proving that externally referenced .js files do
 * not fail loading.
 *
 * Why don't I rely on modernizr's classes in the CSS? I don't know. I have
 * told CSS that consider JS to be reliable if it sees the .external-js class.
 */
(function () {
  "use strict";

  // Modernizr removes the .no-js class, so we need to prepare for if that
  // happens (althougn modernizr is loaded async now, but that may change
  // later).
  if (document.documentElement.className.match(/no-js/)) {
    document.documentElement.className =
    document.documentElement.className.replace(/(?:^|\s)no-js(?!\S)/g , 'has-js external-js');
  }
  else {
    document.documentElement.className += ' has-js external-js';
  }
})();
