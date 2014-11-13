$(document).ready(function(){

	var appendImages = function(result){
		
		var resultArray = JSON.parse(result);
		var $container = $("#imagecontainer");
		
		for (var i = 0; i < resultArray.length; i++) {
			
			var $img = $("<img src='" + resultArray[i] + "'/>");
			$container.append($img);
			
		}
		
	};
	
	var bindingEvents = function(){
		
		//$("#mostrar").on("click", function(){

			$.ajax({
			  url: "/Imageapp/ver_imagen.php",
			  type: "GET"
			}).done(function(result) {
				appendImages(result)
			}).fail(function(){
				console.log("error");
			});
			
		//});
		
	}
	
	bindingEvents();
	
});
