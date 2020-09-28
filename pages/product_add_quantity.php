<?php
  session_start();

  if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
    header('location:../admin_index.php');
    exit();
  }
?>


<?php
// including the database connection file
include("../config/dbconn.php");
if(isset($_POST['submit']))
{   
    $product_id = mysqli_real_escape_string($dbconn, $_POST['product_id']);
	/* $product_cost = mysqli_real_escape_string($dbconn, $_POST['product_cost']);
	echo $product_id ;
	echo $product_name;
    $product_name=$_POST['product_name'];
    $description=$_POST['description'];*/
    $product_quantity=$_POST['product_quantity'];
    /*$product_cost=$_POST['product_cost'];
    $product_price=$_POST['product_price'];
    $category=$_POST['category'];
    $supplier=$_POST['supplier'];
    $product_serial=$_POST['product_serial']; */
    // checking empty field
   
        if(empty($product_quantity)) {
            echo "<font color='red'>Product Quantity field is empty!</font><br/>";
        
        } else {    

        //updating the table
        $query = "UPDATE products SET product_quantity=product_quantity+'$product_quantity' WHERE product_id=$product_id";

        $result = mysqli_query($dbconn,$query);
       
       if($result){
            
            /* $product_name = $_POST['product_name']; */
            $product_quantity = $_POST['product_quantity'];
            
            date_default_timezone_set('Asia/Manila');

            $date = date("Y-m-d H:i:s");
            $id=$_SESSION['id'];
            
            $query=mysqli_query($dbconn,"SELECT * FROM products WHERE product_id='$product_id'")or die(mysqli_error());
          
                while($res=mysqli_fetch_array($query)){
                $product_name=$res['product_name'];
                $remarks="added $product_quantity of $product_name";  
            }
                mysqli_query($dbconn,"INSERT INTO logs (user_id,action,date) VALUES ('$id','$remarks','$date')")or die(mysqli_error($dbconn));

        //redirecting to the display page.
        header("Locategoryion: admin_panel.php");
        }
        
    }
}
?>
            




<?php
    //getting id from url
    $product_id=isset($_GET['product_id']) ? $_GET['product_id'] : die('ERROR: Record ID not found.');
    //selecting data associated with this particular id
    $result = mysqli_query($dbconn, "SELECT * FROM products WHERE product_id=$product_id");
        while($res = mysqli_fetch_array($result))
        {
            $product_name = $res['product_name'];
            $description = $res['description'];
            $product_quantity = $res['product_quantity'];
            $product_cost = $res['product_cost'];
            $product_price = $res['product_price'];
            $category = $res['category'];
            $supplier = $res['supplier'];
            $product_serial = $res['product_serial'];
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
                      <h2>Purchased Product Information</h2>
                      <hr color="orange">
                      <a href='admin_panel.php' class='btn btn-warning btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

    <div class="panel panel-success panel-size-customerom">
  <div class="panel-heading"><h3>Add Product Quantity</h3></div>
  <div class="panel-body">
    <form action="product_add_quantity.php" method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="product_id" name="product_id" value=<?php echo $_GET['product_id'];?>>
            <label for="product_name" id="product_name" name="product_name">Product Name: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $product_name;?></label><br><br>
            <label for="product_serial">Product Serial: &nbsp &nbsp &nbsp <?php echo $product_serial;?></label><br><br>
            <label for="product_name">Name: &nbsp &nbsp &nbsp <?php echo $product_name;?></label><br><br>
            <label for="description">Description: &nbsp &nbsp &nbsp <?php echo $description;?></label><br><br>
            <label for="product_price">Product Cost (Php): &nbsp &nbsp &nbsp &nbsp <?php echo $product_price;?></label><br><br>
            <label for="category">Product Supplier: &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $category;?></label><br><br>
            <label for="supplier">Product Category: &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $supplier;?></label><br><br>
            <label for="quantity">Available Quantity: &nbsp &nbsp &nbsp &nbsp &nbsp <?php echo $product_quantity;?></label><br><br>
            <label for="product_quantity">Number of Quantity/Volume to be added:</label>
            <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Value e.g. 1234">
        </div>
        <br/>
        <div class="form group">
            <button type="submit" class="btn btn-success btn-round" id="submit" name="submit">
            <i class="now-ui-icons ui-1_check"></i> Add Quantity
            </button> 
        </div>
    </form>
  
  </div>
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