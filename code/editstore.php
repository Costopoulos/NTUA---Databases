<?php 

	include('configdatabase/project_databaseconn.php');

	session_start();
	$store_id_prev_page=$_SESSION['store_id'];
	$working_hours_prev_page=$_SESSION['working_hours'];
	$phone_prev_page=$_SESSION['phone'];
	$address_prev_page=$_SESSION['address'];
	$postal_code_prev_page=$_SESSION['postal_code'];
	$city_prev_page=$_SESSION['city'];
	$square_meters_prev_page=$_SESSION['square_meters'];

	//$email=$full_name=$phone=$age=$pet=$address=$postal_code=$city=$birth_date=''; 
	$working_hours=$address=$square_meters=$postal_code=$phone=$city=''; 
	//$errors=array('email'=>'', 'full_name'=>'', 'phone'=>'', 'age'=>'', 'pet'=>'', 'address'=>'', 'postal_code'=>'', 'city'=>'', 'birth_date'=>''); 
	$errors=array('working_hours'=>'','address'=>'', 'square_meters'=>'', 'postal_code'=>'', 'phone'=>'', 'city'=>''); 
	if(isset($_POST['submit'])){

		if(empty($_POST['working_hours'])) $errors['working_hours']='Working hours are required <br />';
		else {
			$working_hours=$_POST['working_hours'];
			if (!preg_match('/0[6-9][:][0-5][0-9][-][1-2][0-9][:][0-5][0-9]/', $working_hours)) $errors['working_hours']='The hours must be formed as OpenHour:OpenMinute-ClosingHour:ClosingMinute';
		}

		// ^[#.0-9a-zA-Z\s,-]+$
		if(empty($_POST['address'])) $errors['address']='An address is required <br />';
		else {
			$address=$_POST['address'];
			if (!preg_match('/[a-zA-Z][\s][0-9]+$/', $address)) $errors['address']='Your address must be spaces, numbers and letters only';
		}

		if(empty($_POST['square_meters'])) $errors['square_meters']='Square meters are required <br />';
		else{
			$square_meters=$_POST['square_meters'];
			if (!preg_match('/^[0-9]*$/', $square_meters)) $errors['square_meters']='Square meters must be numbers only';
		}

		/*if(empty($_POST['product_categories'])) $errors['product_categories']='A product category is required <br />';
		else {
			$product_categories=$_POST['product_categories'];
			if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $product_categories)) $errors['product_categories']='The product category must be spaces and letters only';
		}*/

		if(empty($_POST['phone'])) $errors['phone']='A phone number is required <br />';
		else{
			$phone=$_POST['phone'];
			if (!preg_match('/210[0-9]{7}$/', $phone)) $errors['phone']='Phone number must be numbers only';
		}
		
		

		if(empty($_POST['postal_code'])) $errors['postal_code']='A postal code is required <br />';
		else{
			$postal_code=$_POST['postal_code'];
			if (!preg_match('/^[0-9]*$/', $postal_code)) $errors['postal_code']='Postal code must be numbers only';
		}

		if(empty($_POST['city'])) $errors['city']='A city name is required <br />';
		else {
			$city=$_POST['city'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $city)) $errors['city']='The city name must be spaces and letters only';
		}

		//$email=$full_name=$phone=$age=$pet=$address=$postal_code=$city=$birth_date
		if(array_filter($errors)){
			echo "Errors in the form";
		} 

		else{
			//$email=mysqli_real_escape_string($conn, $_POST['email']); //we import these in our database
			$working_hours=mysqli_real_escape_string($conn, $_POST['working_hours']);
			$phone=mysqli_real_escape_string($conn, $_POST['phone']);
			//$age=mysqli_real_escape_string($conn, $_POST['age']);
			//$pet=mysqli_real_escape_string($conn, $_POST['pet']);
			$address=mysqli_real_escape_string($conn, $_POST['address']);
			$square_meters=mysqli_real_escape_string($conn, $_POST['square_meters']);
			$city=mysqli_real_escape_string($conn, $_POST['city']);
			//$product_categories=mysqli_real_escape_string($conn, $_POST['product_categories']);
			$postal_code=mysqli_real_escape_string($conn, $_POST['postal_code']);


			//IMPORT INTO SQL
			//$addtosql="INSERT INTO customer(email, full_name, phone, age, pet, address, postal_code, city, birth_date) VALUES('$email', '$full_name', '$phone', '$age', '$pet', '$address', '$postal_code', '$city', '$birth_date')";
	

			$editsql="UPDATE store 
			SET 
				square_meters='$square_meters', 
				working_hours='$working_hours', 
				phone='$phone', 
				address='$address', 
				postal_code='$postal_code', 
				city='$city'
			WHERE store_id='$store_id_prev_page'"
				;
			
			//save to database and check

			if(mysqli_query($conn, $editsql)){
				header('Location: viewstore.php'); 
			}
			else{
				echo 'Query error: '.mysqli_error($conn);
			}

		}
	}

?>


<!DOCTYPE html>
<html>

	<?php include('topbottemplates/header.php'); ?> 

	<section class="container grey-text" >
		<h4 class="center">Edit Store <?php echo $store_id_prev_page ?></h4>
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
			<!--Since we want this page to redirect to itself, instead of doing action="<?php echo $_SERVER['PHP_SELF'] ?>", we can do action ="finaladd.php". However, by doing the $_SERVER PHP SELF, we won't have to change the action name if we change the name of the file for whatever reason -->
			<label>Working Hours:</label>
			<input type="text" name="working_hours" value="<?php echo $working_hours_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['working_hours']; ?></div>

			<label>Address:</label>
			<input type="text" name="address" value="<?php echo $address_prev_page ?>">
			<div class="red-text"><?php echo $errors['address']; ?></div> <!--Errors-->
			
			<label>Square Meters:</label>
			<input type="text" name="square_meters" value="<?php echo $square_meters_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['square_meters']; ?></div>

		<!--	<label>Product Categories:</label>
			<input type="text" name="product_categories" value="<?php echo htmlspecialchars($product_categories) ?>"> //This way we store the inputs of the user if he fucks up 
			<div class="red-text"><?php echo $errors['product_categories']; ?></div> -->

			<!--<label>Birthday (DD/MM/YYYY):</label>
			<input type="text" name="birth_date" value="<?php echo htmlspecialchars($birth_date) ?>"> 
			<div class="red-text"><?php echo $errors['birth_date']; ?></div>

			<label>Pet:</label>
			<input type="text" name="pet" value=""> 
			<div class="red-text"><?php echo $errors['pet']; ?></div>

			<label>Address:</label>
			<input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>"> 
			<div class="red-text"><?php echo $errors['address']; ?></div> -->

			<label>Postal code:</label>
			<input type="text" name="postal code" value="<?php echo $postal_code_prev_page ?>">
			<div class="red-text"><?php echo $errors['postal_code']; ?></div>

			<label>City:</label>
			<input type="text" name="city" value="<?php echo $city_prev_page ?>"> 
			<div class="red-text"><?php echo $errors['city']; ?></div>	

			<label>Phone Number:</label>
			<input type="text" name="phone" value="<?php echo $phone_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['phone']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="Update" class="btn brand z-depth-0"> 
			</div>
		</form>
	</section>

	<?php include('topbottemplates/footer.php'); ?>

</html>