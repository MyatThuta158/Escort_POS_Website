<?php
include('../includes/header.php');
include('../includes/navbar.php');
include '../includes/ConnectDB.php';

if ($_REQUEST['ofid']) {
    $oid=$_REQUEST['ofid'];
    $get="SELECT o.*,c.* from orders o,customers c where o.Customer_ID=c.Customer_ID AND Order_Code='$oid'";
    $run=mysqli_query($connect,$get);
    $count=mysqli_num_rows($run);

    if ($count>0) {
        $info=mysqli_fetch_array($run);
        $date=$info['OrderDate'];
        $status=$info['Order_Status'];
        $cusName=$info['Customer_Name'];
        $pType=$info['PaymentType'];
        $rPhoneNo=$info['ReceiverPhoneNo'];
        $address=$info['DeliveryAddress'];
    }
}

?>

<div class="container mt-4">
    <form action="Purchase_Details.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <td>Order Date</td>
                        <td><b><?php echo $date ?></b></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><b><?php echo $status ?></b></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td><b><?php echo $cusName ?></b></td>
                    </tr>
                    <tr>
                        <td>Payment Type</td>
                        <td><b><?php echo $pType ?></b></td>
                    </tr>
                    <tr>
                        <td>Receiver Phone Number</td>
                        <td><b><?php echo $rPhoneNo ?></b></td>
                    </tr>
                    <tr>
                        <td>Delivery Address</td>
                        <td><b><?php echo $address ?></b></td>
                    </tr>
                </table>
            </div>
        </div>
        <fieldset>
            <legend>Product Detail List:</legend>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Unit Quantity</th>
                            <th>Order color</th>
                            <th>Order size</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $select="SELECT op.*,p.ProductName
                                     FROM orders o, order_products op, Products p 
                                     WHERE op.ProductCode=p.ProductCode
                                     AND op.Order_Code=o.Order_Code
                                     AND o.Order_Code='$oid'";
                            $query=mysqli_query($connect,$select);
                            $count=mysqli_num_rows($query);
                            for($i=0;$i<$count;$i++)
                            {
                                $data=mysqli_fetch_array($query);
                                $productname=$data['ProductName'];
                                $unitqty=$data['UnitQuantity'];
                                $unitprice=$data['UnitAmount'];
                                $color=$data['Order_Color'];
                                $size=$data['Order_Size'];


                                
                                echo "<tr>
                                        <td>$productname</td>
                                        <td>$unitprice</td>
                                        <td>$unitqty</td>
                                        <td>$color</td>
                                        <td>$size</td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </form>
</div>

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>