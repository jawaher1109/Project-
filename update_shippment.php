<?php 
 
	

require_once'../config.php';



       
				
		if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		
				$order_id = $_GET['order_id'];
				$order_stat = $_GET['order_stat'];
				
			

		$query = "UPDATE shipping_request SET order_stat ='".$order_stat."'
		WHERE order_id='".$order_id."'";

		$result = $conn->query($query);
		if(!$result){
			echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";
		}else{
		echo	"<script type='text/javascript'>
   alert('تم تعديل حالة الطلب');
   window.location = 'index.php';</script>" ;
	$stmt->close();
	}
	

	
	}//end of if
?>