<?php
  session_start();
  include('../includes/ConnectDB.php');


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shop</title>
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
                          class="item-anchor d-flex align-item-center"
                          data-effect="Home"
                          >Home</i
                        ></a>
                      </li>


                      <li class="menu-item has-sub">
                        <a
                          href="shop.php"
                          class="item-anchor active d-flex align-item-center"
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



    <section
      class="site-banner jarallax min-height300 padding-large"
      style="
        background: url(images/hero-image.jpg) no-repeat;
        background-position: top;
      "
    >
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-title">Shop page</h1>
            <div class="breadcrumbs">
              <span class="item">
                <a href="index.html">Home /</a>
              </span>
              <span class="item">Shop</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="shopify-grid padding-large">
      <div class="container">
        <div class="row">
          <section id="selling-products" class="col-md-9 product-store">
            <div class="container">
              <ul class="tabs list-unstyled">
                <li data-tab-target="#all" class="active tab">All</li>
                <li data-tab-target="#shoes" class="tab">Promotions Items</li>
                <!-- <li data-tab-target="#tshirts" class="tab">Tshirts</li>
                <li data-tab-target="#pants" class="tab">Pants</li>
                <li data-tab-target="#hoodie" class="tab">Hoodie</li>
                <li data-tab-target="#outer" class="tab">Outer</li>
                <li data-tab-target="#jackets" class="tab">Jackets</li>
                <li data-tab-target="#accessories" class="tab">Accessories</li> -->
              </ul>
              <div class="tab-content">
                <div id="all" data-tab-content class="active">
                  <div class="row d-flex flex-wrap">

                  <?php

                      if (isset($_POST['searchBtn'])) {

                        $searchData=$_POST['search'];

                        if ($searchData == "") {
                          echo "<script>window.alert('Please Enter Search information')</script>";
                          echo "<script>window.location.href='shop.php'</script>";
                        }
                        {
                        ///////////Select state ment for search/////////
                        $searchData = mysqli_real_escape_string($connect, $searchData);

                        $select = "SELECT products.*,IF(promotion_products.Unit_Promotion_Product_Price IS NOT NULL AND CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate,
                                  promotion_products.Unit_Promotion_Product_Price,
                                  products.ProductPrice) AS final_price
                                  FROM products 
                                  LEFT JOIN 
                                  promotion_products ON products.ProductCode = promotion_products.ProductCode
                                  LEFT JOIN 
                                  promotions ON promotion_products.Promotion_Code = promotions.Promotion_Code
                                  WHERE products.ProductName LIKE '%$searchData%' 
                                   OR products.ProductPrice='$searchData'";
                        $run = mysqli_query($connect, $select);
                        $count=mysqli_num_rows($run);

                        if ($count>0) {
                          for ($j=0; $j <$count ; $j++) {

                                    $data=mysqli_fetch_array($run);
                                    //$data0=mysqli_fetch_array($run);
                                    $productName=$data['ProductName'];
                                    $productPrice=$data['ProductPrice'];
                                    $productImg=$data['Product_Image'];
                                    $promoP=$data['final_price'];
                                    $pID=$data['ProductCode'];
                                    $promoP=$data['final_price'];

                                    ?>
                          <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="image-holder">
                                    <img src="<?php echo $productImg ?>" alt="Books" class="product-image" style='object-fit:cover' />
                                </div>
                                <div class="cart-concern">
                                    <div class="cart-button d-flex justify-content-between align-items-center">
                                        <button type="button" class="btn-wrap cart-link d-flex align-items-center" style="margin-left: 3vw;">
                                          <a href="Product_Detail.php?ProductID=<?php echo $pID ?>">View Detail <i class="icon icon-arrow-io"></i></a>
                                        </button>
                                       
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <h3 class="product-title">
                                    <a href="Product_Detail.php?ProductID=<?php echo $pID ?>"><?php echo $productName ?></a>
                                    </h3>
                                    <div class="item-price text-primary"><?php

                                    if ($promoP != $productPrice) {
                                      echo "<strike>$productPrice</strike>";
                                      echo $promoP;
                                    }else{
                                      echo $productPrice;
                                    }

                                    ?></div>
                                </div>
                          </div>


                                    <?php
                                  }
                               }
                               else{
                                 echo "<h6>Your search product cannot be found!</h6>";
                               }
                          }
                      }elseif (isset($_REQUEST['id'])) {
                        $id=$_REQUEST['id'];
                        // echo $id;

                      
                        $sel2 = "SELECT 
                                products.*, 
                                IF(
                                    promotion_products.Unit_Promotion_Product_Price IS NOT NULL 
                                    AND CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate,
                                    promotion_products.Unit_Promotion_Product_Price,
                                    products.ProductPrice
                                ) AS final_price
                            FROM 
                                products
                            JOIN 
                                product_type pt ON products.ProductTypeID = pt.ProductTypeID
                            LEFT JOIN 
                                promotion_products ON products.ProductCode = promotion_products.ProductCode
                            LEFT JOIN 
                                promotions ON promotion_products.Promotion_Code = promotions.Promotion_Code
                            WHERE 
                                products.ProductTypeID = '$id'";

                        $run=mysqli_query($connect,$sel2);
                        $cot=mysqli_num_rows($run);

                        if ($cot>0) {
                          for ($i=0; $i <$cot ; $i++) { 
                            $data4=mysqli_fetch_array($run);
                            $productName2 = $data4['ProductName'];
                            $productPrice2 = $data4['ProductPrice'];
                            $productImg2 = $data4['Product_Image'];
                            $productID2=$data4['ProductCode'];
                            $promo=$data4['final_price'];
                            ?>
                            <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="image-holder">
                                    <img src="<?php echo $productImg2 ?>" alt="Books" class="product-image" style='object-fit:cover' />
                                </div>
                                <div class="cart-concern">
                                    <div class="cart-button d-flex justify-content-between align-items-center">
                                        <button type="button" class="btn-wrap cart-link d-flex align-items-center" style="margin-left: 3vw;">
                                          <a href="Product_Detail.php?ProductID=<?php echo $productID2 ?>">View Detail <i class="icon icon-arrow-io"></i></a>
                                        </button>
                                       
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <h3 class="product-title">
                                    <a href="Product_Detail.php?ProductID=<?php echo $productID2 ?>"><?php echo $productName2 ?></a>
                                    </h3>
                                    <div class="item-price text-primary"><?php

                                    if ($promo != $productPrice2) {
                                      echo "<strike>$productPrice2</strike>";
                                      echo $promo;
                                    }else{
                                      echo $productPrice2;
                                    }

                                    ?></div>
                                </div>
                          </div>



                        <?php
                          }
                          
                        }
                        
                      }
                      elseif(isset($_REQUEST['sho'])){
                        $select5 = "SELECT 
                        products.*,
                        IF(promotion_products.Unit_Promotion_Product_Price IS NOT NULL AND CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate,
                            promotion_products.Unit_Promotion_Product_Price,
                            products.ProductPrice) AS final_price
                    FROM 
                        products
                    LEFT JOIN 
                        promotion_products ON products.ProductCode = promotion_products.ProductCode
                    LEFT JOIN 
                        promotions ON promotion_products.Promotion_Code = promotions.Promotion_Code";
                        $run5 = mysqli_query($connect, $select5);
                        $count5 = mysqli_num_rows($run5);

                        if ($count5 == 0) {
                        echo "<h3 class='text-center text-muted'>There are no products found!</h3>";
                        } else {
                        while ($data5 = mysqli_fetch_array($run5)) {
                          $productName5 = $data5['ProductName'];
                          $productPrice5 = $data5['ProductPrice'];
                          $productImg5 = $data5['Product_Image'];
                          $productID5=$data5['ProductCode'];
                          $promoPrice=$data5['final_price'];
                        ?>
                          <div class="product-item col-lg-4 col-md-6 col-sm-6">
                              <div class="image-holder">
                                  <img src="<?php echo $productImg5 ?>" alt="Books" class="product-image" style='object-fit:cover' />
                              </div>
                              <div class="cart-concern">
                                  <div class="cart-button d-flex justify-content-between align-items-center">
                                      <button type="button" class="btn-wrap cart-link d-flex align-items-center" style="margin-left: 3vw;">
                                        <a href="Product_Detail.php?ProductID=<?php echo $productID5 ?>">View Detail <i class="icon icon-arrow-io"></i></a>
                                      </button>
                                     
                                  </div>
                              </div>
                              <div class="product-detail">
                                  <h3 class="product-title">
                                  <a href="Product_Detail.php?ProductID=<?php echo $productID5 ?>"><?php echo $productName5 ?></a>
                                  </h3>
                                  <div class="item-price text-primary">
                                  <?php

                                    if ($promoPrice != $productPrice5) {
                                      echo "<strike>$productPrice5</strike>";
                                      echo $promoPrice;
                                    }else{
                                      echo $productPrice5;
                                    }

                                    ?>
                                  </div>
                              </div>
                        </div>

                            <?php
                          }
                        }
                      }elseif(isset($_REQUEST['price'])){
                        $price=$_REQUEST['price'];
                        $getSelect="SELECT products .*,IF(promotion_products.Unit_Promotion_Product_Price IS NOT NULL AND CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate,
                        promotion_products.Unit_Promotion_Product_Price,
                        products.ProductPrice) AS final_price 
                        from products 
                        LEFT JOIN 
                              promotion_products ON products.ProductCode = promotion_products.ProductCode
                          LEFT JOIN 
                              promotions ON promotion_products.Promotion_Code = promotions.Promotion_Code
                        WHERE products.ProductPrice<$price";
                        $run7=mysqli_query($connect,$getSelect);
                        $countPrice=mysqli_num_rows($run7);
                        
                        if ($countPrice>0) {
                          for ($i=0; $i <$countPrice ; $i++) { 
                            $getData=mysqli_fetch_array($run7);
                            $productName8 = $getData['ProductName'];
                            $productPrice8 = $getData['ProductPrice'];
                            $productImg8 = $getData['Product_Image'];
                            $productID8=$getData['ProductCode'];
                            $finalPrice=$getData['final_price'];

                            ?>
                       <div class="product-item col-lg-4 col-md-6 col-sm-6">
                              <div class="image-holder">
                                  <img src="<?php echo $productImg8 ?>" alt="Books" class="product-image" style='object-fit:cover' />
                              </div>
                              <div class="cart-concern">
                                  <div class="cart-button d-flex justify-content-between align-items-center">
                                      <button type="button" class="btn-wrap cart-link d-flex align-items-center" style="margin-left: 3vw;">
                                        <a href="Product_Detail.php?ProductID=<?php echo $productID8 ?>">View Detail <i class="icon icon-arrow-io"></i></a>
                                      </button>
                                     
                                  </div>
                              </div>
                              <div class="product-detail">
                                  <h3 class="product-title">
                                  <a href="Product_Detail.php?ProductID=<?php echo $productID8 ?>"><?php echo $productName8 ?></a>
                                  </h3>
                                  <div class="item-price text-primary">
                                    <?php

                                  if ($finalPrice != $productPrice8) {
                                    echo "<strike>$productPrice8</strike>";
                                    echo $finalPrice;
                                  }else{
                                    echo $productPrice8;
                                  }

                                  ?>
                                  </div>
                              </div>
                        </div>

                      <?php
                          }
                        }
                        else{
                          echo "<h3 class='text-center text-muted'>There are no products found less than $price MMK!</h3>";
                        }
                        
                      }
                      else{
                         
                          $select2 = "SELECT 
                              products.*,
                              IF(promotion_products.Unit_Promotion_Product_Price IS NOT NULL AND CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate,
                                  promotion_products.Unit_Promotion_Product_Price,
                                  products.ProductPrice) AS final_price
                          FROM 
                              products
                          LEFT JOIN 
                              promotion_products ON products.ProductCode = promotion_products.ProductCode
                          LEFT JOIN 
                              promotions ON promotion_products.Promotion_Code = promotions.Promotion_Code";

                          $run2 = mysqli_query($connect, $select2);
                          $count2 = mysqli_num_rows($run2);

                          if ($count2 == 0) {
                          echo "<h3 class='text-center text-muted'>There are no products found!</h3>";
                          } else {
                          while ($data1 = mysqli_fetch_array($run2)) {
                            $productName1 = $data1['ProductName'];
                            $productPrice1 = $data1['ProductPrice'];
                            $productImg1 = $data1['Product_Image'];
                            $productID=$data1['ProductCode'];
                            $final=$data1['final_price'];
                          ?>
                            
                            <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="image-holder">
                                    <img src="<?php echo $productImg1 ?>" alt="Books" class="product-image" style='object-fit:cover' />
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
                                    <a href="Product_Detail.php?ProductID=<?php echo $productID ?>"><?php echo $productName1 ?></a>
                                    
                                    </h3>
                                    <div class="item-price text-primary"><?php

                                    if ($final != $productPrice1) {
                                      echo "<strike>$productPrice1</strike>";
                                      echo $final;
                                    }else{
                                      echo $productPrice1;
                                    }
                                    
                                     ?></div>
                                </div>
                          </div>


                              <?php
                            }
                          }
                        }
                    


                  ?>
                  
                  </div>
                </div>
                <div id="shoes" data-tab-content>
                  <div class="row d-flex flex-wrap">
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
                     CURDATE() BETWEEN promotions.PromotionStartDate AND promotions.PromotionEndDate";
 
  
                      $runPromo=mysqli_query($connect,$promoSelect);
                      $count=mysqli_num_rows($runPromo);


                    

                        
                      if ($count>0) {
                        for ($i=0; $i < $count ; $i++) { 
                            $promoData=mysqli_fetch_array($runPromo);


                            $productName1 = $promoData['ProductName'];
                            $productPrice1 = $promoData['ProductPrice'];
                            $productImg1 = $promoData['Product_Image'];
                            $productID=$promoData['ProductCode'];
                            $final=$promoData['Unit_Promotion_Product_Price'];

                            ?>

                          <div class="product-item col-lg-4 col-md-6 col-sm-6">
                                <div class="image-holder">
                                    <img src="<?php echo $productImg1 ?>" alt="Books" class="product-image" style='object-fit:cover' />
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
                                    <a href="Product_Detail.php?ProductID=<?php echo $productID ?>"><?php echo $productName1 ?></a>
                                    
                                    </h3>
                                    <div class="item-price text-primary"><?php

                                    if ($final != $productPrice1) {
                                      echo "<strike>$productPrice1</strike>";
                                      echo $final;
                                    }else{
                                      echo $productPrice1;
                                    }
                                    
                                     ?></div>
                                </div>
                          </div>

                          <?php
                        }
                      }else{
                          echo "<h2>There is no promotion products currently!</h2>";
                      }
                    ?>
                </div>
                </div>



              
            </div>
          </section>

          <aside class="col-md-3">
            <div class="sidebar">
              <div class="widgets widget-menu">
                <div class="widget-search-bar">
                  <form role="search" method="POST" class="d-flex rForm" novalidate>
                    <input
                      class="search-field"
                      placeholder="Search by product name or price....."
                      type="text"
                      name="search"
                      required
                    />
                    <!-- <h6 class="invalid-feedback">Please Enter Input for search</h6> -->
                    <button type="submit" class="btn btn-dark" name="searchBtn">
                      <i class="icon icon-search"></i>
                    </button>
                  </form>
                </div>
              </div>

              <a href="shop.php?sho=show" class="btn btn-primary" style="margin-bottom: 3vh;">Show All</a>
              <!--------------- This is filter function ------------>

              <div class="widgets widget-product-tags">
                <h5 class="widget-title">Filter by Product Type</h5>
                <ul class="product-tags sidebar-list list-unstyled">
              <?php
                $sel="SELECT * FROM product_type";
                $run=mysqli_query($connect,$sel);
                $count=mysqli_num_rows($run);

                if ($count>0) {
                  for ($i=0; $i <$count ; $i++) { 
                    $data=mysqli_fetch_array($run);
                    $id=$data['ProductTypeID'];
                    $name=$data['ProductTypeName'];

                    ?>
                      <li class="tags-item">
                         <a href="shop.php?id=<?php echo $id ?>"><?php echo $name ?></a>
                       </li>
                  <?php
                  }
                }
              ?>
                </ul>
              </div>

              <form action="POST">
                  <div class="widgets widget-price-filter">
                    <h5 class="widget-title">Filter By Price</h5>
                    <ul class="product-tags sidebar-list list-unstyled">
                    <li class="tags-item">
                      <a href="shop.php?price=10000" name="less10k">Less than 10000MMK</a>
                   </li>
                   <li class="tags-item">
                      <a href="shop.php?price=20000" name="less10k">Less than 20000MMK</a>
                    </li>
                    <li class="tags-item">
                      <a href="shop.php?price=30000" name="less10k">Less than 30000MMK</a>
                    </li>
                    <li class="tags-item">
                       <a href="shop.php?price=40000" name="less10k">Less than 40000MMK</a>
                    </li>
                     <li class="tags-item">
                     <a href="shop.php?price=50000" name="less10k">Less than 50000MMK</a>
                    </li>
                  </ul>
                </div>
              </form>
            </div>
          </aside>
        </div>
      </div>
    </div>

    <hr />
    <!-- <section id="latest-blog" class="">
      <div class="container">
        <div
          class="section-header d-flex flex-wrap align-items-center justify-content-between"
        >
          <h2 class="section-title">our Journal</h2>
          <div class="btn-wrap align-right">
            <a href="blog.html" class="d-flex align-items-center"
              >Read All Articles <i class="icon icon icon-arrow-io"></i>
            </a>
          </div>
        </div>
        <div class="row d-flex flex-wrap">
          <article class="col-md-4 post-item">
            <div class="image-holder zoom-effect">
              <a href="single-post.html">
                <img src="images/post-img1.jpg" alt="post" class="post-image" />
              </a>
            </div>
            <div class="post-content d-flex">
              <div class="meta-date">
                <div class="meta-day text-primary">22</div>
                <div class="meta-month">Aug-2021</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="single-post.html"
                    >top 10 casual look ideas to dress up your kids</a
                  >
                </h3>
                <a href="blog.html" class="blog-categories">Fashion</a>
              </div>
            </div>
          </article>
          <article class="col-md-4 post-item">
            <div class="image-holder zoom-effect">
              <a href="single-post.html">
                <img src="images/post-img2.jpg" alt="post" class="post-image" />
              </a>
            </div>
            <div class="post-content d-flex">
              <div class="meta-date">
                <div class="meta-day text-primary">25</div>
                <div class="meta-month">Aug-2021</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="single-post.html"
                    >Latest trends of wearing street wears supremely</a
                  >
                </h3>
                <a href="blog.html" class="blog-categories">Trending</a>
              </div>
            </div>
          </article>
          <article class="col-md-4 post-item">
            <div class="image-holder zoom-effect">
              <a href="single-post.html">
                <img src="images/post-img3.jpg" alt="post" class="post-image" />
              </a>
            </div>
            <div class="post-content d-flex">
              <div class="meta-date">
                <div class="meta-day text-primary">28</div>
                <div class="meta-month">Aug-2021</div>
              </div>
              <div class="post-header">
                <h3 class="post-title">
                  <a href="single-post.html"
                    >types of comfortable clothes ideas for women</a
                  >
                </h3>
                <a href="blog.html" class="blog-categories">Inspiration</a>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section> -->

    <!-- <section id="brand-collection" class="padding-medium bg-light-grey">
      <div class="container">
        <div class="d-flex flex-wrap justify-content-between">
          <img src="images/brand1.png" alt="phone" class="brand-image" />
          <img src="images/brand2.png" alt="phone" class="brand-image" />
          <img src="images/brand3.png" alt="phone" class="brand-image" />
          <img src="images/brand4.png" alt="phone" class="brand-image" />
          <img src="images/brand5.png" alt="phone" class="brand-image" />
        </div>
      </div>
    </section> -->

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
    <!-- <script src="../js/Form-validate.js"></script> -->
  </body>
</html>
