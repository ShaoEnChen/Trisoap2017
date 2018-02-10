/* ===================================================
 * Preloader
 * ===================================================
 */

const $preloader = $('#preloader');

function fadePreloader() {
	return new Promise((resolve, reject) => {
		setTimeout(() => {
			$('body').removeClass('no-scroll');
			$preloader.css('opacity', '0');
			resolve();
		}, 500);
	});
}

function hidePreloader() {
	// transition duration 1.5s (1500ms) set in trisoap.scss
	setTimeout(() => {
		$preloader.css('display', 'none');
	}, 1500);
}

$(document).ready(() => {
	fadePreloader().then(hidePreloader);
});
