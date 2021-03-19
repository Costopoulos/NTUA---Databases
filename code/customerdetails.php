<?php 


 	$read_id=$_POST['read_id'];
 	$read_id=intval($read_id);
 	$conn=mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');

 	$query="SELECT * FROM customer WHERE card_id='$read_id'";

 	$result=mysqli_query($conn, $query);
 	$cust=mysqli_fetch_assoc($result);

 	if (isset($_POST['delete'])){
 		$id_to_delete=$_POST['id_to_delete'];

		$sqldelete="DELETE FROM customer WHERE card_id=$id_to_delete";

		if (mysqli_query($conn, $sqldelete)){
			header('Location: hopeviewcust.php');
		}
 	}

    /*if (isset($_POST['edit'])){
        $id_to_edit=$_POST['id_to_edit'];
        $full_name_to_edit=$_POST['full_name_to_edit'];
        $birth_date_to_edit=$_POST['birth_date_to_edit'];
        $phone_to_edit=$_POST['phone_to_edit'];
        $card_points_to_edit=$_POST['card_points_to_edit'];
        $age_to_edit=$_POST['age_to_edit'];
        $family_status_to_edit=$_POST['family_status_to_edit'];
        $address_to_edit=$_POST['address_to_edit'];
        $postal_code_to_edit=$_POST['postal_code_to_edit'];
        $city_to_edit=$_POST['city_to_edit'];
        $pet_to_edit=$_POST['pet_to_edit'];
        $gender_to_edit=$_POST['gender_to_edit'];
        $email_to_edit=$_POST['email_to_edit'];
        $sqledit="UPDATE customer 
        SET 
        WHERE card_id=$id_to_edit";
        $

        if (mysqli_query($conn, $sqledit)){
            header('Location: hopeviewcust.php');
        }
    } */
    if (isset($_POST['edit'])){
        session_start();
        $_SESSION['card_id']=$_POST['id_to_edit']/*$cust["card_id"]*/;
        $_SESSION['full_name']=$_POST['full_name_to_edit'];
        $_SESSION['birth_date']=$_POST['birth_date_to_edit'];
        $_SESSION['phone']=$_POST['phone_to_edit'];
        $_SESSION['card_points']=$_POST['card_points_to_edit'];
        $_SESSION['age']=$_POST['age_to_edit'];
        $_SESSION['family_status']=$_POST['family_status_to_edit'];
        $_SESSION['address']=$_POST['address_to_edit'];
        $_SESSION['postal_code']=$_POST['postal_code_to_edit'];
        $_SESSION['city']=$_POST['city_to_edit'];
        $_SESSION['pet']=$_POST['pet_to_edit'];
        $_SESSION['gender']=$_POST['gender_to_edit'];
        $_SESSION['email']=$_POST['email_to_edit'];

        header("Location: editcustomer.php");
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
    	.button1{
                background-color: #FF7F50;
                position: absolute;
                left: 47%;
                height: 40px;
                width: 150px;
                font-size: 20px;
                color: white;
               /* display: inline-block;
                left: 50%;
                -ms-transform: translate(-50%,-50%);*/
        }
        .button2{
                background-color: #FF7F50;
                position: absolute;
                left: 47%;
                height: 40px;
                width: 180px;
                font-size: 20px;
                color: white;
               /* display: inline-block;
                left: 50%;
                -ms-transform: translate(-50%,-50%);*/
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
			<h4><?php echo $cust["full_name"]; ?></h4> <!--class="brand-text" -->
			<p>Card ID: <?php echo $cust["card_id"]; ?></p>
			<p>Card Points: 
				<?php 
					if ($cust["card_points"]) echo $cust["card_points"];
					else echo 'No points yet'; 
				?>
				
			</p>
			<p>Address: <?php echo $cust["address"]; ?></p>
			<p>Postal Code: <?php echo $cust["postal_code"]; ?></p>
			<p>City: <?php echo $cust["city"]; ?></p>
			<p>Email: <?php echo $cust["email"]; ?></p>
			<p>Phone: <?php echo $cust["phone"]; ?></p>
			<p>Birthday: <?php echo $cust["birth_date"]; ?></p>
			<p>Age: <?php echo $cust["age"]; ?></p>
			<p>Family Status: <?php echo $cust["family_status"]; ?></p>
			<p>Gender: <?php echo $cust["gender"]; ?></p>
			<p>Pet: 
				<?php 
					if ($cust["pet"]) echo $cust["pet"];
					else echo 'No pet'; 
				?>
			
			</p>
			
			<!--Delete pizza form. When I have a tags I input the name like this -> <a href="">NAME</a> and when I have form I create an input tag and put it there in value <form action="">
					<input blabla value="NAME">
				  </form> -->
			<form action="customerdetails.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $cust['card_id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>
            
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <input type="hidden" name="id_to_edit" value="<?php echo $cust['card_id']; ?>">
                <input type="hidden" name="full_name_to_edit" value="<?php echo $cust['full_name']; ?>">
                <input type="hidden" name="birth_date_to_edit" value="<?php echo $cust['birth_date']; ?>">
                <input type="hidden" name="phone_to_edit" value="<?php echo $cust['phone']; ?>">
                <input type="hidden" name="card_points_to_edit" value="<?php echo $cust['card_points']; ?>">
                <input type="hidden" name="age_to_edit" value="<?php echo $cust['age']; ?>">
                <input type="hidden" name="family_status_to_edit" value="<?php echo $cust['family_status']; ?>">
                <input type="hidden" name="address_to_edit" value="<?php echo $cust['address']; ?>">
                <input type="hidden" name="postal_code_to_edit" value="<?php echo $cust['postal_code']; ?>">
                <input type="hidden" name="city_to_edit" value="<?php echo $cust['city']; ?>">
                <input type="hidden" name="pet_to_edit" value="<?php echo $cust['pet']; ?>">
                <input type="hidden" name="gender_to_edit" value="<?php echo $cust['gender']; ?>">
                <input type="hidden" name="email_to_edit" value="<?php echo $cust['email']; ?>">
                <input type="submit" name="edit" value="Edit" class="btn brand z-depth-0">
            </form> 


		<!--</div>-->
        <form action="customer_queries.php" method="POST">
                <input type="submit" value="Queries" class="btn brand z-depth-0">
                <input type="hidden"name="id_to_edit" value="<?php echo $cust['card_id']; ?>">
        </form>

		<form action="index.php" method="POST">
       			<input type="submit" value="Homepage" class="btn brand z-depth-0">
     	</form>

     	<form action="hopeviewcust.php" method="POST">
       		<input type="submit" value="Previous Page" class="btn brand z-depth-0">
     	</form>
     	<!--	<a href="index.php" class="btn brand">Homepage</a> -->
       </div>
</body>
</html>>