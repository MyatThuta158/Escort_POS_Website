<?php
//session_start();
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Staff_Class.php';





    $id=$_SESSION['uid'];//--------get session ID to use validation
   
  
    if (!$id) {
        echo "<script>window.alert('Please Login!')</script>";
        echo "<script>window.location.href='../login.php'</script>";
    }else{
        $select="SELECT s.*,sr.* FROM staffs s,staff_role sr WHERE Staff_ID='$id'"; //-----------Select the customer related information that match with id----//
        $run=mysqli_query($connect,$select);//-----------Run query-------//
        $count=mysqli_num_rows($run);

        if ($count>0) {
            $data=mysqli_fetch_array($run);//----Fetch data into array----//
            $name=$data['Staff_Name'];
            $email=$data['Staff_Email'];
            $phonNo=$data['Staff_PhoneNumber'];
            $img=$data['Staff_Image'];
            $role=$data['Role'];

        }else{
            echo "<script>window.alert('There is no record')</script>";
        }
    }

?>


<div class="h-75 col-md-4 mb-2 mx-auto" >
    <div class="modal-content p-3 rounded h-100">
    <h1 class="text-center font-weight-bold">Staff Profile</h1>
    <img src="<?php echo $img; ?>" alt="" class="img-fluid h-40 w-50 mx-auto rounded-circle">
    <form action="" method="POST" class="pitchTypeUpdate" class="h-100">
       <table class="h-100 mt-4 mx-auto">
            <tr class="mt-4">
                <td>Name</td>
                <td ><input type="text" class="form-control w-100 col-md-12" name="txtName" value="<?php echo $name; ?>" readonly></td>
            </tr>

            <tr class="mt-4">
                <td>Email</td>
                <td> <input type="text" class="form-control w-100 col-md-12" name="txtemail" value="<?php echo $email; ?>" readonly></td>
            </tr>

            <tr>
                <td>Role</td>
                <td><input type="text" name="txtPhonNo" value="<?php echo $role; ?>" class="form-control w-100 col-md-12" readonly></td>
            </tr>
  
            <tr class="mt-4">
                <td>Phone No</td>
                <td ><input type="text" class="form-control w-100 col-md-12" name="txtPhonNo" value="<?php echo $phonNo; ?>" class="ptInput" readonly></td>
            </tr>         

            

            <!-- <tr class="w-100">
    <td class="text-center">
        <div class="modal-footer mx-auto w-100">
            <input type="submit" name="btnupdate" value="Update" class="btn btn-primary col-md-12">
        </div>
    </td>
</tr> -->
        <tr class="w-100">
                    <td class="text-center" colspan="3">
                        <div class="modal-footer mx-auto">
                            <?php
                                echo "
                                <a href='Staff_Update.php?sid=$id' class='btn btn-primary col-md-12'>
                                     Update
                                </a>
                                ";
                            ?>
                            <!-- <input type="submit" name="btnupdate" value="Update" class="btn btn-primary col-md-12">
                            <a href='Product_Update.php?sid=$productCode' class='btn btn-success'>Update</a>|<a href='ProductDelete.php?sid=$productCode' class='btn btn-danger'>Delete</a> -->
                        </div>
                    </td>
                </tr>

           

        
       </table>
    </form>
    </div>
</div>

<div>

</div>



<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>