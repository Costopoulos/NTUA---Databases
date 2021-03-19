 <?php  
 $connect = mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');
 if(!$connect){
    echo "Connection error: ".mysqli_connect_error(); //to know exactly where the problem with the connection eroded.
  }


 ?>  
 
	<?php include('topbottemplates/header.php'); ?> 
 <!DOCTYPE html>  
 <html>  
      <head>  
         
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
                left: 52%;
                height: 90px;
                width: 130px;
                font-size: 20px;
                color: white;
               /* display: inline-block;
                left: 50%;
                -ms-transform: translate(-50%,-50%);*/
              }
              .brand-text{
                  color: #FF7F50 !important; /*SUPERTURBO SOSOSSOSOSOSO
                       Whenever I use a CSS command such as color:
                       I ALWAYS leave a space after : (so it is 
                       color: colornumber) OR ELSE IT WONT WORK*/
              }
           </style>
      </head>  
<body>
<table>
<h3 align="center" class="brand-text"><b> Search Results </b></h3>
<?php

$str_id=$_POST["str_id"];
$total_pieces=$_POST["total_pieces"];
$start_date=$_POST["start_date"];
$total_amount=$_POST["total_amount"];
$payment_method=$_POST["payment_method"];
$end_date=$_POST["end_date"];
$category_id=$_POST["category_id"];

//echo $start_date;

$sql="SELECT * FROM transaction ";
$where="" ; 
if($str_id != ""){

	$where.= "str_id= '$str_id' ";
	}

if($total_pieces != ""){
	if(!empty($where)) {$where.="AND ";}
	$where.= "total_pieces>'$total_pieces' ";
}

if($start_date != ""){
	if(!empty($where)) {$where.="AND ";}
	$where.= "date_time>='$start_date' ";
	}
	
if($end_date != ""){
	if(!empty($where)) {$where.="AND ";}
	$where.= "date_time<='$end_date' ";
	}

if($total_amount != ""){
	if(!empty($where)) {$where.="AND ";}
	$where.= "total_amount='$total_amount' ";
	}

if($payment_method != ""){
	if(!empty($where)) {$where.="AND ";}
	$where.= "payment_method='$payment_method' ";

 }
 
 if(!empty($where))
 {
 	$where = " WHERE " .$where;
  
 	$sql .=$where;
//echo $sql;
 	

 }
if($result=mysqli_query($connect,$sql))
 {

 if(mysqli_num_rows($result)!=0)
 {
  while($row = mysqli_fetch_assoc($result))  
 	 {
                               echo '  
                               <tr>  
                                    <td>
                                      '.$row["date_time"].'</td>  
                                    <td>'.$row["cust_id"].'</td> 
                                    <td>'.$row["total_amount"].'</td> 
                                    <td>'.$row["total_pieces"].'</td> 
                                    <td>'.$row["str_id"].'</td> 
                                    <td>'.$row["payment_method"].'</td>
                               </tr>  
                               ';  
                          } 
}}

?>
</table>
</body>
</html>
