
<?php
include('configdatabase/project_databaseconn.php');
$prod_id=$_POST["prod_id"];
$price=(float)$_POST["price"];
$prod_id=str_replace(' ','', $prod_id);
//echo $price,$prod_id;
$sql1="SELECT price,first_transaction FROM product WHERE product_id='$prod_id'";
if($result5=mysqli_query($conn,$sql1))
{
	 while($row5 = mysqli_fetch_assoc($result5)) {
        //echo $row5["price"];
        if ($row5["price"] != $price){
                $sql2 = "SELECT end_date FROM old_price WHERE prodd_id ='$prod_id'" ;
                //echo $sql2;
                $resultt = $conn->query($sql2);
                		if($resultt->num_rows > 0){
                			while($row7 = mysqli_fetch_assoc($resultt))
                			{

                                $sql3 = "INSERT INTO old_price(prodd_id,start_date,end_date,price) VALUES ('$prod_id', '".$row7['end_date']."', CURRENT_TIMESTAMP,' ".$row5['price']."' )" ;
                                //echo $sql3;

                                $result3= $conn->query($sql3);
                            }
                        }
                        else
                        {
                        	$sql3 = "INSERT INTO old_price(prodd_id,start_date,end_date,price) VALUES ('$prod_id', '".$row5["first_transaction"]."', CURRENT_TIMESTAMP, ".$row5["price"]." )" ;
                               // echo $sql3;
                                $result3= $conn->query($sql3);


                        }

                    }

        }
}


?>

<html>
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
              table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(odd) {
  background-color: #dddddd;
}</style>
<br>	

<?php

$query="UPDATE product SET price ='$price' where product_id='$prod_id'";
if($result=mysqli_query($conn,$query))
{

	echo "Price Edited Succesfully!";	

}

?>

<br>
<a href="products.php">Go Back to Products Page</a>

  
                     <table id="older_prices" class="table table-striped table-bordered">  
                        <h3 align="center"> Old Prices of Selected Product</h3>
                          <thead>  
                               <tr>  
                                    <td>Product ID</td>  
                                    <td>Price</td>
                                    <td>Start Date</td>  
                                    <td>End Date</td>

                               </tr>  
                          </thead>  
                          <?php  
                          $sql="SELECT * FROM old_price WHERE prodd_id='$prod_id'";

							$resultprint=$conn->query($sql);
	
                          while($row = mysqli_fetch_assoc($resultprint))  
                          {  
                               echo '  
                               <tr>  
                                   
                                    <td>'.$row["prodd_id"].'</td> 
                                    <td>'.$row["price"].'</td> 
                                    <td>'.$row["start_date"].'</td> 
                                    <td>'.$row["end_date"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  
</html>


