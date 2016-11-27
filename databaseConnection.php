<?php
	$true = 1; 
	$username = "hive1";
	$password = "hive1";
	$hostname = "104.131.92.40";
	//$hostname = "localhost";
	$dbname = "hivedata";
	
	//connection to database
	
	mysql_close($dbhandle);
	$dbhandle = mysql_connect($hostname, $username, $password);
	if (!$dbhandle) {
		die('Could not connect: ' . mysql_error());
	}
	echo 'Connected successfully';
	
	mysql_select_db($dbname);
	$prefix = "29";
	//$query = "SELECT * FROM users WHERE User_id = '$userid'";
	//Select all items on $querry $query = "SELECT * FROM exhibits";
	$query = "SELECT * FROM exhibits ORDER BY User_id DESC";


	$result = mysql_query($query) or die('Invalid query: ' . mysql_error());
	$numRows = mysql_num_rows($result);
	
	for($i=0; $i<$numRows; ++$i)
	{
		$row = mysql_fetch_row($result);
		$userid = $row[0];
		echo "<br>USER ".$row[0]." <br>";
		if($row[1] == $true){
			//show content related to this portion of the exhibit.
			echo "SC_IN ".$row[1]."<br>";
		}
		if($row[2] == $true){
			//show content related to this portion of the exhibit.
			echo "NAV_IN ".$row[2]."<br>";
		}
		if($row[3] == $true){
			//show content related to this portion of the exhibit.
			echo "SP_IN ".$row[3]."<br>";
		}
		if($row[4] == $true){
			//show content related to this portion of the exhibit.
			echo "N_IN ".$row[4]."<br>";
		}
			
			echo "QUIZ_SCORE ".$row[5]."<br>";
	
			//Link to cbc documentray. 
		
		
		
	}
	//Display user info
	echo "<br> <br>";
	$query = "SELECT * FROM users WHERE User_id = '$userid'";
	
	$result = mysql_query($query) or die('Invalid query: ' . mysql_error());
	$numRows = mysql_num_rows($result);
	for($i=0;$i<$numRows; ++$i)
	{
		$row = mysql_fetch_row($result);
		echo"Email ".$row[1]."<br>";
		echo" User Name ".$row[2]."<br>";
		echo" Last Visit ".$row[6]."<br>";
	}


	//print values to screen


	// Free the resources associated with the result set
	// This is done automatically at the end of the script
	mysql_free_result($result);
	
	?>
	
	<?php
	
	
	
	
	
	mysql_close($dbhandle);
	echo 'Connection Closed';


?>
