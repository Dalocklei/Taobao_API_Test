<?php
    	$username = "taobao_user"; 
	$password = "taobao_user";   
	$host = "sotbda84.mysql.rds.aliyuncs.com";
	$database = "taobao_data";

	$con = mysql_connect($host, $username, $password);
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}

	mysql_select_db($database, $con);
	mysql_query("set character set 'utf8'");//读库
	mysql_query("set names 'utf8'");//写库 

	$sql = "select DTR,VTR,BTR,BDTR,PTR,VATR,NATR,ADTR from transfer_rate_table";

	$result = mysql_query($sql);

    	if ( ! $result ) {
        	echo mysql_error();
        	die;
    	}

    	$data = array();
    
    	$rowcount = mysql_num_rows($result);
  	for ($x = 1; $x <= $rowcount; $x++) {
        	$data[] = mysql_fetch_assoc($result);
    	}
    
   	header("Content-type: application/json");

	echo json_encode($data);

	mysql_close($con);
?>
