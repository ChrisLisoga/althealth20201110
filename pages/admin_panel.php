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
        <a href="admin_panel.php" class="navbar-brand" rel="tooltip"  data-placement="bottom" target="">
        <img src="assets/img/logo.png" alt="althealth" height="100px" style="left:0;" id="logo">
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
        <div class="page-header-image" data-parallax="true" style="background-image: url('../assets/img/pharmacy-3377670_1280.jpg');"></div>
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
        <p class="category">Welcome to Admin Panel</p>
        </div>
        </div>
        </div>
        </div>

        <div class="section">
        <div class="container">
        <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
        <h4 class="title text-center">Dashboard</h4>
        <div class="nav-align-center">
        <ul class="nav nav-pills nav-pills-primary" role="tablist">
                               
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#supplier" role="tablist">
            <i class="now-ui-icons shopping_delivery-fast"></i>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#user_accounts" role="tablist">
            <i class="now-ui-icons users_circle-08"></i>
            </a>
       </li>
								
	    <!-- Birthdays -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#admin_accounts" role="tablist">
            <i class="now-ui-icons users_circle-08"></i>
            </a>
         </li>
								
		<!-- Unpaid invoices -->
		<li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#unpaid_invoices_accounts" role="tablist">
            <i class="now-ui-icons users_circle-08"></i>
            </a>
        </li>
								
		<!-- minimum stock levels -->
		<li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#minimum_stock_levels" role="tablist">
            <i class="now-ui-icons users_circle-08"></i>
            </a>
            </li>
								
		<!-- Top 10 clients -->
		<li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#top_ten_clients" role="tablist">
            <i class="now-ui-icons users_circle-08"></i>
            </a>
        </li>
								
		<!-- Puchases statistics -->
		<li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#purchases_stats" role="tablist">
            <i class="now-ui-icons users_circle-08"></i>
            </a>
        </li>
								
		<!-- Client Information -->
		<li class="nav-item">
           <a class="nav-link" data-toggle="tab" href="#clients_contact_info" role="tablist">
            <i class="now-ui-icons users_circle-08"></i>
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
        <h3>Supplier Information</h3>
        </div>
        </div>
        <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
                if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
                }
            $query = "SELECT * FROM tblsupplier_info ORDER BY Supplier_ID ASC";
            $result = mysqli_query($dbconn,$query);
         ?>  
                                 
        <br>
        <br>
        <table id="" class="table table-condensed table-striped" style="border: 1px solid black;">
        <tr>
            <th style="text-align:left; border: 1px solid black;">Supplier ID</th>
            <th style="text-align:left; border: 1px solid black;">Contact Person</th>
            <th style="text-align:left; border: 1px solid black;">Telephone</th>
            <th style="text-align:left; border: 1px solid black;">Email</th>
            <th style="text-align:left; border: 1px solid black;">Bank</th>
            <th style="text-align:left; border: 1px solid black;">Code</th>
            <th style="text-align:left; border: 1px solid black;">Account</th>
            <th style="text-align:left; border: 1px solid black;">Type</th>
            <th style="text-align:left; border: 1px solid black;">Option</th>
        </tr>
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
            echo "<tr>";
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Supplier_ID'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Contact_Person'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Supplier_Tel'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['Supplier_Email'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['Bank'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['Bank_code'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['Supplier_BankNum'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Supplier_Type_Bank_Account'].'</td>';  
            echo "<td><a href=\"supplier_update.php?Supplier_ID=$res[Supplier_ID]\">Edit</a> | <a href=\"supplier_delete.php?Supplier_ID=$res[Supplier_ID]
            \" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
            echo "</tr>"; 
            }
        }?>
        </table>
        <br><br>
        <a class="btn btn-success btn-round" href="supplier_add.php"><i class="now-ui-icons ui-1_simple-add"></i> Add Supplier</a>
        </div>
        </div>
        </div>
        <div class="tab-pane" id="user_accounts" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Client Information</h3>
        </div>
        </div>
         <br>                
        
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
            echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
            $query = "SELECT * FROM tblclientinfo ORDER BY Client_id ASC";
            $result = mysqli_query($dbconn,$query);
        ?>  
                                 
        <br>
        <br>
        <table class="table table-condensed table-striped" style="border: 1px solid black;">
        <tr>
           <th style="text-align:left; border: 1px solid black;">Client ID</th>
            <th style="text-align:left; border: 1px solid black;">First Name</th>
            <th style="text-align:left; border: 1px solid black;">Last Name</th>
            <th style="text-align:left; border: 1px solid black;">Address</th>
            <th style="text-align:left; border: 1px solid black;">Code</th>
			<th style="text-align:left; border: 1px solid black;">Tel Home</th>
			<th style="text-align:left; border: 1px solid black;">Tel Work</th>
			<th style="text-align:left; border: 1px solid black;">Cellphone Number</th>
			<th style="text-align:left; border: 1px solid black;">Email</th>
			<th style="text-align:left; border: 1px solid black;">Ref ID</th>
            <th style="text-align:left; border: 1px solid black;">Option</th>
        </tr>
                
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
            echo "<tr>";
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Client_id'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_name'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_surname'].'</td>';  
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Address'].'</td>'; 
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Code'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_Tel_H'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_Tel_W'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_Tel_C'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_Email'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['Reference_ID'].'</td>';
            echo "<td><a href=\"user_delete.php?Client_id=$res[Client_id]
            \" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
            echo "</tr>"; 
            }
        }?>
        
        </table>
	    <a class="btn btn-success btn-round" href="user_signup.php"><i class="now-ui-icons ui-1_simple-add"></i> Add New Client</a>
        </div>
        </div>
        </div>
			
	    <!--Birthdays Display -->
            <div class="tab-pane" id="admin_accounts" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Today's Birthdays</h3>
            </div>
            </div>
            <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
            echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
            $query = "SELECT Client_id, CONCAT (C_name , C_surname) FROM tblclientinfo WHERE MONTH(CURRENT_DATE()) 
            = MONTH(STR_TO_DATE(SUBSTR(Client_id,1,6),'%y%m%d')) AND DAY(CURRENT_DATE()) = DAY(STR_TO_DATE(SUBSTR(Client_id,1,6),'%y%m%d'))";
            $result = mysqli_query($dbconn,$query);
        ?>  
                                 
        <br>
            <br>
            <table class="table table-condensed table-striped" style="border: 1px solid black;">
            <tr>
            <th style="text-align:left; border: 1px solid black;">CLIENT ID</th>
            <th style="text-align:left; border: 1px solid black;">CLIENT NAME</th>
            </tr>
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
            echo "<tr>";
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Client_id'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['CONCAT (C_name , C_surname)'].'</td>'; 
           }
        }?>
        </table>
        </div>
        </div>
        </div>
						

	    <!--Unpaid invoices -->	
            <div class="tab-pane" id="unpaid_invoices_accounts" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Unpaid Invoices</h3>
            </div>
            </div>
            <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
                                      }
 			$query = "SELECT I.CLIENT_ID, CONCAT(C.C_NAME, C.C_SURNAME), I.INV_NUM , I.INV_DATE  FROM tblinv_info  I , tblclientinfo  C 
            WHERE I.inv_date<'2020-01-02' AND I.INV_PAID<>'Y' AND I.Client_id = C.Client_id ORDER BY I.Inv_Date ASC";
			$result = mysqli_query($dbconn,$query);
        ?>  
                                 
            <br>
            <br>
            <table class="table table-condensed table-striped" style="border: 1px solid black;">
            <tr>
            <th style="text-align:left; border: 1px solid black;">CLIENT ID</th>
            <th style="text-align:left; border: 1px solid black;">CLIENT </th>
			<th style="text-align:left; border: 1px solid black;">INVOICE NUMBER</th>
			<th style="text-align:left; border: 1px solid black;">INVOICE DATE</th>
            </tr>
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
            echo "<tr>";
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['CLIENT_ID'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['CONCAT(C.C_NAME, C.C_SURNAME)'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['INV_NUM'].'</td>';
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['INV_DATE'].'</td>';                                
            }
        }?>
            </table>
            </div>
            </div>
            </div>
						
        <!--Minimum stock levels -->		
            <div class="tab-pane" id="minimum_stock_levels" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Minimum Stock Levels</h3>
            </div>
            </div>
            <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
            $query = "SELECT b.Supplement_id, CONCAT (a.Supplier_ID,Contact_Person ,Supplier_Tel), Min_levels, Current_stock_levels 
            FROM tblsupplements b JOIN tblsupplier_info a ON b.Supplier_ID = a.Supplier_ID WHERE Min_levels > Current_stock_levels ORDER BY 2";
            $result = mysqli_query($dbconn,$query);
        ?>  
                                 
            <br>
            <br>
            <table class="table table-condensed table-striped" style="border: 1px solid black;">
            <tr>
			<th style="text-align:left; border: 1px solid black;">SUPPLEMENT</th>
            <th style="text-align:left; border: 1px solid black;">SUPPLIER INFORMATION </th>
			<th style="text-align:left; border: 1px solid black;">MIN LEVELS</th>
			<th style="text-align:left; border: 1px solid black;">CURRENT STOCK</th>
            </tr>
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
            echo "<tr>";
			$supInfo = $res['CONCAT (a.Supplier_ID,Contact_Person ,Supplier_Tel)'];
			$supID = substr($supInfo, 0, 10);
			$contactInfo = substr($supInfo, 10);
			$supInfo = $supID." ".$contactInfo;
											  
            echo '<td style="text-align:left; border: 1px solid black;">'.$res['Supplement_id'].'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$supInfo.'</td>';
			echo '<td style="border: 1px solid black;">'.$res['Min_levels'].'</td>';
            echo '<td style="border: 1px solid black;">'.$res['Current_stock_levels'].'</td>';                               
            }
        }?>
            </table>
            </div>
            </div>
            </div>
						
		<!-- REPORTIN ENDS HERE -->
						
		<!-- TOP TEN CLIENTS SHOW HERE -->
            <div class="tab-pane" id="top_ten_clients" role="tabpanel" style="margin-top: 20px;">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Top 10 Clients </h3>
            </div>
            </div>
            <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
            $query = "select CONCAT(a.Client_id, a.C_name, a.C_surname), count(*) from tblclientinfo a join tblinv_info b on b.client_id = a.Client_id 
            WHERE YEAR(b.Inv_Date) in ('2018','2019') GROUP by CONCAT(a.Client_id,a.C_name,a.C_surname) order by 2 desc LIMIT 10";
            $result = mysqli_query($dbconn,$query);
        ?>  
            <br>
            <br>
            <table class="table table-condensed table-striped" style="border: 1px solid black;">
            <tr>
			<th style="text-align:left; border: 1px solid black;">CLIENT</th>
            <th style="text-align:left; border: 1px solid black;">FREQUENCY </th>
            </tr>
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
                echo "<tr>";
			$client = $res['CONCAT(a.Client_id, a.C_name, a.C_surname)'];
			$idNum = substr($client, 0, 13);
			$client_name = substr($client, 13);
			$client = $idNum.'   '.$client_name;
            echo '<td style="text-align:left; border: 1px solid black;">'.$client.'</td>';
			echo '<td style="text-align:left; border: 1px solid black;">'.$res['count(*)'].'</td>';
            }
        }?>
            </table>
            </div>
            </div>
            </div>

    <!-- TOP TEN CLIENTS END -->
						
    <!-- PURCHASES STATS TABLE HERE -->

            <div class="tab-pane" id="purchases_stats" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Purchases Statistics</h3>
            </div>
            </div>
            <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
            $query = "select count(*), MONTHNAME(Inv_Date) from tblinv_info 
            WHERE YEAR(Inv_Date) >= '2012' GROUP by MONTHNAME(Inv_Date) order by MONTH(Inv_Date)";
            $result = mysqli_query($dbconn,$query);
        ?>  
                                 
            <br>
            <br>
            <table class="table table-condensed table-striped" style="border: 1px solid black;">
            <tr>
			<th style="text-align:left; border: 1px solid black;">NUMBER OF PURCHASES</th>
            <th style="text-align:left; border: 1px solid black;">MONTH</th>
            </tr>
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
                echo "<tr>";
                echo '<td style="text-align:left; border: 1px solid black;">'.$res['count(*)'].'</td>';
				echo '<td style="text-align:left; border: 1px solid black;">'.$res['MONTHNAME(Inv_Date)'].'</td>';
            }
        }?>
            </table>
            </div>
            </div>
            </div>
		<!-- PURCHASES STATS TABLE END HERE  -->

        <!-- TABLE CLIENT CONTACT DETAILS HERE -->
            <div class="tab-pane" id="clients_contact_info" role="tabpanel">
            <div class="col-md-12 ml-auto mr-auto">
            <div class="row collections">
            <br>
            <div class="row">
            <div align="center">
            <h3>Clients With No Cell/Email Contacts</h3>
            </div>
            </div>
            <br>                
                                    
        <?php
            include('../config/dbconn.php');
            $action = isset($_GET['action']) ? $_GET['action'] : "";
            if($action=='deleted'){
                echo "<div class='alert alert-success'>Record was deleted.</div>";
            }
            $query = "SELECT Client_id, C_Tel_H, C_Tel_W, C_Tel_C , C_Email FROM tblclientinfo where C_Email ='' and C_Tel_C =''";
            $result = mysqli_query($dbconn,$query);
        ?>  
                                 
            <br>
            <br>
            <table class="table table-condensed table-striped" style="border: 1px solid black;">
            <tr>
				<th style="text-align:left; border: 1px solid black;">CLIENT</th>
                <th style="text-align:left; border: 1px solid black;">HOME</th>
				<th style="text-align:left; border: 1px solid black;">WORK</th>
				<th style="text-align:left; border: 1px solid black;">CELL</th>
				<th style="text-align:left; border: 1px solid black;">EMAIL</th>
            </tr>
        <?php
            if($result){
            while($res = mysqli_fetch_array($result)) {     
                echo "<tr>";
                echo '<td style="text-align:left; border: 1px solid black;">'.$res['Client_id'].'</td>';
				echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_Tel_H'].'</td>';
				echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_Tel_W'].'</td>';
                echo '<td style="text-align:left; border: 1px solid black;">'.$res['C_Email'].'</td>'; 
            }
        }?>
            </table>
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
                    ALL copyrights reserved
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
