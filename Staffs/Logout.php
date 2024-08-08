<?php
    session_start();
    include '../includes/ConnectDB.php';


    unset($_SESSION['userName']);
    unset($_SESSION['Role']);
    unset($_SESSION['SImg']);
    unset($_SESSION['uid']);
    unset($_SESSION['Purchase_Function']);
    unset($_SESSION['Promotion_Function']);

    echo "<script>window.alert('Logout successfully')</script>";
    echo "<script>window.location.href='../login.php'</script>";

?>