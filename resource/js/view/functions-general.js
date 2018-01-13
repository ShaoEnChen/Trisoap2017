// Set check status according to checking dropdown
function changeStatus() {
	var selects = document.getElementById("status");
	var selected_index = selects.selectedIndex;
	document.getElementById("current_status").innerHTML = selects.options[selected_index].text;
}

// Set dropdown menu content in xs screen
$(function setDropdownMenu() {
	var pills = $("#pills a");
	for(var i = 0; i < pills.length; i++) {
		var li = document.createElement("li");
		li.id = "dropdown-pill" + i;
		li.appendChild(document.createTextNode(pills[i].text));
		var ul = document.getElementsByClassName("dropdown-menu")[0];
		ul.appendChild(li);
	}
});

// Set onclick on xs dropdown button
$(function() {
	$("#dropdown-pill" + 0).click(function() {
		changeDropdownText(0);
	});
	$("#dropdown-pill" + 1).click(function() {
		changeDropdownText(1);
	});
	$("#dropdown-pill" + 2).click(function() {
		changeDropdownText(2);
	});
	$("#dropdown-pill" + 3).click(function() {
		changeDropdownText(3);
	});
	$("#dropdown-pill" + 4).click(function() {
		changeDropdownText(4);
	});
	$("#dropdown-pill" + 5).click(function() {
		changeDropdownText(5);
	});
});

// Set change pill func on xs screen
function changeDropdownText(index) {
	$("#pills-xs-dropdown").html($("#dropdown-pill" + index).text() + '<span class="caret"></span>');
	var map = {0 : "all_orders", 1 : "pending", 2 : "processing",
	 3 : "paid", 4 : "overdue", 5 : "shipped"};
	$('.nav-pills a[href="#' + map[index] + '"]').tab('show');
}