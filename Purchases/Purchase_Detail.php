<?php
    include('../includes/header.php'); 
    include('../includes/navbar.php'); 
    include('../includes/ConnectDB.php');
?>

<div class="container mt-4 h-75">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Purchase Code</th>
                <th>Unit Price</th>
                <th>Unit Quantity</th>
                <th>Unit Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $select = "SELECT p.Purchase_Code, pr.ProductName, pp.Unit_Price, pp.Unit_Quantity, pp.Sub_Total FROM purchases p, products pr, purchase_product pp WHERE p.Purchase_Code=pp.Purchase_Code AND pr.ProductCode=pp.ProductCode";
               //$select="SELECT * from products p,product_type pt WHERE p.ProductTypeID=pt.ProductTypeID";
               $run = mysqli_query($connect, $select);
                $count = mysqli_num_rows($run);

                if (!$run) {
                    die("Query failed: " . mysqli_error($connect));
                }else{

                //echo $count;
                if ($count > 0) {
                    for ($i=0; $i <$count ; $i++) { 
                    
                        $data=mysqli_fetch_array($run);
                        $purchaseCode=$data['Purchase_Code'];
                        $productName=$data['ProductName'];
                        $unitPrice=$data['Unit_Price'];
                        $unitqty=$data['Unit_Quantity'];
                        $subTotal=$data['Sub_Total'];
    
                        echo "<tr>";
                        echo "<td>";
                        echo $productName;
                        echo "</td>";
                        echo "<td>";
                        echo $purchaseCode;
                        echo "</td>";
                        echo "<td>";
                        echo $unitPrice;
                        echo "</td>";
                        echo "<td>";
                        echo $unitqty;
                        echo "</td>";
                        echo "<td>";
                        echo $subTotal;
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                }
            ?>
        </tbody>
    </table>
</div>

<?php
    include('../includes/scripts.php');
    include('../includes/footer.php');
?>
