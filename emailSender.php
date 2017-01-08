	<?php
	
	//Swiftmailer needs to installed and configured on webserver to allow emails


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
    

    //update email_sent

	$query_user_update = "UPDATE users set email_sent=1 where email_sent=0 order by Last_visit desc limit 1";

	$result_user_update = mysql_query($query_user_update) or die('Invalid query: ' . mysql_error());


	
	if (mysql_affected_rows() ){ 

		$query = "SELECT * from users order by Last_visit desc limit 1";
		$result = mysql_query($query) or die('Invalid query: ' . mysql_error());
		$numRows = mysql_num_rows($result);
		for($i=0;$i<$numRows; ++$i)
			{
				$row = mysql_fetch_row($result);
				echo"Email ".$row[1]."<br>";
				echo" User Name ".$row[2]."<br>";
				echo" Last Visit ".$row[6]."<br>";
				$userid = $row[1];
			}


	

				$query = "SELECT * FROM exhibits WHERE User_id = '$userid'";

				$result = mysql_query($query) or die('Invalid query: ' . mysql_error());
				$numRows = mysql_num_rows($result);
				
				for($i=0; $i<$numRows; ++$i)
				{
					$mods = mysql_fetch_row($result);
					
					echo "<br>USER ".$row[0]." <br>";
					if($mods[1] == $true){
						//show content related to this portion of the exhibit.
						echo "SC_IN ".$mods[1]."<br>";
					}
					if($mods[2] == $true){
						//show content related to this portion of the exhibit.
						echo "NAV_IN ".$mods[2]."<br>";
					}
					if($mods[3] == $true){
						//show content related to this portion of the exhibit.
						echo "SP_IN ".$mods[3]."<br>";
					}
					if($mods[4] == $true){
						//show content related to this portion of the exhibit.
						echo "N_IN ".$mods[4]."<br>";
					}
						
						echo "QUIZ_SCORE ".$mods[5]."<br>";
				
						//Link to cbc documentray. 
						
				}
				//Display user info
				echo "<br> <br>";
				$query = "SELECT * FROM users WHERE User_id = '$userid'";
				
				$result = mysql_query($query) or die('Invalid query: ' . mysql_error());

				$userinfo = mysql_fetch_row($result);


					for($i=0;$i<$numRows; ++$i)
					{
						$rows = mysql_fetch_row($result);
						echo"Email ".$rows[1]."<br>";
						echo" User Name ".$rows[2]."<br>";
						echo" Last Visit ".$rows[6]."<br>";
					}


				echo "email sending<br>";
				printf("useremail".$rows[6]);

				//send email
				/////////////////////////////////////////////////////	

			   require_once "vendor/swiftmailer/swiftmailer/lib/swift_required.php";
			  

			   echo "files loaded";

			    $transport = Swift_SmtpTransport::newInstance('smtp.gmx.com', 25)
			        ->setUsername('amrakori@gmx.com')
			        ->setPassword('Pear#101');
			    $mailer = Swift_Mailer::newInstance($transport);
			    $message = Swift_Message::newInstance('Wonderful Subject')
			        ->setFrom(array('amrakori@gmx.com' => 'Museum'))
			        ->setTo(array( $rows[6] => 'Visitor'));

			    echo "<br>email setting up";

			    $message->setBody(
			    	'<html>
			    		<head>
						<title>Lab 4 - index.html</title>
						<meta http-equiv="Content-Type" charset="utf-8">
						</head>
					    <body>'.
					     <img src="WholeEmail.jpg"></img>   
					    .'</body>
					</html>');
			    if (!$mailer->send($message, $errors))
			    {
			        echo "Error:";
			        print_r($errors);
			    }
				
				////////////////////////////////////////////////////////

	}//end of if to send


	// Free the resources associated with the result set
	// This is done automatically at the end of the script
	mysql_free_result($result);
	
	?>
	
	<?php
	mysql_close($dbhandle);
	echo 'Connection Closed';
	?>
