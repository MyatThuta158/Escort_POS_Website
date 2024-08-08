<?php

    include('../includes/header.php'); 
    include('../includes/navbar.php'); 
    include '../includes/ConnectDB.php';
    include '../Auto_ID.php';
    include 'PurchaseFunction.php';

    if (isset($_POST['btnAdd'])) {
        $ProductID = $_POST['selectProduct'];
        $PurchasePrice = $_POST['totalPrice'];
        $PurchaseTotal = $_POST['totalQty'];

        AddProduct($ProductID, $PurchasePrice, $PurchaseTotal);
    }

    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        if ($action === 'remove') {
            $ProductID = $_GET['ProductID'];
            RemoveProduct($ProductID);
        } else if ($action === 'clearall') {
            //ClearAll();
        }
    }

    if (isset($_POST['btnSave'])) {
        $purchaseCode = $_POST['txtPurchaseID'];
        $purchaseDate=date('Y-m-d');
       // $purchaseDate = $_POST['purchaseDate'];
        $totalAmount = $_POST['priceTotal'];
        $totalQty = $_POST['qty'];
       // $staffID = $_SESSION['uid'];
       $staffID=$_SESSION['uid'];
        $manufacturerID = $_POST['selectManufacturer'];

        $insert = "INSERT INTO purchases(Manufacturer_ID,PurchaseDate,PurchaseTotalAmount,PurchaseTotalQuantity,Purchase_Code,Staff_ID) Values('$manufacturerID','$purchaseDate','$totalAmount','$totalQty','$purchaseCode','$staffID') ";
        $query = mysqli_query($connect, $insert);

        $size = count($_SESSION['Purchase_Function']);

        for ($i = 0; $i < $size; $i++) {
            $productid = $_SESSION['Purchase_Function'][$i]['ProductID'];
            $price = $_SESSION['Purchase_Function'][$i]['PurchasePrice'];
            $quantity = $_SESSION['Purchase_Function'][$i]['PurchaseQty'];
            $amount = $price * $quantity;

            $insert = "INSERT INTO purchase_product(ProductCode,Purchase_Code,Unit_Price,Unit_Quantity,Sub_Total) Values('$productid','$purchaseCode','$price','$quantity','$amount')";
            $query = mysqli_query($connect, $insert);
        }

        if ($query) {
            echo "<script>window.alert('Successfully Saved Purchase')</script>";
            unset($_SESSION['Purchase_Function']);
        }
    }
?>

