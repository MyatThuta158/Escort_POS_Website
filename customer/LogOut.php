<?php
    session_start();
    include('../includes/ConnectDB.php');
    unset($_SESSION['urid']);
    unset($_SESSION['ShoppingCartFunctions']);
    unset($_SESSION['PType']);

    echo "<script>window.alert('LogOut Successfully')</script>";
    echo "<script>window.location.href='../login.php'</script>";

?>