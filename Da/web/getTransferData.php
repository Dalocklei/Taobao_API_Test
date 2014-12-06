<?php
	$date_start = $_POST["start"];
	$date_end = $_POST["end"];

    	$username = "taobao_user"; 
	$password = "taobao_user";   
	$host = "sotbda84.mysql.rds.aliyuncs.com:3306";
	$database = "taobao_data";

	$con = mysql_connect($host, $username, $password);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db($database, $con);
	mysql_query("set character set 'utf8'");//读库
	mysql_query("set names 'utf8'");//写库 

	// DTR,VTR,BTR,BDTR,PTR,VATR,NATR,ADTR
	$sql = "select sum(DTR) as DTR,sum(VTR) as VTR,sum(BTR) as BTR,sum(BDTR) as BDTR,sum(PTR) as PTR,sum(VATR) as VATR,sum(NATR) as NATR,sum(ADTR) as ADTR from transfer_rate_table";

	//$sql = "select * from transfer_rate_table";

	if ($date_start == $date_end) {
		$sql = $sql . " WHERE Date like '" . $date_start . "%'";
	}
	else {
		$sql = $sql . " WHERE Date between '" . $date_start . "' and '" . $date_end . "'";
	}

	$result = mysql_query($sql);

    	if ( ! $result ) {
		alert(mysql_error());
        	echo "not";
        	die;
    	}

    	$data = array();
    
    	$rowcount = mysql_num_rows($result);
  	for ($x = 1; $x <= $rowcount; $x++) {
        	$data[] = mysql_fetch_assoc($result);
    	}
	
	/*echo "<thead>
											<tr>
												<th>DTR</th>
												<th>VTR</th>
												<th>BTR</th>
												<th>BDTR</th>
												<th>PTR</th>
												<th>VATR</th>
												<th>NATR</th>
												<th>ADTR</th>
											</tr></theda>";
	echo "	<tbody>
			<tr>
				<td>12</td>
				<td>12</td>
				<td>12</td>
				<td>12</td>
				<td>12</td>
				<td>12</td>
				<td>12</td>
				<td>12</td>
			</tr></tbody>
		";*/
	
    
   	header("Content-type: application/json");

	echo json_encode($data);

	mysql_close($con);
?>
