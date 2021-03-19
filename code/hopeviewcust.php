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
           <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>  
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
        <!--<form action="#">
          <input type="submit" >
        </form> -->

       <!-- <ul id></ul> -->
       

        <form action="customerdetails.php" method="POST"> <!-- customerinfo.php-->
           <br /><br />  
           <div class="container">  
                <h2 align="center" class="brand-text"><b>All Customers</b></h2>  
                <br />  
                <div class="table-responsive">  
                     <table id="customer_data" class="table table-striped table-bordered">  
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
                          while($row = mysqli_fetch_assoc($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>
                                      <input type="radio" name="read_id" value='.$row["card_id"].' required>'.$row["card_id"].'</td>  
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
                </div>  
           </div> 
          <input type="submit" value="View" class="btn button1 align=center">
      </form>
      <!--<a href="addcustomer.php" class="btn button2 text-align: center">Add</a>-->
      <form action="addcustomer.php" method="POST">
        <input type="submit" value="Add" class="btn button2">
      </form>
      
      <!--<a href="index.php" class="btn button 3">Homepage</a>-->
      <form action="index.php" method="POST">
        <input type="submit" value="Homepage" class="btn button3">
      </form>
      <!--<form action="hopeviewcust.php" method="POST">
      <input type="submit" name="delete" value="Delete" class="btn"> 
      <div class="btn-group btn-group-lg">
        <button type="button" class="btn btn-primary">Apple</button>
        <button type="button" class="btn btn-primary">Samsung</button>
        <button type="button" class="btn btn-primary">Sony</button>
      </div> -->
   
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#customer_data').DataTable();  
 });  
 </script>  