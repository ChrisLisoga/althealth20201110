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

    <div class="section" id="carousel">
        <div class="container">
            <h2>Product Details</h2>
            <a class="btn btn-primary btn-round" href="admin_index.php"><i class="now-ui-icons arrows-1_minimal-left"></i> &nbsp Back to index</a>
            <hr color="green">
            <div class="col-md-12">
                <div class="row justify-content-center">
                    <div class="col-8">
                    
<?php
    include('../config/dbconn.php');
    $product_id=$_GET['product_id'];
    $query = "SELECT * FROM products WHERE product_id='$product_id'";
    $result = mysqli_query($dbconn,$query);
    while($res = mysqli_fetch_array($result)) {  
    
?>   
                
                <div id="carouselExampleIndicategoryors" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicategoryors">
                        <li data-target="#carouselExampleIndicategoryors" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicategoryors" data-slide-to="1" class="active"></li>
                        <li data-target="#carouselExampleIndicategoryors" data-slide-to="2" class="active"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <?php if($res['product_image1'] != ""): ?>
                            <img class="d-block" src="../uploads/<?php echo $res['product_image1']; ?>" alt="First slide">
                            <?php else: ?>
                            <img src="../uploads/default.png">
                            <?php endif; ?>
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $res['product_name']; ?></h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <?php if($res['product_image2'] != ""): ?>
                            <img class="d-block" src="../uploads/<?php echo $res['product_image2']; ?>" alt="Second slide">
                            <?php else: ?>
                            <img src="../uploads/default.png">
                            <?php endif; ?>
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $res['product_name']; ?></h5>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <?php if($res['product_image3'] != ""): ?>
                            <img class="d-block" src="../uploads/<?php echo $res['product_image3']; ?>" alt="Third slide">
                            <?php else: ?>
                            <img src="../uploads/default.png">
                            <?php endif; ?>
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?php echo $res['product_name']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicategoryors" role="button" data-slide="prev">
                        <i class="now-ui-icons arrows-1_minimal-left"></i>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicategoryors" role="button" data-slide="next">
                        <i class="now-ui-icons arrows-1_minimal-right"></i>
                    </a>
                    </div>
                </div>
            </div>
        </div>

        <h5><br><br>
        <ul><b>Serial number: 
        <span style="color:green;"><?php echo $res['product_serial']; ?></span></b>
        </ul>
        <ul><b>Product name: </b> 
        <?php echo $res['product_name']; ?>
        </ul>
        <ul><b>Description: </b>
        <?php echo $res['description']; ?>
        </ul>
        <ul><b>Type: </b>
        <?php echo $res['category']; ?>
        </ul>
        <ul><b>Price: </b>
        <?php echo 'Php'.$res['product_price'].''; ?>
        </ul>
        <ul>
        <?php  $product_quantity=$res['product_quantity'];?> 
        <?php
        if ($product_quantity<=10){
        ?>
         <b>Items in stock: </b><span style="color:red;"><?php echo $res['product_quantity'];?> :Reorder!</span>   
         <?php
        }else{
       ?>
       <b>Items in stock: </b><?php echo $res['product_quantity'];?>
       </ul>
       <ul>
       <?php echo "<a href=\"product_update.php?product_id=$res[product_id]\">Edit Product Details</a>"; }?>
       </ul>
       <?php 
    }
?>      
        </h5>

        
       


    </div>
</div>


        <br>
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
                               ElegantMe
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

</html>