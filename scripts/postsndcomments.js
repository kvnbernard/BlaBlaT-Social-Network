window.onload = function(){
displaypost();
};

$("#idrefreshlink").click(function() {	
displaypost();
});
function displaypost(){

	console.log($("#iduser").val());
	$("#postelts").text(" ");
	$.ajax({
		url: './functions/displaypostscript.php',
		type: 'GET',
		dataType: 'text',
		data: {"iduser": $('#iduser').val()},
	})
	.done(function(response) {
		console.log("success");
		//console.log(response);
		$("#postelts").append(response);
	})
	.fail(function() {
		console.log("error");
		$("#postelts").append("<p class=\"text-center\">Erreur lors de l'affichage des posts</p>");
	})
	.always(function() {
		console.log("complete");
	});

};