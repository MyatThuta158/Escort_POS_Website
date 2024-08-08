<?php

function AddPromotion($ProductID, $amount)
{
    include '../includes/ConnectDB.php';
    global $connect; // Add this line to access the global variable

    $query = "SELECT * FROM products WHERE ProductCode='$ProductID'";
    $result = mysqli_query($connect, $query);
    $count = mysqli_num_rows($result);
    $arr = mysqli_fetch_array($result);

    $name=$arr['ProductName'];
    $img=$arr['Product_Image'];
    $price=$arr['ProductPrice'];


   //var_dump($arr['ProductPrice']);

    if ($count < 1) {
        echo "<p>No Product Found!</p>";
        //exit();
    } else {
        if (isset($_SESSION['Promotion_Function'])) {
            $Index=IndexOf($ProductID);
            if ($Index==-1) {
                $size = count($_SESSION['Promotion_Function']);
                // echo $amount;
     
                $promotionPrice = (float)$price - ((float)$price * (float)$amount / 100);
     
                // $promotionPrice= $amount/ 100;
                // echo $promotionPrice;
     
                 $_SESSION['Promotion_Function'][$size]['ProductID'] = $ProductID;
                 $_SESSION['Promotion_Function'][$size]['ProductName'] = $name;
                 $_SESSION['Promotion_Function'][$size]['ProductImg'] = $img;
                 $_SESSION['Promotion_Function'][$size]['initialPrice'] = $price;
                 $_SESSION['Promotion_Function'][$size]['PromotionPrice'] = $promotionPrice;
            }
            else{
                $_SESSION['Promotion_Function'][$Index]['ProductName'] = $name;
            }
           
        } else {
            $_SESSION['Promotion_Function'] = array();

            // Initialize $size based on the length of $_SESSION['Promotion_Function']
            $size = count($_SESSION['Promotion_Function']);

            $promotionPrice = $arr['ProductPrice'] - ($arr['ProductPrice'] * $amount / 100);

            $_SESSION['Promotion_Function'][0]['ProductID'] = $ProductID;
            $_SESSION['Promotion_Function'][0]['ProductName'] = $name;
            $_SESSION['Promotion_Function'][0]['ProductImg'] = $img;
            $_SESSION['Promotion_Function'][0]['initialPrice'] = $price;
            $_SESSION['Promotion_Function'][0]['PromotionPrice'] = $promotionPrice;
        }
    }
}

//-----------------This is remove product Function------//
function RemoveProduct($ProductID){
    $Index=Indexof($ProductID);
    //echo $Index;
    // echo $ProductID;
    unset($_SESSION['Promotion_Function'][$Index]);
    $_SESSION['Promotion_Function']=array_values($_SESSION['Promotion_Function']);

    echo "<script>window.location='CreatePromotion.php'</script>";
}

function Indexof($ProductID){
    if (!isset($_SESSION['Promotion_Function'])) {
        return -1;
    }

    if (isset($_SESSION['Promotion_Function'])) {
        $size=count($_SESSION['Promotion_Function']);


        if ($size<1) {
            return -1;
        }
        else{
            for ($i=0; $i < $size ; $i++) { 
               if ($ProductID==$_SESSION['Promotion_Function'][$i]['ProductID']) {
                return $i;
               // echo $i;
               }
            }
            return -1;
        }
    }
}
?>
