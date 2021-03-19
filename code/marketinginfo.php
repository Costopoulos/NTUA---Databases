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
  text-align: left;
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
                position: absolute;
                left: 47%;
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
                left: 45%;
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

        <table id="customers">
 
    <h3 align="center"><b>Most Popular Product Pairs</b></h3>

   <thead>  
                               <tr>  
                                    <td align="center"><b>Product 1</b></td>
                                    <td align="center"><b>Product 2</b></td>  
                                    
                               </tr>  
                          </thead>  
<!--String hot_pair = "SELECT first_prod.Name as n1,second_prod.Name as n2, count(*) AS freq" + 
        " FROM " + 
        "(SELECT DISTINCT contains.Barcode, Datetime,Card_Id,Name" + 
        " FROM contains" + 
        " join product" + 
        " where contains.Barcode = product.Barcode) AS first_prod" + 
        " join" + 
        " (SELECT DISTINCT contains.Barcode, Datetime,Card_Id,Name" + 
        " FROM contains" + 
        " join product" + 
        " where contains.Barcode = product.Barcode) AS second_prod" + 
        " WHERE(" + 
        " first_prod.Datetime = second_prod.Datetime AND" + 
        " first_prod.Card_Id = second_prod.Card_Id AND" + 
        " first_prod.Barcode != second_prod.Barcode AND" + 
        " first_prod.Barcode < second_prod.Barcode" + 
        ")" + 
        " GROUP BY first_prod.Barcode,second_prod.Barcode" + 
        " ORDER BY freq DESC" + 
        " LIMIT 10"; -->

<?php
$sqlpair = "SELECT  first_prod.name as n1,second_prod.name as n2, count(*) AS freq FROM (SELECT DISTINCT p_id, d_time,cust_id,name FROM contains join product where contains.p_id = product.product_id) AS first_prod join (SELECT DISTINCT p_id, d_time,cust_id,name FROM contains join product where contains.p_id = product.product_id) AS second_prod WHERE (first_prod.d_time = second_prod.d_time AND first_prod.cust_id = second_prod.cust_id AND first_prod.p_id != second_prod.p_id AND first_prod.p_id < second_prod.p_id) GROUP BY first_prod.p_id,second_prod.p_id ORDER BY freq DESC LIMIT 10";
//echo $sqlpair;
$resultpair=mysqli_query($connect,$sqlpair);
 
                          while($row = mysqli_fetch_assoc($resultpair))  
                          {  
                               echo '  
                               <tr>  
                              
                                    <td align="center">'.$row["n1"].'</td>
                                    <td align="center">'.$row["n2"].'</td>  
                               </tr>  
                               ';  
                          }  
                        

?>


<table id="customers">
  <h2 align="center"><b>Marketing Information</b></h2>
 
    <h3 align="center"><b>Transaction Per Hour</b></h3>

   <thead>  
                               <tr>  
                                    <td>Hour</td>  
                                    <td>Total Amount</td>  
                                    
                               </tr>  
                          </thead>  
<?php
$sql = "SELECT date_time , sum(total_amount) as x from transaction group by hour(date_time) order by date_time";
$result=mysqli_query($connect,$sql);
 
                          while($row = mysqli_fetch_assoc($result))  
                          {  
                               echo '  
                               <tr>  
                              
                                    <td>'.$row["date_time"].'</td>  
                                    <td>'.$row["x"].'</td>  
                               </tr>  
                               ';  
                          }  
                        

?>



 
</table>

<table id="customers">
 
    <h3 align="center"><b>Best 10 Customers</b></h3>

   <thead>  
                               <tr>  
                                    <td>Customer Id</td>  
                                    <td>Total Amount</td>  
                                    
                               </tr>  
                          </thead>  
