<?php
  session_start();
    include('ShoppingCartFunction.php');
    include('../includes/ConnectDB.php');


    
       ///////////////////Check customer login is exist///////////
       if(!isset($_SESSION['urid']))
       {
           echo"<script>alert('Please Login!')</script>";
           echo"<script>window.location='../login.php'</script>";
       }
    

    if(isset($_POST['btnAdd'])) 
 {
     $txtProductID=$_POST['txtProductID'];
    //  echo $txtProductID;
     $txtBuyQuantity=$_POST['txtBuyQuantity'];
     $txtColor=$_POST['txtColor'];
     $txtSize=$_POST['txtSize'];
    // $pQuantity=$_POST['txtProductQuantity'];
     $qty=$_POST['qtyP'];
     $price=$_POST['txtFinal'];
    // echo $price;
     if($txtBuyQuantity>$qty)
     {
         echo "<script>alert('You order quantity is exceeed our product stock!')</script>";            
         echo "<script>window.location.href='shop.php'</script>";
     }
     else
     {
        AddProductCart($txtProductID,$txtBuyQuantity,$price,$txtColor,$txtSize);
     }
 }

 if (isset($_POST['btnCheck'])) {
  $type=$_POST['Ptype'];
  $_SESSION['PType']=$type;

  //var_dump($_SESSION['PType']);

 echo "<script>window.location.href='Payment.php'</script>";
 }

////////////////For Shopping Cart Remove///////////
 if(isset($_REQUEST['action'])) 
 {
     $action=$_REQUEST['action'];

     if ($action === 'remove') 
     {
         $ProductID=$_REQUEST['PID'];
         RemoveProduct($ProductID);
     }   
 }
