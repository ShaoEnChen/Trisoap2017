"use strict";function wedding(){if(0==document.getElementById("wd-cta-privacy").checked)alert("請先同意個資保護法先關聲明");else{var t=new XMLHttpRequest;t.open("POST","index.php");var e=document.getElementById("wd-cta-name").value,n=document.getElementById("wd-cta-phone").value,a=document.getElementById("wd-cta-email").value,s=document.getElementById("wd-cta-offer").value,o=document.getElementById("wd-cta-diy").value;if(1==document.getElementById("wd-cta-subscribe").checked)var d="Y";else d="N";var r="module=wedding&event=create&name="+e+"&phone="+n+"&email="+a+"&offer="+s+"&diy="+o+"&subscribe="+d;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(r),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("我們已經收到您的來信，您的婚禮按編號為 "+e.wedno+"，將有專人與您聯絡。"),location.assign("index.php")):alert(e.message)}}}}function contactMe(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=member&event=contact&name="+document.getElementById("contact-form-name").value+"&email="+document.getElementById("contact-form-email").value+"&phone="+document.getElementById("contact-form-phone").value+"&message="+document.getElementById("contact-form-message").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("我們已經收到您的來信，感謝您的回饋。"),location.assign("index.php")):alert(e.message)}}}function orderitemCreate(n){var a=new XMLHttpRequest;a.open("POST","index.php");var s,e=document.getElementById("purchase-amount");s=null!==e?e.value:1;var t="module=orderitem&event=create&index="+n+"&amount="+s;a.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),a.send(t),a.onreadystatechange=function(){if(4===a.readyState&&200===a.status){var e=JSON.parse(a.responseText);if("Success"==e.message)location.assign("index.php?route=purchase_finish");else if("請先註冊或登入"==e.message){alert("請先註冊或登入");var t=location.href;location.assign("index.php?route=member&in=signin&index="+n+"&amount="+s+"&origin="+t.replace("&","@@"))}else alert(e.message)}}}function orderitemCreateDirect(e,t){var n=new XMLHttpRequest;n.open("POST","index.php");var a="module=orderitem&event=create&index="+e+"&amount="+t;n.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),n.send(a),n.onreadystatechange=function(){if(4===n.readyState&&200===n.status){var e=JSON.parse(n.responseText);"Success"!=e.message&&alert(e.message)}}}function cartDelete(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=orderitem&event=cartDelete&index="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("成功移除"),location.reload()):alert(e.message)}}}function FBmemberSignin(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=member&event=FBsignin&account="+e.email+"&name="+e.name+"&origin="+document.getElementById("origin").value+"&index="+document.getElementById("index").value+"&amount="+document.getElementById("amount").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message&&void 0!==e.origin?(alert("成功登入，商品已加入購物車"),orderitemCreateDirect(e.index,e.amount),location.assign(e.origin)):"Success"==e.message?location.assign("index.php"):alert(e.message)}}}function memberSignin(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=member&event=signin&account="+document.getElementById("account").value+"&password="+document.getElementById("password").value+"&origin="+document.getElementById("origin").value+"&index="+document.getElementById("index").value+"&amount="+document.getElementById("amount").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message&&void 0!==e.origin?(alert("成功登入，商品已加入購物車"),orderitemCreateDirect(e.index,e.amount),location.assign(e.origin)):"Success"==e.message?location.assign("index.php"):alert(e.message)}}}function memberLogout(){var t=new XMLHttpRequest;t.open("POST","index.php");t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send("module=member&event=logout"),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?location.assign("index.php"):alert(e.message)}}}function memberSignup(){var t=new XMLHttpRequest;t.open("POST","index.php");var e={required:{},optional:{}},n="module=member&event=signup";for(var a in e.required.account=document.getElementById("account"),e.required.name=document.getElementById("name"),e.required.password1=document.getElementById("password1"),e.required.password2=document.getElementById("password2"),e.optional.phone=document.getElementById("phone"),e.optional.skintype=document.getElementById("skintype"),e.optional.birth=document.getElementById("birth"),e.optional.add=document.getElementById("address"),e.optional.taxid=document.getElementById("taxid"),e.optional.knowtype=document.getElementById("knowtype"),e.optional.notice=document.getElementById("notice"),e)for(var s in e[a])null===e[a][s]&&(e[a][s]={},e[a][s].value=""),n+="&",n+=s,n+="=",n+=e[a][s].value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("註冊成功"),location.assign("index.php")):alert(e.message)}}}function memberVerify(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=member&event=verify&verify="+document.getElementById("verify").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?location.assign("index.php"):alert(e.message)}}}function memberEdit(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=member&event=edit&name="+document.getElementById("name").value+"&address="+document.getElementById("address").value+"&phone="+document.getElementById("phone").value+"&taxid="+document.getElementById("taxid").value+"&notice="+document.getElementById("notice").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("修改成功"),location.assign("index.php")):alert(e.message)}}}function memberAdddata(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=member&event=adddata&sex="+document.getElementById("sex").value+"&birth="+document.getElementById("birth").value+"&phone="+document.getElementById("phone").value+"&skintype="+document.getElementById("skintype").value+"&knowtype="+document.getElementById("knowtype").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("感謝您參加本次活動，您的折扣碼為"+e.discount),location.assign("index.php")):alert(e.message)}}}function memberChangePassword(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=member&event=change_password&ori_password="+document.getElementById("ori_password").value+"&new_password1="+document.getElementById("new_password1").value+"&new_password2="+document.getElementById("new_password2").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("修改成功"),location.assign("index.php")):alert(e.message)}}}function memberResetPassword(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=member&event=reset_password&account="+document.getElementById("account").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?(alert("新密碼已寄至您的信箱，請前往確認。"),location.assign("index.php?route=member&in=signin")):alert(e.message)}}}function discountApply(){var t=new XMLHttpRequest;t.open("POST","index.php");var e="module=discount&event=apply&index="+document.getElementById("index").value;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(e),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message?location.assign("index.php?route=pay&order=cart"):alert(e.message)}}}function makePayment(e){var t=document.getElementById("address").value,n=document.getElementById("notice").value,a=document.getElementById("paytype").value;location.assign(e+"&address="+t+"&notice="+n+"&paytype"+a)}function orderDetail(e){var t=new XMLHttpRequest;t.open("POST","index.php");var n="module=order&event=detail&ordno="+e;t.setRequestHeader("Content-Type","application/x-www-form-urlencoded"),t.send(n),t.onreadystatechange=function(){if(4===t.readyState&&200===t.status){var e=JSON.parse(t.responseText);"Success"==e.message||alert(e.message)}}}