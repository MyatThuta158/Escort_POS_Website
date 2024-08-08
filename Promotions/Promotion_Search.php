<?php
    include('../includes/header.php'); 
    include('../includes/navbar.php'); 
    include('../includes/ConnectDB.php');
?>

<div class="container">
  <div class="row">
  <form method="POST" class="col-md-6 input-group">
      <input type="text" name="name" class="form-control" id="name-search" placeholder="Search by Promotion Name or code">
      <div class="input-group-append">
        <button type="submit" name="btnName" class="btn btn-primary" id="name-search-btn">Search</button>
      </div>
    </form>
    <form method="POST" class="col-md-6 input-group">
      <input type="text" name="year" class="form-control" id="year-search" placeholder="Search by Year">
      <div class="input-group-append">
        <button type="submit" name="btnYear" class="btn btn-primary" id="year-search-btn">Search</button>
      </div>
    </form>
  </div>
  <form method="POST" class="col-md-6 input-group mt-3">
        <button type="submit" name="" class="btn btn-primary">Show All</button>
    </form>
</div>

<?php

    if (isset($_POST['btnName'])) {

        $value = $_POST['name'];
        $searchPara = "%$value%";
        $select = "SELECT * from promotions WHERE Promotion_Code LIKE ? OR Promotion_Name LIKE ?";
        $stm = mysqli_prepare($connect, $select);
        mysqli_stmt_bind_param($stm, 'ss', $searchPara, $searchPara);
        mysqli_stmt_execute($stm);
        $result = mysqli_stmt_get_result($stm);
        $row = mysqli_num_rows($result);


        echo "<h1 class='text-center mt-5'>Search results</h1>
    <div class='table-responsive mt-5 mb-5'>
        <table class='table table-striped'>

                    <thead>
                        <tr>
                            <th>Promotion Code</th>
                            <th>Promotion Name</th>
                            <th>Promotion Start Date</th>
                            <th>Promtion End Date</th>
                            <th>Promotion Amount</th>
                            <th>Detail</th>
                        </tr>
                    </thead>";

        if ($row>0) {
            for ($i=0; $i <$row ; $i++) { 
                $info=mysqli_fetch_array($result);
                $code=$info['Promotion_Code'];
                $name=$info['Promotion_Name'];
                $startDate=$info['PromotionStartDate'];
                $endDate=$info['PromotionEndDate'];
                $amount=$info['PromotionAmount'];

                ?>

                    <tr>
                        <td><?php echo $code ?></td>
                        <td><?php echo $name ?></td>
                        <td><?php echo $startDate ?></td>
                        <td><?php echo $endDate ?></td>
                        <td><?php echo $amount ?></td>
                        <td><a href='Promotion_Detail.php?poid=<?php echo $code ?>' class='btn btn-success'> View Promotion</a></td>
                    </tr>

                <?php
            }
        }

        echo "</table>
        </div>";
    }
    elseif(isset($_POST['btnYear'])){
        // Assuming $year contains the year you want to search for, e.g., 2024
        $year = $_POST['year']; // Assuming you're getting the year from a form input

        // SQL query to select data for a specific year
        $select1 = "SELECT * FROM promotions WHERE YEAR(PromotionStartDate) = ?";
        $stm1 = mysqli_prepare($connect, $select1);
        mysqli_stmt_bind_param($stm1, 'i', $year); 
        mysqli_stmt_execute($stm1);
        $result1 = mysqli_stmt_get_result($stm1);
        $row1 = mysqli_num_rows($result1);

        echo "<h1 class='text-center mt-5'>Search results</h1>
        <div class='table-responsive mt-5 mb-5'>
            <table class='table table-striped'>
    
                        <thead>
                            <tr>
                                <th>Promotion Code</th>
                                <th>Promotion Name</th>
                                <th>Promotion Start Date</th>
                                <th>Promtion End Date</th>
                                <th>Promotion Amount</th>
                                <th>Detail</th>
                            </tr>
                        </thead>";

        if ($row1>0) {
            for ($i=0; $i <$row1 ; $i++) { 
                $info1=mysqli_fetch_array($result1);
                $code1=$info1['Promotion_Code'];
                $name1=$info1['Promotion_Name'];
                $startDate1=$info1['PromotionStartDate'];
                $endDate1=$info1['PromotionEndDate'];
                $amount1=$info1['PromotionAmount'];

                ?>

                    <tr>
                        <td><?php echo $code1 ?></td>
                        <td><?php echo $name1 ?></td>
                        <td><?php echo $startDate1 ?></td>
                        <td><?php echo $endDate1 ?></td>
                        <td><?php echo $amount1 ?></td>
                        <td><a href='Promotion_Detail.php?poid=<?php echo $code1 ?>' class='btn btn-success'> View Promotion</a></td>
                    </tr>

            <?php
            }
        }
        echo "
        </table>
        </div>";

    }else{
        $select3="SELECT * from promotions";
        $run3=mysqli_query($connect,$select3);
        $count3=mysqli_num_rows($run3);

        
        echo "<h1 class='text-center mt-5'>Search results</h1>
        <div class='table-responsive mt-5 mb-5'>
            <table class='table table-striped'>
    
                        <thead>
                            <tr>
                                <th>Promotion Code</th>
                                <th>Promotion Name</th>
                                <th>Promotion Start Date</th>
                                <th>Promtion End Date</th>
                                <th>Promotion Amount</th>
                                <th>Detail</th>
                            </tr>
                        </thead>";

        if ($count3>0) {
            for ($i=0; $i <$count3 ; $i++) { 
                $info3=mysqli_fetch_array($run3);
                $code3=$info3['Promotion_Code'];
                $name3=$info3['Promotion_Name'];
                $startDate3=$info3['PromotionStartDate'];
                $endDate3=$info3['PromotionEndDate'];
                $amount3=$info3['PromotionAmount'];

                ?>

                    <tr>
                        <td><?php echo $code3 ?></td>
                        <td><?php echo $name3 ?></td>
                        <td><?php echo $startDate3 ?></td>
                        <td><?php echo $endDate3 ?></td>
                        <td><?php echo $amount3 ?></td>
                        <td><a href='Promotion_Detail.php?poid=<?php echo $code3 ?>' class='btn btn-success'> View Promotion</a></td>
                    </tr>

            <?php
            }
        }
    }

?>

<?php

    include('../includes/scripts.php');
?>