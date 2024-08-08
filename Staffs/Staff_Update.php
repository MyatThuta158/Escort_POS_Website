<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Staff_Class.php';

//---------This is for product update code---------//
if (isset($_REQUEST['sid'])) {
    $id=$_REQUEST['sid'];

    //echo $id;
    $select="SELECT * from staffs WHERE Staff_ID='$id'";
    $query=mysqli_query($connect,$select);
    $count=mysqli_num_rows($query);

    if ($count>0) {
        $data=mysqli_fetch_array($query);
        $name=$data['Staff_Name'];
        $email=$data['Staff_Email'];
        $phoneNo=$data['Staff_PhoneNumber'];
        $img=$data['Staff_Image'];
       
   
    }else{
        echo "fail";
    }

   if (isset($_POST['btnupdate'])) {

        $name1=$_POST['txtName'];
        $email1=$_POST['txtEmail'];
        $phoneNo1=$_POST['txtPhoneno'];
        $img1=$_FILES['txtImg'];

       // $obj=new Staffs($connect);

        if (!empty($img1)) {
            $obj=new Staffs($connect);
            $obj->updateUser($id,$name1,$email1,$phoneNo1,$img1);
        }else{
            $obj=new Staffs($connect);
            $obj->updateUser($id,$name1,$email1,$phoneNo1,$img);
        }
       
   }
}else{
    echo "Fail";
}

?>


<div class="form-group col-md-7 mx-auto ml-md-8">
<div class="modal-content">
    <h1 class="text-center p-2">Update Staff</h1>
    <form class="form-group p-3 rForm" method="POST" action="" enctype="multipart/form-data" novalidate>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Name</label>
                <br>
                <input type="text" name="txtName" class="form-control" value="<?php echo $name; ?>" required>
                <div class="invalid-feedback">Please Enter Name!</div>
            </div>

            <div class="form-group col-md-6">
                <label for="">Email</label>
                <br>
                <input type="text" name="txtEmail" class="form-control" value="<?php echo $email; ?>" required>
                <div class="invalid-feedback">Please Enter Email!</div>
                
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Phone Number</label>
                <br>
                <input type="text" name="txtPhoneno" class="form-control" value="<?php echo $phoneNo; ?>" required>
                <div class="invalid-feedback">Please Enter Phone Number!</div>
            </div>

            <div class="form-group col-md-6">
                <label for="">Image</label>
                <br>
                <input type="file" name="txtImg" class="form-control">
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