<?php
    session_start();
    include('../config/dbconn.php');

    if (!isset($_SESSION['id']) ||(trim ($_SESSION['id']) == '')) {
        header('location:user_login_page.php');
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
    <title>althealth</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/css/demo.css" rel="stylesheet" />

    <!--     inserted     -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">

</head>
<body class="index-page sidebar-collapse">
    <div class="wrapper"><br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>       <?php
					  
								$Client_id=$_GET['Client_id'];
								
								//echo $Client_id;
								
                                 include('../config/dbconn.php');
                                 $query=mysqli_query($dbconn,"SELECT * FROM `tblclientinfo` WHERE Client_id='$Client_id'");
                                 $row=mysqli_fetch_array($query);
                                 $cid=$row['Client_id'];
                                 echo $row['C_name'];
                                ?>'s Shopping Cart
                      </h2>
                      <a class="btn btn-primary btn-round" href="supplements.php"><i class="now-ui-icons shopping_basket"></i> &nbsp Shop more supplements</a>
                      <hr color="orange"> 
                
                <div class="col-md-12">
                <br>
            
                <div class="panel panel-success panel-size-customerom">
                        <div class="panel-body">

                                    <br>
                                    <br>   
									<?php
										include('../config/dbconn.php');
										$query = "SELECT * FROM cart WHERE clientID='$Client_id'";
										$result = mysqli_query($dbconn,$query);
                                      ?>									
       
                                <table id="" class="table table-condensed table-striped" style="border: 1px solid black;">
                                    <tr>
                                      <th style="text-align:left; border: 1px solid black;">Supplement ID</th>
                                      <th style="text-align:left; border: 1px solid black;">Description</th>
                                      <th style="text-align:left; border: 1px solid black;">Quantity</th>
									  <th style="text-align:left; border: 1px solid black;">Price</th>
									  <th style="text-align:left; border: 1px solid black;">Total</th>
                                      <th style="text-align:center; border: 1px solid black;">Option</th>
                                    </tr>
									 
                                        <?php
											
                                          if($result){
                                            while($res = mysqli_fetch_array($result)) {     
                                              echo "<tr>";
                                                echo '<td style="text-align:left; border: 1px solid black;">'.$res['supplementID'].'</td>';
                                                echo '<td style="text-align:left; border: 1px solid black;">'.$res['descriptiom'].'</td>';
												echo '<td style="text-align:left; border: 1px solid black;">'.$res['quantity'].'</td>';
                                                echo '<td style="text-align:left; border: 1px solid black;">'.$res['price_excl_vat'].'</td>';
												echo '<td style="text-align:left; border: 1px solid black;">'.$res['price_incl_vat'].'</td>';
												
												echo "<td><a href=\"supplier_update.php?clientID=$res[clientID]\">update order</a> | <a href=\"supplier_delete.php?clientID=$res[clientID]
                                                \" onClick=\"return confirm('Are you sure you want to delete?')\">Delete order</a></td>";
                                                
                                              echo "</tr>"; 
                                            }
                                        }?>
                                </table>
	
						<!-- TABLE CLIENT CONTACT DETAILS ENDS HERE -->
           
                <button  type="submit" id="" onclick="return confirm('Are you sure you want to Checkout?')" name="submit" class="btn btn-success btn-round pull-right" data-toggle="modal" data-target="#myModal">
                <i class="now-ui-icons shopping_bag-16"></i> Check Out</button> 

               <?php
                
              ?>
 <form method="post" action="user_payment.php">
            <!-- Modal Core -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Customer Invoice</h4>
                  </div>
                  <div class="modal-body">
				  
					<?php
						include('../config/dbconn.php');
						$query = "SELECT * FROM cart WHERE clientID='$Client_id'";
						$result = mysqli_query($dbconn,$query);
						
						if($result){
                        while($res = mysqli_fetch_array($result)) { 
					?>
							
							<ul><b>Invoice number: 

							</ul> 
							
							<ul><b>Client Name: 
								<span style="color:green;"><?php echo $res['clientName']; echo " ".$res['clientSurname']; ?></span></b>
							</ul> 
							
							<ul><b>Client ID: 
								<span style="color:green;"><?php echo $res['clientID']; ?></span></b>
							</ul>
							
							<ul><b>Date: 
								<span style="color:green;"><?php echo $res['date']; ?></span></b>
							</ul> 
							
							<ul><b>Supplement ID: 
							<span style="color:green;"><?php echo $res['supplementID']; ?></span></b>
							</ul> 
							
							<ul><b>Description: 
							<span style="color:green;"><?php echo $res['descriptiom']; ?></span></b>
							</ul> 
							
							<ul><b>Quantity:
							<span style="color:green;"><?php echo $res['quantity']; ?></span></b>
							</ul> 
							
							<ul><b>Cost excluding VAT: 
							<span style="color:green;"><?php echo $res['price_excl_vat']; ?></span></b>
							</ul>
							
							<ul><b>Cost Including VAT: 
							<span style="color:green;"><?php echo $res['price_incl_vat']; ?></span></b>
							</ul> 
					<?php
						}
					}
					?>
						

                  </div>
                  <div class="modal-footer">
				  <button type="button" class="btn btn-warning btn-round" onclick = "window.print()"><span class="now-ui-icons ui-1_check"></span> print invoice</button>
                    <!--<button type="button" class="btn btn-primary btn-round" data-dismiss="modal">print invoice</button> -->
                    <a><button type="submit" name="btnsubmit" class="btn btn-success btn-round"><i class="now-ui-icons shopping_delivery-fast"></i> email invoice</button></a>
                  </div>
              </div>
            </div>
            </div>

    </form>

                        </div>
                    </div> 
                </div>
            </div>
        </div>
<br><br><br><br>
<footer class="footer" data-background-color="black">
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            althealth
                        </li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>,Designed and Created by: Chris Lisoga
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
