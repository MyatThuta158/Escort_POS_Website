<?php
     include_once "../includes/ConnectDB.php";
     include '../Classes/Product_Class.php';

     if (isset($_REQUEST['sid'])) {
        $id=$_REQUEST['sid'];//---Getting User clicked id for delete---

        //---------obj create for delete---//
     $obj=new Products($connect);
     $obj->productDelete($id);
     }else{
        echo "Error";
     }
 
     
 

?>