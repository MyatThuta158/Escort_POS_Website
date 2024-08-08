<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Manufacturer_Class.php';

if (isset($_REQUEST['sid'])) {
    $id=$_REQUEST['sid'];

    //echo $id;
    $select="SELECT * from manufacturers WHERE Manufacturer_ID='$id'";
    $query=mysqli_query($connect,$select);
    $count=mysqli_num_rows($query);

    if ($count>0) {
        $data=mysqli_fetch_array($query);
        $mID=$data['Manufacturer_ID'];
        $mName=$data['Manufacturer_Name'];
        $mEmail=$data['Manufacturer_Email'];
        $mPhoneNo=$data['Manufacturer_PhoneNo'];
        $mAddress=$data['Manufacturer_Address'];
    }else{
        echo "fail";
    }

   if (isset($_POST['btnupdate'])) {
        $code1=$_POST['txtID'];
        $name1=$_POST['txtName'];
        $phoneNo=$_POST['txtPhoneNo'];
        $email=$_POST['txtEmail'];
        $address=$_POST['txtAddress'];

        //--------Creating obj to update informatioin---//
        $obj=new Manufacturers($connect);
        $obj->updateManufacturer($code1,$name1,$email,$phoneNo,$address);

   }
}else{
    echo "Fail";
}

?>


<div class="form-group col-md-7 mx-auto ml-md-8">
<div class="modal-content">
    <h1 class="text-center p-2">Manufacturer Update form</h1>
    <form class="form-group p-3 rForm needs-validation" method="POST" action="" novalidate>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Manufacturer Name</label>
                <br>
                <input type="text" name="txtName" class="form-control" value="<?php echo $mName; ?>" required>
                <input type="hidden" name="txtID" value="<?php echo $mID; ?>">
                <div class="invalid-feedback">Please Enter Manufacturer Name!</div>
            </div>

            <div class="form-group col-md-6">
                <label for="">Manufacturer Email</label>
                <br>
                <input type="text" name="txtEmail" class="form-control" value="<?php echo $mEmail; ?>" required>
                <div class="invalid-feedback">Please Enter Manufacturer Email!</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Manufacturer PhoneNo</label>
                <br>
                <input type="text" name="txtPhoneNo" class="form-control" value="<?php echo $mPhoneNo; ?>" required>
                <div class="invalid-feedback">Please Enter Phone Number!</div>
            </div>

            <div class="form-group col-md-6">
                <label for="">Manufacturer Address</label>
                <br>
                <input type="text" name="txtAddress" class="form-control" value="<?php echo $mAddress; ?>" required>
                <div class="invalid-feedback">Please Enter Manufacturer address!</div>
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
?>
<script src="../js/FormValidate.js"></script>