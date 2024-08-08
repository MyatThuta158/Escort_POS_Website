<?php
include('../includes/header.php');
include('../includes/navbar.php');
include '../includes/ConnectDB.php';

$PurchaseID=$_GET['PurchaseID'];

//Single Data Retrieve-----------------------------------------------------

$query1="SELECT pur.*,m.Manufacturer_ID,m.Manufacturer_Name,st.Staff_ID,st.Staff_Name
        FROM purchases pur,manufacturers m,staffs st
        WHERE pur.Purchase_Code='$PurchaseID'
        AND pur.Staff_ID=st.Staff_ID
        AND pur.Manufacturer_ID=m.Manufacturer_ID
		";


$result1=mysqli_query($connect,$query1);
$row1=mysqli_fetch_array($result1);
?>

<div class="container mt-4">
    <form action="Purchase_Details.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tr>
                        <td>Purchase Date</td>
                        <td><b><?php echo $row1['PurchaseDate'] ?></b></td>
                    </tr>
                    <tr>
                        <td>Report Date</td>
                        <td><b><?php echo date('Y-m-d') ?></b></td>
                    </tr>
                    <tr>
                        <td>Manufacturer Name</td>
                        <td><b><?php echo $row1['Manufacturer_Name'] ?></b></td>
                    </tr>
                    <tr>
                        <td>Purchase Manager Name</td>
                        <td><b><?php echo $row1['Staff_Name'] ?></b></td>
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
                            <th>Unit Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $select="SELECT p.Purchase_Code,pr.ProductName,pd.Unit_Price,pd.Unit_Quantity,pd.Sub_Total
                                     FROM purchases p, Purchase_product pd, Products pr 
                                     WHERE p.Purchase_Code=pd.Purchase_Code
                                     AND pd.ProductCode=pr.ProductCode
                                     AND p.Purchase_Code='$PurchaseID'";
                            $query=mysqli_query($connect,$select);
                            $count=mysqli_num_rows($query);
                            for($i=0;$i<$count;$i++)
                            {
                                $data=mysqli_fetch_array($query);
                                $productname=$data['ProductName'];
                                $unitprice=$data['Unit_Price'];
                                $unitquantity=$data['Unit_Quantity'];
                                $subtotal=$data['Sub_Total'];

                                echo "<tr>
                                        <td>$productname</td>
                                        <td>$unitprice</td>
                                        <td>$unitquantity</td>
                                        <td>$subtotal</td>
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
