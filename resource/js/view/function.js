function coverClose() {
	document.getElementById("cover").style.display = 'none';
	document.getElementById("detailBox").style.display = 'none';
}

function orderitemCreate(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var amount = document.getElementById("amount").value;
	var data = "module=orderitem&event=create&index=" + index + "&amount=" + amount;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				location.assign("index.php?route=purchaseFinish");
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

function orderCreate() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var num_1 = document.getElementById("num_1").value;
	var num_2 = document.getElementById("num_2").value;
	var num_3 = document.getElementById("num_3").value;
	var num_4 = document.getElementById("num_4").value;
	var num_5 = document.getElementById("num_5").value;
	var num_6 = document.getElementById("num_6").value;
	var num_7 = document.getElementById("num_7").value;
	var num_8 = document.getElementById("num_8").value;
	var priceType = document.getElementById("priceType").value;
	var notice = document.getElementById("notice").value;
	var data;
	if (priceType == 'A') {
		var setPrice = document.getElementById("setPrice").value;
		var data = "module=order&event=create&num_1=" + num_1 + "&num_2=" + num_2 + "&num_3=" + num_3 + "&num_4=" + num_4 + "&num_5=" + num_5 + "&num_6=" + num_6 + "&num_7=" + num_7 + "&num_8=" + num_8 + "&priceType=" + priceType + "&notice=" + notice + "&setPrice=" + setPrice;
	}
	else {
		var data = "module=order&event=create&num_1=" + num_1 + "&num_2=" + num_2 + "&num_3=" + num_3 + "&num_4=" + num_4 + "&num_5=" + num_5 + "&num_6=" + num_6 + "&num_7=" + num_7 + "&num_8=" + num_8 + "&priceType=" + priceType + "&notice=" + notice;
	}
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("建立成功，訂單編號 " + data.ORDNO + "。");
				location.assign("index.php?route=order&in=stateE");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function orderActive(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=order&event=active&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功更改狀態為執行");
				location.reload();
			}
			else {
				alert(data.message);
			}
		}
	}
}

function orderOutstock(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=order&event=outstock&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功更改狀態為缺貨");
				location.reload();
			}
			else {
				alert(data.message);
			}
		}
	}
}

function orderComplete(index) {
	var invoice = prompt("請輸入發票號碼", "");
    if (invoice != null) {
        var request = new XMLHttpRequest();
		request.open("POST", "index.php");
		var data = "module=order&event=complete&index=" + index + "&invoice=" + invoice;
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send(data);
		request.onreadystatechange = function() {
			if (request.readyState === 4 && request.status === 200) {
				alert(request.responseText);
				var data = JSON.parse(request.responseText);
				if (data.message == 'Success') {
					alert("成功更改狀態為完成");
					location.reload();
				}
				else {
					alert(data.message);
				}
			}
		}
    }
}

function orderClose(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=order&event=close&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功更改狀態為結束");
				location.reload();
			}
			else {
				alert(data.message);
			}
		}
	}
}

function orderDetail(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=order&event=detail&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				document.getElementById("cover").style.display = 'block';
				document.getElementById("detailBox").style.display = 'block';
				document.getElementById("orderDetail").innerHTML = data.content;
			}
			else {
				alert(data.message);
			}
		}
	}
}

function orderSearch() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var key = document.getElementById("key").value;
	var value = document.getElementById("value").value;
	var data = "module=order&event=search&key=" + key + "&value=" + value;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				document.getElementById("orderShow").innerHTML = data.content;
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
	var add = document.getElementById("add").value;
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

function memberSearch() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var key = document.getElementById("key").value;
	var value = document.getElementById("value").value;
	var data = "module=member&event=search&key=" + key + "&value=" + value;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				document.getElementById("memberShow").innerHTML = data.content;
			}
			else {
				alert(data.message);
			}
		}
	}
}

function memberDetail(index) {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var data = "module=member&event=detail&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				document.getElementById("cover").style.display = 'block';
				document.getElementById("detailBox").style.display = 'block';
				document.getElementById("memberDetail").innerHTML = data.content;
			}
			else {
				alert(data.message);
			}
		}
	}
}

