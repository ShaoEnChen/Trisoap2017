"use strict";function checkLoginState(){console.log(login),FB.getLoginStatus(function(e){statusChangeCallback(e)})}function statusChangeCallback(e){"connected"===e.status&&fbApiRequest()}function fbApiRequest(){FB.api("/me",{fields:["email","name"]},function(e){FBmemberSignin(e)})}window.fbAsyncInit=function(){FB.init({appId:"403462720092445",xfbml:!0,version:"v2.12"}),FB.AppEvents.logPageView()},function(e,n,t){var i,o=e.getElementsByTagName(n)[0];e.getElementById(t)||((i=e.createElement(n)).id=t,i.src="https://connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.12&appId=403462720092445",o.parentNode.insertBefore(i,o))}(document,"script","facebook-jssdk");