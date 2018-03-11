window.fbAsyncInit = function() {
    FB.init({
        appId      : '403462720092445',
        xfbml      : true,
        version    : 'v2.12'
    });
    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {
        // 1. Logged into your app ('connected')
        // 2. Logged into Facebook, but not your app ('not_authorized')
        // 3. Not logged into Facebook and can't tell if they are logged into
        //    your app or not.
        console.log(response.status);
    });

	FB.Event.subscribe('auth.login', function() {
	    FB.getLoginStatus(function(response) {
            FBmemberSignin(response);
        });
	});
};

// Load the SDK asynchronously
(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/zh_TW/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
