<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Manufacturer_Class.php';



 //-------------insert data into data by calling add function from product type class----//
 if (isset($_POST['btnAddManufacturer'])) {
        

    //----------Create object from product type class------//
    $obj=new Manufacturers($connect);
   $obj->AddManufacturer($_POST['name'],$_POST['email'],$_POST['phoneNo'],$_POST['address']);//---calling function from class----//



}

?>


      <div class="form-group col-md-7 mx-auto ml-md-8" >
    <div class="modal-content">
      <form action="" method="POST" class="needs-validation rForm" novalidate>
      <h1 class="text-center">Add Manufacturer</h1>
        <div class="modal-body">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter Manufacturer Name!" class="form-control" required>
                <div class="invalid-feedback">Please Enter Manufacturer Name!</div>
              </div>
              <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter Manufacturer Email address!" class="form-control" required>
                <div class="invalid-feedback">Please Enter Manufacturer Email!</div>
            </div>
            </div>
            

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Phone Number</label>
                <input type="text" name="phoneNo" placeholder="Enter Manufacturer Phone Number Name!" class="form-control" required>
                <div class="invalid-feedback">Please Enter Phone Number!</div>
              </div>

              <div class="form-group col-md-6">
                <label>Address</label>
                <input type="text" name="address" placeholder="Enter Manufacturer Address!" class="form-control" required>
                <div class="invalid-feedback">Please Enter Manufacturer address!</div>
              </div>
            </div>
            
        <div class="modal-footer">
            <button type="submit" name="btnAddManufacturer" class="btn btn-primary col-2 mr-md-4">Save</button>
        </div>
      </form>

    </div>
</div>


   <div class="container mx-auto mt-3" style="width: 59vw;" >

    <div class="table-responsive" style="max-height: 300px; overflow-y:auto"> 

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
      <?php
    include('../includes/ConnectDB.php');
    $select="SELECT * from manufacturers";
    $run=mysqli_query($connect,$select);
    $count=mysqli_num_rows($run);

    if ($count>0) {
     
        echo "<tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>PhoneNo</td>
            <td>Address</td>
            <td>action</td>
        </tr>";
        for ($i=0; $i <$count ; $i++) { 
            $data=mysqli_fetch_array($run);
            $mID=$data['Manufacturer_ID'];
            $name=$data['Manufacturer_Name'];
            $phoneNo=$data['Manufacturer_PhoneNo'];
            $email=$data['Manufacturer_Email'];
            $address=$data['Manufacturer_Address'];
            
            echo "<tr>
            
            <td>$mID</td>
            <td>$name</td>
            <td>$phoneNo</td>
            <td>$email</td>
            <td>$address</td>
            <td><a href='ManufacturerUpdate.php?sid=$mID' class='btn btn-success'>Update</a>|<a href='ManufacturerDelete.php?sid=$mID' class='btn btn-danger'>Delete</a></td>
            </tr>";


        }
      
    }else{
        echo "<h1>Not Found data!</h1>";
    }
?>
      </table>

</div>

</div>

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>
<script src="../js/FormValidate.js"></script>