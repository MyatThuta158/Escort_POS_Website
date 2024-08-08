<?php

function AddProduct($ProductID, $PurchasePrice, $PurchaseQty)
{
    include '../includes/ConnectDB.php';
    global $connect; // Add this line to access the global variable

    $query = "SELECT * FROM products WHERE ProductCode='$ProductID'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
    $arr = mysqli_fetch_array($result);

    if ($count < 1) {
        echo "<p>No Product Found!</p>";
        exit();
    }

    if ($PurchaseQty < 1) {
        echo "<script>window.alert('Please Enter Correct Quantity')</script>";
        echo "<script>window.location.href='Purchases.php'</script>";
    }else{

    if (isset($_SESSION['Purchase_Function'])) {
        $Index=Indexof($ProductID);

        if ($Index == -1) {
            $size=count($_SESSION['Purchase_Function']);

            $_SESSION['Purchase_Function'][$size]['ProductID']=$ProductID;
            $_SESSION['Purchase_Function'][$size]['PurchasePrice']=$PurchasePrice;
            $_SESSION['Purchase_Function'][$size]['PurchaseQty']=$PurchaseQty;

            $_SESSION['Purchase_Function'][$size]['ProductName']=$arr['ProductName'];
            //$_SESSION['Purchase_Function'][$size]['ProductImage']=$arr['ProductImage'];
        }
        else{
            $_SESSION['Purchase_Function'][$Index]['PurchaseQty'] += (int)$PurchaseQty;
        }
    } else{
        $_SESSION['Purchase_Function'] = array();
        
   // $index = count($_SESSION['Purchase_Function']);
    $_SESSION['Purchase_Function'][0]['ProductID'] = $ProductID;
    $_SESSION['Purchase_Function'][0]['PurchasePrice'] = $PurchasePrice;
    $_SESSION['Purchase_Function'][0]['PurchaseQty'] = $PurchaseQty;

    $_SESSION['Purchase_Function'][0]['ProductName'] = $arr['ProductName'];
   // $_SESSION['Purchase_Function'][$index]['ProductImage'] = $arr['ProductImage'];
    }
}


}


//-----------------This is remove product Function------//
function RemoveProduct($ProductID){
    $Index=Indexof($ProductID);
    unset($_SESSION['Purchase_Function'][$Index]);
    $_SESSION['Purchase_Function']=array_values($_SESSION['Purchase_Function']);

    echo "<script>window.location='Purchases.php'</script>";
}

function Indexof($ProductID){
    if (!isset($_SESSION['Purchase_Function'])) {
        return -1;
    }

    if (isset($_SESSION['Purchase_Function'])) {
        $size=count($_SESSION['Purchase_Function']);

        if ($size<1) {
            return -1;
        }
        else{
            for ($i=0; $i < $size ; $i++) { 
               if ($ProductID==$_SESSION['Purchase_Function'][$i]['ProductID']) {
                return $i;
               }
            }
            return -1;
        }
    }
}


function CalculateTotalAmount(){
    if (isset($_SESSION['Purchase_Function'])) {
        $TotalAmount=0;

        $size=count($_SESSION['Purchase_Function']);

        for ($i=0; $i < $size; $i++) { 
            $PurchaseQty=$_SESSION['Purchase_Function'][$i]['PurchaseQty'];
            $PurchasePrice=$_SESSION['Purchase_Function'][$i]['PurchasePrice'];
            $TotalAmount +=($PurchaseQty*$PurchasePrice);
        }

        return $TotalAmount;
    }
}


function CalculateTotalQty(){
    if (isset($_SESSION['Purchase_Function'])) {
        $TotalQty=0;

        $size=count($_SESSION['Purchase_Function']);

        for ($i=0; $i <$size ; $i++) { 
            $PurchaseQty=$_SESSION['Purchase_Function'][$i]['PurchaseQty'];
            $TotalQty+=($PurchaseQty);
        }
        return $TotalQty;
    }
}
?>
