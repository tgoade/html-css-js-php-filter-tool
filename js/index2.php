<?php 
include('database-connection.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Stormwatch</title>
<link rel="stylesheet" type="text/css" href="css/style2.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet" type="text/css">
<!--<link rel="stylesheet" type="text/css" href="css/example-styles.css">-->
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
				<div class="narrow-results"><h2>Narrow results:</h2></div>				
				<form name="filterForm[]" action="" method="post">
					<div id="filters">
						<fieldset name="filter[0][]" id="brand">
							<legend><h3>Brand</h3></legend>
							<?php							
							$query = "SELECT DISTINCT market FROM stormwatch";   //SELECT DISTINCT grabs the unique/first occurrence of a value in the column "market"							
							$result = mysqli_query($connect, $query);	// Query inside the database	
							foreach ($result as $row)					// $row will be the key of the array $result
							{
								if (!empty($row['market'])){								
							?>
								<div class="list-group-item checkbox">
									<label>
										<input type="checkbox" class="brand commonSelector" value="<?php echo $row['market']; ?>">
										<?php echo $row['market']; ?>
									</label>
								</div>
							<?php
								}
							}
							?>							
						</fieldset>
						<fieldset name="filter[1][]" id="outageType">
							<legend><h3>Natural Disaster Type</h3></legend>
							<?php							
							$query = "SELECT DISTINCT natural_disaster_type FROM stormwatch";									
							$result = mysqli_query($connect, $query);
							foreach ($result as $row)
							{
								if (!empty($row['natural_disaster_type'])){
							?>
								<div class="list-group-item checkbox">
									<label>
										<input type="checkbox" class="outageType commonSelector" value="<?php echo $row['natural_disaster_type']; ?>">
										<?php echo $row['natural_disaster_type']; ?>
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
							$query = "SELECT DISTINCT severity_of_storm FROM stormwatch";									
							$result = mysqli_query($connect, $query);
							foreach ($result as $row)
							{
								if (!empty($row['severity_of_storm'])){
							?>
								<div class="list-group-item checkbox">
									<label>
										<input type="checkbox" class="severity commonSelector" value="<?php echo $row['severity_of_storm']; ?>">
										<?php echo $row['severity_of_storm']; ?>
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
							foreach ($result as $row)
							{
								if (!empty($row['phase_of_event'])){		
							?>
								<div class="list-group-item checkbox">
									<label>
										<input type="checkbox" class="phase commonSelector" value="<?php echo $row['phase_of_event']; ?>">
										<?php echo $row['phase_of_event']; ?>
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
							$query = "SELECT DISTINCT type_of_communication FROM stormwatch";									
							$result = mysqli_query($connect, $query);
							foreach ($result as $row)
							{
								if (!empty($row['type_of_communication'])){	
							?>
								<div class="list-group-item checkbox">
									<label>
										<input type="checkbox" class="commType commonSelector" value="<?php echo $row['type_of_communication']; ?>">
										<?php echo $row['type_of_communication']; ?>
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
							$query = "SELECT DISTINCT type_of_customer FROM stormwatch";									
							$result = mysqli_query($connect, $query);
							foreach ($result as $row)
							{
								if (!empty($row['type_of_customer'])){	
							?>
								<div class="list-group-item checkbox">
									<label>
										<input type="checkbox" class="custType commonSelector" value="<?php echo $row['type_of_customer']; ?>">
										<?php echo $row['type_of_customer']; ?>
									</label>
								</div>
							<?php
								}
							}
							?>
						</fieldset>
						<fieldset name="filter[6][]" id="assetType" >
							<legend><h3>Asset Type</h3></legend>
							<?php							
							$query = "SELECT DISTINCT asset_type FROM stormwatch";									
							$result = mysqli_query($connect, $query);
							foreach ($result as $row)
							{
								if (!empty($row['asset_type'])){
							?>
								<div class="list-group-item checkbox">
									<label>
										<input type="checkbox" class="assetType commonSelector" value="<?php echo $row['asset_type']; ?>">
										<?php echo $row['asset_type']; ?>
									</label>
								</div>
							<?php
								}
							}
							?>
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
	
	filterData();
	
	function filterData(){
		$('.filter-data').html('<div id="loading" style=""></div>');
		//var action = 'fetchData';
		var brand = getFilter('brand');									// Calls the getFilter function for the class name 'brand', which results in an array of user-selected values
		var outageType = getFilter('outageType');						// Calls the getFilter function for the class name 'outageType', ...
		var severity = getFilter('severity');
		var phase = getFilter('phase');
		var commType = getFilter('commType');
		var custType = getFilter('custType');
		var assetType = getFilter('assetType');
		$.ajax({
			url:"fetch2.php",
			method:"POST",
			data:{brand:brand, outageType:outageType, severity:severity, phase:phase, commType:commType, custType:custType, assetType:assetType},		// Passing the arrays to fetch2.php
			success:function(data){
				$('.filter-data').html(data);
				//console.log(data.debug);
			}
		});
	}
	
	// Function to collect user-selected values for each class name and store them in the 'filter' array 
	
	function getFilter(className){
		var filter = [];
		$('.'+className+':checked').each(function(){
			filter.push($(this).val());
		});
		return filter;
	}
	
	// When any checkboxes are clicked, the filterData function is called 
	
	$('.commonSelector').click(function(){
		filterData();
	});
	
	
	

});
	

</script>
<script src="js/scripts2.js"></script>
</body>
</html>

