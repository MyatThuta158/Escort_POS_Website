<?php
    // session_start();

    include('../includes/header.php'); 
    include('../includes/navbar.php'); 
    include '../includes/ConnectDB.php';
    include ('../includes/scripts.php');

?>

<div class="row ml-2">
  <div class="col-md-5">
    <form method="POST" action="OrderSearch.php">
      <h3 for="date-sort">Search Order:</h3>
      <div class="input-group mb-3">
        <input type="text" name="searchID" class="form-control" placeholder="Search..." aria-label="Search" aria-describedby="search-btn">
        <div class="input-group-append">
          <button class="btn btn-dark" type="submit" name="btnSearch" id="search-btn">Search</button>
        </div>
      </div>
    </form>
    <form action="" method="POST">
       <button class="btn btn-dark" type="submit" name="showAll" id="search-btn">Show All</button>
    </form>
  </div>
  <div class="col-md-5 ml-md-4">
    <form method="POST">
      <div class="form-group row">
        <div class="col-md-12">
          <h3 for="date-sort">Search by Date:</h3>
        </div>
          <div class="col-md-6">
            <h6>From</h6>
            <input type="date" class="form-control" name="start" value="<?php echo date('Y-m-d') ?>">
          </div>
          <div class="col-md-6">
            <h6>To</h6>
            <input type="date" class="form-control" name="end" value="<?php echo date('Y-m-d')?>">
          </div>
          <div class="col-md-12">
            <button class="btn btn-dark btn-block mt-2" type="submit" name="btnDate" id="search-btn">Search</button>
          </div>
      </div>
    </form>
  </div>
</div>

