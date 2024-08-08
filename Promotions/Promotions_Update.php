<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Promotion_class.php';

//---------This is for product update code---------//
if (isset($_REQUEST['sid'])) {
    $id=$_REQUEST['sid'];

    //echo $id;
    $select="SELECT * from promotions WHERE Promotion_Code='$id'";
    $query=mysqli_query($connect,$select);
    $count=mysqli_num_rows($query);

    if ($count>0) {
        $data=mysqli_fetch_array($query);
        $pCode=$data['Promotion_Code'];
        $name=$data['Promotion_Name'];
        $Sdate=$data['PromotionStartDate'];
        $Edate=$data['PromotionEndDate'];
        $Amount=$data['PromotionAmount'];
       
   
    }else{
        echo "fail";
    }

   if (isset($_POST['btnupdate'])) {
        $code1=$_POST['txtCode'];
        $name1=$_POST['txtName'];
        $sDate=$_POST['sDate'];
        $eDate=$_POST['eDate'];


        //--------Creating obj to update informatioin---//
        $obj=new Promotions($connect);
        $obj->updatePromotion($code1,$name1,$sDate,$eDate);
   }
}else{
    echo "Fail";
}

?>


<div class="form-group col-md-7 mx-auto ml-md-8">
<div class="modal-content">
    <h1 class="text-center p-2">Update Promotions</h1>
    <form class="rForm needs-validation form-group p-3" method="POST" action="" novalidate>
        <div class="form-row">
          
                <input type="hidden" name="txtCode" class="form-control" value="<?php echo $pCode; ?>" required>
               

            <div class="form-group col-md-6">
                <label for="">Promotion Name</label>
                <br>
                <input type="text" name="txtName" class="form-control" value="<?php echo $name; ?>" required>
                <div class="invalid-feedback">Please Enter Promotion Name!</div>
            </div>

            <div class="form-group col-md-6">
                <label for="">Start Date</label>
                <br>
                <input type="date" name="sDate" class="form-control" value="<?php echo $Sdate; ?>" required>
                <div class="invalid-feedback">Please select start date!</div>
            </div>
        </div>

        <div class="form-row">
           

            <div class="form-group col-md-6">
                <label for="">End date</label>
                <br>
                <input type="date" name="eDate" class="form-control" value="<?php echo $Edate; ?>" required>
                <div class="invalid-feedback">Please Enter Promotion end date!</div>
            </div>
        </div>

       

        <div class="modal-footer">
             <input type="submit" name="btnupdate" value="update" class="btn btn-primary col-2 mr-md-4">
        </div>
</form>

    </div>
</div>

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>\

<script src="../js/FormValidate.js"></script>