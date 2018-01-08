// Initialize accordion if JQuery UI is Loaded.
if(window.jQuery.ui) {
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
