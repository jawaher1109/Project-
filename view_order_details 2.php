 <?php include 'header.php'; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>عرض تفاصيل الطلب</title>
    
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
   		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('رجاء تأكيد الحذف؟')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>
</head>


<body>
<div class="page_div" >
	
	<p><h1><center>عرض تفاصيل الطلب</center></h1></p><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left"></h2>
                

                    </div>
 <br>
                     <?php
                    // Include config file
                    require_once "../config.php";
					
                    $user_id=$_GET['user_id'];					
                    $order_id=$_GET['order_id'];
					
                    // Attempt select query execution
                    $sql = "SELECT * FROM order_".$order_id."";
                    
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>اسم المتجر</th>";
										 echo "<th>اسم المنتج</th>";
										  echo "<th>سعر المنتج (بالريال السعودي)</th>";
                                        echo "<th>صورة المنتج</th>";
                           
							    
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" .$row['shop_name'] . "</td>";
                                        echo "<td>" . $row['item_name'] . "</td>";
                                         echo "<td>" . $row['item_price'] . "</td>";
										 echo "<td>";
										?>
							<img class="img-responsive img-thumbnail" width="75" height="75" 
							src="../images/<?php echo $row['item_photo']; ?>">
						<?php
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
                  
                    ?>
            		
            		

  				</div>
            </div>   
		<br>	
<a href="index.php" class="btn btn-primary">رجوع</a>			
        </div>
		
    </div>
		
	 </div>
	
</body>

</html>
<?php include '../footer.php'; ?>