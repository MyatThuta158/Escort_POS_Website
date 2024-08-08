<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include ('../includes/scripts.php');



if (isset($_REQUEST['oid'])) {
    $id=$_REQUEST['oid'];


    $select = "SELECT o.*, c.Customer_Name FROM orders o INNER JOIN customers c ON o.Customer_ID = c.Customer_ID WHERE o.Order_Code='$id'";
    $query=mysqli_query($connect,$select);
    $count=mysqli_num_rows($query);
    if ($count>0) {
        $data=mysqli_fetch_array($query);
        $orderCode=$data['Order_Code'];
        $cusName=$data['Customer_Name'];
        $qty=$data['TotalQuantity'];
        $amount=$data['TotalAmount'];
        $Ptype=$data['PaymentType'];
        $pImg=$data['Payment_Image'];
        $date=$data['OrderDate'];  
   
    }else{
        echo "fail";
    }
}else{
    echo "nothing";
}

   if (isset($_POST['btnConfirm'])) {
    // $oid=$_POST['ocode'];
    // echo $oid;
    $ocode = $_REQUEST['oid'];
    // echo $orderCode;

    $select5="SELECT op.*,p.ProductName,p.ProductCode,p.Product_Quantity, op.UnitQuantity
    FROM orders o, order_products op, Products p 
    WHERE op.ProductCode=p.ProductCode
    AND op.Order_Code=o.Order_Code
    AND o.Order_Code='$ocode'";
$query5=mysqli_query($connect,$select5);
$count5=mysqli_num_rows($query5);
//echo $count5;

if ($count5>0) {
    for($i=0;$i<$count5;$i++){
        $data1=mysqli_fetch_array($query5);
        $pCode=$data1['ProductCode'];
        $qty1=$data1['Product_Quantity'];
        $unitQty=$data1['UnitQuantity'];
        // echo $unitQty;
        $final= $qty1-$unitQty;
        $update="UPDATE products SET Product_Quantity='$final' WHERE ProductCode='$pCode'";
        $runU=mysqli_query($connect,$update);

        
    }

    $update1 = "UPDATE orders SET Order_Status='Confirmed' WHERE Order_Code='$id'";
    $query2 = mysqli_query($connect, $update1);

    if ($query2) {
        echo "<script>window.alert('This Order is approved')</script>";
        echo "<script>window.location.href='Confirmpage.php'</script>";

    }else{
        echo "error";
    }
}
    
   }


   if (isset($_POST['btnDecline'])) {
    $id=$_REQUEST['oid'];
    $update = "UPDATE orders SET Order_Status='Declined' WHERE Order_Code='$id'";
    $query2 = mysqli_query($connect, $update);

    if ($query2) {
        echo "<script>window.alert('This Order is declined')</script>";
        echo "<script>window.location.href='Confirmpage.php'</script>";

    }else{
        echo "error";
    }
   }

?>
<form action="" method="POST">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Payment Confirmation Details
                </div>
                <div class="card-body">
                    <h5 class="card-title">Order Code: <?php echo $orderCode; ?></h5>
                    <input type="hidden" name="ocode" value="<?php echo $orderCode ?>">
                    <p class="card-text">Customer Name: <?php echo $cusName; ?></p>
                    <p class="card-text">Total Quantity: <?php echo $qty; ?></p>
                    <p class="card-text">Total Amount: <?php echo $amount; ?></p>
                    <p class="card-text">Payment Type: <?php echo $Ptype; ?></p>
                    <p class="card-text">Order Date: <?php echo $date; ?></p>
                    <img src="../customer/<?php echo $pImg; ?>" alt="Payment Image" class="img-fluid mb-5" style="height: 50vh; object-fit:cover">
                    <div class="btn-group" style="display: block;" role="group" aria-label="Payment Confirmation Buttons">
                        <button type="submit" name="btnConfirm" class="btn btn-success">Confirm</button>
                        <button type="submit" name="btnDecline" class="btn btn-danger">Decline</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
