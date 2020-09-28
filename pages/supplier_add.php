<?php
    session_start();
    include('../config/dbconn.php');

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
    header('location:../index.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/altHealth.jpeg">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Althealth</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your projects -->
    <link href="../assets/css/demo.css" rel="stylesheet" />
</head>

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8" language="javascript" src="js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf-8" language="javascript" src="js/DT_bootstrap.js"></script>

<body class="index-page sidebar-collapse">

    <!-- End Navbar -->
    <div class="wrapper">

<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>Supplier Information</h2>
                      <hr color="orange">
                      <a href='admin_panel.php' class='btn btn-warning btn-round'>Go Home</a>
                <br>
                <div class="col-md-12">
               

<?php
// including the database connection file
include("../config/dbconn.php");
if(isset($_POST['submit'])){
	
	echo "<font color='red'>Submit request triggered!</font><br/>";

    $Supplier_ID=$_POST['Supplier_ID'];
    $Contact_Person=$_POST['Contact_Person'];
    $Supplier_Tel=$_POST['Supplier_Tel'];
    $Supplier_Email=$_POST['Supplier_Email'];
	$Bank=$_POST['Bank'];
	$Bank_code=$_POST['Bank_code'];
	$Supplier_BankNum=$_POST['Supplier_BankNum'];
	$Supplier_Type_Bank_Account=$_POST['Supplier_Type_Bank_Account'];
	
	echo "<font color='red'>Assigning values Done!!!!</font><br/>";

     // checking empty fields
    if(empty($Supplier_ID) || empty($Contact_Person) || empty($Supplier_Tel) || empty($Supplier_Email) || empty($Bank) || empty($Bank_code) || empty( $Supplier_BankNum) || empty($Supplier_Type_Bank_Account)){    
            
        if(empty($Supplier_ID)) {
            echo "<font color='red'>Supplier ID field is empty!</font><br/>";
        }
        
        if(empty($Contact_Person)) {
            echo "<font color='red'>Contact person field is empty!</font><br/>";
        }

        if(empty($Supplier_Tel)) {
            echo "<font color='red'>Supplier Telephone field is empty!</font><br/>";
        }   

        if(empty($Supplier_Email)) {
            echo "<font color='red'>Email field is empty!</font><br/>";
        }   
		
		 if(empty($Bank)) {
            echo "<font color='red'>Bank field is empty!</font><br/>";
        }
		
		 if(empty($Bank_code)) {
            echo "<font color='red'>Bank code field is empty!</font><br/>";
        }
		
		 if(empty($Supplier_BankNum)) {
            echo "<font color='red'>Account field is empty!</font><br/>";
        }
		
		 if(empty($Supplier_Type_Bank_Account)) {
            echo "<font color='red'>Account type field is empty!</font><br/>";
        }

    } else {  
		echo "<font color='red'>Start populating the table!</font><br/>";

        $query = "INSERT INTO tblsupplier_info (Supplier_ID, Contact_Person, Supplier_Tel, Supplier_Email, Bank, Bank_code, Supplier_BankNum, Supplier_Type_Bank_Account) 
        VALUES ('$Supplier_ID','$Contact_Person','$Supplier_Tel','$Supplier_Email', '$Bank', '$Bank_code', '$Supplier_BankNum', '$Supplier_Type_Bank_Account')";  

        $result = mysqli_query($dbconn,$query);
        
        if($result){
            //redirecting to the display page. In our case, it is index.php
        header("Locategoryion: admin_panel.php");
        }
        
    }
}

?>



<div class="panel panel-success panel-size-customerom">
          <div class="panel-heading"><h3>Add New Supplier</h3></div>

          <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form group">
                    <label for="Supplier_ID">Supplier ID:</label>
                    <input type="text" class="form-control" id="Supplier_ID" name="Supplier_ID" placeholder="Supplier ID"/>
					
                    <label for="Contact_Person">Contact Person:</label>
                    <input type="text" class="form-control" id="Contact_Person" name="Contact_Person" placeholder="Contact Person"/>
					
					<label for="Supplier_Tel">Telephone:</label>
                    <input type="text" class="form-control" id="Supplier_Tel" name="Supplier_Tel" placeholder="Telephone"/>
					
					<label for="Supplier_Email">Email:</label>
                    <input type="email" class="form-control" id="Supplier_Email" name="Supplier_Email" placeholder="Email@email.com"/>
					
					<label for="Bank">Bank Name:</label>
                    <input type="text" class="form-control" id="Bank" name="Bank" placeholder="Bank"/>
					
					<label for="Bank_code">Bank Code:</label>
                    <input type="text" class="form-control" id="Bank_code" name="Bank_code" placeholder="Bank code"/>
					
					<label for="Supplier_BankNum">Account:</label>
                    <input type="text" class="form-control" id="Supplier_BankNum" name="Supplier_BankNum" placeholder="Account"/>
					
					<label for="Supplier_Type_Bank_Account">Account Type:</label>
                    <input type="text" class="form-control" id="Supplier_Type_Bank_Account" name="Supplier_Type_Bank_Account" placeholder="Account Type"/>
   
                </div>
                <br>

                <div class="form group">
                    <button type="submit" class="btn btn-success btn-round" id="submit" name="submit">
                    <i class="now-ui-icons ui-1_check"></i> Submit
                    </button> 
                </div>
            </form>
          </div>
        </div> 
        <br> 
    </div>
</div>
</div>
<footer class="footer" data-background-color="black">
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="" target="_blank">
                                All copyrights reserverd
                            </a>
                        </li>
                        <li>
                         @althealth
                        </li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,ElegantMe Style and Beauty
                </div>
            </div>
        </footer>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="../assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="../assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // the body of this function is in assets/js/now-ui-kit.js
        nowuiKit.initSliders();
    });

    function scrollToDownload() {

        if ($('.section-download').length != 0) {
            $("html, body").animate({
                scrollTop: $('.section-download').offset().top
            }, 1000);
        }
    }
</script>

</html>
