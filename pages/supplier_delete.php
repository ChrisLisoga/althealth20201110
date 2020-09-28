
    <!-- dynamic content will be here -->
<?php
//including the database connection file
include '../config/dbconn.php';
echo "<font color='red'>Delete value here!!!!!!!!!!!!!!!!!!!!!</font><br/>";
//getting id of the data from url
$id = $_GET['Supplier_ID'];
//deleting the row from table
$result = mysqli_query($dbconn, "DELETE FROM tblsupplier_info WHERE Supplier_ID=$id");
//redirecting to the display page (index.php in our case)
header("Location:admin_panel.php");
?>
    