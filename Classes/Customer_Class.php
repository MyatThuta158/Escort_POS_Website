<?php
    class customers{

         //-------------------------This is for database connection--------------//
         protected $dbConnection; //---connection variable
         //------------Create constructor to connect database when create obj------//
         public function __construct($db)
         {
          $this->dbConnection=$db;
 
         }
        //------------------------------------Function for register---------------------------------------------//
        public function Register($name,$email,$password,$PhoneNo,$address,$fileImg){
            

            //----Check email is in correct format---//
            function validateEmail($emailValue){
              return  preg_match('/@gmail.com/i',$emailValue);
            }
            
            //------------Check input fields are empty-----//
		    if (empty($name)|| empty($password)|| empty($email)||empty($PhoneNo) || empty($address)) {
		    	echo "<script>window.alert('Some input field should not empty')</script>";
		    }elseif(validateEmail($email)==false){
                echo "<script>window.alert('Email is not correct format!')</script>";
            }
            else{
            $hashPassword=password_hash($password,PASSWORD_DEFAULT);// Hash value for password....
            
            //-----Check email that is duplicate from user databse----//
            $checkEmail="SELECT * from customers 
            WHERE Customer_Email='$email'";

            //Run the query for database check----
            $runResult=mysqli_query($this->dbConnection,$checkEmail);//Run query
            $count=mysqli_num_rows($runResult);// count row

            if ($count>0) {
                echo "<script>window.alert('Email Already Exist!')</script>";//--Alert if user exist--
            }else{

                $folder="images/";//---------Create folder name to move img------//

                if ($fileImg['name']) {      //Check the uploaded file name is empty 
                    $fileName=$folder.''.$fileImg['name'];//------This is a path where the image will be moved...
                    $tmp_name=$fileImg['tmp_name'];//----------Here is a temp file upload name location----

                    if (!empty($tmp_name)) {
                        $copy=copy($tmp_name,$fileName); //------------Copy the file to desire file destination......
                    }
                    
                }

                $insertData="INSERT INTO customers(Customer_Name,Customer_Email,Customer_Password,Customer_PhoneNumber,CustomerProfileImage,Customer_Address)
                VALUES('$name','$email','$hashPassword','$PhoneNo','$fileName','$address')";
                $run=mysqli_query($this->dbConnection,$insertData);

                if ($run) {
                   echo "<script>window.alert('User Register successfully')</script>";
                }

            }
        }
    }

    //--------------------This is for Update function for user-----//
    public function updateCustomer($id, $name, $email, $phoneNo,$address, $img)
    {
        if (empty($email) || empty($phoneNo) || empty($name) | empty($address)) {
            echo "<script>window.alert('Input fields should not be empty!')</script>";
        } else {
            $folder = "images/"; 
    
            if ($_FILES['pImg']['error'] == 0) {
                $fileName = $folder . uniqid() . '_' . $img['name'];
                $tmp_name = $img['tmp_name'];
    
                if (!empty($tmp_name)) {
                    $copy = copy($tmp_name, $fileName);
                }
            }
    
            // Check if $fileName 
            if (isset($fileName)) {
                $update = "UPDATE customers SET Customer_Name='$name',Customer_Email='$email',Customer_PhoneNumber='$phoneNo',CustomerProfileImage='$fileName',Customer_Address='$address' WHERE Customer_ID='$id'";
            } else {
                // No new image uploaded, keep the original file path
                $update = "UPDATE customers SET Customer_Name='$name',Customer_Email='$email',Customer_PhoneNumber='$phoneNo',Customer_Address='$address' WHERE Customer_ID='$id'";
            }
    
            $run = mysqli_query($this->dbConnection, $update);
            if ($run) {
                echo "<script>window.alert('Update successfully!')</script>";
                echo "<script>window.location.href = 'UserProfile.php'</script>";
            }
        }
    }
    
    }

?>