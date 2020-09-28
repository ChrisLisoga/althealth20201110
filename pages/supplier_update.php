<?php
// including the database connection file
include("../config/dbconn.php");
if(isset($_POST['update']))
{   
    $supplier_id = mysqli_real_escape_string($dbconn, $_POST['supplier_id']);
    $supplier_name = mysqli_real_escape_string($dbconn, $_POST['supplier_name']);
    $supplier_address = mysqli_real_escape_string($dbconn, $_POST['supplier_address']);
    $supplier_contact = mysqli_real_escape_string($dbconn, $_POST['supplier_contact']);
    $supplier_email = mysqli_real_escape_string($dbconn, $_POST['supplier_email']); 

    // checking empty fields
    if(empty($supplier_name) || empty($supplier_address) || empty($supplier_contact) || empty($supplier_email)) {    
            
        if(empty($supplier_name)) {
            echo "<font color='red'>Supplier name field is empty!</font><br/>";
        }
        
        if(empty($supplier_address)) {
            echo "<font color='red'>Address field is empty!</font><br/>";
        }

        if(empty($supplier_contact)) {
            echo "<font color='red'>Contact field is empty!</font><br/>";
        }
        
        if(empty($supplier_email)) {
            echo "<font color='red'>Email field is empty!</font><br/>";
        }    
       
    } else {    





        //updating the table
        $query = "UPDATE supplier SET supplier_name='$supplier_name',supplier_address='$supplier_address',supplier_contact='$supplier_contact',supplier_email='$supplier_email' WHERE supplier_id=$supplier_id";
        $result = mysqli_query($dbconn,$query);
        
        if($result){
            //redirecting to the display page. In our case, it is index.php
        header("Locategoryion: admin_panel.php");
        }
        
    }
}
?>






<?php
//getting id from url
$id=isset($_GET['supplier_id']) ? $_GET['supplier_id'] : die('ERROR: Record ID not found.');
//selecting data associated with this particular id
$result = mysqli_query($dbconn, "SELECT * FROM supplier WHERE supplier_id=$id");
while($res = mysqli_fetch_array($result))
{
    $supplier_name = $res['supplier_name'];
    $supplier_address = $res['supplier_address'];
    $supplier_contact = $res['supplier_contact'];
    $supplier_email = $res['supplier_email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>ElegantMe</title>
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
                      <a href='admin_panel.php' class='btn btn-warning btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

    <div class="panel panel-success panel-size-customerom">
  <div class="panel-heading"><h3>Update Supplier</h3></div>
  <div class="panel-body">
    <form action="supplierlier_update.php" method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="supplier_id" name="supplier_id" value=<?php echo $_GET['supplier_id'];?>>
            <label for="supplier_name">Supplier name:</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="<?php echo $supplier_name;?>">
            <label for="supplier_address">Address:</label>
            <input type="text" class="form-control" id="supplier_address" name="supplier_address" value="<?php echo $supplier_address;?>">
            <label for="supplier_contact">Contact Details:</label>
            <input type="text" class="form-control" id="supplier_contact" name="supplier_contact" value="<?php echo $supplier_contact;?>">
            <label for="supplier_email">Email:</label>
            <input type="text" class="form-control" id="supplier_email" name="supplier_email" value="<?php echo $supplier_email;?>">
            

                </div>            
             </div>
            </div>
            <br>
            <div class="form group">
                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                    <i class="now-ui-icons ui-1_check"></i> Update Supplier
                </button>
            </div>
    </form>
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