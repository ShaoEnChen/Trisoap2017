// // Set check status according to checking dropdown
// function changeStatus() {
// 	var selects = document.getElementById("status");
// 	var selected_index = selects.selectedIndex;
// 	document.getElementById("current_status").innerHTML = selects.options[selected_index].text;
// }

// // Set dropdown menu content in xs screen
// $(function setDropdownMenu() {
// 	var pills = $("#pills a");
// 	for(var i = 0; i < pills.length; i++) {
// 		var li = document.createElement("li");
// 		li.id = "dropdown-pill" + i;
// 		li.appendChild(document.createTextNode(pills[i].text));
// 		var ul = document.getElementsByClassName("dropdown-menu")[0];
// 		ul.appendChild(li);
// 	}
// });

// // Set onclick on xs dropdown button
// $(function() {
// 	$("#dropdown-pill" + 0).click(function() {
// 		changeDropdownText(0);
// 	});
// 	$("#dropdown-pill" + 1).click(function() {
// 		changeDropdownText(1);
// 	});
// 	$("#dropdown-pill" + 2).click(function() {
// 		changeDropdownText(2);
// 	});
// 	$("#dropdown-pill" + 3).click(function() {
// 		changeDropdownText(3);
// 	});
// 	$("#dropdown-pill" + 4).click(function() {
// 		changeDropdownText(4);
// 	});
// 	$("#dropdown-pill" + 5).click(function() {
// 		changeDropdownText(5);
// 	});
// });

// // Set change pill func on xs screen
// function changeDropdownText(index) {
// 	$("#pills-xs-dropdown").html($("#dropdown-pill" + index).text() + '<span class="caret"></span>');
// 	var map = {0 : "all_orders", 1 : "pending", 2 : "processing",
// 	 3 : "paid", 4 : "overdue", 5 : "shipped"};
// 	$('.nav-pills a[href="#' + map[index] + '"]').tab('show');
// }


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

function memberSearch() {
	var request = new XMLHttpRequest();
	request.open("POST", "index.php");
	var key = document.getElementById("search-option").value;
	var value = document.getElementById("search-value").value;
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
