// Get personal-info-protect-act textarea
const act = document.getElementById('personal-info-protect-act');

// Get content of personal information protection act, and put into textarea
fetch('resource/text/personal_information_protection_act.txt')
	.then((response) => response.text())
	.then((text) => {
		act.innerHTML = text;
	})
