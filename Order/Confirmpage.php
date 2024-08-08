<?php
    // session_start();

    include('../includes/header.php'); 
    include('../includes/navbar.php'); 
    include '../includes/ConnectDB.php';
    include ('../includes/scripts.php');

?>

<h1 class="text-center">Today Orders</h1>
    <div class='table-responsive mb-5'>
        <table class='table table-striped'>

                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Total Quantity</th>
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>

<?php
   $currentDate = date('Y-m-d'); 
   $orderSelect = "SELECT * FROM orders WHERE OrderDate='$currentDate' AND Order_Status='Pending.....'";   
    $run1=mysqli_query($connect,$orderSelect);
    $count=mysqli_num_rows($run1);
 
 

    if ($count>0) {

        for ($i=0; $i <$count ; $i++) { 
            $data1=mysqli_fetch_array($run1);
            $code1=$data1['Order_Code'];
            $qty1=$data1['TotalQuantity'];
            $price1=$data1['TotalAmount'];
            $date1=$data1['OrderDate'];
            $status1=$data1['Order_Status'];
        
            ?>
            <tr>
                <td><?php echo $code1 ?></td>
                <td><?php echo $qty1 ?></td>
                <td><?php echo $price1 ?>MMK</td>
                <td><?php echo $date1 ?></td>
                <td><?php echo $status1 ?></td>
                <td><a href='OrderDetail.php?oid=<?php echo $code1 ?>' class='btn btn-success'>View Detail</a></td>
            </tr>
                        
                
            <?php
        }
    }
?>
        </table>
</div>

<hr>

<h1 class="text-center mt-5">All Order request</h1>
<?php
    $query="SELECT * from orders where Order_Status='Pending.....'";
    $run=mysqli_query($connect,$query);
    $count=mysqli_num_rows($run);

    if ($count>0) {

        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped'>";

        echo "<thead>
                <tr>
                    <th>Order Code</th>
                    <th>Total Quantity</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>";

        echo "<tbody>";

        for ($i=0; $i < $count; $i++) { 
            $data=mysqli_fetch_array($run);

            $code=$data['Order_Code'];
            $qty=$data['TotalQuantity'];
            $price=$data['TotalAmount'];
            $date=$data['OrderDate'];
            $status=$data['Order_Status'];

            echo "<tr>
                <td>$code</td>
                <td>$qty</td>
                <td>$price MMK</td>
                <td>$date</td>
                <td>$status</td>
                <td><a href='OrderDetail.php?oid=$code' class='btn btn-success'>View Detail</a></td>
            </tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }
?>