//  var_dump($_SESSION['ShoppingCartFunctions']);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shopping Cart</title>
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
    <link
      rel="stylesheet"
      type="text/css"
      media="all"
      href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" type="text/css" href="css/vendor.css" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="https://kit.fontawesome.com/3ce05f7db2.js" crossorigin="anonymous"></script>
  </head>
  <body>

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
                          class="item-anchor active d-flex align-item-center"
                          data-effect="Pages"
                          >Pages<i class="icon icon-chevron-down"></i
                        ></a>
                        <ul class="submenu">

                          
                          
                          
                          <?php
                                if (isset($_SESSION['urid'])) {
                                  echo '<li>
                                  <a href="OrderStatus.php" class="item-anchor">View order status</a>
                                </li>
                                <li>
                                  <a href="UserProfile.php" class="item-anchor">Profile</a>
                                </li>
                                <li>
                                <a href="ShoppingCart.php" class="item-anchor">Shopping Cart</a>
                              </li>
                              <li>
                              <a href="LogOut.php" class="item-anchor">LogOut</a>
                            </li>';
                                }else{
                                  echo '<li>
                                  <a href="../login.php" class="item-anchor"
                                    >Login</a
                                  >
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
  

  <section class="h-100 h-custom" style="background-color: white; margin-bottom:10vh;">
  <div class="container py-4 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <div class="col-lg-8">
                <div class="p-5">
                  <div class="d-flex justify-content-between align-items-center mb-5">
                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    <h6 class="mb-0 text-muted"><?php  echo CalculateTotalQuantity(); ?> items</h6>
                  </div>
                  <hr class="my-4">


                  <?php  
                    if(!isset($_SESSION['ShoppingCartFunctions'])) 
                    {
                    echo "<p>No Product In the Cart!</p>";
                    }
                    else
                    {
                         $size=count($_SESSION['ShoppingCartFunctions']);

                        for ($i=0; $i < $size; $i++) 
                        { 
                            $ProductID=$_SESSION['ShoppingCartFunctions'][$i]['ProductID'];
                            $ProductName= $_SESSION['ShoppingCartFunctions'][$i]['ProductName'];
                            $Price=$_SESSION['ShoppingCartFunctions'][$i]['ProductPrice'];
                            $Quantity=$_SESSION['ShoppingCartFunctions'][$i]['ProductQuantity'];
                            $ProductImage=$_SESSION['ShoppingCartFunctions'][$i]['ProductImage'];
                            $ptype=$_SESSION['ShoppingCartFunctions'][$i]['ProductType'];

                            
                            ?>

                            

                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                              <img
                                src="<?php echo $ProductImage ?>"
                                class="img-fluid rounded-2" alt="Cotton T-shirt">
                            </div>
                            <!-- <div class="col-md-1 col-lg-1 col-xl-2">
                              <h6 class="text-muted">Code</h6>
                              <h6 class="text-black mb-0"><?php echo $ProductID ?></h6>
                            </div> -->
                            <div class="col-md-1 col-lg-1 col-xl-2">
                              <h6 class="text-muted">Name</h6>
                              <h6 class="text-black mb-0"><?php echo $ProductName ?></h6>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-2">
                              <h6 class="text-muted">Type</h6>
                              <h6 class="text-black mb-0"><?php echo $ptype ?></h6>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2">
                              <h6 class="text-muted">Quantity</h6>
                              <h6 class="text-black mb-0"><?php echo $Quantity ?></h6>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2">
                              <h6 class="text-muted">Price per Unit</h6>
                              <h6 class="text-black mb-0"><?php echo $Price ?></h6>
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end mt-md-2">
                            <!-- <h4 class="text-muted">Remove</h4> -->
                              <a href='ShoppingCart.php?action=remove&PID=<?php echo $ProductID?>'><i class="fa-solid fa-trash" style="font-size: 24px; margin-top:7vh;"></i></a>
                            </div>
                          </div>

                          <hr class="my-4">
                          

                    <?php
                        }
                    }
                    ?>

                  
                  
                  <div class="mt-8" style="margin-top: 10vh;">
                    <h6 class="mb-0"><a href="shop.php" class="text-body"><i
                          class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 bg-grey" style="height: 90vh; ">
                <div class="p-2">
                  <h3 class="fw-bold mb-5 mt-4 pt-1 text-center" style="margin-top: 10vh;">Summary</h3>
                  <!-- <hr class="my-4"> -->
                  <!-- <hr class="my-4" style="color: whitesmoke;"> -->

                  <div class="d-flex justify-content-between mb-4" style="margin-top: 8vh;">
                    <div class="row d-flex">
                      <div>
                        <h6 class="text-uppercase" style="padding-left: 3vw;">Total Quantity:</h6>
                      </div>
                      <div>
                        <h6 class="text-muted" style="padding-left: 2vw;"><?php  echo CalculateTotalQuantity(); ?></h6>
                      </div>
                    </div>
                  </div>

                <div class="d-flex justify-content-between mb-4">
                  <div class="row d-flex">
                      <div>
                        <h6 class="text-uppercase" style="padding-left: 3vw;">Total Amount:</h6>
                      </div>
                      <div>
                         <h6 class="text-muted" style="padding-left: 2vw;"><?php  echo CalculateTotalAmount(); ?>MMK</h6>
                      </div>
                    </div>
                  </div>

                  <form action="" method="POST" class="rForm" novalidate>
                      <div class="d-flex justify-content-between mb-4">
                      <div class="row">
                          <div>
                            <h6 class="text-uppercase" style="padding-left: 3vw;">Payment Type:</h6>
                          </div>
                          <div>
                            <Select name="Ptype" class="custom-select w-100" style="margin-left: 3vw; border:1px solid black; " required>
                              <option value="">Choose Payment Type</option>
                              <option value="Kpay">Kpay</option>
                              <option value="Wave">Wave Pay</option>
                              <option value="AYApay">AYA Pay</option>
                            </Select>
                            <div class="invalid-feedback">Please Select payment type!</div>
                          </div>
                        </div>
                      </div>

                     
                      
                      <button type="submit" name="btnCheck" class="btn btn-dark btn-block mr-1 btn-lg"  
                        data-mdb-ripple-color="dark">Check Out</button>
                      
                      
                        <div style="margin-left: 9vw;">
                        <a href="shop.php" class="text-body"><i
                              class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a>
                        </div>
                    </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

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
                    <a href="contact.php">Contact us</a>
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

  <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
    <script src="../js/FormValidate.js"></script>
  </body>