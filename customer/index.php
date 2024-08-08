<?php
  session_start();
  include('../includes/ConnectDB.php');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Home</title>
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
                          class="item-anchor active d-flex align-item-center"
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


    <section id="billboard" class="overflow-hidden">
      <button class="button-prev">
        <i class="icon icon-chevron-left"></i>
      </button>
      <button class="button-next">
        <i class="icon icon-chevron-right"></i>
      </button>
      <div class="swiper main-swiper">
        <div class="swiper-wrapper">
          <div
            class="swiper-slide"
            style="
              background-image: url('images/banner2.jpg');
              background-repeat: no-repeat;
              background-size: cover;
              background-position: center;
            "
          >
            <div class="banner-content">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <h2 class="banner-title">Summer Collection</h2>
                    <p>
                      We have summer collection that is suitable for every type of seasons in Myanmar
                    </p>
                    <div class="btn-wrap">
                      <a
                        href="shop.php"
                        class="btn btn-light btn-medium d-flex align-items-center"
                        tabindex="0"
                        >Shop it now <i class="icon icon-arrow-io"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="swiper-slide"
            style="
              background-image: url('images/banner1.jpg');
              background-repeat: no-repeat;
              background-size: cover;
              background-position: center;
            "
          >
            <div class="banner-content">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <h2 class="banner-title">Casual Collection</h2>
                    <p>
                      We have many casual ware product collection that is sutiable for everytime and everyplaces.
                    </p>
                    <div class="btn-wrap">
                      <a
                        href="shop.php"
                        class="btn btn-light btn-light-arrow btn-medium d-flex align-items-center"
                        tabindex="0"
                        >Shop it now <i class="icon icon-arrow-io"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="featured-products" class="product-store padding-large">
      <div class="container">
        <div
          class="section-header d-flex flex-wrap align-items-center justify-content-between"
        >
          <h2 class="section-title">Featured Products</h2>
          <div class="btn-wrap">
            <a href="shop.php" class="d-flex align-items-center"
              >View all products <i class="icon icon icon-arrow-io"></i
            ></a>
          </div>
        </div>
        <div class="swiper product-swiper overflow-hidden">
          <div class="swiper-wrapper">

            <?php
                $select="SELECT * FROM products LIMIT 4";
                $run=mysqli_query($connect,$select);
                $count=mysqli_num_rows($run);

                if ($count==0) {
                  echo "<h1 class=' text-center color-warning'>There is no product in shop!</h1>";
                }else{

                  while ($data=mysqli_fetch_array($run)) {
                    $productID=$data['ProductCode'];
                    $productImg=$data['Product_Image'];
                   $productName=$data['ProductName'];
                    $price=$data['ProductPrice'];

                    ?>

                          <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="image-holder">
                                    <img src="<?php echo $productImg ?>" alt="Books" class="product-image" style='object-fit:cover' />
                                </div>
                                <div class="cart-concern">
                                    <div class="cart-button d-flex justify-content-between align-items-center">
                                        <button type="button" class="btn-wrap cart-link d-flex align-items-center" style="margin-left: 3vw;">
                                          <a href="Product_Detail.php?ProductID=<?php echo $productID ?>">View Detail <i class="icon icon-arrow-io"></i></a>
                                        </button>
                                       
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <h3 class="product-title">
                                    <a href="Product_Detail.php?ProductID=<?php echo $productID ?>"><?php echo $productName ?></a>
                                    
                                    </h3>
                                    <div class="item-price text-primary"><?php
                                      echo $price
                                   
                                     ?></div>
                                </div>
                          </div>

                  <?php
                    
                  }
                  
                }
            ?>
            
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </section>

    <section id="latest-collection">
      <div class="container">
        <div class="product-collection row">
          <div class="col-lg-7 col-md-12 left-content">
            <div class="collection-item">
              <div class="products-thumb">
                <img
                  src="images/collection-item1.jpg"
                  alt="collection item"
                  class="large-image image-rounded"
                />
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 product-entry">
                <div class="categories">Women ware collection</div>
                <h3 class="item-title">Women wear</h3>
                <p>
                  Escort produce all type of women ware collection that can ware any age of women.
                </p>
                <div class="btn-wrap">
                  <a href="shop.php" class="d-flex align-items-center"
                    >shop collection <i class="icon icon-arrow-io"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-md-12 right-content flex-wrap">
            <div class="collection-item top-item">
              <div class="products-thumb">
                <img
                  src="images/collection-item2.jpg"
                  alt="collection item"
                  class="small-image image-rounded"
                />
              </div>
              <div class="col-md-6 product-entry">
                <div class="categories">Basic Collection</div>
                <h3 class="item-title">Basic shoes.</h3>
                <div class="btn-wrap">
                  <a href="shop.php" class="d-flex align-items-center"
                    >shop collection <i class="icon icon-arrow-io"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="collection-item bottom-item">
              <div class="products-thumb">
                <img
                  src="images/collection-item3.jpg"
                  alt="collection item"
                  class="small-image image-rounded"
                />
              </div>
              <div class="col-md-6 product-entry">
                <div class="categories">Hat collection</div>
                <h3 class="item-title">woolen hat.</h3>
                <div class="btn-wrap">
                  <a href="shop.php" class="d-flex align-items-center"
                    >shop collection <i class="icon icon-arrow-io"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <section
      id="selling-products"
      class="product-store bg-light-grey "
    >
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Best selling products</h2>
        </div>
        <ul class="tabs list-unstyled">
          <li data-tab-target="#all" class="active tab">All</li>
        </ul>
        <div class="tab-content">
          <div id="all" data-tab-content class="active">
            <div class="row d-flex flex-wrap">
            <?php
                $select="SELECT * FROM products LIMIT 6";
                $run=mysqli_query($connect,$select);
                $count=mysqli_num_rows($run);

                if ($count==0) {
                  echo "<h1 class=' text-center color-warning'>There is no product in shop!</h1>";
                }else{

                  while ($data=mysqli_fetch_array($run)) {
                    $productID=$data['ProductCode'];
                    $productImg=$data['Product_Image'];
                   $productName=$data['ProductName'];
                    $price=$data['ProductPrice'];

                    ?>

                          <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="image-holder">
                                    <img src="<?php echo $productImg ?>" alt="Books" class="product-image" style='object-fit:cover' />
                                </div>
                                <div class="cart-concern">
                                    <div class="cart-button d-flex justify-content-between align-items-center">
                                        <button type="button" class="btn-wrap cart-link d-flex align-items-center" style="margin-left: 3vw;">
                                          <a href="Product_Detail.php?ProductID=<?php echo $productID ?>">View Detail <i class="icon icon-arrow-io"></i></a>
                                        </button>
                                       
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <h3 class="product-title">
                                    <a href="Product_Detail.php?ProductID=<?php echo $productID ?>"><?php echo $productName ?></a>
                                    
                                    </h3>
                                    <div class="item-price text-primary"><?php
                                      echo $price
                                   
                                     ?></div>
                                </div>
                          </div>

                  <?php
                    
                  }
                  
                }
            ?>
              </div>
            </div>
          </div>
        
    </section>

    <section id="testimonials" class="padding-large no-padding-bottom">
      <div class="container">
        <div class="reviews-content">
          <div class="row d-flex flex-wrap">
            <div class="col-md-2">
              <div class="review-icon">
                <i class="icon icon-right-quote"></i>
              </div>
            </div>
            <div class="col-md-8">
              <div class="swiper testimonial-swiper overflow-hidden">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="testimonial-detail">
                      <p>
                        “Style is a reflection of your attitude and personality. It's not about what you wear, but how you wear it. Fashion is the armor to survive the reality of everyday life.”
                      </p>
                      <div class="author-detail">
                        <div class="name">By Bill Cunningham</div>
                      </div>
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="testimonial-detail">
                      <p>
                        “Style is a deeply personal expression of who you are, and every time you dress, you are asserting a part of yourself. Fashion isn't merely about clothes, it's about embracing the opportunity to craft your narrative through fabric and design, weaving together threads of creativity and confidence to adorn yourself in the artistry of self-expression.”
                      </p>
                      <div class="author-detail">
                        <div class="name">By John Smith</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="swiper-arrows">
                <button class="prev-button">
                  <i class="icon icon-arrow-left"></i>
                </button>
                <button class="next-button">
                  <i class="icon icon-arrow-right"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <?php
                     $promoSelect = "SELECT 
                     products.*, 
                     promotions.*,
                     promotion_products.*
                 FROM 
                     products
                 INNER JOIN 
                     promotion_products ON products.ProductCode = promotion_products.ProductCode
                 INNER JOIN 
                     promotions ON promotion_products.Promotion_Code = promotions.Promotion_Code
                 WHERE
                     CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate
                     LIMIT 4";
 
  
                      $runPromo=mysqli_query($connect,$promoSelect);
                      $count=mysqli_num_rows($runPromo);
                      if ($count>0) {

                        ?>

                    <section id="flash-sales" class="product-store padding-large">
                          <div class="container">
                            <div class="section-header">
                              <h2 class="section-title">Flash sales</h2>
                            </div>
                            <div class="swiper product-swiper flash-sales overflow-hidden">
                              <div class="swiper-wrapper">

                              <?php
                                  for ($i=0; $i <4 ; $i++) { 
                                    $promoData=mysqli_fetch_array($runPromo);


                                    $productName1 = $promoData['ProductName'];
                                    $productPrice1 = $promoData['ProductPrice'];
                                    $productImg1 = $promoData['Product_Image'];
                                    $productID=$promoData['ProductCode'];
                                    $final=$promoData['Unit_Promotion_Product_Price'];
                                    $promoAmount=$promoData['PromotionAmount'];
                                    ?>
                                  <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                    <img
                                      src="<?php echo $productImg1 ?>"
                                      alt="Books"
                                      class="product-image"
                                      style='object-fit:cover'
                                    />
                                    <div class="cart-concern">
                                      <div
                                        class="cart-button d-flex justify-content-between align-items-center"
                                      >
                                        <button
                                          type="button"
                                          class="btn-wrap cart-link d-flex align-items-center" style="margin-left: 3vw;"
                                        >
                                        <a href="Product_Detail.php?ProductID=<?php echo $productID ?>">View Detail <i class="icon icon-arrow-io"></i></a>
                                        </button>
                                    
                                      </div>
                                    </div>
                                    <div class="discount"><?php echo $promoAmount ?>% Off</div>
                                    <div class="product-detail">
                                      <h3 class="product-title">
                                      <a href="Product_Detail.php?ProductID=<?php echo $productID ?>"><?php echo $productName1 ?></a>
                                      </h3>
                                      <div class="item-price text-primary">
                                      <strike><?php echo $productPrice1 ?></strike>
                                      <?php echo $final ?> MMK
                                      </div>
                                    </div>
                                  </div>

                                  <?php
                                  }

                          ?>
                          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

          <?php
                        
                      }
                    

    ?>
   
         
            
            
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <section class="shoppify-section-banner">
      <div class="container">
        <div class="product-collection">
          <div class="left-content collection-item">
            <div class="products-thumb">
              <img
                src="images/model.jpg"
                alt="collection item"
                class="large-image image-rounded"
              />
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 product-entry">
              <div class="categories">Denim collection</div>
              <h3 class="item-title">The casual selection.</h3>
              <p>
                We have special casual ware selection in our shop that have affortable price. You can search 
                with affortable price and product type name.
              </p>
              <div class="btn-wrap">
                <a href="shop.php" class="d-flex align-items-center"
                  >shop collection <i class="icon icon-arrow-io"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="quotation" class="align-center">
      <div class="inner-content">
        <h2 class="section-title divider">Quote of the day</h2>
        <blockquote>
          <q
            >It's true, I don't like the whole cutoff-shorts-and-T-shirt look,
            but I think you can look fantastic in casual clothes.</q
          >
          <div class="author-name">- Dr. Seuss</div>
        </blockquote>
      </div>
    </section>

    <hr />
  
    <section id="instagram" class="">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Follow our instagram</h2>
        </div>
        <p>
          Our official Instagram account <a href="https://www.instagram.com/escort_fashion?igsh=MTRtNng1anM3MnBiZQ==">@escort</a> or
          <a href="https://www.instagram.com/escort_fashion?igsh=MTRtNng1anM3MnBiZQ==">#escort_fashion</a>
        </p>
        <div class="row d-flex flex-wrap justify-content-between">
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img
                src="images/insta-image1.jpg"
                alt="instagram"
                class="insta-image"
              />
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img
                src="images/insta-image2.jpg"
                alt="instagram"
                class="insta-image"
              />
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img
                src="images/insta-image3.jpg"
                alt="instagram"
                class="insta-image"
              />
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img
                src="images/insta-image4.jpg"
                alt="instagram"
                class="insta-image"
              />
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img
                src="images/insta-image5.jpg"
                alt="instagram"
                class="insta-image"
              />
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
          <div class="col-lg-2 col-md-4 col-sm-6">
            <figure class="zoom-effect">
              <img
                src="images/insta-image6.jpg"
                alt="instagram"
                class="insta-image"
              />
              <i class="icon icon-instagram"></i>
            </figure>
          </div>
        </div>
      </div>
    </section>

    <section id="shipping-information">
      <hr />
      <div class="container">
        <div
          class="row d-flex flex-wrap align-items-center justify-content-between"
        >
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-truck"></i>
              <h4 class="block-title">
                <strong>Shipping</strong> Over 100 cities
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-return"></i>
              <h4 class="block-title">
                <strong>Products back</strong> Return within 1 months
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-tags1"></i>
              <h4 class="block-title">
                <strong>Have promotions</strong> monthly
              </h4>
            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-box">
              <i class="icon icon-help_outline"></i>
              <h4 class="block-title">
                <strong>Any questions?</strong> experts are ready
              </h4>
            </div>
          </div>
        </div>
      </div>
      <hr />
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
  </body>
</html>
