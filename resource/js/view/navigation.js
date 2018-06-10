/* ===================================================
 * Navigation - mobile toggle menu
 * ===================================================
 */

const $navToggleBtn = $('.nav-mobile-toggle');
const $navMainMenu = $('#nav-main-menu');
const $hasDropdowns = $('.has-dropdown');
const $angleDowns = $('.icon-angle-down');

$navToggleBtn.click(() => {
	$navMainMenu.toggle();
});

$hasDropdowns.click(function(event) {
	event.stopPropagation();
	let hasSub = $(this).children('.nav-dropdown-submenu').length;
	if (hasSub > 0) {
		$(this).children('.nav-dropdown-submenu').toggle();
	}
	else {
		let hasDropdown = $(this).children('.nav-dropdown-menu').length;
		if (hasDropdown > 0) {
			$(this).children('.nav-dropdown-menu').toggle();
		}
	}
});

$angleDowns.click((event) => {
	event.preventDefault();
});