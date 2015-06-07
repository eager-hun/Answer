/**
 * @file
 * Highlights elements with the specified classes.
 *
 * Usage:
 *
 * @code
 *
 * // .some-class items will be highlighted with the passed color.
 * visualDebug('.some-class', 'green');
 *
 * @endcode
 */
(function ($, window, document, undefined) {
  "use strict";

  var defaultColor = 'red';
  var $elem;
  var classes;
  var itemName;
  var badgeLabel;
  var badge;
  var i;
  var val;

  var visualDebug = function debug(selector, color) {
    color = color || defaultColor;
    $(selector).each(function() {
      $elem = $(this);
      frame($elem, color);
      badge($elem, selector);
    });
  }
  var frame = function frame($elem, color) {
    $elem.css({
      'border': '3px solid ' + color,
      'box-shadow': 'white 0 0 0 1px, white 0 0 0 1px inset',
      'padding': '1em'
    });
  };
  var badge = function badge($elem, selector) {
    classes = $elem[0].className.split(' ');
    itemName = selector.replace('.','');
    for (i = 0; i < classes.length; i++) {
      val = classes[i];
      if (val.indexOf(itemName + '--') > -1) {
        badgeLabel = '.' + val;
        break;
      }
      else {
        badgeLabel = '.' + itemName;
      }
    }
    var badge = [
      '<span class="debug-badge__container">',
      '<span class="debug-badge">',
      badgeLabel,
      '</span>',
      '</span>'
    ].join('');
    $elem.prepend(badge);
  };
  var theme = function theme() {
    $('.debug-badge__container').css({
      'display': 'block',
      'padding': '0 0 1em',
      'margin': '-1.05em -1.05em 0 0',
      'text-align': 'right',
    });
    $('.debug-badge').css({
      'background': 'whitesmoke',
      'border': '1px solid silver',
      'color': '#333',
      'display': 'inline-block',
      'font-size': '0.8em',
      'padding': '0.25em'
    });
  };

  // Actiontime.
  visualDebug('.page-center', 'red');
  visualDebug('.binder', 'blue');
  visualDebug('.entity', 'gold');
  visualDebug('.grid-item', 'green');

  // Finish.
  theme();

})(jQuery, this, this.document);
