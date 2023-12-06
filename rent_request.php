 <?php include 'header.php'; ?>
<?php
require_once'../config.php';
//	tenant_name	tenant_id	shop_id	owner_id_card	owner_name	shop_name	shop_field	shop_marouf_id	shop_link	shop_about	


	

		if($_SERVER["REQUEST_METHOD"] == "POST") 
	{

		$shop_id=trim($_POST['shop_id']);
$tenant_id =$_SESSION['id'];
$tenant_name =$_SESSION['username'];
		
		$owner_name = trim($_POST['owner_name']);
		$owner_id_card = trim($_POST['owner_id_card']);
		$shop_name = trim($_POST['shop_name']);
		$shop_field = trim($_POST['shop_field']);
		$shop_marouf_id = trim($_POST['shop_marouf_id']);
		$shop_link = trim($_POST['shop_link']);
		$shop_about = trim($_POST['shop_about']);
	$request_status= 'تحت الاجراء';
	
		
	
		$query = "INSERT INTO rent_request (tenant_name	,tenant_id	,shop_id	,owner_id_card,	owner_name,	shop_name,	shop_field,	shop_marouf_id	,shop_link	,shop_about,request_status) 
					VALUES ('$tenant_name' ,'$tenant_id','$shop_id','$owner_id_card','$owner_name','$shop_name','$shop_field','$shop_marouf_id','$shop_link','$shop_about','$request_status' )";
					
		$result = $conn->query($query);
		if(!$result)
			echo "INSERT failed: $query <br>" . $conn->error . "<br><br>";
		else
		echo	"<script type='text/javascript'>
   alert('تم ارسال الطلب');
   window.location = 'index.php';</script>" ;
	
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>طلب استئجار متجر</title>
	  <link rel="stylesheet" href="css/header.css">
	 <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

	
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
     
		
		 body{ font: 14px sans-serif; background-color:#;}
		
		
        .page_div{ width: 1140px; margin-left: auto;
		height: auto;
				
				padding: 25px 25px 25px 25px;
				margin-right: auto; justify-content: center;
		}

 
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: auto;
			font-weight: bold;
        }
		th , td{ text-align: center;
		}
    </style>
</head>



<body>
<div class="page_div" >
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">طلب استئجار متجر</h2>
                    <p>رجاء تعبئة البيانات المطلوبة *</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>رقم المتجر</label>
                            <input type="text" name="shop_id" id="shop_id" class="form-control" value="<?php echo $_GET['shop_id']?>" readonly>							
                        </div>
						
						
						<div class="form-group">
                            <label>اسم مالك المتجر</label>
                            <input type="text" name="owner_name" id="owner_name" class="form-control" required>							
                        </div>
						
						 <div class="form-group">
                            <label>رقم الهوية الوطنية</label>
                            <input type="number" name="owner_id_card" id="owner_id_card" class="form-control" required>
                        </div>
					
						 <div class="form-group">
                            <label>اسم المتجر</label>
                            <input type="text" name="shop_name" id="shop_name" class="form-control" required>
                        </div>
						 <div class="form-group">
                            <label>المجال التجاري</label>
                            <input type="text" name="shop_field" id="shop_field" class="form-control" required>
                        </div>
						 <div class="form-group">
                            <label>رقم معروف</label>
                            <input type="number" name="shop_marouf_id" id="shop_marouf_id" class="form-control" required>
                        </div>
						 <div class="form-group">
                            <label>رابط المتجر</label>
                            <input type="url" name="shop_link" id="shop_link" class="form-control" required>
                        </div>
						
						 <div class="form-group">
                            <label>نبذة عن المتجر</label>
                            <textarea  name="shop_about" id="shop_about" class="form-control" required></textarea >
                        </div>
							<div class="form-group">
                            <label>
                           قبول شروط الايجار <input type="checkbox" name="accept" id="accept" class="form-control"  required>
							
							</label>
                        </div>
				
                        <input type="submit" class="btn btn-primary" name="Submit" value="ارسال الطلب">
                       <input type="reset" value="مسح البيانات" class="btn btn-default">
                    </form>
                </div>
            </div>        
        </div>
    </div>
	</div>
	<br>

	
</body>
<?php include '../footer.php'; ?>
</html>