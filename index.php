<?php 
// Connect to the database	
$connect = mysqli_connect('localhost','*****','*****','customer_impact');	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Stormwatch</title>
<link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</head>

<body>

<section id="selections">
	<div class="wrapper">		
		<a href="/" >
			<h1>Customer Impacting Events</h1>
			<img src="images/logos-small.png" width="300" height="32" alt="Grande | RCN | Wave" id="logos" />
		</a>		
	</div>
	</section>	
	<section>
		<div class="wrapper main">
			<div class="colL">
				<div class="narrow-results"><h2>Narrow results:</h2>
				<?php							
							$query = "SELECT * FROM stormwatch";									
							$result = mysqli_query($connect, $query);
							$totalRows = mysqli_num_rows($result);					// Counts the total rows in the database
							echo "<p>".$totalRows." Total Entries</p>";
				?>
				</div>				
				<form name="filterForm[]" action="" method="post">
					<div id="filters">
						<fieldset name="filter[0][]" id="brand">
							<legend><h3>Brand</h3></legend>
								<?php							
								$query = "SELECT DISTINCT market FROM stormwatch ORDER BY market DESC";   // SELECT DISTINCT grabs the unique/first occurrence of a value in the column "market"					
								$result = mysqli_query($connect, $query);			 // Query inside the database, forming an array of unique values in the "market" column	
								foreach ($result as $column)						 // $result = array($column['market'][1], $column['market'][2], ...)
								{
									if (!empty($column['market'])){					 // If the cell in that column is not empty, display the following checkbox div					
								?>
									<div class="list-group-item checkbox">
										<label>
											<input type="checkbox" class="brand commonSelector" value="<?php echo $column['market']; ?>">
											<?php echo $column['market']; ?>
										</label>
									</div>
								<?php
									}
								}
								?>							
						</fieldset>
						<fieldset name="filter[1][]" id="outageType">
							<legend><h3>Event Type</h3></legend>
								<?php							
								$query = "SELECT DISTINCT natural_disaster_type FROM stormwatch ORDER BY natural_disaster_type";									
								$result = mysqli_query($connect, $query);
								foreach ($result as $column)
								{
									if (!empty($column['natural_disaster_type'])){
								?>
									<div class="list-group-item checkbox">
										<label>
											<input type="checkbox" class="outageType commonSelector" value="<?php echo $column['natural_disaster_type']; ?>">
											<?php echo $column['natural_disaster_type']; ?>
										</label>
									</div>
								<?php
									}
								}
								?>
						</fieldset>
						<fieldset name="filter[5][]" id="custType" >
							<legend><h3>Customer Type</h3></legend>
								<?php							
								$query = "SELECT DISTINCT type_of_customer FROM stormwatch ORDER BY type_of_customer DESC";									
								$result = mysqli_query($connect, $query);
								foreach ($result as $column)
								{
									if (!empty($column['type_of_customer'])){	
								?>
									<div class="list-group-item checkbox">
										<label>
											<input type="checkbox" class="custType commonSelector" value="<?php echo $column['type_of_customer']; ?>">
											<?php echo $column['type_of_customer']; ?>
										</label>
									</div>
								<?php
									}
								}
								?>
						</fieldset>
						<fieldset name="filter[4][]" id="commType" >
							<legend><h3>Communication Type</h3></legend>
								<?php							
								$query = "SELECT DISTINCT type_of_communication FROM stormwatch ORDER BY type_of_communication";									
								$result = mysqli_query($connect, $query);
								foreach ($result as $column)
								{
									if (!empty($column['type_of_communication']) && $column['type_of_communication']!=='EMAIL'){	/* Code added to hide the email filter for now */
								?>
									<div class="list-group-item checkbox">
										<label>
											<input type="checkbox" class="commType commonSelector" value="<?php echo $column['type_of_communication']; ?>">
											<?php echo $column['type_of_communication']; ?>
										</label>
									</div>
								<?php
									}
								}
								?>
						</fieldset>	
						<fieldset name="filter[2][]" id="severity">
							<legend><h3>Severity</h3></legend>
								<?php							
								$query = "SELECT DISTINCT severity_of_storm FROM stormwatch ORDER BY severity_of_storm";									
								$result = mysqli_query($connect, $query);
								foreach ($result as $column)
								{
									if (!empty($column['severity_of_storm'])){
								?>
									<div class="list-group-item checkbox">
										<label>
											<input type="checkbox" class="severity commonSelector" value="<?php echo $column['severity_of_storm']; ?>">
											<?php echo $column['severity_of_storm']; ?>
										</label>
									</div>
								<?php
									}
								}
								?>
						</fieldset>
						<fieldset name="filter[3][]" id="phase" >
							<legend><h3>Phase of Event</h3></legend>
								<?php							
								$query = "SELECT DISTINCT phase_of_event FROM stormwatch";									
								$result = mysqli_query($connect, $query);
								foreach ($result as $column)
								{
									if (!empty($column['phase_of_event'])){		
								?>
									<div class="list-group-item checkbox">
										<label>
											<input type="checkbox" class="phase commonSelector" value="<?php echo $column['phase_of_event']; ?>">
											<?php echo $column['phase_of_event']; ?>
										</label>
									</div>
								<?php
									}
								}
								?>
							<a href="" class="reset-filters right">Clear all filters</a>
						</fieldset>											
						<!--<fieldset name="filter[6][]" id="assetType" >
							<legend><h3>Asset Type</h3></legend>
								<?php							
								$query = "SELECT DISTINCT asset_type FROM stormwatch";									
								$result = mysqli_query($connect, $query);
								foreach ($result as $column)
								{
									if (!empty($column['asset_type'])){
								?>
									<div class="list-group-item checkbox">
										<label>
											<input type="checkbox" class="assetType commonSelector" value="<?php echo $column['asset_type']; ?>">
											<?php echo $column['asset_type']; ?>
										</label>
									</div>
								<?php
									}
								}
								mysqli_close($connect);
								?>
						</fieldset>-->	
						<fieldset>							
							<a href="no-no-list.html" target="_blank" class="field-link">No-No List</a>
						</fieldset>
					</div>						
				</form>	
			</div>
			<div class="colR"> 
				<div class="filter-data"></div>				
			</div>
		 </div>
	</section>
	
	<script>
