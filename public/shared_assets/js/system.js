/**
 * @file
 * Scripts for the system - theme-agnostic things.
 *
 * FYI:
 * awrS stands for answerSettings,
 * awrA stands for answerAssets,
 * while 'answer' is the project name.
 *
 * NOTE: most of the things are in an unfinished state.
 */
(function ($, window, document, undefined) {
  "use strict";

  var orientation = {/*TODO*/};
  var ajaxSuite = {/*TODO*/};
  var modalSuite = {
    'modalTemplate': [
      '<div id="overlay--common"></div>',
      '<div id="modal--common" tabindex="0">',
        '<div id="modal__content">',
          '<button id="modal__close" class="modal__close" tabindex="0"></button>',
        '</div>',
      '</div>'
    ].join(''),
    'createModal': function () {
      if (!document.getElementById('overlay--common')) {
        $(this.modalTemplate).appendTo("body");
        this.overlay = $('#overlay--common');
        this.modal = $('#modal--common');
        this.modalContent = $('#modal__content');
      }
    },
    'clearModal': function() {
      this.modalContent.children().not('#modal__close').remove();
      this.overlay.removeClass();
      this.modal.removeClass();
    },
    'populateModal': function(newContent) {
      this.clearModal();
      this.modalContent.append(newContent);
    },
    'showModalTimeout': '',
    'showModal': function(delay) {
      if (typeof delay === 'undefined') {
        delay = 50; // Animations have a problem without it.
      }
      else if (delay > 500) {
        awrA.utility.throbber.add($('body'), 'throbber--modal');
      }
      this.modal.css('top', window.pageYOffset + 'px');
      $('body').attr('data-modal-init', 'true');
      this.showModalTimeout = window.setTimeout(function() {
        $('body').attr('data-modal-show', 'true');
        awrA.utility.throbber.hide('throbber--modal');
        awrA.modalSuite.modal.focus();
      }, delay);
    },
    'hideModal': function() {
      // Trigger the fadeout.
      $('body').attr('data-modal-show', 'false');
      // If modal is closed before loading.
      window.clearTimeout(this.showModalTimeout);
      awrA.utility.throbber.hide('throbber--modal');
      window.setTimeout(function() {
        $('body').attr('data-modal-init', 'false');
      }, 700); // Allow the fadeout effect to finish before hiding.
    },
    'specifyVariant': function(variant) {
      this.overlay.addClass('overlay--' + variant);
      this.modal.addClass('modal--' + variant);
    },
    'keyControls': function(event) {
      event.keyCode ? event.keyCode : event.charCode;
      // Escape key.
      if (event.keyCode == 27) {
        this.hideModal();
      }
    },
    'registerEListeners': function() {
      this.modalContent.on('click', function(event) {
        event.stopPropagation();
      });
      this.overlay.on('click', function() {
        awrA.modalSuite.hideModal();
      });
      $('.modal__close').on('click', function() {
        awrA.modalSuite.hideModal();
      });
      $(document).on('keydown', function(event) {
        awrA.modalSuite.keyControls(event);
      });
    }
  };
  var utility = {
    'scrollWatcher': function() {
      if (window.pageYOffset > 0) {
        $('body').attr('data-scrolled-in', 'true');
      }
      else if (window.pageYOffset <= 0) {
        $('body').attr('data-scrolled-in', 'false');
      }
    },
    'throbber': {
      'add': function(tbParent, tbId) {
        if (!document.getElementById(tbId)) {
          var tbTemplate = [
            '<div id="' + tbId + '"',
            ' class="throbber ' + tbId + '"',
            ' data-on="true"></div>'
          ].join('');
          $(tbTemplate).appendTo(tbParent);
        }
        else {
          $('#' + tbId).attr('data-on', 'true');
        }
      },
      'hide': function(tbId) {
        $('#' + tbId).attr('data-on', 'false');
      },
    },
    'registerEListeners': function() {
      $(window).on('scroll', function() { // On window!
        awrA.utility.scrollWatcher();
      });
    }
  };

  // Assigning assets to their final place in the global awrA object.
  awrA.orientation = orientation;
  awrA.ajaxSuite = ajaxSuite;
  awrA.modalSuite = modalSuite;
  awrA.utility = utility;

  // Initializing assets.
  awrA.modalSuite.createModal();
  awrA.modalSuite.registerEListeners();
  awrA.utility.registerEListeners();

})(jQuery, this, this.document);
