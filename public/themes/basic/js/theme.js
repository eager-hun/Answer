/**
 * @file
 * Scripts for the theme.
 */
(function ($, window, document, undefined) {
  "use strict";

  // Mobile menu.
  if (document.getElementById('modal--common')) {
    var menus = [];
    $('.sidebar .block--menu').each(function() {
      menus.push($(this).clone().removeAttr('id'));
    });
    awrA.modalSuite.populateModal(menus);
    awrA.modalSuite.specifyVariant('nav');
    $('.menu-button').on('click', function(event) {
      event.preventDefault();
      awrA.modalSuite.showModal();
    });
  }

})(jQuery, this, this.document);
