/* ===================================================
 * Navigation - mobile toggle menu
 * ===================================================
 */

const $navToggleBtn = $('.nav-mobile-toggle'),
	  $navMainMenu = $('#nav-main-menu'),
	  $hasDropdowns = $('.has-dropdown'),
	  $navMainValidLinks = $('.nav-main-link:not([href="javascript:void(0)"])');

$navToggleBtn.click(() => {
	$navMainMenu.toggle();
});

// Prevent dropdown from toggling when location is directing
$navMainValidLinks.click(function(event) {
	event.stopPropagation();
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
