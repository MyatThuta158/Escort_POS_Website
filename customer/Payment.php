<?php
  session_start();
   include ('../includes/ConnectDB.php');
   include ('ShoppingCartFunction.php');
   include ('../Auto_ID.php');

 
   ///////////////////Check customer login is exist///////////
   if(!isset($_SESSION['urid']))
    {
        echo"<script>alert('Please Login!')</script>";
        echo"<script>window.location='../login.php'</script>";
    }
   
   if (isset($_SESSION['PType'])) {
    $type=$_SESSION['PType'];
        if ($type=="Kpay") {
            $img='images/KPayQR.jpg';
        }
        elseif($type=="Wave"){
            $img="images/wave-qr.jpg";
        }
        elseif($type=="AYApay"){
            $img="images/QR.jpg";
        }else{
            $img="COD";
        }
   }else{
    echo "null";
   }


  

   //////////////This for adding database section//////////

   if (isset($_POST['btnSave'])) {

    echo "<script>alert('CheckOut Successfully. We will tell your payment is success or not. Please check the order status frequently.')</script>";
     $qty=CalculateTotalQuantity();
     $amount=CalculateTotalAmount();
        $Cid=$_SESSION['urid'];
     $pt=$_SESSION['PType'];
     $pimg = $_FILES['payImg']['name'];
     $status="Pending.....";
     $orderDate=date('Y-m-d');
     $orderCode=$_POST['oCode'];
     $phno=$_POST['phNo'];
     $address=$_POST['address'];
    //  $color=$_SESSION['color'];
    //  $size=$_SESSION['size'];

  

     $folder="images/";
     if ($pimg) {
        $filename=$folder.''.$pimg;
        $copy=copy($_FILES['payImg']['tmp_name'],$filename);

        if ($copy) {
            $query="INSERT into orders (Order_Code,Customer_ID,TotalQuantity,TotalAmount,PaymentType,Payment_Image,Order_Status,OrderDate,ReceiverPhoneNo,DeliveryAddress) 
            values ('$orderCode','$Cid','$qty','$amount','$pt','$filename','$status','$orderDate','$phno','$address')";
            $run=mysqli_query($connect,$query);
            // if($run)
            // {
                $size1=count($_SESSION['ShoppingCartFunctions']);
            //  echo $size;
            //  echo "<br>";

                for ($i=0; $i < $size1; $i++) 
                { 
                  
                   $productid=$_SESSION['ShoppingCartFunctions'][$i]['ProductID'];
                  $price=$_SESSION['ShoppingCartFunctions'][$i]['ProductPrice'];
                   $quantity=$_SESSION['ShoppingCartFunctions'][$i]['ProductQuantity'];
                    $amount=$_SESSION['ShoppingCartFunctions'][$i]['ProductQuantity'] + $_SESSION['ShoppingCartFunctions'][$i]['ProductQuantity'];
                    $color=$_SESSION['ShoppingCartFunctions'][$i]['ProductColor'];
		                $size=$_SESSION['ShoppingCartFunctions'][$i]['ProductSize'];

                    

                    // echo $color;
                    // echo $size;

                    // var_dump($_SESSION['ShoppingCartFunctions']);
        
                    $insert1="INSERT  INTO order_products(Order_Code,ProductCode,UnitQuantity,UnitAmount,Order_Color,Order_Size) values('$orderCode','$productid','$quantity','$price','$color','$size')";
                    $query1=mysqli_query($connect,$insert1);

                //     // if ($query1) {
                //     //     $update="UPDATE products set Product_Quantity=Product_Quantity-$quantity where ProductCode='$productid'";
                //     //      $query2=mysqli_query($connect,$update);
                //     // }else{
                //     //     echo"<script>alert('Error')</script>";
                //     // }
        
                     
                }
                
                  
                  // Unset session variable
                  unset($_SESSION['ShoppingCartFunctions']);
                  
                  // Redirect to home page
                  echo "<script>window.location.href='index.php';</script>";
                  exit; // Make sure to exit after the redirect to prevent further execution of the script
                  
                  
                    
                // }
            // }
        }else{
            echo "<script>alert('Image insert problem!')</script>";
        }
     }
    }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Payment</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css" />
    <link rel="stylesheet" type="text/css" media="all" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/vendor.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="js/modernizr.js"></script>
    <script src="https://kit.fontawesome.com/3ce05f7db2.js" crossorigin="anonymous"></script>

