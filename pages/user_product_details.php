<?php
    session_start();

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:user_login_page.php');
        exit();
    }
?>
     <?php
        include('../config/dbconn.php');
        $Supplement_id=$_GET['Supplement_id'];
        $query = "SELECT * FROM tblsupplements WHERE Supplement_id='$Supplement_id'";
        $result = mysqli_query($dbconn,$query);
        while($res = mysqli_fetch_array($result)){
							
        $Supplement_id=$res['Supplement_id'];
        $Cost_excl=$res['Cost_excl'];
		$Cost_incl=$res['Cost_incl'];
		$Description=$res['Description'];
		$Current_stock_levels=$res['Current_stock_levels'];
        $user_id = $_SESSION['id'];

            if (isset($_POST['submit'])){
            $Supplement_id=$Supplement_id;
			$Description=$Description;
            $Cost_excl=$Cost_excl;
			$Cost_incl=$Cost_incl;						
			$Client_id=$_POST['Client_id'];
        
        $query = "SELECT * FROM tblclientinfo WHERE Client_id='$Client_id'";
		$result = mysqli_query($dbconn,$query);
            while($res = mysqli_fetch_array($result)){
            $C_name=$res['C_name'];
            $C_surname=$res['C_surname'];
		}
										
        $Current_stock_levels = $_POST['Current_stock_levels'];                                       
            // $total = $Cost_excl * $_POST['Current_stock_levels'];         
            //$user_id = $user_id;

            $date=date("Y-m-d");
            if(empty($Current_stock_levels)){    
                if(empty($Current_stock_levels)) {
                    echo "<br><center><h4><font color='red'><b>Error!</b> Select Supplements Quantity.</font></h4></center>";
                }

            } else {
											
			$insert_query = "INSERT INTO cart (supplementID, descriptiom, price_excl_vat,price_incl_vat, clientID, clientName, clientSurname, date, quantity ) 
            VALUES ('$Supplement_id','$Description','$Cost_excl','$Cost_incl','$Client_id','$C_name','$C_surname','$date','$Current_stock_levels')";
												
			$result = mysqli_query($dbconn,$insert_query);	
			//echo $insert_query;
				echo $Client_id;					
					if($result)
					{
					?>
                                         
                    <script type="text/javascript">
                        alert("Product Added To Cart!");
                        // window.location = "user_cart.php";
                    </script>
   
                     <?php
						echo "<td><a href=\"user_cart.php?Client_id=$_POST[Client_id]\">Show Client Cart</a></td>";
					}
					else
					{
					?>
                                         
                    <script type="text/javascript">
                        alert("Could Not Add Supplements to cart!!!!!!!!!");
                        //window.location = "user_cart.php";
                    </script>
                    <?php
					}
										
												
										

                                        /* mysqli_query($dbconn,"INSERT INTO cart (supplementID, descriptiom, price_excl_vat,price_incl_vat, clientID, clientName, clientSurname, date, quantity ) 
                                                VALUES ('$Supplement_id','$Description','$Cost_excl','$Cost_incl','$Client_id','$C_name','$C_surname','$date','$Current_stock_levels')"); /* or die(mysql_error()  */
												
										//add details to order table
										/* $query = "INSERT INTO order (user_id, track_number, firstname, lastname, email, contact, shipping_address, order_date, status, totalprice, tax)
											VALUES ('$user_id','$track_number','$firstname','$lastname','$email','$contact','$ship_add','$date','Pending',,'$total','$tax')";
										$result = mysqli_query($dbconn,$query); */
                                          /*   ?>
                                         
                                            <script type="text/javascript">
                                                alert("Product Added To Cart!");
                                                window.location = "user_cart.php";
                                            </script>
   
                                            <?php  */
                                    }
                            }
                    } ?>

