$(document).ready(function() {
	var isfollowing = false;
	$.ajax({
		url: './functions/isfollowing.php',
		type: 'POST',
		dataType: 'text',
		data: {"follower": $('#follower').val(), "followed" : $('#followed').val()},
	})
	.done(function(response) {
		console.log("success");
	})
	.fail(function(response) {
		console.log("error");
	})
	.always(function(response) {
		console.log("complete");
		console.log(response);
		if(response == "false"){
			$('.btnabo').background = 'orange';
		}
		else{
			//console.log('ui')
			$('.btnabo').css("background-color","orangered");
			$('.btnabo').text("Abonné");
			isfollowing = true;
		}
	});


	$(".btnabo").click(function(){
	//console.log(isfollowing);
	  	if(isfollowing == true){
	  		$('.btnabo').css("background-color","orange");
	  		$('.btnabo').text("S'abonner ");
	  		isfollowing = false;
	  		// ajax unfollow
	  		$.ajax({
				url: './functions/unfollow.php',
				type: 'POST',
				dataType: 'text',
				data: {"follower": $('#follower').val(), "followed" : $('#followed').val()},
			})
			.done(function(response) {
				console.log("success");
			})
			.fail(function(response) {
				console.log("error");
			})
			.always(function(response) {
				console.log("complete");
			});
	  	}
	  	else{
	  		
	  		$('.btnabo').css("background-color","orangered");
			$('.btnabo').text("Abonné");
			isfollowing = true;
			// ajax follow
			$.ajax({
				url: './functions/follow.php',
				type: 'POST',
				dataType: 'text',
				data: {"follower": $('#follower').val(), "followed" : $('#followed').val()},
			})
			.done(function(response) {
				console.log("success");
			})
			.fail(function(response) {
				console.log("error");
			})
			.always(function(response) {
				console.log("complete");
				
			});
	  	}
	});
	
});


