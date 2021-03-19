<!DOCTYPE html>
<html>

	<?php include('topbottemplates/header.php'); ?> 

	<section class="container grey-text" >
		<h4 class="center">Search a Transaction</h4>
		<form class="white" action="transactionsearchresult.php" method="POST"> 
			<label>Start Date:</label>
			<input type="date" placeholder="Enter Start Date" name="start_date"  > 
			
			<label>End Date:</label>
			<input type="date" placeholder="Enter End Date " name="end_date" >
			

			<label>Store ID:</label>
			<input type="number" placeholder="Enter Store Id" name="str_id">
		
			
			<label>Total Amount:</label><br><br>
			<input type="float" placeholder="Enter Total Amount" name="total_amount" > 
			

<br><br>
			<label>Total Pieces:</label>
			<input type="text" placeholder="Enter Total Pieces" name="total_pieces" >
			
			<label>Payment Method:</label>
			<input type="text" placeholder="Enter Method" name="payment_method" > 

			<label>Category ID:</label>
			<input type="number"  placeholder="Enter Category Id" name="category_id" > 
		

			<div class="center">
				<input type="submit"  name="submit" value="submit" class="btn brand z-depth-0"> 
			</div>
		</form>
	</section>	

	<?php include('topbottemplates/footer.php'); ?>

</html>