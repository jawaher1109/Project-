<?php 
 
	

require_once'../config.php';



              
				
		if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		 
				$item_id = $_POST['item_id'];
				$item_name = $_POST['item_name'];
				$item_price = $_POST['item_price'];
			
		
		

		$query = "UPDATE items SET item_name ='".$item_name."' , item_price ='".$item_price."'
		WHERE item_id='".$item_id."'";

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