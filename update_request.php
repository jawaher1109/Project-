<?php 
 
	

require_once'../config.php';



       
				
		if($_SERVER["REQUEST_METHOD"] == "GET")
	{
		 
				$request_status = $_GET['request_status'];
				$rent_request_id =$_GET['rent_request_id'];
			

		$query = "UPDATE rent_request SET request_status ='".$request_status."'
		WHERE rent_request_id='".$rent_request_id."'";

		$result = $conn->query($query);
		
		
		if($request_status=='موافقة'){
		
		$shop_id=$_GET['shop_id'];		
		$shop_name	=$_GET['shop_name'];	
		$tenant_id	=$_GET['tenant_id'];	
		$tenant_name=$_GET['tenant_name'];	
		$status_rent='مؤجر';		
			
			
		$query2 = "UPDATE shop SET shop_name ='".$shop_name."',tenant_id ='".$tenant_id."',tenant_name ='".$tenant_name."',status_rent ='".$status_rent."'
		WHERE shop_id='".$shop_id."'";
	
		$conn->query($query2);
		
		}else if($request_status=='رفض'){
		
		$shop_id=$_GET['shop_id'];		
		
		$status_rent='غير مؤجر';		
			
			
		$query3 = "UPDATE shop SET shop_name ='لا يوجد',tenant_id ='0',tenant_name ='لا يوجد',status_rent ='".$status_rent."'
		WHERE shop_id='".$shop_id."'";
	
		$conn->query($query3);
		}
		
		
		if(!$result){
			echo "UPDATE failed: $query <br>" . $conn->error . "<br><br>";
		}else{
		echo	"<script type='text/javascript'>
   alert('تم تحديث حالة الطلب');
   window.location = 'index.php';</script>" ;
	$stmt->close();
	
	
	
	}
	

	
	}//end of if
?>