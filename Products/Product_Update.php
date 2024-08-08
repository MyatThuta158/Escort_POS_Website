<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Product_Class.php';

//---------This is for product update code---------//
if (isset($_REQUEST['sid'])) {
    $id=$_REQUEST['sid'];

    //echo $id;
    $select="SELECT * from products WHERE ProductCode='$id'";
    $query=mysqli_query($connect,$select);
    $count=mysqli_num_rows($query);

    if ($count>0) {
        $data=mysqli_fetch_array($query);
        $pCode=$data['ProductCode'];
        $name=$data['ProductName'];
        $color=$data['ProductAvailableColor'];
        $size=$data['ProductAvailableSize'];
        $price=$data['ProductPrice'];
        $qty=$data['Product_Quantity'];
       
   
    }else{
        echo "fail";
    }

   if (isset($_POST['btnupdate'])) {
        $code1=$_POST['txtCode'];
        $name1=$_POST['txtName'];
        $color1=$_POST['txtColor'];
        $size1=$_POST['txtSize'];
        $price1=$_POST['txtPrice'];
        $qty=$_POST['qty'];

        //--------Creating obj to update informatioin---//
        $obj=new Products($connect);
        $obj->updateProduct($code1,$name1,$color1,$size1,$price1,$qty);
   }
}else{
    echo "Fail";
}

?>


<div class="form-group col-md-7 mx-auto ml-md-8">
<div class="modal-content">
    <h1 class="text-center p-2">Update Products</h1>
    <form class="rForm needs-validation form-group p-3" method="POST" action="" novalidate>
        <div class="form-row">
           

        
                <input type="hidden" name="txtCode" class="" value="<?php echo $pCode; ?>">
               

            <div class="form-group col-md-6">
                <label for="">Product Name</label>
                <br>
                <input type="text" name="txtName" class="form-control" value="<?php echo $name; ?>" required>
                <div class="invalid-feedback">Please Enter Product Name!</div>
            </div>

            <div class="form-group col-md-6">
                <label for="">Size</label>
                <br>
                <input type="text" name="txtSize" class="form-control" value="<?php echo $size; ?>" required>
                <div class="invalid-feedback">Please Enter Product Size!</div>
            </div>
        </div>

        <div class="form-row">
            

            <div class="form-group col-md-6">
                <label for="">Color</label>
                <br>
                <input type="text" name="txtColor" class="form-control" value="<?php echo $color; ?>" required>
                <div class="invalid-feedback">Please Enter Product Color!</div>
            </div>

            <div class="form-group col-md-6">
                <label for="">Price</label>
                <br>
                 <input type="text" name="txtPrice" class="form-control" value="<?php echo $price; ?>" required>
                 <div class="invalid-feedback">Please Enter Product Price!</div>
            </div>
        </div>

       
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Sales quantity</label>
                <br>
                 <input type="text" name="qty" class="form-control" value="<?php echo $qty ?>" required>
                 <div class="invalid-feedback">Please Enter Sales quantity!</div>
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