function FBmemberSignin(content) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var account = content.email;
	var name = content.name;
	var data = "module=member&event=FBsignin&account=" + account + "&name=" + name;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				location.assign("index.php");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function orderitemCreate(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var amount = document.getElementById("purchase-amount").value;
	var data = "module=orderitem&event=create&index=" + index + "&amount=" + amount;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				location.assign("index.php?route=purchase_finish");
			}
			else if (data.message == '請先註冊或登入') {
				alert(data.message);
				location.assign("index.php?route=member&in=signin");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function cartDelete(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=orderitem&event=cartDelete&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功移除");
				location.reload();
			}
			else {
				alert(data.message);
			}
		}
	}
}

// ??
function orderitemDelete(ordno, index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=orderitem&event=delete&ordno=" + ordno + "&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功移除");
				location.reload();
			}
			else {
				alert(data.message);
			}
		}
	}
}

// ??
function orderitemSearch() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=orderitem&event=search";
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {

			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberSignin() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var account = document.getElementById("account").value;
	var password = document.getElementById("password").value;
	var data = "module=member&event=signin&account=" + account + "&password=" + password;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				location.assign("index.php");
			}
			else if (data.message == 'Unverified account') {
				alert("您的帳號尚未驗證，請查看簡訊驗證碼進行驗證。");
				location.assign("index.php?route=member&in=verify");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberLogout() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=member&event=logout";
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				location.assign("index.php");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberSignup() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var account = document.getElementById("account").value;
	var name = document.getElementById("name").value;
	var password1 = document.getElementById("password1").value;
	var password2 = document.getElementById("password2").value;
	var skintype = document.getElementById("skintype").value;
	var birth = document.getElementById("birth").value;
	var phone = document.getElementById("phone").value;
	var add = document.getElementById("address").value;
	var taxid = document.getElementById("taxid").value;
	var knowtype = document.getElementById("knowtype").value;
	var notice = document.getElementById("notice").value;
	var data = "module=member&event=signup&account=" + account + "&name=" + name + "&password1=" + password1 + "&password2=" + password2 + "&skintype=" + skintype + "&birth=" + birth + "&phone=" + phone + "&add=" + add + "&taxid=" + taxid + "&knowtype=" + knowtype + "&notice=" + notice;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("請查看簡訊驗證碼進行驗證。");
				location.assign("index.php?route=member&in=verify");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberVerify() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var verify = document.getElementById("verify").value;
	var data = "module=member&event=verify&verify=" + verify;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				location.assign("index.php");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberEdit() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var name = document.getElementById("name").value;
	var address = document.getElementById("address").value;
	var skintype = document.getElementById("skintype").value;
	var phone = document.getElementById("phone").value;
	var taxid = document.getElementById("taxid").value;
	var notice = document.getElementById("notice").value;
	var data = "module=member&event=edit&name=" + name + "&address=" + address + "&skintype=" + skintype + "&phone=" + phone + "&taxid=" + taxid + "&notice=" + notice;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("修改成功");
				location.assign("index.php");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberChangePassword() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var ori_password = document.getElementById("ori_password").value;
	var new_password1 = document.getElementById("new_password1").value;
	var new_password2 = document.getElementById("new_password2").value;
	var data = "module=member&event=change_password&ori_password=" + ori_password + "&new_password1=" + new_password1 + "&new_password2=" + new_password2;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("修改成功");
				location.assign("index.php");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberResetPassword() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var account = document.getElementById("account").value;
	var data = "module=member&event=reset_password&account=" + account;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("新密碼已寄至您的信箱，請前往確認。");
				location.assign("index.php?route=member&in=signin");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function discountApply() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var index = document.getElementById("index").value;
	var data = "module=discount&event=apply&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				location.assign("index.php?route=pay&order=cart");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function makePayment(route) {
    var payType = document.getElementById('paytype').value;
    location.assign(route + payType);
}

// ??
function cashing(account, ordno) {
	var request = new XMLHttpRequest();
	request.open("POST", "resource/cashing.php");
	var payType = document.getElementById("paytype").value;
	var data = "account=" + account + "&ordno=" + ordno + "&payType=" + payType;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {

			}
			else {
				alert(data.message);
			}
		}
	}
}
