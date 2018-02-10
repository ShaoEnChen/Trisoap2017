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
