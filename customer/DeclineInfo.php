<?php
session_start();
    include('../includes/ConnectDB.php');


    ///////////////////Check customer login is exist///////////
    if(!isset($_SESSION['urid']))
    {
        echo"<script>alert('Please Login!')</script>";
        echo"<script>window.location='../login.php'</script>";
    }

    if (isset($_REQUEST['Did'])) {
        $id=$_REQUEST['Did'];
    
    
        $select = "SELECT o.*, c.Customer_Name FROM orders o INNER JOIN customers c ON o.Customer_ID = c.Customer_ID WHERE o.Order_Code='$id'";
        $query=mysqli_query($connect,$select);
        $count=mysqli_num_rows($query);
        if ($count>0) {
            $data=mysqli_fetch_array($query);
            $orderCode=$data['Order_Code'];
            $cusName=$data['Customer_Name'];
            $qty=$data['TotalQuantity'];
            $amount=$data['TotalAmount'];
            $Ptype=$data['PaymentType'];
            $pImg=$data['Payment_Image'];
            $date=$data['OrderDate'];  
       
        }else{
            echo "fail";
        }
    }else{
        echo "nothing";
    }

    if (isset($_POST['btnSubmit'])) {
        $id=$_REQUEST['Did'];
        $pimg = $_FILES['payImg']['name'];

        $folder="images/";
     if ($pimg) {
        $filename=$folder.''.$pimg;
        $copy=copy($_FILES['payImg']['tmp_name'],$filename);

        if ($copy) {
            $update = "UPDATE orders SET Payment_Image='$filename',Order_Status='Pending.....' WHERE Order_Code='$id'";
            $query2 = mysqli_query($connect, $update);

            if ($query2) {
                echo "<script>window.alert('Payment Information is submitted')</script>";
                 echo "<script>window.location.href='OrderStatus.php'</script>";
            }
    }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Status</title>
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

<form action="" method="POST" enctype="multipart/form-data" class="rForm needs-validation" novalidate>
<div class="container mt-5 ">
    <div class="row" style="margin-bottom: 10vh;">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    Order information
                </div>
                <div class="card-body">
                    <h5 class="card-title">Order Code: <?php echo $orderCode; ?></h5>
                    <p class="card-text">Total Quantity: <?php echo $qty; ?></p>
                    <p class="card-text">Total Amount: <?php echo $amount; ?></p>
                    <p class="card-text">Payment Type: <?php echo $Ptype; ?></p>
                    <p class="card-text">Order Date: <?php echo $date; ?></p>
                    <div>
                        <h4 class="text-danger">About Decline</h4>
                        <p class="text-danger">Your order is declined due to incorrect payment information such incorrect payment amount or screenshot is blur and does not contain payment number.
                            So, Please resubmit the payment screenshot.
                        </p>
                    </div>

                    <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="payImg" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="updateFileName(this)" required>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                <div class="invalid-feedback">Insert Payment Screenshot!</div>
                            </div>
                        </div>
                    </div>
                    <!-- <img src="../customer/<?php echo $pImg; ?>" alt="Payment Image" class="img-fluid mb-3"> -->
                    <div class="btn-group d-block" role="group" aria-label="Payment Confirmation Buttons">
                        <button type="submit" name="btnSubmit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

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


<script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
</body>
</html>