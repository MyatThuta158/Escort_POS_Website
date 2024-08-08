<?php
    session_start();
    include('../includes/ConnectDB.php');

    if (!isset($_SESSION['urid'])) {
        echo "<script>window.alert('Please Login!')</script>";
        echo "<script>window.location.href='../login.php'</script>";
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
<?php  
   
    $id=$_SESSION['urid'];

    $query="SELECT * from orders where Customer_ID='$id'";
    $run=mysqli_query($connect,$query);
    $count=mysqli_num_rows($run);

    if ($count>0) {

        echo "<div class='table-responsive mt-4 mb-4'>";
        echo "<table class='table table-striped'>";

        echo "<thead>
                <tr>
                    <th>Order Code</th>
                    <th>Total Quantity</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>";

        echo "<tbody>";

        for ($i=0; $i < $count; $i++) { 
            $data=mysqli_fetch_array($run);

            $code=$data['Order_Code'];
            $qty=$data['TotalQuantity'];
            $price=$data['TotalAmount'];
            $date=$data['OrderDate'];
            $status=$data['Order_Status'];

            if ($status=="Declined") {
                echo "<tr>
                <td>$code</td>
                <td>$qty</td>
                <td>$price</td>
                <td>$date</td>
                <td>$status</td>
                <td><a href='DeclineInfo.php?Did=$code' class='btn btn-info'>About Declined</a></td>
            </tr>";
            }else{
                echo "<tr>
                <td>$code</td>
                <td>$qty</td>
                <td>$price</td>
                <td>$date</td>
                <td>$status</td>
                
            </tr>";
            }
           
        }
        
        echo "</tbody>";
        echo "</table>";
        echo "</div>";
    }

    
?>

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
</body>
</html>