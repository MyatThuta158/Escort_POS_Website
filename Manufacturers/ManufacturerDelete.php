<?php
     include_once "../includes/ConnectDB.php";
     include '../Classes/Manufacturer_class.php';
 
     $id=$_REQUEST['sid'];//---Getting User clicked id for delete---
 
     //---------obj create for delete---//
     $obj=new Manufacturers($connect);
     $obj->ManufacturerDelete($id);


?>