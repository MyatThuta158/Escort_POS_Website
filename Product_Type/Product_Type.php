<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/ProductType_Class.php';



//------------Add data into database code----------------//

//-------------insert data into data by calling add function from product type class----//
if (isset($_POST['btnAdd'])) {
        

    //----------Create object from product type class------//
    $obj=new Product_Type($connect);
    $obj->AddType($_POST['name']);//---calling function from class----//
}

?>


<div class="form-group col-md-5 mx-auto ml-md-8 p-1" >
    <div class="modal-content ">
      <form action="" method="POST" class="rForm needs-validation" novalidate>
      <h1 class="text-center p-1">Add Products Type</h1>
        <div class="modal-body">

            
              <div class="form-group col-md-8">
                <label>Product Type Name</label>
                <input type="text" name="name" placeholder="Enter Product Type Name!" class="form-control" required>
                <div class="invalid-feedback">Please Enter Product Type!</div>
              </div>

            
        <div class="modal-footer">
            <button type="submit" name="btnAdd" class="btn btn-primary col-2 mr-md-4">Save</button>
        </div>
      </form>
    </div>
</div>



   <div class="container mx-auto ml-md-6 p-1 mt-4" >

    <div class="table-responsive mx-auto" style="max-height: 300px; overflow-y:auto"> 

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
      <?php
    include('../includes/ConnectDB.php');
    $select="SELECT * from product_type";
    $run=mysqli_query($connect,$select);
    $count=mysqli_num_rows($run);

    if ($count>0) {
        
        echo "<tr>
            <td>Product Type ID</td>
            <td>Product Type Name</td>
            <td>action</td>
        </tr>";
        for ($i=0; $i <$count ; $i++) { 
            $data=mysqli_fetch_array($run);
            $productTCode=$data['ProductTypeID'];
            $name=$data['ProductTypeName'];
            
            echo "<tr>
            
            <td>$productTCode</td>
            <td>$name</td>
            <td><a href='ProductTypeUpdate.php?sid=$productTCode' class='btn btn-success'>Update</a>|<a href='ProductTypeDelete.php?sid=$productTCode' class='btn btn-danger'>Delete</a></td>
            </tr>";


        }
       
    }else{
        echo "<h1>Not Found data!</h1>";
    }

?>
      </table>

    <!-- </div>
  </div> -->
</div>

</div>
<!-- /.container-fluid -->

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>
<script src="../js/FormValidate.js"></script>