
 <?php include 'header.php'; ?>
 
 <?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM client WHERE id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $clientname = $row['username'];
				$email = $row['email'];
				$phone = $row['phone'];
			

                
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
    <title>view Book</title>
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
	  body{ font: 14px sans-serif; background-color:#F7F2E7;}
		
		
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
                    <h1 class="mt-5 mb-3">عرض بيانات العضو</h1>
                    <div class="form-group">
                       <table class="table table-striped table-hover" border>               
							<tr>        
					   <td >رقم العضو :</td>
                        <td><b><?php echo $row["id"]; ?></b></td>
						</tr> 
                        <tr>  
                        <td>اسم المستخدم :</td>
                        <td><b><?php echo $row["username"]; ?></b></td>
                        </tr> 
		
					<tr>  
					 <td>البريد الالكتروني :</td>
                        <td><b><?php echo $row["email"]; ?></b></td>
					</tr>  
					<tr>             
					 <td>رقم الجوال :</td>
                        <td><b><?php echo $row["phone"]; ?></b></td>
					</tr> 
                        
                      </table>   
                    </div>
                   
                    <p><a href="index.php" class="btn btn-primary">رجوع</a></p>
                </div>
            </div>        
        </div>
    </div>
	   </div>
</body>
</html>
<?php include '../footer.php'; ?>