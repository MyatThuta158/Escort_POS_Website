<?php

    class Products{


        protected $dbConnection;
        //-----------Consturctor to create database connection----------//
        public function __construct($DB)
        {
            $this->dbConnection=$DB; //Insert data base connection
        }

        //------------------------Function for add product----------//
        //------------------------------------Function for register---------------------------------------------//
        public function AddProduct($codeNo, $name, $TypeID, $color, $Size, $price, $fileInfo,$qty) {
            // Check if input fields are empty
            if (empty($codeNo) || empty($name) || empty($TypeID) || empty($color) || empty($Size) || empty($price)|| empty($qty)) {
                echo "<script>window.alert('Some input fields should not be empty')</script>";
            } else {
                // Check if product code already exists
                $checkCode = "SELECT ProductCode FROM products WHERE ProductCode='$codeNo'";
                $runCheck = mysqli_query($this->dbConnection, $checkCode);
                $count = mysqli_num_rows($runCheck);
                if ($count > 0) {
                    echo "<script>window.alert('Product code already exists')</script>";
                } else {
                    // Image upload process
                    $folder = "../img/";
                    if ($fileInfo['name']) {
                        $fileName = $folder . '' . $fileInfo['name'];
                        $tmp_name = $fileInfo['tmp_name'];
                        if (!empty($tmp_name)) {
                            $copy = copy($tmp_name, $fileName);
                            if ($copy) {
                                echo "<script>window.alert('Product image uploaded successfully')</script>";
                                // Insert data into database after successful file upload
                                $insertData = "INSERT INTO products(ProductCode, ProductName, ProductTypeID, ProductAvailableColor, ProductAvailableSize, ProductPrice, Product_Image, Product_Quantity) VALUES ('$codeNo', '$name', '$TypeID', '$color', '$Size', '$price', '$fileName','$qty')";
                                $runInsert = mysqli_query($this->dbConnection, $insertData);
                                if ($runInsert) {
                                    echo "<script>window.alert('Product added successfully')</script>";
                                } else {
                                    echo "<script>window.alert('Failed to add product')</script>";
                                }
                            } else {
                                echo "<script>window.alert('Failed to upload product image')</script>";
                            }
                        }
                    }
                }
            }
        }
        



     //--------------------This is for Update function for product-----//
     public function updateProduct($code1,$name1,$color1,$size1,$price1,$qty){
        if (empty($code1)||empty($name1)||empty($color1)||empty($size1)||empty($price1)||empty($qty)) {
            echo "<script>window.alert('Input fields should not empty!')</script>";
        }else{
            $update="UPDATE products SET ProductName='$name1',ProductAvailableColor='$color1',ProductAvailableSize='$size1', ProductPrice='$price1',Product_Quantity='$qty' WHERE ProductCode='$code1'";
            $run= mysqli_query($this->dbConnection,$update);
            if ($run) {
                echo "<script>window.alert('Update successfully!')</script>";
                echo "<script>window.location.href = 'Products.php'</script>";
                
                
            } else{
                echo "<script>window.alert('Error in Update')</script>";
            }
        }

    }


    //-------------------------This is for Delete function for Product-------------//
    public function productDelete($id){
        $delete="DELETE FROM products WHERE ProductCode='$id'";
        $run=mysqli_query($this->dbConnection,$delete);

        if ($run) {
            echo "<script>window.alert('Delete successfully!')</script>";
            echo "<script>window.location.href = 'Products.php'</script>";
        }
        else{
            echo "<script>window.alert('ERROR!')</script>";
        }
    }
    }


?>