<div class="container mt-4">
    <h1 class="text-center">Purchase Product</h1>
    <form action="Purchases.php" method="POST" class="form-group needs-validation rForm" novalidate>
        <table class="table table-bordered">
            <tr>
                <td>PurchaseID:</td>
                <td><input type="text" name="txtPurchaseID" value="<?php echo Auto_ID('purchases', 'Purchase_Code', 'PU', 6) ?>" class="form-control" readonly></td>
            </tr>

            <tr>
                <td>Product lists</td>
                <td>
                    <select name="selectProduct" class="form-control" required>
                        <?php
                        echo "<option value=''>Choose Product Name</option>";
                        $select = "SELECT * from products";
                        $run = mysqli_query($connect, $select);
                        while ($data = mysqli_fetch_array($run)) {
                            $pCode = $data['ProductCode'];
                            $pName = $data['ProductName'];
                            echo "<option value='$pCode'>$pName</option>";
                        }
                        ?>
                        
                    </select>
                    <div class="invalid-feedback">Please select product lists!</div>
                </td>
            </tr>

            <tr>
                <td>Purchase Date</td>
                <td><input type="date" name="purchaseDate" value="<?php echo date('Y-m-d') ?>" readonly class="form-control"></td>
            </tr>

            <tr>
                <td>Purchase Manager</td>
                <td><input type="text" name="purchaseManager" value="<?php echo $_SESSION['userName'] ?>" readonly class="form-control"></td>
            </tr>

            <tr>
                    <td>Total Quantity:</td>
                    <td><input type="number" name="totalQty" class="form-control" required>
                    <div class="invalid-feedback">Please enter total quantity!</div>
                    </td>
            </tr>
    
            

                <tr>
                    <td>Unit Price(MMK):</td>
                    <td><input type="number" name="totalPrice" class="form-control needs-validation" required>
                    <div class="invalid-feedback">Please enter total price!</div>
                    </td>
                </tr>
            
            

            <tr>
                <td colspan="2"><button name="btnAdd" class="btn btn-primary">Add</button></td>
            </tr>
        </table>
    </form>

    <form action="Purchases.php" method="POST" class="form-group vForm" novalidate>
        <?php
        if (empty($_SESSION['Purchase_Function'])) {
            echo "<p>No Record Found!</p>";
        } else {
            ?>
            <h1>Your cart</h1>
            <input type="hidden" name="txtPurchaseID" value="<?php echo Auto_ID('purchases', 'Purchase_Code', 'PU', 6) ?>" class="form-control">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Purchase Qty</th>
                        <th>Sub Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $size = count($_SESSION['Purchase_Function']);

                    for ($i = 0; $i < $size; $i++) {
                        $ProductID = $_SESSION['Purchase_Function'][$i]['ProductID'];
                        $ProductName = $_SESSION['Purchase_Function'][$i]['ProductName'];
                        $Price = $_SESSION['Purchase_Function'][$i]['PurchasePrice'];
                        $ProductQty = $_SESSION['Purchase_Function'][$i]['PurchaseQty'];

                        echo "<tr>";
                        echo "<td>$ProductID</td>";
                        echo "<td>$ProductName</td>";
                        echo "<td>$Price</td>";
                        echo "<td>$ProductQty</td>";
                        echo "<td>" . $Price * $ProductQty . "</td>";
                        echo "<td><a href='Purchases.php?action=remove&ProductID=$ProductID' class='btn btn-danger btn-sm'>Remove</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-6">
                    <label>Total Quantity:</label>
                    <input type="int" name="qty" value="<?php echo CalculateTotalQty() ?>" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Total Price:</label>
                    <input type="int" name="priceTotal" value="<?php echo CalculateTotalAmount() ?>" class="form-control" readonly>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-6">
                    <label>Select Manufacturer:</label>
                    <select name="selectManufacturer"  class="form-control" required>
                    <option value=''>Choose Manufacturer Name</option>
                    <?php
                    
                        $select = "SELECT * from manufacturers";
                        $run = mysqli_query($connect, $select);
                        while ($data = mysqli_fetch_array($run)) {
                            $mCode = $data['Manufacturer_ID'];
                            $mName = $data['Manufacturer_Name'];
                            echo "<option value='$mCode'>$mName</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Please select Manufacturer!</div>
                </div>
                <div class="col-md-6">
                    <button name="btnSave" class="btn btn-success mt-3">Save</button>
                </div>
            </div>
        <?php
        }
        ?>
    </form>
</div>

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>
<!-- <script src="../js/FormValidate.js"></script> -->
<script>

    // function checkValid(){
    //     let rForm = document.querySelector(".rForm");
    //     rForm.addEventListener("submit", (e) => {
    //         if (!rForm.checkValidity()) {
    //             e.preventDefault();
    //             e.stopPropagation();
    //         }

    //         rForm.classList.add("was-validated");
    //     });
    // }



    document.addEventListener("DOMContentLoaded", () => {
        let vform = document.querySelector(".vForm");
        let rForm = document.querySelector(".rForm");
       

        //------This is function for form validation-----------//
        vform.addEventListener("submit", (e) => {
            if (!vform.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }

            vform.classList.add("was-validated");
        });

        rForm.addEventListener("submit", (e) => {
            if (!rForm.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }

            rForm.classList.add("was-validated");
        });
    });
</script>

