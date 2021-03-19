 <?php  
 $connect = mysqli_connect('localhost', 'costo', '68709900dKnSkKeK', 'project');
 if(!$connect){
    echo "Connection error: ".mysqli_connect_error(); //to know exactly where the problem with the connection eroded.
  }
 $query ="SELECT * FROM store ORDER BY store_id DESC";  
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
       

        <form action="storedetails.php" method="POST"> <!-- customerinfo.php-->
           <br /><br />  
           <div class="container">  
                <h2 align="center" class="brand-text"><b>All Stores</b></h2>  
                <br />  
                <div class="table-responsive">  
                     <table id="store_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Store ID</td>  
                                    <td>City</td>
                                    <td>Address</td>
                                    <td>Postal Code</td>
                                  
                                    <td>Working Hours</td>  
                                    <td>Square Meters</td> 
                                    <!--<td></td>-->
                               </tr>  
                          </thead>  
                          <?php  
                          while($row = mysqli_fetch_assoc($result))  
                          {  
                               echo '  
                               <tr>  
                                    <td>
                                      <input type="radio" name="read_id" value='.$row["store_id"].' required>'.$row["store_id"].'</td>  
                                    <td>'.$row["city"].'</td> 
                                    <td>'.$row["address"].'</td>
                                    <td>'.$row["postal_code"].'</td>
                                    <td>'.$row["working_hours"].'</td>  
                                    <td>'.$row["square_meters"].'</td>  
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
      <form action="addstore.php" method="POST">
        <input type="submit" value="Add" class="btn button2">
      </form>
    
       <form action="index.php" method="POST">
        <input type="submit" value="Homepage" class="btn button3">
      </form>
     <!-- <form action="hopeviewcust.php" method="POST">
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
      $('#store_data').DataTable();  
 });  
 </script>  