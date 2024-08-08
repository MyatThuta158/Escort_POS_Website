<?php
include('../includes/header.php');
include('../includes/navbar.php');
include '../includes/ConnectDB.php';
//include('connect.php');


if(isset($_POST['btnSearch'])) 
{
    $rdoSearchType=$_POST['rdoSearchType'];

    if($rdoSearchType == 1) 
    {
        $PurchaseID=$_POST['cboPurchaseID'];

        $query="SELECT pur.*,m.Manufacturer_ID,m.Manufacturer_Name,st.Staff_ID,st.Staff_Name
                FROM purchases pur,manufacturers m,staffs st
                WHERE pur.Purchase_Code='$PurchaseID'
                AND pur.Staff_ID=st.Staff_ID
                AND pur.Manufacturer_ID=m.Manufacturer_ID
                ";
        $results=mysqli_query($connect,$query);
    }
    elseif($rdoSearchType == 2) 
    {
        $From=date('Y-m-d',strtotime($_POST['txtFrom']));
        $To=date('Y-m-d',strtotime($_POST['txtTo']));

        $query="SELECT pur.*,m.Manufacturer_ID,m.Manufacturer_Name,st.Staff_ID,st.Staff_Name
                FROM purchases pur,manufacturers m,staffs st
                WHERE pur.PurchaseDate BETWEEN '$From' AND '$To'
                AND pur.Staff_ID=st.Staff_ID
                AND pur.Manufacturer_ID=m.Manufacturer_ID
                ";
        $results=mysqli_query($connect,$query);
    }

}
elseif(isset($_POST['btnShowAll'])) 
{
    $query="SELECT pur.*,m.Manufacturer_ID,m.Manufacturer_Name,st.Staff_ID,st.Staff_Name
            FROM purchases pur,manufacturers m,staffs st
            WHERE pur.Staff_ID=st.Staff_ID
            AND pur.Manufacturer_ID=m.Manufacturer_ID
            ";
    $results=mysqli_query($connect,$query);
}
else
{
    $query="SELECT pur.*,m.Manufacturer_ID,m.Manufacturer_Name,st.Staff_ID,st.Staff_Name
    FROM purchases pur,manufacturers m,staffs st
    WHERE pur.Staff_ID=st.Staff_ID
    AND pur.Manufacturer_ID=m.Manufacturer_ID
    ";
    $results=mysqli_query($connect,$query);
}
?>

<form action="" method="POST" class="mt-4 mb-8">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdoSearchType" id="searchByID" value="1" checked>
                    <label class="form-check-label" for="searchByID">
                        Search By ID
                    </label>
                    <select name="cboPurchaseID" class="form-control mt-2">
                        <option>Choose Purchase code</option>
                        <?php  
                        $Query="SELECT * FROM purchases";
                        $result=mysqli_query($connect,$Query);
                        $count=mysqli_num_rows($result);

                        for ($i=0; $i < $count; $i++) 
                        { 
                            $arr=mysqli_fetch_array($result);
                            $PurchaseCode=$arr['Purchase_Code'];

                            echo "<option value='$PurchaseCode'>" . $arr['Purchase_Code'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="rdoSearchType" id="searchByDate" value="2">
                    <label class="form-check-label" for="searchByDate">
                        Search By Date
                    </label>
                    <div class="row mt-2">
                        <div class="col">
                            From
                            <input type="date" name="txtFrom" class="form-control" value="<?php echo date('Y-m-d') ?>">
                        </div>
                        <div class="col">
                            To
                            <input type="date" name="txtTo" class="form-control" value="<?php echo date('Y-m-d') ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3 mt-md-0">
                <div class="form-group">
                    <input type="submit" name="btnSearch" value="Search" class="btn btn-primary">
                    <input type="submit" name="btnShowAll" value="Show All" class="btn btn-secondary ml-2">
                </div>
            </div>
        </div>
    </div>
</form>

<?php  
$counts=mysqli_num_rows($results);

if ($counts < 1) 
{
    echo "<p>No Search Record Found.</p>";
    exit();
}
else
{
?>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Purchase Code</th>
                <th>Purchase Date</th>
                <th>Supplier Name</th>
                <th>Total Price</th>
                <th>Total Quantity</th>    
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php  
            for ($x=0; $x < $counts; $x++) 
            { 
                $row=mysqli_fetch_array($results);
                $PurchaseID=$row['Purchase_Code'];
                $PurchaseDate=$row['PurchaseDate'];
                $TotalPrice=$row['PurchaseTotalAmount'];
                $SupplierName=$row['Manufacturer_Name'];
                $TotalQuantity=$row['PurchaseTotalQuantity'];

                echo "<tr>";
                    echo "<td> $PurchaseID </td>";
                    echo "<td> $PurchaseDate </td>";
                    echo "<td>$SupplierName</td>";
                    echo "<td>$TotalPrice</td>";
                    echo "<td>$TotalQuantity</td>";

                    echo "<td>
                            <a href='PurchaseDetailShow.php?PurchaseID=$PurchaseID'>Details</a>
                         </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
<?php
}
?>
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>
