<?php
     include_once "../includes/ConnectDB.php";
     include '../Classes/ProductType_Class.php';
 
     $id=$_REQUEST['sid'];//---Getting User clicked id for delete---
 
     //---------obj create for delete---//
     $obj=new Product_Type($connect);
     $obj->productTypeDelete($id);


?>