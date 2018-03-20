/* ===================================================
 * Universal variables
 * ===================================================
 */

const $preloader = $('#preloader'),
	  _dir = 'resource/img/misc/logo.svg';

/* ===================================================
 * Show & Hide preloader
 * ===================================================
 */

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

/* ===================================================
 * Draw / Render preloader content
 * ===================================================
 */

const $content = $('<img/>', {
	id: 'preloader-content',
	src: _dir,
	alt: '您的瀏覽器不支援 SVG'
});

$content.appendTo($preloader);
