<?php
session_start();
include_once "Classes/Staff_Class.php";
include('includes/ConnectDB.php');

if (isset($_POST['btnlogin'])) {
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];
    // echo $password;

    if (empty($email) || empty($password)) {
        echo "<script>window.alert('Input fields should not be empty')</script>";
    } else {
        $check = "SELECT s.Staff_ID,s.Staff_Name,s.Staff_Email,s.Staff_Image,s.Staff_Password,sr.* FROM Staffs s,staff_role sr WHERE Staff_Email='$email' AND sr.Role_id=s.Role_id";
        $runQuery = mysqli_query($connect, $check);
        $count = mysqli_num_rows($runQuery);

        if ($count > 0) {
            $array = mysqli_fetch_array($runQuery);
            $userDbpassword = $array['Staff_Password'];

            if (password_verify($password, $userDbpassword)) {
                $userName = $array['Staff_Name'];
                $userId = $array['Staff_ID'];
                $role=$array['Role'];
                $img=$array['Staff_Image'];
                $roleId=$array['Role_id'];
                $_SESSION['uid'] = $userId;
                $_SESSION['userName'] = $userName;
                $_SESSION['Role']=$role;
                $_SESSION['SImg']=$img;

               // echo $_SESSION['SImg'];
                //----------------Identify manager or other level staff in order to change interface based on level---//
                // if ($role=='Manager') {
                //     echo "<script>window.location.href='ManagerHome.php'</script>";
                    
                // }else{
                //     echo "<script>window.location.href='StaffHome.php'</script>";
                // }

              echo "<script>window.location.href='Staff_Home/index.php'</script>";

            } 
            else{
                echo "<script>window.alert('Password Invalid')</script>";
            }
		} 
        else {
                $check1 = "SELECT Customer_ID,Customer_Name,Customer_Email,Customer_Password FROM customers WHERE Customer_Email='$email'";
                $runQuery1 = mysqli_query($connect, $check1);
                $count1 = mysqli_num_rows($runQuery1);

				if ($count1 > 0) {
					$array1 = mysqli_fetch_array($runQuery1);
                    $userDbpassword1 = $array1['Customer_Password'];

					// echo $userDbpassword1;
					if (password_verify($password, $userDbpassword1)) {
						$userName = $array1['Customer_Name'];
                        $userId = $array1['Customer_ID'];
                       
                        $_SESSION['urid'] = $userId;
                        $_SESSION['userName'] = $userName;

                        echo $_SESSION['urid'];

                        echo "<script>window.alert('Login Successfully')</script>";
                        echo "<script>window.location.href='customer/index.php'</script>";  
					}
					else{
						echo "<script>window.alert('Password Invalid!')</script>";
			             
					}

				}       
			}
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-XXXXXX" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-XXXXXX" crossorigin="anonymous">
</head>
<body>

<header class="sLoginHeader w-100">
    <img src="img/logo.jpg" alt="" class="img-fluid">
</header>

<img src="img/bgLp.jpg" alt="" class="bgLogin">
<div class="container">
    <div class="row justify-content-center mt-6 margin">
        <div class="col-md-4 background p-4" style="border-radius: 15px;">
            <form action="" method="POST" class="login-form">
                <div class="internal-login">
                    <h1 class="text-center">User Login</h1>
                    <h3>User Email</h3>
                    <div class="inputContainer">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="txtEmail" class="form-control" placeholder="Please enter email" />
                    </div><br>

                    <h3>User Password</h3>
                    <div class="inputContainer">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="txtPassword" class="form-control" placeholder="Please enter password"/>
                    </div><br>

                    <div id="countdown-timer"></div>
                    <input type="submit" name="btnlogin" value="Login" id="loginBtn" class="btn btn-secondary btn-block">

                    <a href="customer/User_Register.php" class="linkAcc mt-1">Register Account!</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
