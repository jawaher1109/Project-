<?php 
 
	

require_once'../config.php';



       
				
		if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		
				$shop_id = $_GET['shop_id'];
				$status_payment = $_GET['status_payment'];
				
			

		$query = "UPDATE shop SET status_payment ='".$status_payment."'
		WHERE shop_id='".$shop_id."'";

		$result = $conn->query($query);
		if(!$result){
			echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";
		}else{
		echo	"<script type='text/javascript'>
   alert('تم تعديل حالة الدفع');
   window.location = 'index.php';</script>" ;
	$stmt->close();
	}
	

	
	}//end of if
?>