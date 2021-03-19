<?php 

	$conn=mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');

	//check connection
	if(!$conn){
		echo "Connection error: ".mysqli_connect_error(); //to know exactly where the problem with the connection eroded.
	}

 ?>