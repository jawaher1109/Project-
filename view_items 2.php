 <?php include 'header.php'; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>عرض المنتجات</title>
    
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

	<!----   --->
	
	
	<div class="page_div">
	<div class="wrapper">
        <div class="container-fluid">
		<p><h1><center>عرض منتجات المتجر</center></h1></p><br>
 <?php
                    // Include config file
                    require_once "../config.php";
                     $shop_id = $_GET['shop_id'];
					  $shop_name = $_GET['shop_name'];
                    // Attempt select query execution
                    $sql = "SELECT * FROM items WHERE shop_id ='".$shop_id."' ";
                    
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            
                                while($row = mysqli_fetch_array($result)){
                                  ?>  
								  
	 

      <div class="row">
	 <div class="col-md-3 " >
<div class="card border-dark mb-3" style="max-width: 18rem;">
  <img class="img-responsive img-thumbnail" width="100" height="100" 
							src="../images/<?php echo $row['item_photo']; ?>">
  <div class="card-body text-dark">
   
    <h4 class="card-title" > <?php echo $shop_name ; ?> </h4>
	<h4 class="card-title" > <?php echo $row['item_name']; ?> </h4>
	<h4 class="card-title" > <?php echo $row['item_price'] ;?> </h4>
  <a href="add_to_cart.php?item_id=<?php echo $row['item_id']; ?>&item_name=<?php echo $row['item_name']; ?>&item_price=<?php echo $row['item_price'] ;?>
										 &item_photo=<?php echo $row['item_photo']; ?>&shop_id=<?php echo $shop_id ;?>&shop_name=<?php echo $row['item_shop_name']; ?>&user_id=<?php echo $_SESSION['id']; ?>"  ><h4><span class="fa fa-shopping-cart"></h4></span></a>
								
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
 
<a href="view_shops.php" class="btn btn-primary">رجوع</a>
 </div>
    </div>
	   </div>
	   
	   
</body>

</html>
<?php include '../footer.php'; ?>