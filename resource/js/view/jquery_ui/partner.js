// Initialize accordion if JQuery UI is Loaded.
if(window.jQuery.ui) {
	/* ===================================================
	 * 合作夥伴｜Partner - jquery accordion initialization
	 * ===================================================
	 */

	$('#partner-accordion').accordion({
		collapsible: true,
		heightStyle: 'content',
	});

	// Nested Accordion
	$('#partner-accordion > .accordion').accordion({
		collapsible: true,
		heightStyle: 'content',
	});
}
