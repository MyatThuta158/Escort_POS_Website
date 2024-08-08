<?php
     include_once "../includes/ConnectDB.php";
     include '../Classes/Promotion_class.php';

     if (isset($_REQUEST['pid'])) {
        $id=$_REQUEST['pid'];//---Getting User clicked id for delete---

        //---------obj create for delete---//
     $obj=new Promotions($connect);
     $obj->promotionDelete($id);
     }else{
        echo "Error";
     }
 
     
 

?>