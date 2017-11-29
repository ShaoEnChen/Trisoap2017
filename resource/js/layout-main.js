/* ===================================================
 * Navigation - mobile toggle menu
 * ===================================================
 */

$navToggleBtn = $('.nav-mobile-toggle');
$navMainMenu = $('#nav-main-menu');
$navItemHasDropdown = $('.nav-main-item.has-dropdown');

$navToggleBtn.click(function() {
	$navMainMenu.toggle();
});

$navItemHasDropdown.click(function() {
	$(this).find('.nav-dropdown-menu').toggle();
});

// Initialize if FlexSlider is Loaded.
if($.isFunction($.fn.flexslider)) {
	/* ===================================================
	 * 首頁 Header - flexslider initialization
	 * ===================================================
	 */

	$('#index-header > .flexslider').flexslider({
		animation: 'fade',
		directionNav: false,
		slideshowSpeed: 8000,
		animationSpeed: 1000,
	});

	/* ===================================================
	 * 試用品申請｜Trial - flexslider initialization
	 * ===================================================
	 */

	$('#trial-recommend > .flexslider').flexslider({
		animation: "slide",
		directionNav: false,
		controlNav: false,
		slideshowSpeed: 4000,
		animationSpeed: 1000,
	});

	/* ===================================================
	 * 單項商品頁｜Single Product - flexslider initialization
	 * ===================================================
	 */

	$('#single-product-carousel > .flexslider').flexslider({
		animation: "slide",
		controlNav: "thumbnails",
		slideshowSpeed: 4000,
		animationSpeed: 600,
	});
}

// Initialize accordion if JQuery UI is Loaded.
if(window.jQuery.ui) {

	/* ===================================================
	 * 顧客問答｜FAQ - jquery accordion initialization
	 * ===================================================
	 */

	$('#faq-accordion').accordion({
		collapsible: true,
		heightStyle: "content",
	});

	/* ===================================================
	 * 合作夥伴｜Partner - jquery accordion initialization
	 * ===================================================
	 */

	$('#partner-accordion').accordion({
		collapsible: true,
		heightStyle: "content",
	});

	// Nested Accordion
	$('#partner-accordion > .accordion').accordion({
		collapsible: true,
		heightStyle: "content",
	});

	/* ===================================================
	 * 單項商品頁｜Single Product - jquery accordion initialization
	 * ===================================================
	 */

	$('#single-product-accordion').accordion({
		active: false,
		collapsible: true,
		heightStyle: "content",
	});
}
