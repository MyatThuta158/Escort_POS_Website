<?php

include('../includes/header.php');
include('../includes/navbar.php');
include '../includes/ConnectDB.php';
include '../Auto_ID.php';
include 'PromotionMake.php';

//var_dump($_SESSION['promotion']);

// Handle form submission when adding a product to promotion cart
if (isset($_POST['btnAdd'])) {
    $ProductID = $_POST['selectProduct'];

    $_SESSION['promotion']=$_POST['selectPromotion'];
    // Fetch product details from the database
    $select = "SELECT ProductPrice, ProductName FROM products WHERE ProductCode='$ProductID'";
    $run = mysqli_query($connect, $select);
    $data = mysqli_fetch_array($run);

    // Extract product details
    $ProductName = $data['ProductName'];
    $amount = $_POST['promotionAmount'];
    //echo $amount;

    // Call function to add product to promotion cart
    AddPromotion($ProductID, $amount);

 
}

// Handle actions such as removing a product from the promotion cart
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'remove') {
        $ProductID = $_GET['ProductID'];
        RemoveProduct($ProductID);
    } else if ($action === 'clearall') {
        // ClearAll();
    }
}

//////////////Reset session variable for promotion////////
// if (isset($_POST['btnUpdate'])) {
//     unset($_SESSION['promotion']);
//     unset($_SESSION['sDate']);
//     unset($_SESSION['eDate']);
//     unset($_SESSION['Promotion_Function']);
//     unset($_SESSION['PromotionAmount']);
// }


if (isset($_GET['action'])){

    $action = $_GET['action'];

    if ($action=="reset") {
        unset($_SESSION['promotion']);
        unset($_SESSION['sDate']);
        unset($_SESSION['eDate']);
        unset($_SESSION['Promotion_Function']);
        unset($_SESSION['PromotionAmount']);
        echo "<script>window.location='CreatePromotion.php'</script>";
    }
}

/////////////This for save function in promotion_product table////////////
if (isset($_POST['btnSave'])) {
    
    $size=count($_SESSION['Promotion_Function']);
    $promotionCode=$_SESSION['promotion'];

   // echo $promotionCode;

    for ($i=0; $i < $size; $i++) { 
        $ProductID = $_SESSION['Promotion_Function'][$i]['ProductID'];
        $ProductName = $_SESSION['Promotion_Function'][$i]['ProductName'];
        $PromotionPrice = $_SESSION['Promotion_Function'][$i]['PromotionPrice'];

        $insert="INSERT INTO promotion_products(ProductCode,Promotion_Code,Unit_Promotion_Product_Price)Values('$ProductID','$promotionCode','$PromotionPrice')";
        $run=mysqli_query($connect,$insert);
    }

    if ($run) {
        echo "<script>window.alert('Successfully Saved Promotion Products')</script>";
        unset($_SESSION['promotion']);
        unset($_SESSION['sDate']);
        unset($_SESSION['eDate']);
        unset($_SESSION['Promotion_Function']);
        unset($_SESSION['PromotionAmount']);
    }
}
?>

