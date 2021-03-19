<?php 

	include('configdatabase/project_databaseconn.php');

	$email=$full_name=$phone=$age=$pet=$address=$postal_code=$city=$birth_date=$gender=$family_status=''; 

	$errors=array('email'=>'', 'full_name'=>'', 'phone'=>'', 'age'=>'', 'pet'=>'', 'address'=>'', 'postal_code'=>'', 'city'=>'', 'birth_date'=>'', 'gender'=>'', 'family_status'=>''); 

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


			//IMPORT INTO SQL
			$addtosql="INSERT INTO customer(email, full_name, phone, age, pet, address, postal_code, city, birth_date, gender, family_status) VALUES('$email', '$full_name', '$phone', '$age', '$pet', '$address', '$postal_code', '$city', '$birth_date', '$gender', '$family_status')";

			//save to database and check

			if(mysqli_query($conn, $addtosql)){
				header('Location: index.php'); 
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
		<h4 class="center">Add a Customer</h4>
		<form class="white" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST"> 
			<!--Since we want this page to redirect to itself, instead of doing action="<?php echo $_SERVER['PHP_SELF'] ?>", we can do action ="finaladd.php". However, by doing the $_SERVER PHP SELF, we won't have to change the action name if we change the name of the file for whatever reason -->
			<label>Full Name:</label>
			<input type="text" name="full_name" value="<?php echo htmlspecialchars($full_name) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['full_name']; ?></div>

			<label>Your Email:</label>
			<input type="email" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div> <!--Errors-->
			
			<label>Phone Number:</label>
			<input type="text" name="phone" value="<?php echo htmlspecialchars($phone) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['phone']; ?></div>

			<label>Age:</label>
			<input type="text" name="age" value="<?php echo htmlspecialchars($age) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['age']; ?></div>

			<label>Birthday (DD/MM/YYYY):</label>
			<input type="text" name="birth_date" value="<?php echo htmlspecialchars($birth_date) ?>"> 
			<div class="red-text"><?php echo $errors['birth_date']; ?></div>

			<label>Pet:</label>
			<input type="text" name="pet" value=""> 
			<div class="red-text"><?php echo $errors['pet']; ?></div>

			<label>Address:</label>
			<input type="text" name="address" value="<?php echo htmlspecialchars($address) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['address']; ?></div>

			<label>Postal code:</label>
			<input type="text" name="postal code" value="<?php echo htmlspecialchars($postal_code) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['postal_code']; ?></div>

			<label>City:</label>
			<input type="text" name="city" value="<?php echo htmlspecialchars($city) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['city']; ?></div>

			<label>Gender:</label>
			<input type="text" name="gender" value="<?php echo htmlspecialchars($gender) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['gender']; ?></div>

			<label>Family Status:</label>
			<input type="text" name="family_status" value="<?php echo htmlspecialchars($family_status) ?>"> <!--This way we store the inputs of the user if he fucks up -->
			<div class="red-text"><?php echo $errors['family_status']; ?></div>				

			<div class="center">
				<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"> 
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