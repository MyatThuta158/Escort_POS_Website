<?php
    class Promotions{

        protected $dbConnection;

        public function __construct($DB)
        {
            $this->dbConnection=$DB; //Insert data base connection
        }

        //------------------------Function for add product----------//
        //------------------------------------Function for register---------------------------------------------//
        public function AddPromotion($code,$name,$startDate,$endDate,$amount){


            //------------Check input fields are empty-----//
		    if (empty($code)|| empty($name)|| empty($startDate)||empty($endDate)||empty($amount)) {
		    	echo "<script>window.alert('Some input field should not empty')</script>";
		    }
            else{
           
            
            //-----Check email that is duplicate from user databse----//
            $checkName="SELECT Promotion_code from promotions 
            WHERE Promotion_code='$code'";

            //Run the query for database check----
            $runResult=mysqli_query($this->dbConnection,$checkName);//Run query
            $count=mysqli_num_rows($runResult);// count row

            if ($count>0) {
                echo "<script>window.alert('Promotions name Already Exist!')</script>";//--Alert if user exist--
            }else{
                $insertData="INSERT INTO promotions(Promotion_code,Promotion_Name,PromotionStartDate,PromotionEndDate,PromotionAmount)VALUES('$code','$name','$startDate','$endDate','$amount')";
                $run=mysqli_query($this->dbConnection,$insertData);

                if ($run) {
                   echo "<script>window.alert('Promotions Add successfully')</script>";
                }
                else{
                    echo "<script>window.alert('Error in insert data!')</script>";
                }

            }
        }
    }

     //--------------------This is for Update function for promotion-----//
     public function updatePromotion($code,$name,$sDate,$eDate){
        if (empty($code)||empty($name)||empty($sDate)||empty($eDate)) {
            echo "<script>window.alert('Input fields should not empty!')</script>";
        }else{
            $update="UPDATE promotions SET Promotion_Name='$name',PromotionStartDate='$sDate', PromotionEndDate='$eDate' WHERE Promotion_Code='$code'";
            $run= mysqli_query($this->dbConnection,$update);
            if ($run) {
                echo "<script>window.alert('Update successfully!')</script>";
                echo "<script>window.location.href = 'Promotions.php'</script>";
                
                
            } else{
                echo "<script>window.alert('Error in Update')</script>";
            }
        }

    }

    //--------------------This is for delete function for promotion.......//
    public function promotionDelete($id){
        $delete="DELETE FROM promotions WHERE Promotion_Code='$id'";
        $run=mysqli_query($this->dbConnection,$delete);

        if ($run) {
            echo "<script>window.alert('Delete successfully!')</script>";
            echo "<script>window.location.href = 'Promotions.php'</script>";

        }
    }

    }

?>