$(document).ready(function(){
		$('#brand').on('change', function(){
			var brandVal = $(this).val();				// Grab the brand the user selected and assign the value to brandVal
			
			if(brandVal){
				
				$.ajax({
					method:'POST',
					url: "index3.php",			
					data:{brand:brandVal},				// Assign brandVal to brand which needs to match the $_POST name in fetch.php
				})				
				.done(function(data){
					console.log(brandVal);
				});
			} 
		});
});