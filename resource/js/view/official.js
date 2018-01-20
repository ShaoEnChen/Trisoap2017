const $body = $('body');

/* ===================================================
 * Preloader
 * ===================================================
 */

const $preloader = $('#preloader');

function fadePreloader() {
	return new Promise((resolve, reject) => {
		setTimeout(() => {
			$body.removeClass('no-scroll');
			$preloader.css('opacity', '0');
			resolve();
		}, 500);
	});
}

function hidePreloader() {
	setTimeout(() => {
		$preloader.css('display', 'none');
	}, 1500);
}

$(document).ready(() => {
	fadePreloader().then(hidePreloader);
});

/* ===================================================
 * Navigation - mobile toggle menu
 * ===================================================
 */

const $navToggleBtn = $('.nav-mobile-toggle');
const $navMainMenu = $('#nav-main-menu');
const $hasDropdowns = $('.has-dropdown');

$navToggleBtn.click(function() {
	$navMainMenu.toggle();
});

$hasDropdowns.click(function(event) {
	event.stopPropagation();
	if($(this).has('> .nav-dropdown-menu')) {
		$(this).find(' > .nav-dropdown-menu').toggle();
	}
	if($(this).has('> .nav-dropdown-submenu')) {
		$(this).find(' > .nav-dropdown-submenu').toggle();
	}
});