</head>
<body>




<div class="position-absolute m-0 w-100 bg-secondary overflow-hidden modalQR" style="height: 183vh;  z-index: 990; display:none;">
    <div class="position-absolute offset-11 mt-5 text-danger crossSign" style="z-index: 999; font-size:30px; cursor:pointer;" onclick="ModalClose()">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <img src="<?php echo $img ?>" alt="" class="position-absolute img-fluid col-md-4 offset-md-4" style="z-index: 999;  margin-top: 20%;">
</div>

<!-- ----------This is header ---------------->
<header id="header">
      <div id="header-wrap">
        <nav class="secondary-nav border-bottom">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-md-4 header-contact">
                <p>Let's talk! <strong>+95 9 951 888801</strong></p>
              </div>

              <?php

                if (isset($_SESSION['urid'])) {
                  echo '<div class="col-md-8 col-sm-12 user-items">
                  <ul class="d-flex justify-content-end list-unstyled ml-auto">
                    <li>
                      <a href="UserProfile.php">
                        <i class="icon icon-user"></i>
                      </a>
                    </li>
                    <li>
                      <a href="ShoppingCart.php">
                        <i class="icon icon-shopping-cart"></i>
                      </a>
                    </li>
                    <li>
                      <a href="OrderStatus.php">
                        <i class="fa-solid fa-desktop"></i>
                      </a>
                    </li>
                  </ul>
                </div>';
                }
                else{
                  echo '<h6 class="d-flex justify-content-end list-unstyled ml-auto col-md-12 col-sm-12 user-items"><a href="User_Register.php" class=""><i class="fa-solid fa-user-plus"></i>Register Account</a></h6>';
                }

              ?>
              
            </div>
          </div>

          
        </nav>

        <nav class="primary-nav padding-small">
          <div class="container">
            <div class="row d-flex align-items-center">
              <div class="col-lg-2 col-md-2">
                <div class="main-logo">
                  <a href="index.php">
                    <img src="images/logo (1).jpg" alt="logo" />
                  </a>
                </div>
              </div>
              <div class="col-lg-10 col-md-10">
                <div class="navbar">
                  <div
                    id="main-nav"
                    class="stellarnav d-flex justify-content-end right"
                  >
                    <ul class="menu-list">
                      <li class="menu-item has-sub">
                        <a
                          href="index.php"
                          class="item-anchor d-flex align-item-center"
                          data-effect="Home"
                          >Home</i
                        ></a>
                      </li>


                      <li class="menu-item has-sub">
                        <a
                          href="shop.php"
                          class="item-anchor d-flex align-item-center"
                          data-effect="Shop"
                          >Shop</a>
                      </li>

                      <li>
                        <a
                          href="about.php"
                          class="item-anchor"
                          data-effect="About"
                          >About</a
                        >
                      </li>
                      <li class="menu-item has-sub">
                        <a
                          href="#"
                          class="item-anchor d-flex align-item-center"
                          data-effect="Pages"
                          >Pages<i class="icon icon-chevron-down"></i
                        ></a>
                        <ul class="submenu">

                          
                          
                          <li>
                            <a href="../login.php" class="item-anchor"
                              >Login</a
                            >
                          </li>
                          <?php
                                if (isset($_SESSION['urid'])) {
                                  echo '<li>
                                  <a href="blog.html" class="item-anchor">View order status</a>
                                </li>
                                <li>
                                  <a href="UserProfile.php" class="item-anchor">Profile</a>
                                </li>
                                <li>
                                <a href="ShoppingCart.php" class="item-anchor">Shopping Cart</a>
                              </li>';
                                }
                          ?>
                          <li>
                            <a href="thank-you.php" class="item-anchor"
                              >Thankyou</a
                            >
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a
                          href="contact.php"
                          class="item-anchor"
                          data-effect="Contact"
                          >Contact</a
                        >
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>



