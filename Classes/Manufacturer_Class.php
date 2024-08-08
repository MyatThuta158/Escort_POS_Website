<?php

    class Manufacturers{
        
        protected $dbConnection;
        //-----------Consturctor to create database connection----------//
        public function __construct($DB)
        {
            $this->dbConnection=$DB; //Insert data base connection
        }

        //------------------------Function for add product----------//
        //------------------------------------Function for register---------------------------------------------//
        public function AddManufacturer($Name,$Email,$PhoneNo,$address){


            //------------Check input fields are empty-----//
		    if (empty($Name)|| empty($Email)|| empty($PhoneNo)||empty($address)) {
		    	echo "<script>window.alert('Some input field should not empty')</script>";
		    }
            else{
           
            
            //-----Check email that is duplicate from user databse----//
            $checkName="SELECT Manufacturer_Name from manufacturers 
            WHERE Manufacturer_Name='$Name'";

            //Run the query for database check----
            $runResult=mysqli_query($this->dbConnection,$checkName);//Run query
            $count=mysqli_num_rows($runResult);// count row

            if ($count>0) {
                echo "<script>window.alert('Manufacturer name Already Exist!')</script>";//--Alert if user exist--
            }else{
                $insertData="INSERT INTO manufacturers(Manufacturer_Name,Manufacturer_Email,Manufacturer_PhoneNo,Manufacturer_Address)VALUES('$Name','$Email','$PhoneNo','$address')";
                $run=mysqli_query($this->dbConnection,$insertData);

                if ($run) {
                   echo "<script>window.alert('Manufacturer register successfully')</script>";
                }
                else{
                    echo "<script>window.alert('Error in insert data!')</script>";
                }

            }
        }
    }

     //--------------------This is for Update function for Manufacturer-----//
     public function updateManufacturer($code1,$name1,$email1,$phoneNo1,$Address1){
        if (empty($code1)||empty($name1)||empty($email1)||empty($phoneNo1)||empty($Address1)) {
            echo "<script>window.alert('Input fields should not empty!')</script>";
        }else{
            $update="UPDATE manufacturers SET Manufacturer_Name='$name1',Manufacturer_Email='$email1',Manufacturer_PhoneNo='$phoneNo1', Manufacturer_Address='$Address1' WHERE Manufacturer_ID='$code1'";
            $run= mysqli_query($this->dbConnection,$update);
            if ($run) {
                echo "<script>window.alert('Update successfully!')</script>";
                echo "<script>window.location.href = 'Manufacturers.php'</script>";
            }
        }

    }

//--------------------This is for Manufacturer delete----------------//
    public function ManufacturerDelete($id){
        $delete="DELETE FROM manufacturers WHERE Manufacturer_ID='$id'";
        $run=mysqli_query($this->dbConnection,$delete);

        if ($run) {
            echo "<script>window.alert('Delete successfully!')</script>";
            echo "<script>window.location.href = 'Manufacturers.php'</script>";

        }
    }
    }

?>