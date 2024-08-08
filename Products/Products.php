<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Product_Class.php';



//------------Add data into database code----------------//

if (isset($_POST['btnAddProduct'])) {
        
  $code=$_POST['pcode'];
  $name=$_POST['name'];
  $color=$_POST['color'];
  $size=$_POST['size'];
  $price=$_POST['price'];
  $pt=$_POST['pType'];
  $qty=$_POST['qty'];

  //create object in order to insert data into database----
  $obj=new Products($connect);
  $obj->AddProduct($code,$name,$pt,$color,$size,$price,$_FILES['pImg'],$qty);
}

?>


      <div class="form-group col-md-7 mx-auto ml-md-8" >
    <div class="modal-content">
      <form action="" method="POST" enctype="multipart/form-data" class="rForm needs-validation" novalidate>
      <h1 class="text-center">Add Products</h1>
        <div class="modal-body">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Product Code</label>
                <input type="text" name="pcode" class="form-control" placeholder="Enter Product Code number!" required>
                <div class="invalid-feedback">Please Enter Product code!</div>
              </div>
              <div class="form-group col-md-6">
                <label>Product Name:</label>
                <input type="text" name="name" class="form-control" placeholder="Enter Product Name!" required>
                <div class="invalid-feedback">Please Enter Product Name!</div>
            </div>
            </div>
            

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Product Available Color</label>
                <input type="text" name="color" class="form-control" placeholder="Enter available color!" required>
                <div class="invalid-feedback">Please Enter Product available color!</div>
              </div>

              <div class="form-group col-md-6">
                <label>Product Available Size</label>
                <input type="text" name="size" class="form-control" placeholder="Enter Product Available Size!" required>
                <div class="invalid-feedback">Please Enter Product Available Size!</div>
              </div>
            </div>
            

            <div class="form-row">
               <div class="form-group col-md-6">
                <label>Product Price (MMK)</label>
                <input type="number" name="price" class="form-control" placeholder="Enter Product Price (MMK)!" required>
                <div class="invalid-feedback">Please Enter Product Price!</div>
              </div>


              <div class="form-group col-md-6">
              <label>Product Type</label>
                    <select name="pType" class="form-control" required>
                     <option value=''>Choose Product Type</option>
                          <?php
                            $select = "SELECT * FROM product_type";
                            $run = mysqli_query($connect, $select);

                             while ($data = mysqli_fetch_array($run)) { 
                             $ptID = $data['ProductTypeID'];
                             $ptName = $data['ProductTypeName'];

                             echo "<option value='$ptID'>$ptName</option>";
                                 }
                           ?>
                    </select>
                    <div class="invalid-feedback">Please Select product type!</div>
              </div>


              
            </div>

  

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="pImg">Product Image</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="pimg" name="pImg" required onchange="updateFileName(this)">
                        <label class="custom-file-label" for="pImg">Choose file</label>
                    </div>
                    <div class="invalid-feedback">Please choose a Product Image!</div>
                </div>

                <div class="form-group col-md-6">
                <label>Products Sales Quantity</label>
                <input type="number" name="qty" class="form-control" placeholder="Enter Product Sales Quantity!" required>
                <div class="invalid-feedback">Please Enter Product product sales quantity!</div>
            </div>

        
        </div>
        <div class="modal-footer">
            <button type="submit" name="btnAddProduct" class="btn btn-primary col-2 mr-md-4">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>


   <div class="container mx-4 ml-md-1 col-md-12" >

    <div class="table-responsive mx-4" style="max-height: 300px; overflow-y:auto"> 

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
      <?php
    include('../includes/ConnectDB.php');
    $select="SELECT * from products";
    $run=mysqli_query($connect,$select);
    $count=mysqli_num_rows($run);

    if ($count>0) {
        
        echo "<tr>
            <td>Product Code</td>
            <td>Product Name</td>
            <td>Image</td>
            <td>Available color</td>
            <td>Available size</td>
            <td>Product Price</td>
            <td>Quantity</td>
            <td>action</td>
        </tr>";
        for ($i=0; $i <$count ; $i++) { 
            $data=mysqli_fetch_array($run);
            $productCode=$data['ProductCode'];
            $name=$data['ProductName'];
            $color=$data['ProductAvailableColor'];
            $size=$data['ProductAvailableSize'];
            $price=$data['ProductPrice'];
            $img=$data['Product_Image'];
            $qty=$data['Product_Quantity'];
            
            echo "<tr>
            
            <td>$productCode</td>
            <td>$name</td>
            <td><img src='$img' style='width:9.8vw; object-fit:cover'></td>
            <td>$color</td>
            <td>$size</td>
            <td>$price MMK</td>
            <td>$qty</td>
            <td><a href='Product_Update.php?sid=$productCode' class='btn btn-success'>Update</a>|<a href='ProductDelete.php?sid=$productCode' class='btn btn-danger'>Delete</a></td>
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
<script>
  function updateFileName(input) {
  var fileName = input.files[0].name;
  var label = input.nextElementSibling;
  label.innerText = fileName;
}
</script>