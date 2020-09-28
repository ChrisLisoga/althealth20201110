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
            <hr color="orange">
        <a href='supplements.php' class='btn btn-warning btn-round'>Go to Supplements</a>
        <br>
    <div class="col-md-12">
               

<?php
// including the database connection file
include("../config/dbconn.php");
if(isset($_POST['submit'])){

    $supplement_id=$_POST['supplement_id'];
    $description=$_POST['description'];
    $cost_excl=$_POST['cost_excl'];
    $cost_incl=$_POST['cost_incl'];
	$min_stock=$_POST['min_stock'];
	$current_stock=$_POST['current_stock'];
	$nappi_code=$_POST['nappi_code'];
	$supp_id=$_POST['supp_id'];
	

     // checking empty fields
    if(empty($supplement_id) || empty($description) || empty($cost_excl) || empty($cost_incl) || empty($min_stock) || empty($current_stock) || empty($supp_id)){    
            
        if(empty($supplement_id)) {
            echo "<font color='red'>supplement_id field is empty!</font><br/>";
        }
        
        if(empty($description)) {
            echo "<font color='red'>description field is empty!</font><br/>";
        }

        if(empty($cost_excl)) {
            echo "<font color='red'>cost_excle field is empty!</font><br/>";
        }   

        if(empty($cost_incl)) {
            echo "<font color='red'>cost_incl is empty!</font><br/>";
        }   
		
		 if(empty($min_stock)) {
            echo "<font color='red'>min_stock is empty!</font><br/>";
        }
		
		 if(empty($current_stock)) {
            echo "<font color='red'>current_stock field is empty!</font><br/>";
        }
		
		 if(empty($supp_id)) {
            echo "<font color='red'>supp_id is empty!</font><br/>";
        }

    } else {  

        $query = "INSERT INTO tblsupplements (Supplement_id, Description, Cost_excl, Cost_incl, Min_levels, Current_stock_levels, Nappi_code, Supplier_ID) 
        VALUES ('$supplement_id','$description','$cost_excl','$cost_incl', '$min_stock', '$current_stock', '$nappi_code', '$supp_id')";

        $result = mysqli_query($dbconn,$query);
        
        if($result){
	//redirecting to the display page. In our case, it is index.php
        header("Locategoryion: supplements.php");
        } 
    }
}
?>



<div class="panel panel-success panel-size-customerom">
          <div class="panel-heading"><h3>Add New Supplement</h3></div>

          <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form group">
                    <label for="supplement_id">Supplement ID:</label>
                    <input type="text" class="form-control" id="supplement_id" name="supplement_id" placeholder="supplement id"/>
					
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="description"/>
					
					<label for="cost_excl">Cost Excl:</label>
                    <input type="text" class="form-control" id="cost_excl" name="cost_excl" placeholder="cost excluded"/>
					
					<label for="cost_incl">Cost Incl:</label>
                    <input type="text" class="form-control" id="cost_incl" name="cost_incl" placeholder="cost included"/>
					
					<label for="min_stock">Min Stock Level:</label>
                    <input type="text" class="form-control" id="min_stock" name="min_stock" placeholder="min_stock"/>
					
					<label for="current_stock">Current Stock Level:</label>
                    <input type="text" class="form-control" id="current_stock" name="current_stock" placeholder="current stock"/>
					
					<label for="nappi_code">Nappi Code:</label>
                    <input type="text" class="form-control" id="nappi_code" name="nappi_code" placeholder="nappi code"/>
						
					 <label for="reference">Supplier ID</label>
					<div class="input-group">
						<select class="form-control" id="supp_id" name="supp_id" required>
						<?php
						include('../config/dbconn.php');
						$query = mysqli_query($dbconn, "SELECT Supplier_ID FROM tblsupplier_info ORDER BY Supplier_ID ASC") or die(mysqli_error());
						while ($row = mysqli_fetch_array($query)) {
						?>
						<option value="<?php echo $row['Supplier_ID']; ?>">
							<?php echo $row['Supplier_ID']; ?></option>
							<?php } ?>
						</select>
					</div>	
   
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
                                Creative ABC
                            </a>
                        </li>
                        <li>
                            Elective02
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
