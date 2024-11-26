// Recupere et affiche le nombre de caractère dans le textarea lost de l'ecriture du post
// bloque le bouton d'envoi si ca depasse ou si le nombre de cara est nul

window.onload = function(){
	document.getElementsByName("message")[0].addEventListener("input", function(e){
		console.log('kfoepz');

		var currentnbcara =document.getElementsByName("message")[0].value.length;
		var nbcararestant = 300 - currentnbcara;
		console.log(currentnbcara);
		document.getElementById("nbcara").textContent = nbcararestant.toString();

		if(nbcararestant < 0){
			document.getElementById("undertext").style.color = 'red';
			document.getElementById("submit").setAttribute("disabled", "disabled");
		}
		else{
			document.getElementById("undertext").style.color = 'grey';
			document.getElementById("submit").removeAttribute("disabled");
		}

	});
};
