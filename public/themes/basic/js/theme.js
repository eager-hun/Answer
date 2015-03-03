/**
 * @file
 * Scripts for the theme.
 */
(function ($, window, document, undefined) {
  "use strict";

  // Mobile menu.
  if (document.getElementById('modal--common')) {
    awrA.modalSuite.populateModal($('#navigation').find('.block__content').clone());
    awrA.modalSuite.specifyVariant('nav');
    $('.menu-button').on('click', function(event) {
      event.preventDefault();
      awrA.modalSuite.showModal();
    });
  }

})(jQuery, this, this.document);