<?php
$sql = "SELECT  cust_id,sum(total_amount) as x from transaction group by cust_id order by x desc limit 10;";
$result=mysqli_query($connect,$sql);
 
                          while($row = mysqli_fetch_assoc($result))  
                          {  
                               echo '  
                               <tr>  
                              
                                    <td>'.$row["cust_id"].'</td>  
                                    <td>'.$row["x"].'</td>  
                               </tr>  
                               ';  
                          }  
                        

?>



 
</table>
    <h3 align="center"><b>Elderly Groups Visiting Stores per Hour</b></h3>

   <table id="customers">                   
<?php

if(isset($_POST["submit1"]))

{

$hour=(string)$_POST['hour'];
//echo $hour;

$sql1="SELECT * from transaction join customer on transaction.cust_id=customer.card_id where hour(date_time)='$hour' group by customer.age   ";
//echo $sql1;
if($result1=mysqli_query($connect,$sql1)){
 
                          while($row = mysqli_fetch_assoc($result1 ))  
                          {  
                               echo '  
                               <tr>  
                              
                                    <td align="center">'.$row["cust_id"].'</td>  
                                    
                               </tr>  
                               ';  
                          }  }

                        
}
?>
 
</table>  
                 




 
   

   <thead></thead>

<form action="marketinginfo.php" method="post">
   <input type="number" name="hour" value="hour " required>  <br>
   <input type="submit" name="submit1" value="Calculate Percentage">                    
</form>





<h3 align="center"><b>Customer View</b></h3>
<table id="customers" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Card ID</td>  
                                    <td>Full Name</td>  
                                    <td>Birthday</td>
                                    <td>Phone</td>
                                    <td>Card Points</td>
                                    <td>Age</td>
                                    <td>Family Status</td>
                                    <td>Address</td>
                                    <td>Postal Code</td>
                                    <td>City</td>
                                    <td>Pet</td>
                                    <td>Gender</td>  
                                    <td>Email</td> 
                                    <!--<td></td>-->
                               </tr>  
                          </thead>  
                          <?php  
                           $connect = mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');
 if(!$connect){
    echo "Connection error: ".mysqli_connect_error(); //to know exactly where the problem with the connection eroded.
  }
 $query =" SELECT * FROM custs ORDER BY card_id ";  
 $result = mysqli_query($connect, $query); 
                          while($row = mysqli_fetch_assoc($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>
                                     '.$row["card_id"].'</td>  
                                    <td>'.$row["full_name"].'</td> 
                                    <td>'.$row["birth_date"].'</td> 
                                    <td>'.$row["phone"].'</td> 
                                    <td>'.$row["card_points"].'</td> 
                                    <td>'.$row["age"].'</td>
                                    <td>'.$row["family_status"].'</td>
                                    <td>'.$row["address"].'</td>
                                    <td>'.$row["postal_code"].'</td>
                                    <td>'.$row["city"].'</td> 
                                    <td>'.$row["pet"].'</td> 
                                    <td>'.$row["gender"].'</td>  
                                    <td>'.$row["email"].'</td>  
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  

                     <h3 align="center"><b>Category Sales</b></h3>
<table id="customers" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Store ID</td>  
                                    <td>Category ID</td>  
                                    <td>Sales</td>
                                    
                                    <!--<td></td>-->
                               </tr>  
                          </thead>  
                          <?php  
                           $connect = mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');
 if(!$connect){
    echo "Connection error: ".mysqli_connect_error(); //to know exactly where the problem with the connection eroded.
  }
 $query =" SELECT * FROM category_sales ORDER BY str_id ";  
 $result = mysqli_query($connect, $query); 
                          while($row = mysqli_fetch_assoc($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>
                                     '.$row["str_id"].'</td>  
                                    <td>'.$row["catid"].'</td> 
                                    <td>'.$row["sales"].'</td> 
                                    
                               </tr>  
                               ';  
                          }  
                          ?>  
                     </table>  



<form action="index.php" method="POST">
  <input type="submit" value="Homepage" class="btn button3 z-depth-0">
</form>

</body>
</html>