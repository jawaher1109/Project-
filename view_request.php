
 <?php include 'header.php'; ?>
 
 <?php
// Check existence of id parameter before processing further
if(isset($_GET["rent_request_id"]) && !empty(trim($_GET["rent_request_id"]))){
    // Include config file
    require_once "../config.php";
    
	$rent_request_id=$_GET["rent_request_id"];
	
    // Prepare a select statement
    $sql = "SELECT * FROM  rent_request WHERE rent_request_id = '".$rent_request_id."'";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
       // mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = $rent_request_id;
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	    
                // Retrieve individual field value
                $rent_request_id = $row['rent_request_id'];
				$tenant_name = $row['tenant_name'];
				$tenant_id = $row['tenant_id'];
				$shop_id = $row['shop_id'];
				$owner_id_card = $row['owner_id_card'];
				$owner_name = $row['owner_name'];
				$shop_name = $row['shop_name'];
				$shop_field = $row['shop_field'];
				$shop_about = $row['shop_about'];
				$shop_marouf_id = $row['shop_marouf_id'];
				$shop_link = $row['shop_link'];
				$request_status = $row['request_status'];
				
				

                
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
    <title>عرض تفاصيل طلب الايجار</title>
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
                    <h1 class="mt-5 mb-3">عرض تفاصيل طلب الايجار</h1>
                    <div class="form-group">
                       
					   <table class="table table-striped table-hover" border>               
						
							<tr>        
					   <td >رقم الطلب :</td>
                        <td><b><input type="text" name="rent_request_id" class="form-control" value="<?php echo $rent_request_id; ?>" readonly></b></td>
						</tr> 
                        <tr>        
					   <td >رقم المستأجر :</td>
                        <td><b><input type="text" name="tenant_id" class="form-control" value="<?php echo $tenant_id; ?>" readonly></b></td>
						</tr> 
					<tr>        
					   <td >رقم المتجر :</td>
                        <td><b><input type="text" name="shop_id" class="form-control" value="<?php echo $shop_id; ?>" readonly></b></td>
						</tr> 
						
						<tr>        
					   <td >اسم المتجر :</td>
                        <td><b><input type="text" name="shop_name" class="form-control" value="<?php echo $shop_name; ?>" readonly></b></td>
						</tr> 
						<tr>        
					   <td >اسم مالك المتجر :</td>
                        <td><b><input type="text" name="owner_name" class="form-control" value="<?php echo $owner_name; ?>" readonly></b></td>
						</tr> 
						<tr>        
					   <td >رقم الهوية :</td>
                        <td><b><input type="text" name="owner_id_card" class="form-control" value="<?php echo $owner_id_card; ?>" readonly></b></td>
						</tr> 
						<tr>        
					   <td >مجال المتجر :</td>
                        <td><b><input type="text" name="shop_field" class="form-control" value="<?php echo $shop_field; ?>" readonly></b></td>
						</tr>
						<tr>        
					   <td >رقم معروف :</td>
                        <td><b><input type="text" name="shop_marouf_id" class="form-control" value="<?php echo $shop_marouf_id; ?>" readonly></b></td>
						</tr>
						<tr>        
					   <td >رابط المتجر بمعروف :</td>
                        <td><b><input type="text" name="shop_link" class="form-control" value="<?php echo $shop_link; ?>" readonly></b></td>
						</tr>
						<tr>        
					   <td >تفاصيل عن المتجر :</td>
                        <td><b><input type="text" name="shop_about" class="form-control" value="<?php echo $shop_about; ?>" readonly></b></td>
						</tr>
						<tr>        
					   <td >حالة الطلب :</td>
                        <td><b><input type="text" name="request_status" class="form-control" value="<?php echo $request_status; ?>" readonly></b></td>
						</tr>
                        
                        <tr>        
					   <td >تحديث حالة الطلب :</td>
                        <td><a href="update_request.php?request_status=موافقة&rent_request_id=<?php echo $rent_request_id; ?>&shop_id=<?php echo $shop_id; ?>
						&shop_name=<?php echo $shop_name; ?>&tenant_id=<?php echo $tenant_id; ?>&tenant_name=<?php echo $tenant_name; ?>" class="btn btn-success">موافقة</a>
						<a href="update_request.php?request_status=رفض&rent_request_id=<?php echo $rent_request_id; ?>&shop_id=<?php echo $shop_id; ?>" class="btn btn-danger">رفض</a></td>
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