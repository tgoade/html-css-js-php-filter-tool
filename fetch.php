<?php
ob_start();

header('Content-type: application/json; charset=utf-8');

//call file to connect to database
//include('database-connection.php');


//if(isset($_POST["action"])){
	$connect = mysqli_connect('localhost','*****','*****','customer_impact');
	$query = "SELECT * FROM stormwatch";
	$addFilter = FALSE;	

	if (isset($_POST["brand"]) || isset($_POST["outageType"]) || isset($_POST["severity"]) || isset($_POST["phase"]) || isset($_POST["commType"]) || isset($_POST["custType"]) || isset($_POST["assetType"])){			
			$query = $query . " WHERE ";						// If any of the filters exists, add a "WHERE" at the end.									
		};

	if(isset($_POST["brand"])){
		$brandFilter = implode("','", $_POST["brand"]);			// Convert array to string
		$query .= " market IN ('".$brandFilter."')";		// Filters data based on brand
		$addFilter = TRUE;
	}
	if(isset($_POST["outageType"])){
		if ($addFilter == TRUE){ 							// If a previous filter exists, add "AND" in front of this filter.
				$query .= " AND";
			};
		$outageFilter = implode("','", $_POST["outageType"]);
		$query .= " natural_disaster_type IN ('".$outageFilter."')";		// Filters data based on outage type		
		$addFilter = TRUE;
	}
	if(isset($_POST["severity"])){
		if ($addFilter == TRUE){ 							// If a previous filter exists, add "AND" in front of this filter.
				$query .= " AND";
			};
		$sevFilter = implode("','", $_POST["severity"]);
		$query .= " severity_of_storm IN ('".$sevFilter."')";		// Filters data based on severity type		
		$addFilter = TRUE;
	}
	if(isset($_POST["phase"])){
		if ($addFilter == TRUE){ 							// If a previous filter exists, add "AND" in front of this filter.
				$query .= " AND";
			};
		$phaseFilter = implode("','", $_POST["phase"]);
		$query .= " phase_of_event IN ('".$phaseFilter."')";		// Filters data based on phase of event	
		$addFilter = TRUE;
	}
	if(isset($_POST["commType"])){
		if ($addFilter == TRUE){ 							// If a previous filter exists, add "AND" in front of this filter.
				$query .= " AND";
			};
		$commFilter = implode("','", $_POST["commType"]);
		$query .= " type_of_communication IN ('".$commFilter."')";		// Filters data based on communication type	
		$addFilter = TRUE;
	}
	if(isset($_POST["custType"])){
		if ($addFilter == TRUE){ 							// If a previous filter exists, add "AND" in front of this filter.
				$query .= " AND";
			};
		$custFilter = implode("','", $_POST["custType"]);
		$query .= " type_of_customer IN ('".$custFilter."')";		// Filters data based on customer type	
		$addFilter = TRUE;
	}
	if(isset($_POST["assetType"])){
		if ($addFilter == TRUE){ 							// If a previous filter exists, add "AND" in front of this filter.
				$query .= " AND";
			};
		$assetFilter = implode("','", $_POST["assetType"]);
		$query .= " asset_type IN ('".$assetFilter."')";		// Filters data based on asset type		
		$addFilter = TRUE;
	}
	$query .= " ORDER BY event_date DESC;";					// Filter data by descending date		
	
	$result = mysqli_query($connect, $query);
	
	foreach($result as $row){	
			
			$output .= "<div class='event'>
				<div class='details'>
					<div class='col'>
						<div>" . (
									($row['market']=='RCN') ? '<img src="images/rcn.png" />' : 
									  (($row['market']=='Grande') ? '<img src="images/grande.png" alt="" />' : 
									  (($row['market']=='Wave') ? '<img src="images/wave.png" alt="" />' : ''))
								 ) . 
						"</div>
						<div>" . (
									($row['type_of_customer']=='RESI') ? '<img src="images/resi.png" />' : 
									  (($row['type_of_customer']=='BIZ') ? '<img src="images/biz.png" alt="" />' : '')
								 ) . "<span>" 
							   . (
									($row['type_of_customer']=='RESI') ? 'Residential' : 
									  (($row['type_of_customer']=='BIZ') ? 'Business' : '')
								 ) . "</span>
						</div>
						<div>" . (
									($row['type_of_communication']=='SOCIAL - Facebook') ? '<img src="images/fb.png" />' : 
									  (
										($row['type_of_communication']=='SOCIAL - Twitter') ? '<img src="images/tw.png" alt="" />' : 
										(
										   ($row['type_of_communication']=='WEB - Homepage Ribbon') ? '<img src="images/web-ribbon.png" alt="" />' : 
										   (
											   ($row['type_of_communication']=='WEB - Stormwatch Page') ? '<img src="images/webpage.png" alt="" />' : 
											   (
												   ($row['type_of_communication']=='EMAIL') ? '<img src="images/email.png" alt="" />' : ''
											   )
										   )
										)
									  )
								 ) . "<span>" . (
									($row['type_of_communication']=='SOCIAL - Facebook') ? 'Facebook' : 
									  (
										($row['type_of_communication']=='SOCIAL - Twitter') ? 'Twitter' : 
										(
										   ($row['type_of_communication']=='WEB - Homepage Ribbon') ? 'Web Ribbon' : 
										   (
											   ($row['type_of_communication']=='WEB - Stormwatch Page') ? 'Web Page' : 
											   (
												   ($row['type_of_communication']=='EMAIL') ? 'Email' : ''
											   )
										   )
										)
									  )
								 ) . "</span></div>
					</div>
					<div class='col'>
						<div><strong>" . (
									($row['natural_disaster_type']=='Winter Storm') ? 'Winter Storm' : 
									  (
										($row['natural_disaster_type']=='Hurricane') ? 'Hurricane' : 
										(
										   ($row['natural_disaster_type']=='Tropical Storm') ? 'Tropical Storm' : 
										   (
											   ($row['natural_disaster_type']=='Service Outage') ? 'Service Outage' : ''											   
										   )
										)
									  )
								 ) . "</strong><p>" . (
									($row['phase_of_event']=='PRE-' || $row['phase_of_event']=='Pre-' || $row['phase_of_event']=='Pre') ? '&nbsp;(Pre)' : 
									  (
										($row['phase_of_event']=='During') ? '&nbsp;(During)' : 
										(
										   ($row['phase_of_event']=='Post') ? '&nbsp;(Post)' : ""										   
										)
									  )
								 ) . "</p></div>
						<div>" . (($row['event_date']=='0000-00-00') ? '' : date('M. d, Y', strtotime($row['event_date']))) . "</div>
						<div>" . (
									($row['severity_of_storm']=='DEFCON 1') ? '<img src="images/defcon1.png" />' : 
									  (
										($row['severity_of_storm']=='DEFCON 2') ? '<img src="images/defcon2.png" alt="" />' : 
										(
										   ($row['severity_of_storm']=='DEFCON 3') ? '<img src="images/defcon3.png" alt="" />' : ''										   
										)
									  )
								 ) . "<span>" . (
									($row['severity_of_storm']=='DEFCON 1') ? ' DEFCON 1' : 
									  (
										($row['severity_of_storm']=='DEFCON 2') ? ' DEFCON 2' : 
										(
										   ($row['severity_of_storm']=='DEFCON 3') ? ' DEFCON 3' : ''										   
										)
									  )
								 ) . "</span></div>
					</div>
				</div>
				<div class='approvals'>
					<div class='col'>
						<p>GM last approved<br/>" . (($row['gm_date_last_approved']=='0000-00-00') ? 'Unknown' : date('M. d, Y', strtotime($row['gm_date_last_approved']))) . "</p>		
					</div>
					<div class='col'>
						<p>C-level last approved<br/>" . (($row['c_level_date_last_approved'])=='0000-00-00' ? 'Unknown' : date('M. d, Y', strtotime($row['c_level_date_last_approved']))) . "</p>
					</div>
				</div>
				<div class='content'>
					<p class='more'>\"" . htmlspecialchars($row['base_copy'], ENT_SUBSTITUTE) . "\"</p>
				</div>
			</div>";
	};
		

	print_r($query);
	
	$debug = ob_get_clean();

	$data['debug'] = $debug;
		
	echo json_encode($output); 
			
	



	mysqli_close($connect);
?>