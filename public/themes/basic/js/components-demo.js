/**
 * @file
 * Components demo.
 */

// Implementing Slick carousel library.
// @see http://kenwheeler.github.io/slick/#settings
(function ($, window, document, undefined) {
  "use strict";

  var addNumbersToSlides = true;
  var slide;
  var $carousel1;
  var $carousel2;
  var $carousel3;
  var $carousel4;
  var carousel1settings = {
    'adaptiveHeight': true,
    'arrows': true,
    'dots': true,
    'fade': true,
    'speed': 700,
    'respondTo': 'window',
    'responsive': [
      {
        'breakpoint': 500,
        'settings': "unslick"
      }
    ]
  };
  var carousel2settings = {
    'adaptiveHeight': true,
    'arrows': true,
    'dots': false,
    'infinite': true,
    'slidesToShow': 4,
    'slidesToScroll': 2,
    'respondTo': 'window',
    'responsive': [
      {
        'breakpoint': 900,
        'settings': {
          'slidesToShow': 3,
          'slidesToScroll': 1
        }
      },
      {
        'breakpoint': 500,
        'settings': "unslick"
      }
    ]
  };
  var carousel3settings = {
    'adaptiveHeight': true,
    'arrows': false,
    'dots': false,
    'speed': 700,
    'asNavFor': '.crsl--cd-4',
    'infinite': false,
    'focusOnSelect': true,
    'respondTo': 'window',
    'responsive': [
      {
        'breakpoint': 500,
        'settings': "unslick"
      }
    ]
  };
  var carousel4settings = {
    'arrows': true,
    'dots': false,
    'slidesToShow': 4,
    'slidesToScroll': 1,
    'speed': 700,
    'asNavFor': '.crsl--cd-3',
    'infinite': false,
    'focusOnSelect': true,
    'respondTo': 'window',
    'responsive': [
      {
        'breakpoint': 900,
        'settings': {
          'slidesToShow': 3,
          'slidesToScroll': 1
        }
      },
      {
        'breakpoint': 500,
        'settings': "unslick"
      }
    ]
  };

  $(document).ready(function() {
    $carousel1 = $('.crsl--cd-1');
    $carousel2 = $('.crsl--cd-2');
    $carousel3 = $('.crsl--cd-3');
    $carousel4 = $('.crsl--cd-4');
    $carousel1.slick(carousel1settings);
    $carousel2.slick(carousel2settings);
    $carousel3.slick(carousel3settings);
    $carousel4.slick(carousel4settings);

    if (addNumbersToSlides) {
      $('.slide').each(function() {
        slide = $(this);
        $('<div/>',{
          'class': 'debug__slide-number',
          'text': slide.attr('data-slide-number')
        }).appendTo(slide.find('.slot--image'));
      });
    }
  });
  // Re-initializing "unslicked" carousels upon window resize.
  // The re-slicking will happen only if the corresponding settings allow it to
  // happen at the given screen width.
  $(window).on('resize', function() {
    if (!$carousel1.hasClass('slick-initialized')) {
      $carousel1.slick(carousel1settings);
    }
    if (!$carousel2.hasClass('slick-initialized')) {
      $carousel2.slick(carousel2settings);
    }
    if (!$carousel3.hasClass('slick-initialized')) {
      $carousel3.slick(carousel3settings);
    }
    if (!$carousel4.hasClass('slick-initialized')) {
      $carousel4.slick(carousel4settings);
    }
  });

})(jQuery, this, this.document);