<?php
// including the database connection file
/* include("../config/dbconn.php");
if(isset($_POST['clientADD']))
{   
	$Client_id=$_POST['Client_id'];
	
	$query = "SELECT * FROM tblclientinfo WHERE Client_id='$Client_id'";
    $result = mysqli_query($dbconn,$query);
    while($res = mysqli_fetch_array($result)){
        $C_name=$res['C_name'];
        $C_surname=$res['C_surname'];
	
}

echo $C_name;
echo $C_surname;

} */
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
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

    <div class="section" id="carousel">
        <div class="container">
            <h2>Supplement Details</h2>
            <a class="btn btn-primary btn-round" href="supplements.php"><i class="now-ui-icons arrows-1_minimal-left"></i> &nbsp Back to supplements</a>
            <hr color="orange">
            <div class="col-md-12">
            <div class="row justify-content-center">
    <div class="col-8">
         

<?php
    include('../config/dbconn.php');
    $Supplement_id=$_GET['Supplement_id'];
    $query = "SELECT * FROM tblsupplements WHERE Supplement_id='$Supplement_id'";
    $result = mysqli_query($dbconn,$query);
    while($res = mysqli_fetch_array($result)) {  
        //getting product id
        
    
?>   
                
<div id="carouselExampleIndicategoryors" class="carousel slide" data-ride="carousel">
                   <!-- <ol class="carousel-indicategoryors">
                        <li data-target="#carouselExampleIndicategoryors" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicategoryors" data-slide-to="1" class="active"></li>
                        <li data-target="#carouselExampleIndicategoryors" data-slide-to="2" class="active"></li>
                    </ol>-->
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

    <h4><br><br>
		
        <ul><b>Supplement ID: 
        <span style="color:green;"><?php echo $res['Supplement_id']; ?></span></b>
        </ul> 
		
		 <ul><b>Description: 
        <span style="color:green;"><?php echo $res['Description']; ?></span></b>
        </ul> 
		
		 <ul><b>Cost Excluding VAT: 
        <span style="color:green;"><?php echo $res['Cost_excl']; ?></span></b>
        </ul> 
		
		 <ul><b>Cost Including VAT: 
        <span style="color:green;"><?php echo $res['Cost_incl']; ?></span></b>
        </ul> 
		

        <?php }?> 

        </h4>

            <!-- Button trigger modal -->
            <button class="btn btn-success btn-round pull-right" data-toggle="modal" data-target="#myModal">
            <i class="now-ui-icons shopping_cart-simple"></i>Add To Cart</button>

            <!-- Modal Core -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                <form action="" method="post" enctype="multipart/form-data">
            <div class="form group">
				
				<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            <h4 class="modal-title" id="myModalLabel">Select Client:</h4>
            </div>
				
			<div class="input-append">      
            
            <select class="form-control" id="Client_id" name="Client_id" required>
			<?php
				include('../config/dbconn.php');
				$query=mysqli_query($dbconn,"SELECT * FROM tblclientinfo ORDER BY Client_id ASC")or die(mysqli_error());
				while($row=mysqli_fetch_array($query)){
			?>
				<option value="<?php echo $row['Client_id'];?>"><?php echo $row['Client_id'];?></option>
				<?php }?>
				</select>
                </div>
				

                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title" id="myModalLabel">Select Quantity:</h4>
                </div>
                <div class="modal-body">

                <div class="input-append">
                <?php
                    echo "<select class='btn btn-warning btn-round dropdown-toggle' size='1' name='Current_stock_levels' id='Current_stock_levels'>";
                    $i=1; 
                    while ($i <= $Current_stock_levels ){
                        echo "<option value=".$i.">".$i."</option>";
                        $i++;
                        }
                        echo "</select>";
                ?>
                </div>
                    
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-round" data-dismiss="modal">Close</button>
                <a><button type="submit" name="submit" class="btn btn-success btn-round">Order</button></a>
                </div>
                </div>
                </form>

              </div>
            </div>
            </div>
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
        Created by: C LISOGA
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
    </script>, Designed and Coded by Serve(8) Web Solutions, Inc.
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
