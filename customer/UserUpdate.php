<?php
    include('../includes/ConnectDB.php');
    include('../Classes/Customer_Class.php');



    if (isset($_REQUEST['urid'])) {
        $id=$_REQUEST['urid'];
    
        // echo $id;
        $select="SELECT * from customers WHERE Customer_ID='$id'";
        $query=mysqli_query($connect,$select);
        $count=mysqli_num_rows($query);
    
        if ($count>0) {
            $data=mysqli_fetch_array($query);
            $name=$data['Customer_Name'];
            $email=$data['Customer_Email'];
            $phoneNo=$data['Customer_PhoneNumber'];
            $img=$data['CustomerProfileImage'];
            $address=$data['Customer_Address'];
        }else{
            echo "fail";
        }
    
       if (isset($_POST['btnUpdate'])) {
    
            $name1=$_POST['name'];
            $email1=$_POST['email'];
            $phoneNo1=$_POST['phone'];
            $address1=$_POST['address'];
            $img1=$_FILES['pImg'];
    
          
          // echo $img;
    
            if (!empty($img1['name'])) {
                //echo "error";
                $obj=new customers($connect);
                $obj->updateCustomer($id,$name1,$email1,$phoneNo1,$address1,$img1);
            }else{
                $obj=new customers($connect);
                $obj->updateCustomer($id,$name1,$email1,$phoneNo1,$address1,$img);
            }
           
       }
    }else{
        echo "Fail";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
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

              
                  <div class="col-md-8 col-sm-12 user-items">
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
                </div>
                
                
              
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
                          href="shop.php"
                          class="item-anchor d-flex align-item-center"
                          data-effect="Shop"
                          >Shop</a>
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
                            <a href="blog.html" class="item-anchor">Blog</a>
                          </li>
                          <li>
                            <a href="../login.php" class="item-anchor"
                              >Login</a
                            >
                          </li>
                          
                          <li>
                            <a href="thank-you.html" class="item-anchor"
                              >Thankyou</a
                            >
                          </li>
                        </ul>
                      </li>

                      <li>
                        <a
                          href="contact.html"
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

<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <h3 class="text-center pt-1">Update User Information</h3>
        <div class="card-body">
          <form action="#" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required>
              <div class="invalid-feedback">Please Enter Name!</div>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>" required>
              <div class="invalid-feedback">Please Enter Email!</div>
            </div>
            <div class="form-group">
              <label for="address">Address:</label>
              <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>">
              <div class="invalid-feedback">Please Enter Address!</div>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number:</label>
              <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $phoneNo ?>">
              <div class="invalid-feedback">Please Enter Phone Number!</div>
            </div>
            <div class="form-group ">
                <label for="pImg">Product Image</label>
                <div class="custom-file">
                <input type="file" class="custom-file-input" name="pImg" required onchange="updateFileName(this)">
                <label class="custom-file-label" >Choose file</label>
                </div>
                <div class="invalid-feedback">Please choose a Product Image!</div>
            </div>
            <button type="submit" name="btnUpdate" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
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
                  Escort Fashion is a well-known brand that produce fashion ware
                  both men, women and kids. Customers can buy fashion from both
                  physical store that exist in Myanmar and online e-commerce
                  website.
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
              <img src="images/kpay.png" alt="visa" class="img-fluid" />
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
</script>
</body>
</html>