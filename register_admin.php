<?php


	// Include config file
	require_once "config.php";
	 
	// Define variables and initialize with empty values
	$admin_name =	$admin_pass = $confirm_password =$admin_email="";
	$username_err = $password_err = $confirm_password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
	
		$admin_email= trim($_POST["admin_email"]);
	
	
		
		// Validate username 
		// The trim() function removes white space from both sides(left and right) of a string
		if(empty(trim($_POST["admin_name"]))){
			$username_err = "Please enter a admin_name.";
		} else{
			// Prepare a select statement
			$sql = "SELECT admin_id FROM admin WHERE admin_name = ?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["admin_name"]);
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// store result
					$stmt->store_result();
					
					if($stmt->num_rows == 1){
						echo		"<script type='text/javascript'>
							alert('اسم المستخدم موجود مسبقاً');
							window.location = 'index.php';</script>" ;
					} else{
						$admin_name = trim($_POST["admin_name"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}	 
			// Close statement
		$stmt->close();
		}
		
		// Validate password
		if(empty(trim($_POST["admin_pass"]))){
			$password_err = "Please enter a admin_pass.";     
		} elseif(strlen(trim($_POST["admin_pass"])) < 4){
			$password_err = "Password must have atleast 4 characters.";
		} else{
			$admin_pass = trim($_POST["admin_pass"]);
		}
		
		// Validate confirm admin_pass
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please enter confirm admin_pass.";     
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($admin_pass != $confirm_password)){
				$confirm_password_err = "Password did not match.";
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{
			
			// Prepare an insert statement $phone=$id_no=$companyname= $companyfield=$aboutcompany=
			$sql = "INSERT INTO admin (admin_name, admin_email,admin_pass ) VALUES (?,?,?)";
			 
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("sss", $param_username, $param_email, $param_password);
				
				// Set parameters
				
				$param_username = $admin_name;
				$param_email =$admin_email;
				
		       
				$param_password = password_hash($admin_pass, PASSWORD_DEFAULT); 
				// Creates a admin_pass hash
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Redirect to login page
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
 
