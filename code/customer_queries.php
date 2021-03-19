<?php  
 $connect = mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');
 if(!$connect){
    echo "Connection error: ".mysqli_connect_error(); //to know exactly where the problem with the connection eroded.
  }
 $query ="SELECT * FROM customer ORDER BY card_id DESC";  
 $result = mysqli_query($connect, $query); 
// $customers=mysqli_fetch_all($result, MYSQLI_ASSOC); 
 ?>  

<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
}
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
           <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->
           <style type="text/css">
              .button1{
                background-color: #FF7F50;
                position: absolute;
                left: 42%;
                height: 90px;
                width: 100px;
                font-size: 20px;
                color: white;
               /* display: inline-block;
                left: 50%;
                -ms-transform: translate(-50%,-50%);*/
              }
               .button2{
                background-color: #FF7F50;
                /*position: absolute;*/
                left: 46%;
                height: 90px;
                width: 100px;
                font-size: 20px;
                color: white;
               /* display: inline-block;
                left: 50%;
                -ms-transform: translate(-50%,-50%);*/
              }
              .button3{
                background-color: #FF7F50;
                position: absolute;
                left: 46%;
                height: 70px;
                width: 115px;
                font-size: 20px;
                color: white;
               /* display: inline-block;
                left: 50%;
                -ms-transform: translate(-50%,-50%);*/
              }
              .brand-text{
                  color: #FF7F50 !important;
</style>
</head>
<body>
<!--String hot_pair = "SELECT first_prod.Name as n1,second_prod.Name as n2, count(*) AS freq" 
				" FROM "  
				"(SELECT DISTINCT contains.Barcode, Datetime,Card_Id,Name" 
				" FROM contains" 
				" join product" 
				" where contains.Barcode = product.Barcode) AS first_prod" 
				" join" + 
				" (SELECT DISTINCT contains.Barcode, Datetime,Card_Id,Name" 
				" FROM contains" 
				" join product" 
				" where contains.Barcode = product.Barcode) AS second_prod" 
				" WHERE(" 
				" first_prod.Datetime = second_prod.Datetime AND" 
				" first_prod.Card_Id = second_prod.Card_Id AND" 
				" first_prod.Barcode != second_prod.Barcode AND" 
				" first_prod.Barcode < second_prod.Barcode" 
				")" 
				" GROUP BY first_prod.Barcode,second_prod.Barcode" 
				" ORDER BY freq DESC" 
				" LIMIT 10"; -->

<table id="customers">
 <h2 align="center"><b>Customer Queries</b></h2>
 
    <h3 align="center"><b>Top 10 Favorite Products</b></h3>

   <thead>  
                               <tr>  
                                    <td align="center" ><b>Product Name</b></td>  
                              
                                         
                                    
                               </tr>  
                          </thead>  
<?php

$cust_id=$_POST["id_to_edit"];

$sql = "SELECT name FROM (SELECT contains.p_id, product.product_id,name, count(product.product_id) as x FROM contains JOIN product ON contains.p_id = product.product_id WHERE contains.cust_id = '$cust_id' GROUP BY product.product_id ORDER BY x DESC LIMIT 10) AS y";
;
//echo $sql;
 if($result=mysqli_query($connect,$sql))
 {

 
                          while($row = mysqli_fetch_assoc($result))  
                          { // echo $cust_id;
                               echo '  
                               <tr>  
                              
                                    <td align="center">'.$row["name"].'</td>  
                                    
                               </tr>  
                               ';  
                          }  }
                        

?>


<table id="customers">
  
 
    <h3 align="center"><b>Visiting Stores</b></h3>

   <thead>  
                               <tr>  
                                    <td align="center" ><b>Number of Stores</b></td>  
                              
                                         
                                    
                               </tr>  
                          </thead>  
<?php

$cust_id=$_POST["id_to_edit"];

$sql = " SELECT store_id , count(store_id) as x from store where store_id in ( SELECT str_id from transaction where cust_id='$cust_id')"
;
//echo $sql;
 if($result=mysqli_query($connect,$sql))
 {

 
                          while($row = mysqli_fetch_assoc($result))  
                          { // echo $cust_id;
                               echo '  
                               <tr>  
                              
                                    <td align="center">'.$row["x"].'</td>  
                                    
                               </tr>  
                               ';  
                          }  }
                        

?>

<table id="customers">

 


   <thead>  
                               <tr>  
                                 		
                                     <td align="center"><b> Store</b></td>  
                              
                                         
                                    
                               </tr>  
                          </thead>  
<?php

$cust_id=$_POST["id_to_edit"];

$sql = "SELECT distinct transaction.str_id , store.store_id from transaction left join store on transaction.str_id=store.store_id where transaction.cust_id='$cust_id';";
//echo $sql;
 if($result=mysqli_query($connect,$sql))
 {

 
                          while($row = mysqli_fetch_assoc($result))  
                          { // echo $cust_id;
                               echo '  
                               <tr>  
                              
                                  
                                     <td align="center">'.$row["store_id"].'</td>  
                                	
                               </tr>  
                               ';  
                          }  }
                        

?>



 
</table>


<table id="customers">

 
    <h3 align="center"><b>Visiting Hours</b></h3>

   <thead>  
                      
                          </thead>  
<?php

$cust_id=$_POST["id_to_edit"];

$sql = " SELECT HOUR(date_time) as x  from transaction where cust_id='$cust_id' group by HOUR(date_time) ";

//echo $sql;
 if($result=mysqli_query($connect,$sql))
 {

 
                          while($row = mysqli_fetch_assoc($result))  
                          { // echo $cust_id;
                               echo '  
                               <tr>  
                              
                                    <td align="center">'.$row['x'].'</td>  
                                    
                               </tr>  
                               ';  
                          }  }
                        

?>

</table>



<table id="customers">

<?php
if(isset($_POST["submit"]))
{
	$cust_id=$_POST["id_to_edit"];
	$month=$_POST["cust_average"];
	

	$sql="SELECT avg(total_amount) as x from transaction where cust_id='$cust_id' and MONTH(date_time)='$month'";
	//echo $sql;
	if($result=mysqli_query($connect,$sql))
 {
 	?>
	  <thead>  
                               <tr>  
                                    <td align="center" ><b>Per Month</b></td>  
                                     <td align="center" ><b>Per Week</b></td>  
                              
                                         
                                    
                               </tr>  
                          </thead>  



 	<?php

 
                          while($row = mysqli_fetch_assoc($result))  
                          { // echo $cust_id;
                               echo '  
                               <tr>  
                              
                                    <td align="center">' .$row['x'].'</td>
                                    <td align="center">'
                                    .($row['x']/4). '</td>

                                    
                               </tr>  
                               ';  
                          }  }
                        



}
	
?>


  <form action="customer_queries.php" method="POST">
    <h3 align="center"><b>Average Transaction</b></h3>
	   <thead>  
                      
  		</thead>  

    <input type="number" placeholder="Enter Month" name="cust_average" value="average"><br>
    <input type="hidden" name="id_to_edit" value="<?php echo $cust_id ; ?> ">

<input type="submit" name="submit" value="Calculate">	
</form>
</table>

<table id="customers">

 
    <h3 align="center"><b>Total Money Spent</b></h3>

   <thead>  
                      
                          </thead>  
<?php

$cust_id=$_POST["id_to_edit"];

$sql = " SELECT sum(total_amount) as x  from transaction where cust_id='$cust_id'  ";

//echo $sql;
 if($result=mysqli_query($connect,$sql))
 {

 
                          while($row = mysqli_fetch_assoc($result))  
                          { // echo $cust_id;
                               echo '  
                               <tr>  
                              
                                    <td align="center">'.$row['x'].'</td>  
                                    
                               </tr>  
                               ';  
                          }  }
                        

?>

</table>



  

<form action="index.php" method="POST">
  <input type="submit" value="Homepage" class="btn button3 z-depth-0">
</form>

</body>
</html>