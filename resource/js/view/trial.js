// Initialize if FlexSlider is Loaded.
if($.isFunction($.fn.flexslider)) {
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
}
