<?php

 	$dbconn = mysqli_connect("192.168.8.110","appserver","Pr0ject","althealth");

  	// Check connection
  	if (mysqli_connect_errno())
    {
    	echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //date_default_timezone_set("Asia/Manila"); 
?>
