<?php 

include('configdatabase/project_databaseconn.php');
$kati=$_POST["read_id"];
	?>

<!DOCTYPE html>
<html>

	<?php include('topbottemplates/header.php'); ?> 


	<section class="container grey-text" >
		<h4 class="center">Edit Price</h4>
		<form class="white" action="edit_price_result.php" method="POST"> 
			
			<label>New Price:</label>
			<input type="float" name="price" >
			<input type="hidden" name="prod_id" value=" <?php echo $kati; ?>" >
		
					

			<div class="center">
				<input type="submit" name="submit" value="edit" class="btn brand z-depth-0"> 
			</div>
		</form>

	
	</section>

	<?php include('topbottemplates/footer.php'); ?>

</html>