<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="POST" enctype="multipart/form-data" class="rForm needs-validation w-100" novalidate>
                <h2 class="text-center">Delivery information</h2>
                <input type="hidden" name="oCode" value="<?php echo Auto_ID('orders', 'Order_Code', 'O-', 6)?>">

                <!-- <div class="form-group">
                    <h4>Receiver Name</h4>
                    <input type="text"  class="form-control" placeholder="Enter Receiver Name" required>
                    <div class="invalid-feedback">Enter receiver name for delivery</div>
                </div> -->

                <div class="form-group">
                    <h4>Receiver Phone Number</h4>
                    <input type="text" name="phNo" class="form-control" placeholder="Enter Receiver Phone Number" required>
                    <div class="invalid-feedback">Enter Receiver Phone Number for delivery</div>
                </div>

                <div class="form-group">
                    <h4>Delivery Address</h4>
                    <textarea name="address" placeholder="Please Enter delivery address" class="w-100" required></textarea>
                    <div class="invalid-feedback">Enter delivery address</div>
                </div>


               <?php

                    if ($img!=="COD") {
                        echo ' <div class="form-group">
                        <h4>Payment Screenshot</h4>
                        <button type="button" class="btn btn-primary mb-1" data-toggle="button" aria-pressed="false" onclick="ModalOpen()">Get QR Scan</button>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="payImg" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="updateFileName(this)" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                <div class="invalid-feedback">Insert Payment Screenshot!</div>
                            </div>
                        </div>
                    </div>';
                    }

                ?>
               
                

                <input type="submit" value="Save" name="btnSave">
                <h6><a href="ShoppingCart.php">Back</a></h6>
                
            </form>
        </div>
    </div>
</div>

<footer id="footer">
      <div class="container">
        <div class="footer-menu-list">
          <div class="row d-flex flex-wrap justify-content-between">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <h5 class="widget-title">Pages</h5>
                <ul class="menu-list list-unstyled">
                  <li class="menu-item">
                    <a href="index.php">Home</a>
                  </li>
                  <li class="menu-item">
                    <a href="shop.php">Shop page </a>
                  </li>
                  <li class="menu-item">
                    <a href="about.php">About us</a>
                  </li>
                  <li class="menu-item">
                    <a href="contact.html">Contact us</a>
                  </li>
                  <li class="menu-item">
                    <a href="../login.php">Login</a>
                  </li>
                  <li class="menu-item">
                    <a href="User_Register.php">Register Account</a>
                  </li>
                </ul>
              </div>
            </div>

          
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <h5 class="widget-title">Contact Us</h5>
                <p>
                  Do you have any questions or suggestions?
                  <a href="#" class="email">ourservices@escort.com</a>
                </p>
                <p>
                  Do you need assistance? Give us a call. <br />
                  <strong>+95 9 951 888801</strong>
                </p>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="footer-menu">
                <h5 class="widget-title">About Escort</h5>
                <p>
                  Escort Fashion is a well-known brand that produce fashion ware both men, women and kids.
                  Customers can buy fashion from both physical store that exist in Myanmar and online e-commerce website.
                </p>
                <div class="social-links">
                  <ul class="d-flex list-unstyled">
                    <li>
                      <a href="https://www.facebook.com/">
                        <i class="icon icon-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://twitter.com/">
                        <i class="icon icon-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.youtube.com/">
                        <i class="icon icon-youtube-play"></i>
                      </a>
                    </li>
                    
                    <li>
                      <a href="https://www.instagram.com/">
                      <i class="fa-brands fa-square-instagram"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
    </footer>

    <div id="footer-bottom">
      <div class="container">
        <div
          class="d-flex align-items-center flex-wrap justify-content-between"
        >

          <div class="payment-method">
            <p>Payment options :</p>
            <div class="card-wrap">
              <img src="images/kpay.png" alt="visa" class="img-fluid"/>
              <img src="images/wave.jpg" alt="mastercard" />
              <img src="images/aya.jpg" alt="american-express" />
            </div>
          </div>
        </div>
      </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="../js/FormValidate.js"></script>
<script>
function updateFileName(input) {
  var fileName = input.files[0].name;
  var label = input.nextElementSibling;
  label.innerText = fileName;
}

function ModalOpen(){
    let form=document.querySelector('.modalQR');
    form.style.display="block";
}

function ModalClose(){
    let form=document.querySelector('.modalQR');
    // let crossSign=document.querySelector('.crossSign');
    form.style.display="none";
}

</script>
</body>
</html>
