<?php
//---------------------Create Auto ID-----------------//
function Auto_ID($tableName, $fieldName, $prefix, $noOfLeadingZeros)
{
    include "includes/ConnectDB.php"; 

    $sql = "SELECT $fieldName FROM $tableName ORDER BY $fieldName DESC LIMIT 1";

    $result = mysqli_query($connect, $sql);

    if ($result) {
        $row = mysqli_fetch_array($result);
        $lastID = $row ? $row[$fieldName] : null;

        if ($lastID !== null) {
            $newNumber = preg_replace('/[^0-9]/', '', $lastID) + 1;
        } else {
            $newNumber = 1;
        }

        $newID = $prefix . str_pad($newNumber, $noOfLeadingZeros, '0', STR_PAD_LEFT);

        return $newID;
    } else {
        die("Error: " . mysqli_error($connect));
    }


    function NumberFormatter($number,$n)
    {
        return str_pad((int) $number,$n,"0",STR_PAD_LEFT);///Increase from left
    }
}
?>
