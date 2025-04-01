(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";

var _global = _interopRequireDefault(require("./components/global"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

/**
 * This is the entry point for our app
 * We just load and initialize all the available components
 */
class App {
  constructor() {
    this.name = "PSDGator Web Framework";
    this.version = "0.1.0";
    this.run();
  }

  run() {
    /*--> Here we declare all the components <--*/
    const global = new _global.default();
    /*--> Here we initialize all the components <--*/

    global.init();
  }

}

window.app = new App();


},{"./components/global":2}],2:[function(require,module,exports){
"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;

class Global {
  /**
   * Component's constructor
   */
  constructor() {}
  /**
   * The method called by the app's entry point.
   * Here we can decide if we need this component or not,
   * additionaly we can run different logic if needed.
   * We don't do any checks for Global component since it will be used on all pages.
   */


  init() {
    this.logic();
  }
  /**
   * This is where we place the functionality of the component
   */


  logic() {
    jQuery($ => {
      if ($('.js-date').length > 0) {
        $('.js-date').on('click', function () {
          let dateInput = $('#date')[0];

          if (dateInput.showPicker) {
            dateInput.showPicker(); // Opens the date picker (modern browsers)
          } else {
            dateInput.focus(); // Fallback for older browsers
          }
        });
      } // Headroom


      var myElement = document.querySelector("header");
      var headroom = new Headroom(myElement);
      headroom.init();
      $('.jsMenuToggle').on('click', function (e) {
        $('.jsMenuToggle').toggleClass('active');
        $('.header__center').toggleClass('active');
        $('body').toggleClass('active');
      });

      if ($('.grid').length > 0) {
        var grid = document.querySelector('.grid');
        var msnry = new Masonry(grid, {
          itemSelector: '.grid-item',
          columnWidth: '.grid-item',
          percentPosition: true,
          gutter: 10
        }); // Re-layout Masonry after images are loaded

        imagesLoaded(grid, function () {
          msnry.layout();
        });
      }

      lightbox.option({
        'alwaysShowNavOnTouchDevices': true
      });

      if ($('.wpcf7-form select').length > 0) {
        $('.wpcf7-form select').each(function () {
          $(this).find('option:first').attr("disabled", "disabled");
        });
      } // FAQ Accordion


      $('.faq-question').on('click', function () {
        const $answer = $(this).next('.faq-answer');
        const isExpanded = $(this).attr('aria-expanded') === 'true'; // Close all other answers

        $('.faq-question').not(this).each(function () {
          if ($(this).attr('aria-expanded') === 'true') {
            $(this).attr('aria-expanded', 'false');
            $(this).next('.faq-answer').css('height', '0');
          }
        }); // Toggle current answer

        $(this).attr('aria-expanded', !isExpanded);

        if (!isExpanded) {
          $answer.css('height', $answer.find('.faq-answer__content').outerHeight() + 'px');
        } else {
          $answer.css('height', '0');
        }
      });
      $('.js-category-select').change(function () {
        const category = $(this).val();
        const cruiseSelect = $('.js-cruise-select'); // Clear previous options

        cruiseSelect.empty();
        const isGerman = window.location.pathname.startsWith('/de'); // Show options based on category selection

        if (category === 'semi-private') {
          if (isGerman) {
            cruiseSelect.append('<option value="morning">Morgenkreuzfahrt</option>');
            cruiseSelect.append('<option value="sunset">Sonnenuntergang Kreuzfahrt</option>');
          } else {
            cruiseSelect.append('<option value="morning">Morning Cruise</option>');
            cruiseSelect.append('<option value="sunset">Sunset Cruise</option>');
          }
        } else if (category === 'private') {
          if (isGerman) {
            cruiseSelect.append('<option value="half-day">Halbtägig Privat</option>');
            cruiseSelect.append('<option value="full-day">Ganztägig Privat</option>');
          } else {
            cruiseSelect.append('<option value="half-day">Half Day Private</option>');
            cruiseSelect.append('<option value="full-day">Full Day Private</option>');
          }
        } // Enable the cruise select dropdown


        cruiseSelect.prop('disabled', false);
      });
      AOS.init();
      setTimeout(function () {
        var $iframe = $(".map-container iframe");

        if ($iframe.length) {
          $iframe.attr("src", $iframe.attr("src")); // Reload the iframe
        }
      }, 500); // 500ms delay
    });
  }

} // import { tns } from "./src/tiny-slider.js";


var _default = Global;
exports.default = _default;


},{}]},{},[1]);
