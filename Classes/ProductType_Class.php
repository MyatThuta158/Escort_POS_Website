<?php
    class Product_Type{
        protected $DBconnection;

        public function __construct($connection)
        {
            $this->DBconnection=$connection; //Insert data base connection
        }


         //------------------------Function for add product----------//
        //------------------------------------Function for register---------------------------------------------//
        public function AddType($ptName){


            //------------Check input fields are empty-----//
		    if (empty($ptName)) {
		    	echo "<script>window.alert('Input field should not empty')</script>";
		    }
            else{

            //-----Check product that is duplicate from product type databse----//
            $checkEmail="SELECT ProductTypeName from product_type 
            WHERE ProductTypeName ='$ptName'";

            //Run the query for database check----
            $runResult=mysqli_query($this->DBconnection,$checkEmail);//Run query
            $count=mysqli_num_rows($runResult);// count row

            if ($count>0) {
                echo "<script>window.alert('Product Type Already Exist!')</script>";//--Alert if product type exist--
            }else{
                $insertData="INSERT INTO product_type(ProductTypeName)VALUES('$ptName')";
                $run=mysqli_query($this->DBconnection,$insertData);

                if ($run) {
                   echo "<script>window.alert('Product Type Add successfully')</script>";
                }

            }
        }
    }


    //--------------------This is for Update function for user-----//
     public function updateProductType($ID,$name1){
        if (empty($name1)) {
            echo "<script>window.alert('Input fields should not empty!')</script>";
        }else{
            $update="UPDATE product_type SET ProductTypeName='$name1' WHERE ProductTypeID='$ID'";
            $run= mysqli_query($this->DBconnection,$update);
            if ($run) {
                echo "<script>window.alert('Update successfully!')</script>";
                echo "<script>window.location.href = 'Product_Type.php'</script>";
            }
        }

    }


    public function productTypeDelete($id){
        $delete="DELETE FROM product_type WHERE ProductTypeID='$id'";
        $run=mysqli_query($this->DBconnection,$delete);

        if ($run) {
            echo "<script>window.alert('Delete successfully!')</script>";
            echo "<script>window.location.href = 'Product_Type.php'</script>";

        }
    }
    }
?>