/**
 * @file
 * Custom feature detects.
 *
 * NOTE: optimally, in production, this file should be concatenated together
 * with modernizr.js.
 */
(function () {
  "use strict";

  // Signalling to some CSS rules that
  // a) JS works in the browser,
  // b) this externally linked js file was not blocked from loading
  //    (so hopefully others will get in too).
  //
  // Yes, modernizr also does something alike.
  document.documentElement.className =
  document.documentElement.className.replace(/(?:^|\s)no-js(?!\S)/g , 'has-js');

})();
