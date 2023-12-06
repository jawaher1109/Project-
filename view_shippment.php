 <?php include 'header.php'; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>عرض الطلبات</title>
    
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/header.css">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
        
		
		body{ font: 14px sans-serif; background-color:#;}
		
		
        .page_div{ width: 1140px; margin-left: auto;
		height: auto;
				
				padding: 25px 25px 25px 25px;
				margin-right: auto; justify-content: center;
		}

 
        .wrapper{
            width: auto;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: auto;
			font-weight: bold;
        }
		th , td{ text-align: center;
		}
    </style>

</head>


<body>
<div class="page_div" >
	
	<p><h3><center>شركات الشحن</center></h3></p><br>
    <div class="wrapper">
        <div class="container-fluid">
		
		
                    <div class="form-group">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

					    <table class="table table-striped table-hover" border>   
		 <tr>             
					 <td>اختار شركة الشحن :</td>
                        <td><b><select name="shipping_company" id="shipping_company" class="form-control" required>
    <option value="null">اختار شركة الشحن</option>
    <option value="SMSA">SMSA</option>
    <option value="DHL">DHL</option>
	<option value="ARMEX">ARMEX</option>
    
  </select></b></td>
					</tr> 
		
		</table>
		<center><input type="submit" class="btn btn-primary" name="Submit" value="استعلام"></center>
		</form>
		</div>
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        
           

                    </div>

                     <?php
                    // Include config file
                   if($_SERVER["REQUEST_METHOD"] == "POST")
	{
				   require_once "../config.php";
									
                   $shipping_company=$_POST['shipping_company'];
                    // Attempt select query execution
                    $sql = "SELECT * FROM shipping_request WHERE shipping_company='".$shipping_company."' AND order_stat='جاري التوصيل'";
                       
					   echo"<h3>شركة الشحن : '".$shipping_company."'</h3>";
					   echo"<h4>طلبات جاري تسليمها</h4>";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
									echo "<th>رقم الطلب </th>";
									echo "<th>تاريخ الطلب</th>";
									echo "<th>اسم المستخدم </th>";
                                        echo "<th>عدد القطع المختارة </th>";
										 echo "<th>السعر الاجمالي</th>";
										  echo "<th>شركة الشحن</th>";
										   echo "<th>طريقة الدفع</th>";
                                        echo "<th>حالة الطلب</th>";
                                        echo "<th>عرض التفاصيل</th>";
										 echo "<th>تحديث حالة الطلب</th>";
										  
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['order_id'] . "</td>";
										echo "<td>" . $row['order_date'] . "</td>";
										echo "<td>" . $row['user_name'] . "</td>";
										echo "<td>" . $row['items_number'] . "</td>";
										echo "<td>" . $row['total'] . "</td>";
                                        echo "<td>" . $row['shipping_company'] . "</td>";
                                         echo "<td>" . $row['payment_method'] . "</td>";
										 echo "<td>" . $row['order_stat'] . "</td>";
									
                                       echo "<td>";
                                           
                                                                      
                                         echo '<a href="view_order_details.php?order_id='. $row['order_id'] .'"<h4><span class="fa fa-eye"></h4></span></a>';
									   echo "</td>";
									   
									   echo "<td>";
                                           
                                                                      
                                         echo '<a href="update_shippment.php?order_stat=تم التوصيل&order_id='. $row['order_id'] .'" class="btn btn-success">تم التوصيل</a>';
									   echo "</td>";
									   
										
																				  
								  echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
							
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
	
                  
                    ?>
            		
            		

  				</div>
            </div>  

 <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left"></h2>
           

                    </div>
 <br>
                     <?php
                    // Include config file
                    require_once "../config.php";
									
                   
                    // Attempt select query execution
                    $sql = "SELECT * FROM shipping_request WHERE shipping_company='".$shipping_company."' AND order_stat='تم التوصيل'";
                       echo"<h4>طلبات تم تسليمها</h4>";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
									echo "<th>رقم الطلب </th>";
									echo "<th>تاريخ الطلب</th>";
									echo "<th>اسم المستخدم </th>";
                                        echo "<th>عدد القطع المختارة </th>";
										 echo "<th>السعر الاجمالي</th>";
										  echo "<th>شركة الشحن</th>";
										   echo "<th>طريقة الدفع</th>";
                                        echo "<th>حالة الطلب</th>";
                                        echo "<th>عرض التفاصيل</th>";
										  
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['order_id'] . "</td>";
										echo "<td>" . $row['order_date'] . "</td>";
										echo "<td>" . $row['user_name'] . "</td>";
										echo "<td>" . $row['items_number'] . "</td>";
										echo "<td>" . $row['total'] . "</td>";
                                        echo "<td>" . $row['shipping_company'] . "</td>";
                                         echo "<td>" . $row['payment_method'] . "</td>";
										 echo "<td>" . $row['order_stat'] . "</td>";
									
                                       echo "<td>";
                                           
                                                                      
                                         echo '<a href="view_order_details.php?order_id='. $row['order_id'] .'"<h4><span class="fa fa-eye"></h4></span></a>';
									   echo "</td>";
									   
										
																				  
								  echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
							
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($conn);
                  }
                    ?>
            		
            		

  				</div>
            </div>   
			
<a href="index.php" class="btn btn-primary">رجوع</a>			
        </div>
		
    </div>
		
	 </div>
	
</body>

</html>
<?php include '../footer.php'; ?>