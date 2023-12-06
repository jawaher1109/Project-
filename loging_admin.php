<?php



	// Include config file
	require_once "config.php";
	 
	// Define variables and initialize with empty values
	$username = $password ="";
	$username_err = $password_err = "";
	 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	// $usertype=trim($_POST["usertype"]);
		// Check if username is empty
		if(empty(trim($_POST["username"]))){
			$username_err = "Please enter username.";
		} else{
			$username = trim($_POST["username"]);
		}
		
		// Check if password is empty
		if(empty(trim($_POST["password"]))){
			$password_err = "Please enter your password.";
		} else{
			$password = trim($_POST["password"]);
		}
	
		
		// Validate credentials
		if(empty($username_err) && empty($password_err)){
			// Prepare a select statement
			$sql = "SELECT admin_id, admin_name, admin_pass FROM admin WHERE admin_name = ?";
			
			if($stmt = $conn->prepare($sql)){
				// Bind variables to the prepared statement as parameters
				$stmt->bind_param("s", $param_username);
				
				// Set parameters
				$param_username = $username;
				
				// Attempt to execute the prepared statement
				if($stmt->execute()){
					// Store result
					$stmt->store_result();
					
					// Check if username exists, if yes then verify password
					if($stmt->num_rows == 1){                    
						// Bind result variables
						$stmt->bind_result($id, $username, $hashed_password);
						// $stmt->fetch() will fetch results from a prepared statement into
						// the bound variables
						if($stmt->fetch()){
							//  password_verify ( string $password , string $hash ) : bool
							//	password : The user's password.
							//  hash : A hash created by password_hash().
							if(password_verify($password, $hashed_password)){
								
								// Password is correct, so start a new session
								session_start();
								
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username; 
                               
								
								header("location: admin/index.php");
								
							} // end of if(password_verify($password, $hashed_password))
							else{
								// Display an error message if password is not valid
								//$password_err = "The password you entered was not valid.";
								echo		"<script type='text/javascript'>
							alert('The password you entered was not valid');
							window.location = 'index.php';</script>" ;
							}
						} // end of $stmt->fetch()
					} // end of if($stmt->num_rows == 1)
					else{
						// Display an error message if username doesn't exist
						//$username_err = "No account found with this username.";
							echo		"<script type='text/javascript'>
							alert('No account found with this username.');
							window.location = 'index.php';</script>" ;
					}
				}  // end of if($stmt->execute())
				else{
					//echo "Oops! Something went wrong. Please try again later.";
					echo		"<script type='text/javascript'>
							alert('Oops! Something went wrong. Please try again later.');
							window.location = 'index.php';</script>" ;
				}
			} // End of if($stmt = $conn->prepare($sql))
			
			// Close statement
			$stmt->close();
		}		
		// Close connection
		$conn->close();
}
?>
 