<div class="container mt-4">
    <h1 class="text-center">Promotion Products</h1>

    <form action="" method="POST" class="form-group rForm" novalidate>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Promotion</label>
                    <select name="selectPromotion" id="Promotion" class="form-control" required>
                            
                            <?php
                            if (isset($_SESSION['promotion'])) {
                                $code = $_SESSION['promotion'];
                                $select = "SELECT * from promotions WHERE Promotion_Code='$code'";
                                $run = mysqli_query($connect, $select);
                                $data = mysqli_fetch_array($run);
                                $name = $data['Promotion_Name'];
                                $sDate1 = $data['PromotionStartDate'];
                                $eDate1 = $data['PromotionEndDate'];
                                $amount = $data['PromotionAmount'];
                                $_SESSION['sDate'] = $sDate1;
                                $_SESSION['eDate'] = $eDate1;
                                $_SESSION['PromotionAmount'] = $amount;
                                $price = $data['PromotionAmount'];
                                echo "<option value='$code' data-start-date='$sDate1' data-end-date='$eDate1' data-amount='$amount'>$name</option>";
                            } else {
                                echo "<option value=''>Choose Promotion</option>";
                                $select = "SELECT * from promotions";
                                $run = mysqli_query($connect, $select);
                                $count=mysqli_num_rows($run);
                                echo $count;
                                while ($data = mysqli_fetch_array($run)) {
                                    $pCode = $data['Promotion_Code'];
                                    $pName = $data['Promotion_Name'];
                                    $sDate = $data['PromotionStartDate'];
                                    $eDate = $data['PromotionEndDate'];
                                    $price = $data['PromotionAmount'];
                                    echo "<option value='$pCode' data-start-date='$sDate' data-end-date='$eDate' data-amount='$price'>$pName</option>";
                                }
                            }
                            ?>
                        </select>

                    <div class="invalid-feedback">Please Select Promotions!</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="selectProduct">Products:</label>
                    <select name="selectProduct" class="form-control" required>
                        <?php
                        echo "<option value=''>Choose Products</option>";
                        $select = "SELECT * from products";
                        $run = mysqli_query($connect, $select);
                        while ($data = mysqli_fetch_array($run)) {
                            $proCode = $data['ProductCode'];
                            $proName = $data['ProductName'];
                            echo "<option value='$proCode'>$proName</option>";
                        }
                        ?>
                    </select>
                    <div class="invalid-feedback">Please Select Products!</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="promotionAmount">Promotion percentage Amount (%)</label>
                    <?php
                    if (isset($_SESSION['PromotionAmount'])) {
                        $amount = $_SESSION['PromotionAmount'];
                        echo "<input type='number' name='promotionAmount' id='promotionAmount' value='$amount' class='form-control' readonly>";
                    } else {
                        echo "<input type='number' name='promotionAmount' id='promotionAmount' class='form-control' readonly>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="startDate">Promotion Start Date:</label>
                    <?php
                    if (isset($_SESSION['sDate'])) {
                        $sDate = $_SESSION['sDate'];
                        echo "<input type='date' value='$sDate' class='form-control' readonly>";
                    } else {
                        echo "<input type='date' id='startDate' class='form-control' readonly>";
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endDate">Promotion End Date:</label>
                    <?php
                    if (isset($_SESSION['eDate'])) {
                        $eDate = $_SESSION['eDate'];
                        echo "<input type='date' value='$eDate' class='form-control' readonly>";
                    } else {
                        echo "<input type='date' id='endDate' class='form-control' readonly>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button name="btnAdd" class="btn btn-primary">Add</button>
            <a href='CreatePromotion.php?action=reset' class='btn btn-danger btn-sm'>Reset Promotion</a>
            <!-- <button name="btnUpdate" class="btn btn-secondary">Reset Promotion</button> -->
        </div>
    </form>

    <?php
    if (empty($_SESSION['Promotion_Function'])) {
        echo "<p>No Record Found!</p>";
    } else {
    ?>
        <form action="" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Initial Price</th>
                        <th>Promotion Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $size = count($_SESSION['Promotion_Function']);
                    for ($i = 0; $i < $size; $i++) {
                        $ProductID = $_SESSION['Promotion_Function'][$i]['ProductID'];
                        $ProductName = $_SESSION['Promotion_Function'][$i]['ProductName'];
                        $initialPrice = $_SESSION['Promotion_Function'][$i]['initialPrice'];
                        $PromotionPrice = $_SESSION['Promotion_Function'][$i]['PromotionPrice'];
                        echo "<tr>";
                        echo "<td>$ProductName</td>";
                        echo "<td>$initialPrice MMK</td>";
                        echo "<td>$PromotionPrice MMK</td>";
                        echo "<td><a href='CreatePromotion.php?action=remove&ProductID=$ProductID' class='btn btn-danger btn-sm'>Remove</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button name="btnSave" class="btn btn-success mt-3">Save</button>
        </form>
    <?php
    }
    ?>
</div>

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>
<script src="../js/FormValidate.js"></script>
<script>
    document.querySelector('#Promotion').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var startDate = selectedOption.getAttribute('data-start-date');
        var endDate = selectedOption.getAttribute('data-end-date');
        var amount = selectedOption.getAttribute('data-amount');
        document.getElementById('promotionAmount').value = amount;
        document.getElementById('startDate').value = startDate;
        document.getElementById('endDate').value = endDate;
    });
</script>