class Global {
	/**
	 * Component's constructor
	 */
	constructor() { }

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
		jQuery(($) => {


			if ($('.js-date').length > 0) {
				$('.js-date').on('click', function () {
					let dateInput = $('#date')[0];

					if (dateInput.showPicker) {
						dateInput.showPicker(); // Opens the date picker (modern browsers)
					} else {
						dateInput.focus(); // Fallback for older browsers
					}
				});
			}

			// Headroom
			var myElement = document.querySelector("header");
			var headroom = new Headroom(myElement);
			headroom.init();


			$('.jsMenuToggle').on('click', function (e) {
				$('.jsMenuToggle').toggleClass('active');
				$('.header__center').toggleClass('active');
				$('body').toggleClass('active');
			})

			if ($('.grid').length > 0) {
				var grid = document.querySelector('.grid');
				var msnry = new Masonry(grid, {
					itemSelector: '.grid-item',
					columnWidth: '.grid-item',
					percentPosition: true,
					gutter: 10
				});

				// Re-layout Masonry after images are loaded
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
			}
		});

	}
}

// import { tns } from "./src/tiny-slider.js";

export default Global;
