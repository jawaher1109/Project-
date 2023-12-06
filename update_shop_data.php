<?php 
 
	

require_once'../config.php';



              
				
		if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		 
				$tenant_id = $_POST['tenant_id'];
				$tenant_name = $_POST['tenant_name'];
				$tenant_email = $_POST['tenant_email'];
				$tenant_phone = $_POST['tenant_phone'];
		
		

		$query = "UPDATE tenant SET tenant_name ='".$tenant_name."' , tenant_email ='".$tenant_email."',tenant_phone ='".$tenant_phone."'
		WHERE tenant_id='".$tenant_id."'";

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