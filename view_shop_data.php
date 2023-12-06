
 <?php include 'header.php'; ?>
 
 <?php
// Check existence of id parameter before processing further
if(isset($_GET["shop_id"]) && !empty(trim($_GET["shop_id"]))){
    // Include config file
    require_once "../config.php";
    
	$shop_id=$_GET["shop_id"];
	
    // Prepare a select statement
    $sql = "SELECT * FROM  shop WHERE shop_id = '".$shop_id."'";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
       // mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        //$param_id = $rent_request_id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	    
                // Retrieve individual field value
                $shop_name = $row['shop_name'];
				$tenant_name = $row['tenant_name'];
				$tenant_id = $row['tenant_id'];
				$status_payment = $row['status_payment'];
				$status_rent = $row['status_rent'];
				$shop_name = $row['shop_name'];
				$shop_price = $row['shop_price'];
				$shop_area = $row['shop_area'];

		
		 $sql2 = "SELECT * FROM  tenant WHERE tenant_id = '".$tenant_id."'";
			 		

			 	if($stmt2 = mysqli_prepare($conn, $sql2)){
				if(mysqli_stmt_execute($stmt2)){	
				$result2 = mysqli_stmt_get_result($stmt2);
				$row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
				

				$tenant_email = $row2['tenant_email'];
				$tenant_phone = $row2['tenant_phone'];
				}
				}
                
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>عرض تفاصيل المتجر</title>
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
	<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="mt-5 mb-3">عرض تفاصيل المتجر</h3>
                    <div class="form-group">
                       
					   <table class="table table-striped table-hover" border>               
				
							<tr>        
					   <td >رقم المتجر :</td>
                        <td><b><input type="text" name="shop_id" class="form-control" value="<?php echo $shop_id; ?>" readonly></b></td>
						</tr> 
                        <tr>        
					   <td >اسم المتجر :</td>
                        <td><b><input type="text" name="shop_name" class="form-control" value="<?php echo $shop_name; ?>" readonly></b></td>
						</tr> 
					<tr>        
					   <td >اسم المستأجر :</td>
                        <td><b><input type="text" name="tenant_name" class="form-control" value="<?php echo $tenant_name; ?>" readonly></b></td>
						</tr> 
						
						<tr>        
					   <td >عدد قطع المتجر :</td>
                        <td><b><input type="text" name="shop_area" class="form-control" value="<?php echo $shop_area; ?>" readonly></b></td>
						</tr> 
						<tr>        
					   <td >الايجار السنوي :</td>
                        <td><b><input type="text" name="shop_price" class="form-control" value="<?php echo $shop_price; ?>" readonly></b></td>
						</tr> 
						<tr>        
					   <td >حالة الدفع :</td>
                        <td><b><input type="text" name="status_payment" class="form-control" value="<?php echo $status_payment; ?>" readonly></b></td>
						</tr> 
						     
					 
					
                        
                        <tr>        
					   <td >تحديث حالة الدفع :</td>
                        <td><a href="update_payment.php?status_payment=مدفوع&shop_id=<?php echo $shop_id; ?>" class="btn btn-success">مدفوع</a>
						<a href="update_payment.php?status_payment=غير مدفوع&shop_id=<?php echo $shop_id; ?>" class="btn btn-danger">غير مدفوع</a></td>
						</tr>
						
                      </table>  
					
				
                    
                 
					</div>
                </div>
            </div>  
<br>

      <div class="row">
                <div class="col-md-12">
                    <h3 class="mt-5 mb-3">عرض بيانات المستأجر</h3>
                    <div class="form-group">
                       
					   <table class="table table-striped table-hover" border>               
				
							<tr>        
					   <td >اسم المستأجر :</td>
                        <td><b><input type="text" name="tenant_name" class="form-control" value="<?php echo $tenant_name; ?>" readonly></b></td>
						</tr> 
                        <tr>        
					   <td >البريد الالكتروني :</td>
                        <td><b><input type="text" name="tenant_email" class="form-control" value="<?php echo $tenant_email; ?>" readonly></b></td>
						</tr> 
					<tr>        
					   <td >رقم الجوال :</td>
                        <td><b><input type="text" name="tenant_phone" class="form-control" value="<?php echo $tenant_phone; ?>" readonly></b></td>
						</tr> 
						
						
                      </table>  
					
						<a href="index.php" class="btn btn-primary">رجوع</a>
                    
                 
					</div>
                </div>
            </div> 			
        </div>
    </div>
	   </div>
</body>
</html>
<?php include '../footer.php'; ?>