function managerCreate() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var target = document.getElementById("target").value;
	var data = "module=manager&event=create&target=" + target;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功新增");
				location.assign("index.php?route=manager");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function managerDelete() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var target = document.getElementById("target").value;
	var data = "module=manager&event=delete&target=" + target;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功移除");
				location.assign("index.php?route=manager");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function itemCreate() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var index = document.getElementById("index").value;
	var name = document.getElementById("name").value;
	var amount = document.getElementById("amount").value;
	var price = document.getElementById("price").value;
	var description = document.getElementById("description").value;
	var data = "module=item&event=create&index=" + index + "&name=" + name + "&amount=" + amount + "&price=" + price + "&description=" + description;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功新增");
				location.assign("index.php?route=item");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function itemEdit() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var index = document.getElementById("index").value;
	var name = document.getElementById("name").value;
	var price = document.getElementById("price").value;
	var description = document.getElementById("description").value;
	var data = "module=item&event=edit&index=" + index + "&name=" + name + "&price=" + price + "&description=" + description;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功修改");
				location.assign("index.php?route=item");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function itemEditData() {
	var index = document.getElementById("index").value;
	if (index != 0) {
		var request = new XMLHttpRequest();
		request.open("POST", "index.php");
		var index = document.getElementById("index").value;
		var data = "module=item&event=editData&index=" + index;
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send(data);
		request.onreadystatechange = function() {
			if (request.readyState === 4 && request.status === 200) {
				var data = JSON.parse(request.responseText);
				if (data.message == 'Success') {
					document.getElementById("itemno").innerHTML = index;
					document.getElementById("name").value = data.name;
					document.getElementById("price").value = data.price;
					document.getElementById("description").value = data.description;
				}
				else {
					alert(data.message);
				}
			}
		}
	}
}

function itemOnshelf() {
	var index = document.getElementById("index").value;
	if (index != 0) {
		var request = new XMLHttpRequest();
		request.open("POST", "index.php");
		var data = "module=item&event=onshelf&index=" + index;
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send(data);
		request.onreadystatechange = function() {
			if (request.readyState === 4 && request.status === 200) {
				var data = JSON.parse(request.responseText);
				if (data.message == 'Success') {
					alert("成功上架");
					location.assign("index.php?route=item");
				}
				else {
					alert(data.message);
				}
			}
		}
	}
}

function itemOffshelf() {
	var index = document.getElementById("index").value;
	if (index != 0) {
		var request = new XMLHttpRequest();
		request.open("POST", "index.php");
		var data = "module=item&event=offshelf&index=" + index;
		request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		request.send(data);
		request.onreadystatechange = function() {
			if (request.readyState === 4 && request.status === 200) {
				var data = JSON.parse(request.responseText);
				if (data.message == 'Success') {
					alert("成功下架");
					location.assign("index.php?route=item");
				}
				else {
					alert(data.message);
				}
			}
		}
	}
}

function itemReplenish() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var index = document.getElementById("index").value;
	var amount = document.getElementById("amount").value;
	var data = "module=item&event=replenish&index=" + index + "&amount=" + amount;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功進貨");
				location.assign("index.php?route=item");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function itemSell() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var index = document.getElementById("index").value;
	var amount = document.getElementById("amount").value;
	var data = "module=item&event=sell&index=" + index + "&amount=" + amount;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功出貨");
				location.assign("index.php?route=item");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function discountCreate() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var name = document.getElementById("name").value;
	var price = document.getElementById("price").value;
	var mode = document.getElementById("mode").value;
	var data = "module=discount&event=create&name=" + name + "&price=" + price + "&mode=" + mode;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功新增");
				location.assign("index.php?route=discount");
			}
			else {
				alert(data.message);
			}
		}
	}
}

function discountDelete() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var index = document.getElementById("index").value;
	var data = "module=discount&event=delete&index=" + index;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				alert("成功移除");
				location.assign("index.php?route=discount");
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

function discountSearch() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var key = document.getElementById("key").value;
	var value = document.getElementById("value").value;
	var data = "module=discount&event=search&key=" + key + "&value=" + value;
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.send(data);
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
			var data = JSON.parse(request.responseText);
			if (data.message == 'Success') {
				document.getElementById("discountShow").innerHTML = data.content;
			}
			else {
				alert(data.message);
			}
		}
	}
}

function cashing(account, ordno) {
	var request = new XMLHttpRequest();
	request.open("POST", "resource/cashing.php");
	var payType = document.getElementById("payType").value;
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