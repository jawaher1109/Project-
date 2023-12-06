 <?php include 'header.php'; ?>
 
 

<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>طلب استئجار متجر</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
 <link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/header.css">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	
    <style>
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
    <div class="page_div">
	<div class="wrapper" >
        <div class="container-fluid">
		<p><h1><center>المتاجر المتاحة للايجار</center></h1></p><br>
 <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM shop WHERE status_rent='غير مؤجر'";
                    
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                                while($row = mysqli_fetch_array($result)){
                                  ?>  
								  
	 

      <div class="row" >
	 <div class="col-md-3 " >
<div class="card border-dark mb-3" style="max-width: 18rem;">
  <img src="../images/shop.jpg"  class="card-img-top" alt="shop" width="100" height="100">
  <div class="card-body text-dark">
    <h5 class="card-title">متجر رقم :<?php echo $row['shop_id'] ?></h5>
    <p class="card-text">عدد قطع المتجر : <?php echo $row['shop_area'] ?> قطعة</p>
	<p class="card-text">السعر السنوي : <?php echo $row['shop_price'] ?> ريال</p>
    <form action="" method= "post">
	<a href="rent_request.php?shop_id=<?php echo $row['shop_id'] ?>" class="btn btn-primary">طلب ايجار</a>
	
  </div>
</div>
</div>
								  
									
						<?php			
                                }
                              ?>
							  
</div>
<?php							  
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
	
	<a href="../contactus.php" class="btn btn-success">اضغط للتواصل مع الادارة</a>
	   </div>
</body>
</html>
<?php include '../footer.php'; ?>