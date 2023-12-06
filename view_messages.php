 <?php include 'header.php'; ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>عرض الرسائل</title>
    
    <link rel="stylesheet" href="css/header.css">
	 <link rel="stylesheet" href="css/footer.css">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style type="text/css">
        
		
		body{ font: 14px sans-serif; background-color:#;}
		
		
        .page_div{ width: 1140px; margin-left: auto;
		height: auto;
				
				padding: 25px 25px 25px 25px;
				margin-right: auto; justify-content: center;
		}

 
        .wrapper{
            width: 800px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: auto;
		
			 
        }
		th , td{ text-align: center;
		
		}
		
	
    </style>
   
</head>


<body>
<div class="page_div" >
	
	<p><h1><center>عرض الرسائل</center></h1></p><br>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left"></h2>
             
  
                    </div>
                    
                     <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM message ";
                    
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped table-hover">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
										 echo "<th>اسم المرسل</th>";
										  echo "<th>البريد الالكتروني</th>";
										   echo "<th>تليفون المرسل</th>";
										    echo "<th>نوع الرسالة</th>";
										    echo "<th>نص الرسالة</th>";
	
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['message_id'] . "</td>";
                                        echo "<td>" . $row['message_name'] . "</td>";
                                         echo "<td>" . $row['message_email'] . "</td>";
								  echo "<td>" . $row['message_phone'] . "</td>";
								  	  echo "<td>" . $row['message_type'] . "</td>";
									  	  echo "<td>" . $row['message_text'] . "</td>";
                                    echo "</tr>";
								
                                }
                                echo "</tbody>";                            
                            echo "</table>";
						
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($conn);
                  
                    ?>
            		
            		

  				</div>
            </div>        
        </div>
    </div>
	 </div>
	
</body>

</html>
<?php include '../footer.php'; ?>