// Capture user selections on filters
$(document).ready(function(){
	
	// Calls the filterData function when the page first loads
	
	filterData();	
	
	// Function to
	
	function filterData(){
		$('.filter-data').html('<div id="loading" style=""></div>');	// Inserts a div with the spinning gif
		//var action = 'fetchData';
		var brand = getFilter('brand');									// Calls the getFilter function for the class name 'brand', which results in an array of user-selected values
		var outageType = getFilter('outageType');						// Calls the getFilter function for the class name 'outageType', ...
		var severity = getFilter('severity');
		var phase = getFilter('phase');
		var commType = getFilter('commType');
		var custType = getFilter('custType');
		var assetType = getFilter('assetType');
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{brand:brand, outageType:outageType, severity:severity, phase:phase, commType:commType, custType:custType, assetType:assetType},		// Passing the arrays to fetch.php
			success:function(data){
				$('.filter-data').html(data);
				//console.log(data.debug);
			}
		});		
		
	}
	
	// Calls the moreLess function which shrinks the display copy
	
	moreLess();
	
	// Function to collect user-selected values for each class name and store them in the 'filter' array 
	
	function getFilter(className){
		var filter = [];
		$('.'+className+':checked').each(function(){
			filter.push($(this).val());
		});
		return filter;
	}
	
	// When any checkboxes are clicked, the filterData function is called 
	
	$('.commonSelector').on('click', function(){
		filterData();
		moreLess();
	});
	
	function moreLess(){		
		var showChar = 150;
		var moretext = "&nbsp;...more";
		var lesstext = "&nbsp;&nbsp;less";
		setTimeout(function(){							/* setTimeout is wrapped around this function to delay its execution until the queries are made and displayed */
			$('.more').each(function() {				/* Run this function for each instance of class 'copy' */				
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
		}, 250);
	}

});
		
	// Reset all checkboxes and reloads the unchecked filters, when the "Clear all filters" link is clicked
	
	$('.reset-filters').on('click', function(){		
		$('input:checkbox').prop('checked',false);
		filterData();	
	});

</script>
<!--<script src="js/scripts.js"></script>-->
</body>
</html>

