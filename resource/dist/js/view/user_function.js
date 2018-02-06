"use strict";function orderitemCreate(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=orderitem&event=create&index="+e+"&amount="+document.getElementById("purchase-amount").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?location.assign("index.php?route=purchase_finish"):"請先註冊或登入"==e.message?(alert(e.message),location.assign("index.php?route=member&in=signin")):alert(e.message)}}}function cartDelete(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=orderitem&event=cartDelete&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("成功移除"),location.reload()):alert(e.message)}}}function orderitemDelete(e,t){var n=new XMLHttpRequest;n.open("POST","index.php");var a="module=orderitem&event=delete&ordno="+e+"&index="+t;n.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),n.send(a),n.onreadystatechange=function(){if(4===n.readyState&&200===n.status){var e=JSON.parse(n.responseText);"Success"==e.message?(alert("成功移除"),location.reload()):alert(e.message)}}}function orderitemSearch(){var e=new XMLHttpRequest;e.open("POST","index.php");e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send("module=orderitem&event=search"),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message||alert(t.message)}}}function orderCreate(){var e=new XMLHttpRequest;e.open("POST","index.php");var t=document.getElementById("num_1").value,n=document.getElementById("num_2").value,a=document.getElementById("num_3").value,s=document.getElementById("num_4").value,o=document.getElementById("num_5").value,r=document.getElementById("num_6").value,d=document.getElementById("num_7").value,u=document.getElementById("num_8").value,i=document.getElementById("priceType").value,c=document.getElementById("notice").value;if("A"==i)var m="module=order&event=create&num_1="+t+"&num_2="+n+"&num_3="+a+"&num_4="+s+"&num_5="+o+"&num_6="+r+"&num_7="+d+"&num_8="+u+"&priceType="+i+"&notice="+c+"&setPrice="+document.getElementById("setPrice").value;else m="module=order&event=create&num_1="+t+"&num_2="+n+"&num_3="+a+"&num_4="+s+"&num_5="+o+"&num_6="+r+"&num_7="+d+"&num_8="+u+"&priceType="+i+"&notice="+c;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(m),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("建立成功，訂單編號 "+t.ORDNO+"。"),location.assign("index.php?route=order&in=stateE")):alert(t.message)}}}function orderActive(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=order&event=active&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("成功更改狀態為執行"),location.reload()):alert(e.message)}}}function orderOutstock(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=order&event=outstock&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("成功更改狀態為缺貨"),location.reload()):alert(e.message)}}}function orderComplete(e){var t=prompt("請輸入發票號碼","");if(null!=t){var n=new XMLHttpRequest;n.open("POST","index.php");var a="module=order&event=complete&index="+e+"&invoice="+t;n.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),n.send(a),n.onreadystatechange=function(){if(4===n.readyState&&200===n.status){alert(n.responseText);var e=JSON.parse(n.responseText);"Success"==e.message?(alert("成功更改狀態為完成"),location.reload()):alert(e.message)}}}}function orderClose(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=order&event=close&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("成功更改狀態為結束"),location.reload()):alert(e.message)}}}function orderDetail(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=order&event=detail&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(document.getElementById("cover").style.display="block",document.getElementById("detailBox").style.display="block",document.getElementById("orderDetail").innerHTML=e.content):alert(e.message)}}}function orderSearch(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=order&event=search&key="+document.getElementById("key").value+"&value="+document.getElementById("value").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?document.getElementById("orderShow").innerHTML=t.content:alert(t.message)}}}function memberSignin(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=member&event=signin&account="+document.getElementById("account").value+"&password="+document.getElementById("password").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?location.assign("index.php"):"Unverified account"==t.message?(alert("您的帳號尚未驗證，請查看簡訊驗證碼進行驗證。"),location.assign("index.php?route=member&in=verify")):alert(t.message)}}}function memberLogout(){var e=new XMLHttpRequest;e.open("POST","index.php");e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send("module=member&event=logout"),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?location.assign("index.php"):alert(t.message)}}}function memberSignup(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=member&event=signup&account="+document.getElementById("account").value+"&name="+document.getElementById("name").value+"&password1="+document.getElementById("password1").value+"&password2="+document.getElementById("password2").value+"&skintype="+document.getElementById("skintype").value+"&birth="+document.getElementById("birth").value+"&phone="+document.getElementById("phone").value+"&add="+document.getElementById("address").value+"&taxid="+document.getElementById("taxid").value+"&knowtype="+document.getElementById("knowtype").value+"&notice="+document.getElementById("notice").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("請查看簡訊驗證碼進行驗證。"),location.assign("index.php?route=member&in=verify")):alert(t.message)}}}function memberVerify(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=member&event=verify&verify="+document.getElementById("verify").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?location.assign("index.php"):alert(t.message)}}}function memberEdit(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=member&event=edit&name="+document.getElementById("name").value+"&address="+document.getElementById("address").value+"&skintype="+document.getElementById("skintype").value+"&phone="+document.getElementById("phone").value+"&taxid="+document.getElementById("taxid").value+"&notice="+document.getElementById("notice").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("修改成功"),location.assign("index.php")):alert(t.message)}}}function memberChangePassword(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=member&event=change_password&ori_password="+document.getElementById("ori_password").value+"&new_password1="+document.getElementById("new_password1").value+"&new_password2="+document.getElementById("new_password2").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("修改成功"),location.assign("index.php")):alert(t.message)}}}function memberResetPassword(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=member&event=reset_password&account="+document.getElementById("account").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("新密碼已寄至您的信箱，請前往確認。"),location.assign("index.php?route=member&in=signin")):alert(t.message)}}}function memberSearch(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=member&event=search&key="+document.getElementById("key").value+"&value="+document.getElementById("value").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?document.getElementById("memberShow").innerHTML=t.content:alert(t.message)}}}function memberDetail(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=member&event=detail&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(document.getElementById("cover").style.display="block",document.getElementById("detailBox").style.display="block",document.getElementById("memberDetail").innerHTML=e.content):alert(e.message)}}}function managerCreate(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=manager&event=create&target="+document.getElementById("target").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功新增"),location.assign("index.php?route=manager")):alert(t.message)}}}function managerDelete(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=manager&event=delete&target="+document.getElementById("target").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功移除"),location.assign("index.php?route=manager")):alert(t.message)}}}function itemCreate(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=item&event=create&index="+document.getElementById("index").value+"&name="+document.getElementById("name").value+"&amount="+document.getElementById("amount").value+"&price="+document.getElementById("price").value+"&description="+document.getElementById("description").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功新增"),location.assign("index.php?route=item")):alert(t.message)}}}function itemEdit(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=item&event=edit&index="+document.getElementById("index").value+"&name="+document.getElementById("name").value+"&price="+document.getElementById("price").value+"&description="+document.getElementById("description").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功修改"),location.assign("index.php?route=item")):alert(t.message)}}}function itemEditData(){if(0!=(t=document.getElementById("index").value)){var e=new XMLHttpRequest;e.open("POST","index.php");var t,n="module=item&event=editData&index="+(t=document.getElementById("index").value);e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(n),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var n=JSON.parse(e.responseText);"Success"==n.message?(document.getElementById("itemno").innerHTML=t,document.getElementById("name").value=n.name,document.getElementById("price").value=n.price,document.getElementById("description").value=n.description):alert(n.message)}}}}function itemOnshelf(){var e=document.getElementById("index").value;if(0!=e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=item&event=onshelf&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("成功上架"),location.assign("index.php?route=item")):alert(e.message)}}}}function itemOffshelf(){var e=document.getElementById("index").value;if(0!=e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=item&event=offshelf&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("成功下架"),location.assign("index.php?route=item")):alert(e.message)}}}}function itemReplenish(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=item&event=replenish&index="+document.getElementById("index").value+"&amount="+document.getElementById("amount").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功進貨"),location.assign("index.php?route=item")):alert(t.message)}}}function itemSell(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=item&event=sell&index="+document.getElementById("index").value+"&amount="+document.getElementById("amount").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功出貨"),location.assign("index.php?route=item")):alert(t.message)}}}function discountCreate(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=discount&event=create&name="+document.getElementById("name").value+"&price="+document.getElementById("price").value+"&mode="+document.getElementById("mode").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功新增"),location.assign("index.php?route=discount")):alert(t.message)}}}function discountDelete(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=discount&event=delete&index="+document.getElementById("index").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?(alert("成功移除"),location.assign("index.php?route=discount")):alert(t.message)}}}function discountApply(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=discount&event=apply&index="+document.getElementById("index").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?location.assign("index.php?route=pay&order=cart"):alert(t.message)}}}function discountSearch(){var e=new XMLHttpRequest;e.open("POST","index.php");var t="module=discount&event=search&key="+document.getElementById("key").value+"&value="+document.getElementById("value").value;e.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),e.send(t),e.onreadystatechange=function(){if(4===e.readyState&&200===e.status){var t=JSON.parse(e.responseText);"Success"==t.message?document.getElementById("discountShow").innerHTML=t.content:alert(t.message)}}}function makePayment(e){var t=document.getElementById("paytype").value;location.assign(e+t)}function cashing(e,t){var n=new XMLHttpRequest;n.open("POST","resource/cashing.php");var a="account="+e+"&ordno="+t+"&payType="+document.getElementById("paytype").value;n.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),n.send(a),n.onreadystatechange=function(){if(4===n.readyState&&200===n.status){var e=JSON.parse(n.responseText);"Success"==e.message||alert(e.message)}}}