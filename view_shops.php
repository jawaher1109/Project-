 <?php include 'header.php'; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>عرض المتاجر</title>
    
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
            width: 600px;
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
	
	<p><h1><center>عرض المتاجر</center></h1></p><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left"></h2>
                        <a href="create_shop.php" class="btn btn-success pull-right">اضافة متجر جديد </a>


                    </div>
	<br>
                     <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM shop WHERE status_rent='مؤجر'";
                     echo"<h4>المتاجر المؤجره</h4>";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                      
										 echo "<th>رقم المتجر</th>";
										 echo "<th>اسم المتجر</th>";
										 echo "<th>اسم المستأجر</th>";									
										  echo "<th>حالة الدفع</th>";
										  echo "<th>عرض التفاصيل</th>";
									
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['shop_id'] . "</td>";
                                        echo "<td>" . $row['shop_name'] . "</td>";
                                         echo "<td>" . $row['tenant_name'] . "</td>";
										  echo "<td>" . $row['status_payment'] . "</td>";
										  echo "<td>";                             
                                         echo '<a href="view_shop_data.php?shop_id='. $row['shop_id'] .' "<h4><span class="fa fa-eye"></h4></span></a>';
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
	
                     <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM shop WHERE status_rent='غير مؤجر'";
                     echo"<h4>المتاجر غير المؤجره</h4>";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                      
										 echo "<th>رقم المتجر</th>";
										 echo "<th>عدد قطع المتجر</th>";
										 echo "<th>الايجار السنوي</th>";									
										 
									
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['shop_id'] . "</td>";
                                        echo "<td>" . $row['shop_area'] . "</td>";
                                         echo "<td>" . $row['shop_price'] . "</td>";
										 
									   
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