<?php

	// unset($_SESSION['ShoppingCartFunctions']);
	include('../includes/ConnectDB.php');
    function AddProductCart($ProductID,$BuyQuantity,$price,$color,$size)
    {
        include('../includes/ConnectDB.php');
	$query="SELECT * FROM products p, product_type pt
     WHERE p.ProductTypeID=pt.ProductTypeID
     and p.ProductCode='$ProductID'";
	// $query="SELECT * from products";
	$result=mysqli_query($connect,$query);
	$count=mysqli_num_rows($result);
	$arr=mysqli_fetch_array($result);
    $productname=$arr['ProductName'];
    $Ptname=$arr['ProductTypeName'];
	$ProductImage=$arr['Product_Image'];
    $ProductPrice=$price;

	
   

	if($count < 1) 
	{
		echo "<p>No Product Found!</p>";
		exit();
	}

	if($BuyQuantity < 1) 
	{
		echo "<script>window.alert('Please enter correct Quantity.')</script>";
		exit();
	}

    if(isset($_SESSION['ShoppingCartFunctions'])) 
	{
		$Index=IndexOf($ProductID);

		if($Index == -1) 
		{
			$size=count($_SESSION['ShoppingCartFunctions']);
			$_SESSION['ShoppingCartFunctions'][$size]['ProductID']=$ProductID;
            $_SESSION['ShoppingCartFunctions'][$size]['ProductName']=$productname;
		    $_SESSION['ShoppingCartFunctions'][$size]['ProductPrice']=$price;
            $_SESSION['ShoppingCartFunctions'][$size]['ProductType']=$Ptname;
		    $_SESSION['ShoppingCartFunctions'][$size]['ProductQuantity']=$BuyQuantity;
			$_SESSION['ShoppingCartFunctions'][$size]['ProductImage']=$ProductImage;
			$_SESSION['ShoppingCartFunctions'][$size]['ProductColor']=$color;
			$_SESSION['ShoppingCartFunctions'][$size]['ProductSize']=$size;

			
		}
		else
		{
			$_SESSION['ShoppingCartFunctions'][$Index]['ProductQuantity']+=$BuyQuantity;
		}
	}

    else
    {
        $_SESSION['ShoppingCartFunctions']=array(); //Create Session Array        
		$_SESSION['ShoppingCartFunctions'][0]['ProductID']=$ProductID;
        $_SESSION['ShoppingCartFunctions'][0]['ProductName']=$productname;
		$_SESSION['ShoppingCartFunctions'][0]['ProductPrice']=$ProductPrice;
        $_SESSION['ShoppingCartFunctions'][0]['ProductType']=$Ptname;
		$_SESSION['ShoppingCartFunctions'][0]['ProductQuantity']=$BuyQuantity;
		$_SESSION['ShoppingCartFunctions'][0]['ProductImage']=$ProductImage;
		$_SESSION['ShoppingCartFunctions'][0]['ProductColor']=$color;
		$_SESSION['ShoppingCartFunctions'][0]['ProductSize']=$size;

		
    }


}
function CalculateTotalQuantity()
{
	if(isset($_SESSION['ShoppingCartFunctions'])) 
	{
		$TotalQuantity=0;

		$size=count($_SESSION['ShoppingCartFunctions']);

		for ($i=0; $i < $size; $i++) 
		{ 
			$ProductQuantity=$_SESSION['ShoppingCartFunctions'][$i]['ProductQuantity'];
			$TotalQuantity += ($ProductQuantity);
		}

		return $TotalQuantity;
	}
	else
	{
		$TotalQuantity=0;

		return $TotalQuantity;
	}
}


function CalculateTotalAmount()
{
	if(isset($_SESSION['ShoppingCartFunctions'])) 
	{
		$TotalAmount=0;

		$size=count($_SESSION['ShoppingCartFunctions']);

		for ($i=0; $i < $size; $i++) 
		{ 
			$ProductQuantity=$_SESSION['ShoppingCartFunctions'][$i]['ProductQuantity'];
			$ProductPrice=$_SESSION['ShoppingCartFunctions'][$i]['ProductPrice'];
			$TotalAmount += ($ProductQuantity * $ProductPrice);
		}

		return $TotalAmount;
	}
	else
	{
		$TotalAmount=0;

		return $TotalAmount;
	}
}
function RemoveProduct($ProductID)
{
	$Index=IndexOf($ProductID);

	unset($_SESSION['ShoppingCartFunctions'][$Index]);

	$_SESSION['ShoppingCartFunctions']=array_values($_SESSION['ShoppingCartFunctions']);

	echo "<script>window.location='ShoppingCart.php'</script>";
}


function IndexOf($ProductID)
{
	if(!isset($_SESSION['ShoppingCartFunctions'])) 
	{
		return -1;
	}
	if(isset($_SESSION['ShoppingCartFunctions'])) 
	{
		$size=count($_SESSION['ShoppingCartFunctions']);
		if ($size < 1) 
		{
			return -1;
		}
		else
		{
			for ($i=0; $i < $size; $i++) 
			{ 
				if($ProductID == $_SESSION['ShoppingCartFunctions'][$i]['ProductID']) 
				{
					return $i;
				}
			}
			return -1;
		}
	}
}
?>