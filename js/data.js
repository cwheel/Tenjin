$(document).ready(function () {
	
});

function updatePage() {
	$.ajax({
		type: "GET",
		url: "../data.php",
		success: function(data){
			alert(data);
		}
	});
}