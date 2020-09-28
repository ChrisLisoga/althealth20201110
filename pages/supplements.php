<?php
    session_start();

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:admin_login_page.php');
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

    <!--     inserted     -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

</head>

<body class="profile-page sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transactionsparent " color-on-scroll="400">
    <div class="container">
    <div class="navbar-transactionslate">
        <a href="admin_index.php" class="navbar-brand" rel="tooltip"  data-placement="bottom" target="">
        <img src="assets/img/logo.png" alt="ALTHEALTH" height="100px" style="left:0;" id="logo">
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
            <span class="navbar-toggler-bar bar4"></span>
        </button>
    </div>
        <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="../assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="admin_panel.php" onclick="scrollToDownload()">
        <i class="now-ui-icons users_circle-08"></i>
        <p>
    <?php
        include('../config/dbconn.php');
        $query=mysqli_query($dbconn,"SELECT * FROM `admin` WHERE user_id='".$_SESSION['id']."'");
        $row=mysqli_fetch_array($query);
        echo 'Admin '.$row['firstname'].'';
    ?>
    </p>
    </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="supplements.php">
        <i class="now-ui-icons files_paper"></i>
        <p>Buy Supplements</p>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" href="user_cart.php">
        <i class="now-ui-icons shopping_cart-simple"></i>
        <p>Shopping Cart</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="logout.php" class="nav-link" href="" onclick="scrollToDownload()">
        <i class="now-ui-icons ui-1_lock-circle-open"></i>
        <p>Logout</p>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com" target="_blank">
        <i class="fa fa-twitter"></i>
        <p class="d-lg-none d-xl-none">Twitter</p>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com" target="_blank">
        <i class="fa fa-facebook-square"></i>
        <p class="d-lg-none d-xl-none">Facebook</p>
        </a>
    </li>
    
    <li class="nav-item">
        <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com" target="_blank">
        <i class="fa fa-instagram"></i>
        <p class="d-lg-none d-xl-none">Instagram</p>
        </a>
    </li>
    </ul>
    </div>
    </div>
    </nav>
    <!-- End Navbar -->

    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="white">
        <div class="page-header-image" data-parallax="true" style="background-image: url('../assets/img/supplecounter.jpg');"></div>
        <div class="container">
        <div class="content-center">
        <div class="photo-container">
            <img src="../assets/img/altHealth.jpeg" alt="">
        </div>
            <h2 class="title">
                <?php
                include('../config/dbconn.php');
                $query=mysqli_query($dbconn,"SELECT * FROM `admin` WHERE user_id='".$_SESSION['id']."'");
                $row=mysqli_fetch_array($query);
                echo ''.$row['firstname'].' '.$row['lastname'].'';
                ?>
            </h2>
        <p class="category">Shop Supplements</p>
        </div>
        </div>
        </div>
        </div>
        
        <div class="section">
        <div class="container">
        <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <h4 class="title text-center">Supplements</h4>
            <div class="nav-align-center">
            <ul class="nav nav-pills nav-pills-primary" role="tablist">
                               
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#supplier" role="tablist">
            <i class="now-ui-icons shopping_delivery-fast"></i>
            </a>
            </li>                   
            </ul>
        </div>
        </div>
					
        <!-- Tab panes -->
        <div class="tab-content gallery">
            <div class="tab-pane" id="supplier" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Supplements</h3>
            </div>
        </div>
            <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
            $query = "SELECT * FROM tblsupplements ORDER BY Supplement_id ASC";
            $result = mysqli_query($dbconn,$query);
        ?>  
                                 
            <br>
            <br>
            <table id="" class="table table-condensed table-striped" style="border: 1px solid black;">
            <tr>
                <th style="text-align:left; border: 1px solid black;">Supplement ID</th>
                <th style="text-align:left; border: 1px solid black;">Description</th>
                <th style="text-align:left; border: 1px solid black;">Price</th>
				<th style="text-align:left; border: 1px solid black;">Total</th>
                <th style="text-align:left; border: 1px solid black;">Option</th>
            </tr>
        <?php
            if($result){
                while($res = mysqli_fetch_array($result)) {     
                    echo "<tr>";
                    echo '<td style="text-align:left; border: 1px solid black;">'.$res['Supplement_id'].'</td>';
                    echo '<td style="text-align:left; border: 1px solid black;">'.$res['Description'].'</td>';
                    echo '<td style="text-align:left; border: 1px solid black;">'.$res['Cost_excl'].'</td>';
					echo '<td style="text-align:left; border: 1px solid black;">'.$res['Cost_incl'].'</td>';
                    echo "<td><a href=\"user_product_details.php?Supplement_id=$res[Supplement_id]\">Buy</a></td>";
                    echo "</tr>"; 
                }
            }?>
                </table>
				<br><br>
				<a class="btn btn-success btn-round" href="supplement_add.php"><i class="now-ui-icons ui-1_simple-add"></i> Add Supplement</a>
                </div>
                </div>
                </div>
	
			<!-- TABLE CLIENT CONTACT DETAILS ENDS HERE -->

        </div>
        </div>
        </div>
        </div>
        <footer class="footer" data-background-color="black">
           <div class="container">
            <nav>
            <ul>
            <li>
                <a href="" target="_blank">
                    All copyrights are reserved
                </a>
            </li>
            <li>
                althealth
            </li>
            </ul>
            </nav>
            <div class="copyright">
                &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
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


   <!---  inserted  -->
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../plugins/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../plugins/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
        });
      });
    </script>
     <!--  inserted  -->

</html>
