<?php 


 	$read_id=$_POST['read_id'];
 	$read_id=intval($read_id);
 	$conn=mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');

 	$query="SELECT * FROM store WHERE store_id='$read_id'";

 	$result=mysqli_query($conn, $query);
 	$str=mysqli_fetch_assoc($result);

 	if (isset($_POST['delete'])){
 		$id_to_delete=$_POST['id_to_delete'];

		$sqldelete="DELETE FROM store WHERE store_id=$id_to_delete";

		if (mysqli_query($conn, $sqldelete)){
			header('Location: viewstore.php');
		}
 	}

 	if (isset($_POST['edit'])){
        session_start();
        $_SESSION['store_id']=$_POST['id_to_edit']/*$cust["card_id"]*/;
        $_SESSION['working_hours']=$_POST['working_hours_to_edit'];
        $_SESSION['square_meters']=$_POST['square_meters_to_edit'];
        $_SESSION['phone']=$_POST['phone_to_edit'];
        $_SESSION['address']=$_POST['address_to_edit'];
        $_SESSION['postal_code']=$_POST['postal_code_to_edit'];
        $_SESSION['city']=$_POST['city_to_edit'];

        header("Location: editstore.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
    	.brand{
    		background: #FF7F50 !important; /*In CSS we use these type of comments. #cbb09c is obv a colour, !important means (IMPORTANT) and what it does is make sure that change goes through(cause if somewhere the background has a certain colour somewhere else, this will not work. Here it does work however). One can also use background-color*/ 
    	} 
    	.brand-text{
    		color: #FF7F50 !important; /*SUPERTURBO SOSOSSOSOSOSO
    									 Whenever I use a CSS command such as color:
    									 I ALWAYS leave a space after : (so it is 
    									 color: colornumber) OR ELSE IT WONT WORK*/
    	}
    	form{
    		max-width: 460px;
    		margin: 20px auto; /*20 pixels top bottom, auto left right*/
    		padding: 20px; /*margin creates space AROUND an element, padding INSIDE it*/
    	}

    </style>
</head>
<body>
	
	<h2 class="brand-text center">Details</h2>
	<div class="container center grey-text">
			<h4>Store ID: <?php echo $str["store_id"]; ?></h4>
			<p>City: <?php echo $str["city"]; ?></p>
			<p>Address: <?php echo $str["address"]; ?></p>
			<p>Postal Code: <?php echo $str["postal_code"]; ?></p>
			<p>Phone: <?php echo $str["phone"]; ?></p>
			<p>Working Hours: <?php echo $str["working_hours"]; ?></p>
			<p>Square Meters: <?php echo $str["square_meters"]; ?></p>
			<!--Delete pizza form. When I have a tags I input the name like this -> <a href="">NAME</a> and when I have form I create an input tag and put it there in value <form action="">
					<input blabla value="NAME">
				  </form> -->
			<!--<form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $pizza['ID']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>-->
			<form action="storedetails.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $str['store_id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <input type="hidden" name="id_to_edit" value="<?php echo $str['store_id']; ?>">
                <input type="hidden" name="working_hours_to_edit" value="<?php echo $str['working_hours']; ?>">
                <input type="hidden" name="phone_to_edit" value="<?php echo $str['phone']; ?>">
                <input type="hidden" name="address_to_edit" value="<?php echo $str['address']; ?>">
                <input type="hidden" name="postal_code_to_edit" value="<?php echo $str['postal_code']; ?>">
                <input type="hidden" name="city_to_edit" value="<?php echo $str['city']; ?>">
                <input type="hidden" name="square_meters_to_edit" value="<?php echo $str['square_meters']; ?>">
                <input type="submit" name="edit" value="Edit" class="btn brand z-depth-0">
            </form>  

			
			<form action="index.php" method="POST">
       			<input type="submit" value="Homepage" class="btn brand z-depth-0">
     		</form>

     		<form action="viewstore.php" method="POST">
       			<input type="submit" value="Previous Page" class="btn brand z-depth-0">
     		</form>
		</div>
</body>
</html>>