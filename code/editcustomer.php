<?php 

	include('configdatabase/project_databaseconn.php');

	session_start();
	$card_id_prev_page=$_SESSION['card_id'];
	$full_name_prev_page=$_SESSION['full_name'];
	$birth_date_prev_page=$_SESSION['birth_date'];
	$phone_prev_page=$_SESSION['phone'];
	$card_points_prev_page=$_SESSION['card_points'];
	$age_prev_page=$_SESSION['age'];
	$family_status_prev_page=$_SESSION['family_status'];
	$address_prev_page=$_SESSION['address'];
	$postal_code_prev_page=$_SESSION['postal_code'];
	$city_prev_page=$_SESSION['city'];
	$pet_prev_page=$_SESSION['pet'];
	$gender_prev_page=$_SESSION['gender'];
	$email_prev_page=$_SESSION['email'];

	//if (!$card_points_prev_page) $card_points_prev_page='';
	if (!$pet_prev_page) $pet_prev_page='';


	$email=$full_name=$phone=$age=$pet=$address=$postal_code=$city=$birth_date=$gender=$family_status=$card_points=''; 

	$errors=array('email'=>'', 'full_name'=>'', 'phone'=>'', 'age'=>'', 'pet'=>'', 'address'=>'', 'postal_code'=>'', 'city'=>'', 'birth_date'=>'', 'gender'=>'', 'family_status'=>'', 'card_points'=>''); 

	if(isset($_POST['submit'])){
		if(empty($_POST['email'])) $errors['email']='An email is required <br />';
		else {
			$email=$_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email']='Email is not valid';
		}

		if(empty($_POST['full_name'])) $errors['full_name']='Your full name is required <br />';
		else {
			$full_name=$_POST['full_name'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $full_name)) $errors['full_name']='Your name must be spaces and letters only';
		}

		if(empty($_POST['phone'])) $errors['phone']='A phone number is required <br />';
		else{
			$phone=$_POST['phone'];
			if (!preg_match('/69[0-9]{8}$/', $phone)) $errors['phone']='Phone number must be numbers only';
		}

		if(empty($_POST['age'])) $errors['age']='An age is required <br />';
		else{
			$age=$_POST['age'];
			if (!preg_match('/^[0-9]*$/', $age)) $errors['age']='Age must be numbers only';
		}

		$pet=$_POST['pet']; //pet can be null so we good
		if (!preg_match('/^()|[a-zA-Z\s]+$/', $pet)) $errors['pet']='Your pet\'s name must be spaces and letters only';
		

		// ^[#.0-9a-zA-Z\s,-]+$
		if(empty($_POST['address'])) $errors['address']='An address is required <br />';
		else {
			$address=$_POST['address'];
			if (!preg_match('/[a-zA-Z][\s][0-9]+$/', $address)) $errors['address']='Your address must be spaces, numbers and letters only';
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

		if(empty($_POST['birth_date'])) $errors['birth_date']='A birth date is required <br />';
		else{
			$birth_date=$_POST['birth_date'];
			if (!preg_match('/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/', $birth_date)) $errors['birth_date']='Birth date must be of form DD/MM/YYYY';
		}

		if(empty($_POST['gender'])) $errors['gender']='A gender is required <br />';
		else {
			$gender=$_POST['gender'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $gender)) $errors['gender']='The gender must be spaces and letters only';
		}

		if(empty($_POST['family_status'])) $errors['family_status']='A family status is required <br />';
		else {
			$family_status=$_POST['family_status'];
			if (!preg_match('/^[a-zA-Z\s]+$/', $family_status)) $errors['family_status']='Your family status must be spaces and letters only';
		}


		
		$card_points=$_POST['card_points'];
		if (!preg_match('/^[0-9]*$/', $card_points)) $errors['card_points']='Card points must be numbers only';
		

		if(array_filter($errors)){
			echo "Errors in the form";
		} 

		//$email=$full_name=$phone=$age=$pet=$address=$postal_code=$city=$birth_date

		else{
			$email=mysqli_real_escape_string($conn, $_POST['email']); //we import these in our database
			$full_name=mysqli_real_escape_string($conn, $_POST['full_name']);
			$phone=mysqli_real_escape_string($conn, $_POST['phone']);
			$age=mysqli_real_escape_string($conn, $_POST['age']);
			$pet=mysqli_real_escape_string($conn, $_POST['pet']);
			$address=mysqli_real_escape_string($conn, $_POST['address']);
			$postal_code=mysqli_real_escape_string($conn, $_POST['postal_code']);
			$city=mysqli_real_escape_string($conn, $_POST['city']);
			$birth_date=mysqli_real_escape_string($conn, $_POST['birth_date']);
			$gender=mysqli_real_escape_string($conn, $_POST['gender']);
			$family_status=mysqli_real_escape_string($conn, $_POST['family_status']);
			$card_points=mysqli_real_escape_string($conn, $_POST['card_points']);


			//IMPORT INTO SQL
			$editsql="UPDATE customer 
			SET 
				email='$email', 
				full_name='$full_name', 
				phone='$phone', 
				age='$age', 
				pet='$pet', 
				address='$address', 
				postal_code='$postal_code', 
				city='$city', 
				birth_date='$birth_date', 
				gender='$gender', 
				family_status='$family_status', 
				card_points='$card_points'
			WHERE card_id='$card_id_prev_page'"
				;

			//save to database and check

			if(mysqli_query($conn, $editsql)){
				header('Location: hopeviewcust.php'); 
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
		<h4 class="center">Edit Customer <?php echo $card_id_prev_page ?> </h4>
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
			<!--Since we want this page to redirect to itself, instead of doing action="<?php echo $_SERVER['PHP_SELF'] ?>", we can do action ="finaladd.php". However, by doing the $_SERVER PHP SELF, we won't have to change the action name if we change the name of the file for whatever reason -->
			<label>Full Name:</label>
			<input type="text" name="full_name" value="<?php echo $full_name_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['full_name']; ?></div>

			<label>Your Email:</label>
			<input type="email" name="email" value="<?php echo $email_prev_page ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div> <!--Errors-->
			
			<label>Phone Number:</label>
			<input type="text" name="phone" value="<?php echo $phone_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['phone']; ?></div>

			<label>Age:</label>
			<input type="text" name="age" value="<?php echo $age_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['age']; ?></div>

			<label>Birthday (DD/MM/YYYY):</label>
			<input type="text" name="birth_date" value="<?php echo $birth_date_prev_page ?>"> 
			<div class="red-text"><?php echo $errors['birth_date']; ?></div>

			<label>Pet:</label>
			<input type="text" name="pet" value="<?php echo $pet_prev_page ?>"> 
			<div class="red-text"><?php echo $errors['pet']; ?></div>

			<label>Address:</label>
			<input type="text" name="address" value="<?php echo $address_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['address']; ?></div>

			<label>Postal code:</label>
			<input type="text" name="postal code" value="<?php echo $postal_code_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['postal_code']; ?></div>

			<label>City:</label>
			<input type="text" name="city" value="<?php echo $city_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['city']; ?></div>

			<label>Gender:</label>
			<input type="text" name="gender" value="<?php echo $gender_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['gender']; ?></div>

			<label>Family Status:</label>
			<input type="text" name="family_status" value="<?php echo $family_status_prev_page ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['family_status']; ?></div>	

			<label>Card Points:</label>
			<input type="text" name="card_points" value="<?php echo $card_points_prev_page ?>">
			<div class="red-text"><?php echo $errors['card_points']; ?></div>			

			<div class="center">
				<input type="submit" name="submit" value="Update" class="btn brand z-depth-0"> 
			</div>
		</form>

		<!--<label>Gender:</label>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>">
			<input type="radio" name="gender" value="male"> Male<br>
			<input type="radio" name="gender" value="female"> Female<br>
			<input type="radio" name="gender" value="other"> Other<br>
		</form>-->
	</section>

	<?php include('topbottemplates/footer.php'); ?>

</html>