 <?php include 'header.php'; ?>
<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../config.php";

	$tenant_id=$_GET["id"];
	
    // Prepare a select statement
    $sql = "SELECT * FROM shop WHERE tenant_id = '".$tenant_id."'";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
       // mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $tenant_id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) != 1){
                
               echo	"<script type='text/javascript'>
   alert('لا يوجد متجر مؤجر');
   window.location = 'index.php';</script>" ;
	$stmt->close();
            }else{
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $shop_id = $row['shop_id'];
				 $shop_name = $row['shop_name'];
			
		}
	}
}
}
		?>
		
<!DOCTYPE html>
<html lang="en">
<head>
  <title>المول</title>
  <meta charset="utf-8">

    <link rel="stylesheet" href="css/header.css">
	 <link rel="stylesheet" href="css/footer.css">
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

    </style>
</head>
<body>


	<div class="page_div" >
	
	<p><h1><center>متجر <?php echo $shop_name ?>  </center></h1></p><br>
<br>
<br>
	<div class="row" >
				
				
          	
          			<div class="col-lg-4" style="text-align: center;">
            			<a href="view_orders.php"><img class="img-circle"  src="../images/shipment.png" alt="image" width="200" height="200"></a>
            				<br><a href="view_orders.php"><h4>عرض طلبات الشراء</h4></a>
            		</div>
					
					<div class="col-lg-4" style="text-align: center;">
            			<a href="view_items.php?shop_id=<?php echo $shop_id ?>"><img class="img-circle"  src="../images/shopping.jpg" alt="image" width="200" height="200"></a>
            				<br><a href="view_items.php?shop_id=<?php echo $shop_id ?>"><h4>عرض المنتجات</h4></a>
					</div>
					<div class="col-lg-4" style="text-align: center;">
            			<a href="view_shop_data.php?id=<?php echo $_SESSION['id'] ?>"><img class="img-circle"  src="../images/shops.png" alt="image" width="200" height="200"></a>
            				<br><a href="view_shop_data.php?id=<?php echo $_SESSION['id'] ?>"><h4>عرض بيانات المتجر</h4></a>
					</div>
					
          
				 </div>
			 
			 
       		 
       	
  		
	</div>
				

</div>
</body>

</html>
<?php include '../footer.php'; ?>