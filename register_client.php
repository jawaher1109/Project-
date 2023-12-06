<?php

	// Include config file
	require_once "config.php";
	 
	// Define variables and initialize with empty values
	$username =	$user_pass = $confirm_password =$user_email=$user_phone="";
	$username_err = $password_err = $confirm_password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
	
		$user_email= trim($_POST["user_email"]);
		$user_phone= trim($_POST["user_phone"]);
		$user_address= trim($_POST["user_address"]);
		
		// Validate username 
		// The trim() function removes white space from both sides(left and right) of a string
		if(empty(trim($_POST["user_name"]))){
			$username_err = "Please enter a user_name.";
		} else{
			// Prepare a select statement
			$sql = "SELECT user_id FROM user WHERE user_name=?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = trim($_POST["user_name"]);
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// store result
					$stmt->store_result();
					
					if($stmt->num_rows == 1){
						echo		"<script type='text/javascript'>
							alert('اسم المستخدم موجود مسبقاً');
							window.location = 'index.php';</script>" ;
					} else{
						$user_name = trim($_POST["user_name"]);
					}
				} else{
					echo "Oops! Something went wrong. Please try again later.";
				}
			}	 
			// Close statement
			$stmt->close();
		}
		
		// Validate user_pass
		if(empty(trim($_POST["user_pass"]))){
			$password_err = "Please enter a user_pass.";     
		} elseif(strlen(trim($_POST["user_pass"])) < 4){
			$password_err = "Password must have atleast 4 characters.";
		} else{
			$user_pass = trim($_POST["user_pass"]);
		}
		
		// Validate confirm user_pass
		if(empty(trim($_POST["confirm_password"]))){
			$confirm_password_err = "Please enter confirm user_pass.";     
		} else{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($password_err) && ($user_pass != $confirm_password)){
				$confirm_password_err = "Password did not match.";
			}
		}
		
		// Check input errors before inserting in database
		if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{
			
			// Prepare an insert statement $user_phone=$id_no=$companyname= $companyfield=$aboutcompany=
			$sql = "INSERT INTO user (user_name, user_pass ,user_email ,user_phone,user_address) VALUES (?,?,?,?,?)";
			 
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("sssss", $param_username, $param_password, $param_email,$param_phone,$user_address);
				
				// Set parameters
				
				$param_username = $user_name;
				$param_email =$user_email;
				$param_phone= $user_phone;
				$user_address=$user_address;
		       
				$param_password = password_hash($user_pass, PASSWORD_DEFAULT); 
				// Creates a user_pass hash
				
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
 