<?php
// Include the file that establishes the database connection
include '../includes/ConnectDB.php';

// SQL query to create the table
$Bookingstb = "CREATE TABLE promotion_products (
    ProductCode varchar(20) NOT NULL,
    Promotion_Code varchar(50) NOT NULL,
    Unit_Promotion_Product_Price Decimal,
    Primary Key(ProductCode, Promotion_Code),
    Foreign Key(ProductCode) References products(ProductCode),
    Foreign Key(Promotion_Code) References promotions(Promotion_Code)
)";

// Execute the query
$query = mysqli_query($connect, $Bookingstb);

// Check if the query was successful
if ($query) {
    echo "Promotion Products Table Successfully Created";
} else {
    echo "Error in DB statement: " . mysqli_error($connect); 
}
?>
