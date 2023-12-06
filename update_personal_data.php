<?php 
 
	

require_once'../config.php';



       
				
		if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		 
				$admin_id = $_POST['admin_id'];
				$admin_name = $_POST['admin_name'];
				$admin_email = $_POST['admin_email'];
			

		$query = "UPDATE admin SET admin_name ='".$admin_name."' , admin_email ='".$admin_email."'
		WHERE admin_id='".$admin_id."'";

		$result = $conn->query($query);
		if(!$result){
			echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";
		}else{
		echo	"<script type='text/javascript'>
   alert('تم تعديل البيانات');
   window.location = 'index.php';</script>" ;
	$stmt->close();
	}
	

	
	}//end of if
?>