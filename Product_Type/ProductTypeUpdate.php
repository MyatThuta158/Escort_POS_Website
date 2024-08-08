<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/ProductType_Class.php';

//---------This is for product update code---------//
if (isset($_REQUEST['sid'])) {
    $id=$_REQUEST['sid'];

    //echo $id;
    $select="SELECT * from product_type WHERE ProductTypeID='$id'";
    $query=mysqli_query($connect,$select);
    $count=mysqli_num_rows($query);

    if ($count>0) {
        $data=mysqli_fetch_array($query);
        $pCode=$data['ProductTypeID'];
        $name=$data['ProductTypeName'];
    }else{
        echo "fail";
    }

   if (isset($_POST['btnupdate'])) {
        $code1=$_POST['txtCode'];
        $name1=$_POST['txtName'];

        //--------Creating obj to update informatioin---//
        $obj=new Product_Type($connect);
        $obj->updateProductType($code1,$name1);
   }
}else{
    echo "Fail";
}
?>


<div class="form-group col-md-5 mx-auto ml-md-8">
<div class="modal-content">
    <h1 class="text-center p-2">Update Products</h1>
    <form class="rForm needs-validation form-group p-3" method="POST" action="" novalidate>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="">Product Type Name</label>
                <br>
                <input type="text" name="txtName" value="<?php echo $name; ?>" class="form-control" required>
                <input type="hidden" name="txtCode" value="<?php echo $pCode; ?>">
                <div class="invalid-feedback">Please Enter Product Type!</div>
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