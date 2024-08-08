<?php
    session_start();
    include('../includes/ConnectDB.php');




    if(isset($_REQUEST['ProductID']))
    {
        $pid=$_REQUEST['ProductID'];
        $select="SELECT 
        products.*, 
        IF(
            promotion_products.Unit_Promotion_Product_Price IS NOT NULL
            AND CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate,
            promotion_products.Unit_Promotion_Product_Price,
            products.ProductPrice
        ) AS final_price, pt.ProductTypeName
    FROM 
        products
    JOIN 
        product_type pt ON products.ProductTypeID = pt.ProductTypeID
    LEFT JOIN 
        promotion_products ON products.ProductCode = promotion_products.ProductCode
    LEFT JOIN 
        promotions ON promotion_products.Promotion_Code = promotions.Promotion_Code
    WHERE 
        products.ProductCode = '$pid';
    ";
        $query=mysqli_query($connect,$select);
        $data=mysqli_fetch_array($query);
        $productid=$data['ProductCode'];
        $productname=$data['ProductName'];
        $ProductImage=$data['Product_Image'];        
        $ProductPrice=$data['ProductPrice'];
        $productType=$data['ProductTypeName'];
        $color=$data['ProductAvailableColor'];
        $final=$data['final_price'];
        $size=$data['ProductAvailableSize'];
        $qty=$data['Product_Quantity'];
  
        
    }

 
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ultras - Clothing Store eCommerce Store HTML Website Template</title>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
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
    <section style="margin-bottom: 10vh;">
  <div class="container mt-5">
    <div class="row justify-content-center "> <!-- Center the form horizontally -->
      <form action="ShoppingCart.php" method="POST" class="formQty rForm" novalidate>
        <fieldset>
          <legend>Product Detail:</legend>
          <div class="row">
            <div class="col-md-5">
              <img src="<?php echo $ProductImage ?>" class="img-fluid" alt="Product Image" style="max-width: 100%; height:75vh;">
            </div>
            <div class="col-md-7"> <!-- Adjusted column width for smaller screens -->
              <table class="table">
                <tr>
                  <td>Product Name:</td>
                  <td><?php echo $productname ?></td>
                </tr>
                <tr>
                  <td>Product Type:</td>
                  <td><?php echo $productType ?></td>
                </tr>
                <tr>
                  <td>Available Size:</td>
                  <td><?php echo $size ?></td>
                </tr>
                <tr>
                  <td>Available Color:</td>
                  <td><?php echo $color ?></td>
                </tr>
                <tr>
                  <td>Product Price:</td>
                  <td>
                    <?php 
                      if ($final != $ProductPrice) {
                        echo "<strike>$ProductPrice</strike>";
                        echo $final;
                        ?>
                          <input type="hidden" name="txtFinal" class="form-control" value="<?php echo $final ?>">
                        <?php
                      } else {
                        echo $ProductPrice;
                        ?>
                          <input type="hidden" name="txtFinal" class="form-control" value="<?php echo $ProductPrice ?>">
                        <?php
                      }
                    ?>
                    MMK
                  </td>
                </tr>
                <tr>
                  <td>Maximum Order Quantity:</td>
                  <td style="color: red;"><?php echo $qty ?></td>
                </tr>
                <tr>
                  <td>Order quantity:</td>
                  <td>
                    <input type="number" class="form-control" name="txtBuyQuantity" value="1" min="1" required>
                    <div class="invalid-feedback">Please Enter Order quantity!</div>
                </td>
                </tr>
                <tr>
                  <td>Order color:</td>
                  <td>
                    <div>
                      <input type="text" class="form-control" name="txtColor" required>
                      <div class="invalid-feedback">Please Enter Order color!</div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>Order size:</td>
                  <td>
                    <input type="text" class="form-control" name="txtSize" required>
                    <div class="invalid-feedback">Please Enter Order size!</div>
                  </td>
                </tr>
                <tr>
                  <input type="hidden" name="txtProductID" value="<?php echo $productid ?>">
                  <input type="hidden" name="qtyP" class="mQty" value="<?php echo $qty ?>">
                  <?php
                    if ($qty == 0) {
                      echo "<td><h3 style='color:red'>Out of Stock</h3></td>";
                    } else {
                      echo '<td>
                              <div class="input-group">
                                <div class="input-group-append">
                                  <button class="btn btn-primary" type="submit" name="btnAdd">Add to Cart</button>
                                </div>
                              </div>
                            </td>';
                    }
                  ?>
                </tr>
              </table>
            </div>
          </div>
        </fieldset>
      </form>
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


    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
    <script src='../js/FormValidate.js'></script>
   

    </body>
</html>