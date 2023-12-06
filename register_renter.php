<?php

	// Include config file
	require_once "config.php";
	 
	// Define variables and initialize with empty values
	$tenant_name =	$tenant_pass = $confirm_password =$tenant_email=$tenant_phone="";
	$username_err = $password_err = $confirm_password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
	
		$tenant_email= trim($_POST["tenant_email"]);
		$tenant_phone= trim($_POST["tenant_phone"]);
	
		
		// Validate tenant_name 
		// The trim() function removes white space from both sides(left and right) of a string
		if(empty(trim($_POST["tenant_name"]))){
			$username_err = "Please enter a tenant_name.";
		} else{
			// Prepare a select statement
			$sql = "SELECT tenant_id FROM tenant WHERE tenant_name=?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["tenant_name"]);
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// store result
					$stmt->store_result();
					
					if($stmt->num_rows == 1){
						echo		"<script type='text/javascript'>
							alert('اسم المستخدم موجود مسبقاً');
							window.location = 'index.php';</script>" ;
					} else{
						$tenant_name = trim($_POST["tenant_name"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}	 
			// Close statement
			$stmt->close();
		}
		
		// Validate tenant_pass
		if(empty(trim($_POST["tenant_pass"]))){
			$password_err = "Please enter a tenant_pass.";     
		} elseif(strlen(trim($_POST["tenant_pass"])) < 4){
			$password_err = "Password must have atleast 4 characters.";
		} else{
			$tenant_pass = trim($_POST["tenant_pass"]);
		}
		
		// Validate confirm tenant_pass
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please enter confirm tenant_pass.";     
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($tenant_pass != $confirm_password)){
				$confirm_password_err = "Password did not match.";
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{
			
			// Prepare an insert statement $tenant_phone=$id_no=$companyname= $companyfield=$aboutcompany=
			$sql = "INSERT INTO tenant (tenant_name, tenant_pass ,tenant_email ,tenant_phone) VALUES (?,?,?,?)";
			 
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("ssss", $param_username, $param_password, $param_email,$param_phone);
				
				// Set parameters
				
				$param_username = $tenant_name;
				$param_email =$tenant_email;
				$param_phone= $tenant_phone;
				
		       
				$param_password = password_hash($tenant_pass, PASSWORD_DEFAULT); 
				// Creates a tenant_pass hash
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					echo		"<script type='text/javascript'>
							alert('تم التسجيل');
							window.location = 'index.php';</script>" ;
				} else{
					echo "Something went wrong. Please try again later.";
				}
			} 
			// Close statement
			$stmt->close();
		}
    // Close connection
    $conn->close();
}
?>
 