<?php

  if (isset($_POST['btnSearch'])) {

    $orderID1 = $_POST['searchID']; // Assuming 'searchID' is the name of the input field in your form
    // echo $orderID1;
    //Use prepared statements to prevent SQL injection
   // $select = "SELECT * FROM orders WHERE Order_Code LIKE '%$orderID%'";
    //$result = mysqli_query($connect, $select);
    
    $select1 = "SELECT * FROM orders WHERE Order_Code LIKE ?";
    $stmt1 = mysqli_prepare($connect, $select1);
    mysqli_stmt_bind_param($stmt1, 's', $searchParam1);
    $searchParam1 = "%$orderID1%";
    mysqli_stmt_execute($stmt1);
    
    $result1 = mysqli_stmt_get_result($stmt1);
    $rows1 = mysqli_num_rows($result1);

    // $select = "SELECT * FROM orders WHERE Order_Code like CONCAT('%', ?, '%')";
    // $stmt = mysqli_prepare($connect, $select);
    // mysqli_stmt_bind_param($stmt, 's', $orderID);
    // mysqli_stmt_execute($stmt);

    // $result = mysqli_stmt_get_result($stmt);
   // $rows = mysqli_num_rows($result);

    echo "<h1 class='text-center mt-5'>Search results</h1>
    <div class='table-responsive mt-5 mb-5'>
        <table class='table table-striped'>

                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Total Quantity</th>
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>";

    if ($rows1>0) {

      for ($i=0; $i <$rows1 ; $i++) { 
        $data1=mysqli_fetch_array($result1);
        $code=$data1['Order_Code'];
        $qty=$data1['TotalQuantity'];
        $price=$data1['TotalAmount'];
        $date=$data1['OrderDate'];
        $status=$data1['Order_Status'];
    
        ?>
        <tr>
            <td><?php echo $code ?></td>
            <td><?php echo $qty ?></td>
            <td><?php echo $price ?>MMK</td>
            <td><?php echo $date ?></td>
            <td><?php echo $status ?></td>
            <td>
            <?php
              if ($status=='Pending.....') {
                echo "<td><a href='OrderDetail.php?oid=<?php echo $code ?>' class='btn btn-success'>View Detail</a></td>";
              } else{
                echo "<a href='OrderInformationDetail.php?ofid=$code' class='btn btn-success'> Order Info</a>";
              }
            ?>
            </td>
            
        </tr>
                    
            
        <?php
    }
  }

  echo "</table>
  </div>
  <hr>
  ";

    
    
  }elseif(isset($_POST['btnDate'])){

    echo "<div class='table-responsive mt-5 mb-5'>
    <table class='table table-striped'>";

    $startDate = $_POST['start'];
    $endDate = $_POST['end'];

// Constructing the SQL query with date range condition
$select = "SELECT * FROM orders 
           WHERE OrderDate >= ?
           AND OrderDate <= ?";

// Prepare the SQL statement
$stmt = mysqli_prepare($connect, $select);

// Bind parameters
mysqli_stmt_bind_param($stmt, 'ss', $startDate, $endDate); 

// Execute the statement
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$count = mysqli_num_rows($result);

if ($count > 0) {
    // Arrays to store orders for each status
    $pendingOrders = [];
    $processingOrders = [];
    $completedOrders = [];
    
    while ($data = mysqli_fetch_array($result)) {
        $code = $data['Order_Code'];
        $qty = $data['TotalQuantity'];
        $price = $data['TotalAmount'];
        $date = $data['OrderDate'];
        $status = $data['Order_Status'];
        
        // Depending on the status, store the order in the appropriate array
        switch ($status) {
            case 'Pending.....':
                $pendingOrders[] = [
                    'code' => $code,
                    'qty' => $qty,
                    'price' => $price,
                    'date' => $date,
                    'status' => $status
                ];
                break;
            case 'Declined':
                $processingOrders[] = [
                    'code' => $code,
                    'qty' => $qty,
                    'price' => $price,
                    'date' => $date,
                    'status' => $status
                ];
                break;
            case 'Confirmed':
                $completedOrders[] = [
                    'code' => $code,
                    'qty' => $qty,
                    'price' => $price,
                    'date' => $date,
                    'status' => $status
                ];
                break;
            // default:
            //    echo "<h3 class='text-center text-danger'>There is no Record between these date!</h3>";
            //     break;
        }
    }

    // var_dump($processingOrders);
    //var_dump($processingOrders);
    
    //Output pending orders
    if (!empty($pendingOrders)) {
        echo "<tr><td><h2>Pending Orders</h2></td></tr>";
        foreach ($pendingOrders as $order) {
            echo "<tr>
                    <td>{$order['code']}</td>
                    <td>{$order['qty']}</td>
                    <td>{$order['price']}MMK</td>
                    <td>{$order['date']}</td>
                    <td>{$order['status']}</td>
                    <td><a href='OrderDetail.php?oid={$order['code']}' class='btn btn-success'>View Detail</a></td>
                  </tr>";
        }
    }
    
    // Output processing orders
    if (!empty($processingOrders)) {
        echo "<tr><td><h2>Declined Orders</h2></td></tr>";
        foreach ($processingOrders as $order) {
            echo "<tr>
                    <td>{$order['code']}</td>
                    <td>{$order['qty']}</td>
                    <td>{$order['price']}MMK</td>
                    <td>{$order['date']}</td>
                    <td>{$order['status']}</td>
                    <td><a href='OrderInformationDetail.php?ofid={$order['code']}' class='btn btn-success'>Declined info</a></td>
                  </tr>";
        }
    }
    
    // Output completed orders
    if (!empty($completedOrders)) {
        echo "<h2><tr><td><h2>Confirm Orders</h2></td></tr></h2>";
        foreach ($completedOrders as $order) {
            echo "<tr>
                    <td>{$order['code']}</td>
                    <td>{$order['qty']}</td>
                    <td>{$order['price']}MMK</td>
                    <td>{$order['date']}</td>
                    <td>{$order['status']}</td>
                    <td><a href='OrderInformationDetail.php?ofid={$order['code']}' class='btn btn-success'>Confirm info</a></td>
                  </tr>";
        }
    }
} else {
    echo "No orders found for the specified date range.";
}


echo "
</table>
</div>";

  }else{

    $select="SELECT * from orders WHERE Order_Status='Pending.....'";
    $run=mysqli_query($connect,$select);
    $rows=mysqli_num_rows($run);

    echo "<h1 class='text-center mt-5'>All Orders</h1>
    <div class='table-responsive mt-5 mb-5'>
        <table class='table table-striped'>

          <h3 class='text-left'>Pending Order</h3>
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Total Quantity</th>
                            <th>Total Amount</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>";

    if ($rows>0) {

      for ($i=0; $i <$rows ; $i++) { 
        $data=mysqli_fetch_array($run);
        $code=$data['Order_Code'];
        $qty=$data['TotalQuantity'];
        $price=$data['TotalAmount'];
        $date=$data['OrderDate'];
        $status=$data['Order_Status'];
    
        ?>
        <tr>
            <td><?php echo $code ?></td>
            <td><?php echo $qty ?></td>
            <td><?php echo $price ?>MMK</td>
            <td><?php echo $date ?></td>
            <td><?php echo $status ?></td>
            <td><a href='OrderDetail.php?oid=<?php echo $code ?>' class='btn btn-success'>View Detail</a></td>
        </tr>
                    
            
        <?php
    }
  }

  echo "</table>
  </div>
  <hr>
  ";

  $select1="SELECT * from orders WHERE Order_Status='Confirmed'";
  $run1=mysqli_query($connect,$select1);
  $rows1=mysqli_num_rows($run1);

  echo "
  <div class='table-responsive mt-5 mb-5'>
      <table class='table table-striped'>

        <h3 class='text-left'>Confirmed Order</h3>
                  <thead>
                      <tr>
                          <th>Order Code</th>
                          <th>Total Quantity</th>
                          <th>Total Amount</th>
                          <th>Order Date</th>
                          <th>Status</th>
                          <th>Detail</th>
                      </tr>
                  </thead>";

  if ($rows>0) {

    for ($i=0; $i <$rows1 ; $i++) { 
      $data1=mysqli_fetch_array($run1);
      $code1=$data1['Order_Code'];
      $qty1=$data1['TotalQuantity'];
      $price1=$data1['TotalAmount'];
      $date1=$data1['OrderDate'];
      $status1=$data1['Order_Status'];
  
      ?>
      <tr>
          <td><?php echo $code1 ?></td>
          <td><?php echo $qty1 ?></td>
          <td><?php echo $price1 ?>MMK</td>
          <td><?php echo $date1 ?></td>
          <td><?php echo $status1 ?></td>
          <td><a href='OrderInformationDetail.php?ofid=<?php echo $code1 ?>' class='btn btn-success'>Confirm info</a></td>
      </tr>
                  
          
      <?php
  }
}

echo "</table>
</div>
<hr>
";


$select2="SELECT * from orders WHERE Order_Status='Declined'";
$run2=mysqli_query($connect,$select2);
$rows2=mysqli_num_rows($run2);

echo "
<div class='table-responsive mt-5 mb-5'>
    <table class='table table-striped'>

      <h3 class='text-left'>Declined Order</h3>
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>Total Quantity</th>
                        <th>Total Amount</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>";

if ($rows>0) {

  for ($i=0; $i <$rows2 ; $i++) { 
    $data2=mysqli_fetch_array($run2);
    $code2=$data2['Order_Code'];
    $qty2=$data2['TotalQuantity'];
    $price2=$data2['TotalAmount'];
    $date2=$data2['OrderDate'];
    $status2=$data2['Order_Status'];

    ?>
    <tr>
        <td><?php echo $code2 ?></td>
        <td><?php echo $qty2 ?></td>
        <td><?php echo $price2 ?>MMK</td>
        <td><?php echo $date2 ?></td>
        <td><?php echo $status2 ?></td>
        <td><a href='OrderInformationDetail.php?ofid=<?php echo $code2 ?>' class='btn btn-success'>Declined info</a></td>
    </tr>
                
        
    <?php
}
}

echo "</table>
</div>
<hr>
";

  }

    include('../includes/footer.php');
?>