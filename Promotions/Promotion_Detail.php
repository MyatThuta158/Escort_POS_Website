<?php
include('../includes/header.php');
include('../includes/navbar.php');
include '../includes/ConnectDB.php';

$promoCode=$_GET['poid'];

//Single Data Retrieve-----------------------------------------------------

$query1="SELECT p.ProductName,p.ProductPrice,po.*,pp.*
        FROM products p, promotions po, promotion_products pp
        WHERE po.Promotion_Code='$promoCode'
        AND pp.Promotion_Code=po.Promotion_Code
        AND pp.ProductCode=p.ProductCode
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
                        <td>Promotion Code</td>
                        <td><b><?php echo $row1['Promotion_Code'] ?></b></td>
                    </tr>
                    <tr>
                        <td>Promotion Name</td>
                        <td><b><?php echo $row1['Promotion_Name'] ?></b></td>
                    </tr>
                    <tr>
                        <td>Promotion Start Date</td>
                        <td><b><?php echo $row1['PromotionStartDate'] ?></b></td>
                    </tr>
                    <tr>
                        <td>Promotion End Date</td>
                        <td><b><?php echo $row1['PromotionEndDate'] ?></b></td>
                    </tr>

                    <tr>
                        <td>Promotion Amount</td>
                        <td><b><?php echo $row1['PromotionAmount'] ?>%</b></td>
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
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Normal Price</th>
                            <th>Promotion Price</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query2="SELECT p.ProductCode,p.ProductName,p.ProductPrice,po.*,pp.*
                            FROM products p, promotions po, promotion_products pp
                            WHERE po.Promotion_Code='$promoCode'
                            AND pp.Promotion_Code=po.Promotion_Code
                            AND pp.ProductCode=p.ProductCode
                            ";
        
                        $result2=mysqli_query($connect,$query2);
                        $row2=mysqli_num_rows($result2);
                            for($i=0;$i<$row2;$i++)
                            {
                                $data=mysqli_fetch_array($result2);
                                $productCode=$data['ProductCode'];
                                $productname=$data['ProductName'];
                                $unitprice=$data['ProductPrice'];
                                $unitquantity=$data['Unit_Promotion_Product_Price'];

                                echo "<tr>
                                        <td>$productCode</td>
                                        <td>$productname</td>
                                        <td>$unitprice MMK</td>
                                        <td>$unitquantity MMK</td>
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
