// Initialize if FlexSlider is Loaded.
if($.isFunction($.fn.flexslider)) {
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
