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
}
