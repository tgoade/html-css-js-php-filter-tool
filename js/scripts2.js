
// Ajax: Detects user brand selection to generates dynamic secondary dropdown options

/*$(document).ready(function(){
		$('#brand').on('change', function(){
			var brandVal = $(this).val();				// Grab the brand the user selected and assign the value to brandVal
							
				//$(clickedElem).parent().nextAll().find(".ms-parent").append("<button type='button' class='ms-choice'><span class='placeholder'>%s</span><div></div></button><div class='ms-drop bottom' style='display: block;'><ul class='selectWrap'></ul></div>");				
				
				$.ajax({
					method:'POST',
					url: 'fetch2.php',			
					data:{passtophp:brandVal},				// Assign brandVal to passtophp which needs to match the $_POST name in fetch.php
					success: function(data){
						$(".outageType").find("ul").html(data[0]);		// Puts the dropdown selections echoed in fetch.php back into the dropdown in index.php
						$("#severity").html(data[1]);
						$("#phase").html(data[2]);
						$("#commType").html(data[3]);
						$("#custType").html(data[4]);
						$("#assetType").html(data[5]);
						console.log(data.debug);
						}
				});	
			
		});		
});*/



// Show more or less of the copy

$(document).on('ready', function(){
	console.log("Hello!");
	var showChar = 150;
	var moretext = "&nbsp;...more";
	var lesstext = "&nbsp;&nbsp;less";
	$('.more').each(function() {				/* Run this function for each instance of class 'copy' */
		alert("I am in!");
		var content = $(this).html();
		if(content.length > showChar) {			/* Run this loop if the .more container length > 100 */

			var c = content.substr(0, showChar);								/* Set the part of the container from 0 to length-100 to this var */
			var h = content.substr(showChar);		/* Set the part from 100-1 to content length-100 to this var */
			
			var html = c + '<span class="morecontent"><span>'+h+'</span><a href="" class="morelink">'+moretext+'</a></span>';

			$(this).html(html);							/* Take the .more container, add the 1st-half text, 2nd-half text which is currently display-none, and the 'more' link */
		}

	});

	$(".morelink").click(function(){			/* When the 'more' link is clicked */
		if($(this).hasClass("less")) {					/* If this link has a class of 'less' */
			$(this).removeClass("less");				/* Then remove the 'less' class */
			$(this).html(moretext);						/* Replace everything inside the link with the text 'more' */
		} else {	
			$(this).addClass("less");					/* Otherwise, add 'less' to class */
			$(this).html(lesstext);						/* Replace everything inside the link with the text 'less'  */
		}
		
		$(this).prev().toggle();					/* Toggle (hide or show) the previous container (morecontent span) */
		return false;								/* Prevents the browser from performing the default action for the link */
	});
});