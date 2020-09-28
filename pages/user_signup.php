<?php
    session_start();
    include('../config/dbconn.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>althealth</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transactionsparent " color-on-scroll="400">
        <div class="container">
            <div class="navbar-transactionslate">
                <a href="../index.php" class="navbar-brand" rel="tooltip"  data-placement="bottom">
                    ALTHEALTH
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/CreativeTim" target="_blank">
                            <i class="fa fa-twitter"></i>
                            <p class="d-lg-none d-xl-none">Twitter</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/CreativeTim" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                            <p class="d-lg-none d-xl-none">Facebook</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/CreativeTimOfficial" target="_blank">
                            <i class="fa fa-instagram"></i>
                            <p class="d-lg-none d-xl-none">Instagram</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

<?php
// including the database connection file
include("../config/dbconn.php");
if(isset($_POST['submit']))
{   
	$clientID=$_POST['clientID'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $address=$_POST['address'];
	$code=$_POST['code'];
	$hometel=$_POST['hometel'];
	$worktel=$_POST['worktel'];
	$cellphone=$_POST['cellphone'];
    $email=$_POST['email'];
	$reference=$_POST['reference'];
	
	//assign corresponding values to the reference for inserting to the database
	if($reference == "Website")
	{
		$reference = 1;
	}
	elseif($reference == "Word by mouth")
	{
		$reference = 2;
	}
	elseif($reference == "Friend")
	{
		$reference = 3;
	}
	elseif($reference == "Facebook")
	{
		$reference = 4;
	}
	elseif($reference == "Myself")
	{
		$reference = 5;
	}
	else
	{
		$reference = 6;
	}
	
	//mask cellphone number
/* 	$cellSub1 = substr($cellphone, 0, 3);
	$cellSub2 = substr($cellphone, 3, 3);
	$cellSub3 = substr($cellphone, -4);
	$newCellphone = "(".$cellSub1.")-(".$cellSub2.")-(".$cellSub3.")";
	
	$cellphone = $newCellphone;
	 */
	
	function mask($telephoneNumber)
	{
		$cellSub1 = substr($telephoneNumber, 0, 3);
		$cellSub2 = substr($telephoneNumber, 3, 3);
		$cellSub3 = substr($telephoneNumber, -4);
		$newCellphone = "(".$cellSub1.")-(".$cellSub2.")-(".$cellSub3.")";
		return $newCellphone;
	}
	
	function validateContactDetails($telephoneNumber)
	{
		$validation = TRUE;
		if(is_numeric($telephoneNumber))
		{
			$length = strlen((string)$telephoneNumber);
			if($length != 10)
			{
				$validation = FALSE;
				echo "<font color='red'>Phone number is not 10 digits long!</font><br/>";
			}
		}
		else
		{
			$validation = FALSE;
			echo "<font color='red'>cellphone number is not numeric!</font><br/>";
		}
		
		return $validation;
	}
	

    // checking empty fields
	$emptyFields = TRUE;
	$clientIDValidate = TRUE;
	$emailValidate = TRUE;
	$cellValidate = TRUE;
	$workTelValidation = TRUE;
	$homeTelValidation = TRUE;
	
	
	
	
    if(empty($clientID) || empty($firstname) || empty($lastname) ||empty($address) || empty($code) || empty($cellphone) || empty($reference)) 
	{
		$emptyFields = FALSE;
            
        if(empty($firstname)) {
            echo "<font color='red'>Firstname field is empty!</font><br/>";
        }
        
        if(empty($lastname)) {
            echo "<font color='red'>Lastname field is empty!</font><br/>";
        }

        if(empty($address)) {
            echo "<font color='red'>Address field is empty!</font><br/>";
        }

        if(empty($code)) {
            echo "<font color='red'>Code field is empty!</font><br/>";
        }

        if(empty($cellphone)) {
            echo "<font color='red'>Cellphone number is required!</font><br/>";
        }
        
        if(empty($username)) {
            echo "<font color='red'>Username field is empty!</font><br/>";
        }    
   
    } 
	elseif(is_numeric($clientID))
	{
		$length = strlen((string)$clientID);
		if($length != 13)
		{
			$clientIDValidate = FALSE;
			echo "<font color='red'>ID number must be 13 digist long!</font><br/>";
		}
		else
		{
			echo "<font color='red'>ID number is Valid!</font><br/>";
		}
	}
	else
	{  
		if(empty($email) == FALSE)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				//intentianlayy left empty
			}
			else
			{
				$emailValidate = FALSE;
				echo "<font color='red'>Enter a valid email address!</font><br/>";
			}
		}
		
	}
	
	//call function to validate cellphone	
	if(empty($cellphone) == FALSE)
	{
		$cellValidate = validateContactDetails($cellphone);
		if($cellValidate == TRUE)
		{
			$newCell = mask($cellphone);
			$cellphone = $newCell;
		}
		else
		{
			echo "<font color='red'>Cellphone validation failed</font><br/>";
		}
	}
	
	//validate hometell if it exists
	if(empty($hometel) == FALSE)
	{
		$homeTelValidation = validateContactDetails($hometel);
		if($homeTelValidation == TRUE)
		{
			$newCell = mask($hometel);
			$hometel = $newCell;
		}
		else
		{
			echo "<font color='red'>Hometel validation failed</font><br/>";
		}
	}
	
	if(empty($worktel) == FALSE)
	{
		$workTelValidation = validateContactDetails($worktel);
		if($workTelValidation == TRUE)
		{
			$newCell = mask($worktel);
			$worktel = $newCell;
		}
		else
		{
			echo "<font color='red'>Hometel validation failed</font><br/>";
		}
	}
	

	if($emptyFields == TRUE && $clientIDValidate == TRUE && $emailValidate == TRUE && $cellValidate == TRUE && $homeTelValidation == TRUE && $workTelValidation == TRUE)
	{
		
		echo "<font color='red'>All form fields are valid</font><br/>";
		
		//updating the table
		
        $query = "INSERT INTO tblclientinfo (Client_id, C_name, C_surname, Address, Code, C_Tel_H, C_Tel_W, C_Tel_C, C_Email, Reference_ID) 
        VALUES ('$clientID','$firstname','$lastname','$address', '$code', '$hometel', '$worktel', '$cellphone', '$email', '$reference')";  
		
		/* $newQuery = "ALTER TABLE tblclientinfo DROP FOREIGN KEY tblClientInfo_ibfk_1";
		echo $query."<br>";
	
		$result1 = mysqli_query($dbconn,$newQuery);
		if($result1)
		{
			echo "<font color='red'>Updating the table has passed</font><br/>";
		}
		else
		{
			echo "<font color='red'>Alter the table has failed !!!</font><br/>";
		} */
		
		//ALTER TABLE tblclientinfo ADD CONSTRAINT tblClientInfo_ibfk_1 FOREIGN KEY (Reference_ID) REFERENCES tblReference(Reference_ID)
		
        $result = mysqli_query($dbconn,$query);
		
		echo $result."<br>";
        
        if($result){
            //redirecting to the display page. In our case, it is index.php
        header("location: admin_panel.php");
        }
		else
		{
			echo "<font color='red'>Updating the table has failed</font><br/>";
		}
	}
	else	
	{
		echo "<font color='red'>Some fields aren't valid</font><br/>";
        
    }
}
?>

    <div class="page-header" filter-color="white">
    <div class="page-header-image" style="background-image:url(../assets/img/supplecounter.jpg)"></div>
    <div class="container">
        <div class="col-md-4 content-center">
            <div class="card card-login card-plain">
                    <form class="form" method="post" action="">
                        <div class="header header-primary text-center">
                            <div class="logo-container">
								<img src="../assets/img/elogo.png" alt="Circle Image" class="rounded-circle">
                            </div>
                        </div>
                <div class="content">
							<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons tech_mobile"></i>
                                </span>
                                <input type="text" name="clientID" class="form-control" placeholder="Client ID (YYMMDD0000000)" required>
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </span>
                                <input type="text" name="firstname" class="form-control" placeholder="First name" required>
                            </div>
                            
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </span>
                                <input type="text" name="lastname" class="form-control" placeholder="Last name" required>
                            </div>
							
							<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons business_bank"></i>
                                </span>
                                <input type="text" name="address" class="form-control" placeholder="Residental address" required>
                            </div>
							
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons tech_mobile"></i>
                                </span>
                                <input type="text" name="code" class="form-control" placeholder="Zip Code" required>
                            </div>
							
							
							<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons tech_mobile"></i>
                                </span>
                                <input type="text" name="hometel" class="form-control" placeholder="Home Telephone" >
                            </div>
							
							 <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons tech_mobile"></i>
                                </span>
                                <input type="text" name="worktel" class="form-control" placeholder="Work Telephone" >
                            </div>
                            
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons tech_mobile"></i>
                                </span>
                                <input type="text" name="cellphone" class="form-control" placeholder="Cellphone number" required>
                            </div>
							
							<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_email-85"></i>
                                </span>
                                <input type="text" name="email" class="form-control" placeholder="Email">
                            </div>
							
							
							
							
							
						<label for="reference">Where did you hear about us?</label>
                        <div class="input-group">
                            <select class="form-control" id="reference" name="reference" required>
                              <?php
                              include('../config/dbconn.php');
                              $query=mysqli_query($dbconn,"SELECT Description FROM tblreference ORDER BY Description ASC")or die(mysqli_error());
                              while($row=mysqli_fetch_array($query)){
                              ?>
                                <option value="<?php echo $row['Description'];?>"><?php echo $row['Description'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="bbtn btn-primary btn-round btn-lg btn-block" id="submit" name="submit">
                                 Add Client
                            <span class="glyphicon glyphicon-floppy-save"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Designed and Coded by Chris Lisoga.
                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<script src="../assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

</html>
