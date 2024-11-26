$("#iduserbtn").click(function() {
	//var iduser = $("#iduser").text();
	console.log($("#iduser").val());
	$("#researchelts").text(" ");
	$.ajax({
		url: './functions/researchscript.php',
		type: 'GET',
		dataType: 'text',
		data: {"iduser": $('#iduser').val()},
	})
	.done(function(response) {
		console.log("success");
		//console.log(response);
		$("#researchelts").append(response);
	})
	.fail(function() {
		console.log("error");
		$("#researchelts").append("<p class=\"text-center\">Erreur lors de la recherche</p>");
	})
	.always(function() {
		console.log("complete");
	});
	
});



/*
window.onload = function(){
	console.log('tezfzfazzfs');
	document.getElementById("iduserbtn").addEventListener("click", function (e) {
		console.log('tes');
		var iduser = document.getElementById("iduser").textContent;
		var xhr = new XMLHttpRequest();
		//xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		//xhr.responseType = "text";
		open("../functions/researchscript.php?iduser = " + iduser, "get", true );
		
		xhr.send(null);
		xhr.onload = function () {
			if(xhr.status != 200){
				 alert("Erreur " + xhr.status + " : " + xhr.statusText);
				 document.getElementById("researchelts").textContent = "<p class=\"text-center\">Recherche en cours ...</p>";
			}
			else{
				document.getElementById("researchelts").textContent = xhr.getData("text");
			}
		};
		
		xhr.onerror = function(){
	    	alert("La requête a échoué");
	    	document.getElementById("researchelts").textContent = "<p class=\"text-center\">Recherche échouée, retentez plus tard !</p>";
		};

		
	});
};

*/