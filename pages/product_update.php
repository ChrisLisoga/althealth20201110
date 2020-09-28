<?php
// including the database connection file
include("../config/dbconn.php");
if(isset($_POST['update']))
{   
    $id = mysqli_real_escape_string($dbconn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($dbconn, $_POST['product_name']);
    $description = mysqli_real_escape_string($dbconn, $_POST['description']);
    $product_quantity = mysqli_real_escape_string($dbconn, $_POST['product_quantity']);
    $product_cost = mysqli_real_escape_string($dbconn, $_POST['product_cost']); 
    $product_price = mysqli_real_escape_string($dbconn, $_POST['product_price']); 
    $category = mysqli_real_escape_string($dbconn, $_POST['category']); 
    $supplier = mysqli_real_escape_string($dbconn, $_POST['supplier']);
    $product_serial = mysqli_real_escape_string($dbconn, $_POST['product_serial']);

    // checking empty fields
    if(empty($product_name) || empty($description) || empty($product_cost) || empty($product_price) || empty($supplier) || empty($category) || empty($product_serial)) {    
            
        if(empty($product_name)) {
            echo "<font color='red'>Product name field is empty!</font><br/>";
        }
        
        if(empty($description)) {
            echo "<font color='red'>Product description field is empty!</font><br/>";
        }

        if(empty($product_cost)) {
            echo "<font color='red'>Product cost field is empty!</font><br/>";
        }
        
        if(empty($product_price)) {
            echo "<font color='red'>Product price field is empty!</font><br/>";
        }    

        if(empty($supplier)) {
            echo "<font color='red'>Supplier field is empty!</font><br/>";
        }  

        if(empty($category)) {
            echo "<font color='red'>Category field is empty!</font><br/>";
        }  

        if(empty($product_serial)) {
            echo "<font color='red'>Serial number field is empty!</font><br/>";
        } 
       
    } else {    





        //updating the table
        $query = "UPDATE products SET product_name='$product_name',description='$description',product_cost='$product_cost',product_price='$product_price',
                supplier='$supplier',category='$category',product_serial='$product_serial' WHERE product_id=$id";
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
$id=isset($_GET['product_id']) ? $_GET['product_id'] : die('ERROR: Record ID not found.');
//selecting data associated with this particular id
$result = mysqli_query($dbconn, "SELECT * FROM products WHERE product_id=$id");
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
  <div class="panel-heading"><h3>Update Product</h3></div>
  <div class="panel-body">
    <form action="product_update.php" method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="product_id" name="product_id" value=<?php echo $_GET['product_id'];?>>
            <label for="product_name">Serial number:</label>
            <input type="text" class="form-control" id="product_serial" name="product_serial" value="<?php echo $product_serial;?>">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $product_name;?>">
            <label for="description">Product Description:</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo $description;?>">
            <label for="product_cost">Product Cost (Php):</label>
            <input type="text" class="form-control" id="product_cost" name="product_cost" value="<?php echo $product_cost;?>">
            <label for="product_price">Product Price (Php):</label>
            <input type="text" class="form-control" id="product_price" name="product_price" value="<?php echo $product_price;?>">
            


                    <div class="form-group">
                        <label for="supplier_name">Supplier:</label>
                        <div class="input-group">
                            <select class="form-control" id="supplier" name="supplier" required>
                              <?php
                              include('../config/dbconn.php');
                              $query=mysqli_query($dbconn,"SELECT supplier_name FROM supplier ORDER BY supplier_name ASC")or die(mysqli_error());
                              while($row=mysqli_fetch_array($query)){
                                  ?>
                                <option value="<?php echo $row['supplier_name'];?>"><?php echo $row['supplier_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label for="category">Category:</label>
                        <div class="input-group">
                            <select class="form-control" id="category" name="category" required>
                              <?php
                              include('../config/dbconn.php');
                              $query=mysqli_query($dbconn,"SELECT category_name FROM category ORDER BY category_name ASC")or die(mysqli_error());
                              while($row=mysqli_fetch_array($query)){
                              ?>
                                <option value="<?php echo $row['category_name'];?>"><?php echo $row['category_name'];?></option>
                                <?php }?>
                            </select>
                        </div>

                        <label for="product_quantity" id="product_quantity" name="product_quantity">Available Quantity: &nbsp &nbsp <?php echo $product_quantity;?> Pcs.</label>
                    </div>
                </div>            
             </div>
            </div>
            <br>
            <div class="form group">
                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                    <i class="now-ui-icons ui-1_check"></i> Update Product
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