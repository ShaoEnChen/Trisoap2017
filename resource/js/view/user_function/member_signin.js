async function checkLoginState() {
    var response = await FB.getLoginStatus();
    if (response.status === 'connected') {
        fbApiRequest();
    } else {
        // The person is not logged into your app or we are unable to tell.
    }
}

function fbApiRequest() {
    FB.api('/me', {fields: ['email', 'name']}, function(response) {
        // Signin current FB user to Trisoap server to provide advanced service
        FBmemberSignin(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '403462720092445',
        xfbml      : true,
        version    : 'v2.12'
    });
    FB.AppEvents.logPageView();
};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.12&appId=403462720092445';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
