$('body').on('click', '.likebutton svg', function() {
  	var likeid = $(this).attr("id");
  	var typelement=$(this).parents('.likebutton').parent().parent().parent().attr("class");
  	var nblike=$(this).parents('.likebutton').find('.nblike');
  	  	
  	  	$.ajax({
		url: './functions/likescript.php',
		type: 'GET',
		dataType: 'text',
		data: {"postliked": likeid,"typelement": typelement},
	})

	.done(function(response) {
		console.log("success");

	})

	.fail(function(response) {
		console.log("error");

	})

	.always(function(response) {
		console.log("complete");
		nblike.text(" "+response);
		likeMethode(likeid);
	})
});

function likeMethode ($likee) {

if ($('#'+$likee).attr('fill') == 'white'){

	$('#'+$likee).attr({ fill: "orange" });
	$('#'+$likee).css({ fill: "orange" });
	$('#'+$likee).css({ stroke: "orange" });
	}

	else if ($('#'+$likee).attr('fill') == 'orange'){

		$('#'+$likee).attr("fill", "white" ); 
		$('#'+$likee).css({ fill: "white" });
		$('#'+$likee).css({ stroke: "orange" });

	}
};