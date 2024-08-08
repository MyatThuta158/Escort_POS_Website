<?php
include('../includes/header.php'); 
include('../includes/navbar.php'); 
include '../includes/ConnectDB.php';
include '../Classes/Promotion_class.php';



 //-------------insert data into data by calling add function from product type class----//
 if (isset($_POST['btnAdd'])) {
        

    //----------Create object from product type class------//
    $obj=new Promotions($connect);
   $obj->AddPromotion($_POST['code'],$_POST['name'],$_POST['sDate'],$_POST['eDate'],$_POST['amount']);//---calling function from class----//



}

?>


      <div class="form-group col-md-7 mx-auto ml-md-8" >
    <div class="modal-content">
      <form action="" method="POST" class="needs-validation rForm" novalidate>
      <h1 class="text-center">Add Promotions</h1>
        <div class="modal-body">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Promotion code</label>
                <input type="text" name="code" placeholder="Enter Promotion Code!" class="form-control" required>
                <div class="invalid-feedback">Please Enter Promotion Code!</div>
              </div>
              <div class="form-group col-md-6">
                <label>Promotion Name</label>
                <input type="text" name="name" placeholder="Enter Promotion Name!" class="form-control" required>
                <div class="invalid-feedback">Please Enter Promotion Name!</div>
            </div>
            </div>
            

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Start date</label>
                <input type="date" name="sDate"  class="form-control" required>
                <div class="invalid-feedback">Please Select start date!</div>
              </div>

              <div class="form-group col-md-6">
                <label>End date</label>
                <input type="date" name="eDate"  class="form-control" required>
                <div class="invalid-feedback">Please Select End Date!</div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Promotion percentage amount</label>
                <input type="number" name="amount"  class="form-control" required>
                <div class="invalid-feedback">Please Enter Amount!</div>
              </div>
            </div>
            
        <div class="modal-footer">
            <button type="submit" name="btnAdd" class="btn btn-primary col-2 mr-md-4">Save</button>
        </div>
      </form>

    </div>
</div>


   <div class="container mx-auto mt-3" style="width: 55vw;" >

    <div class="table-responsive" style="max-height: 300px; overflow-y:auto"> 

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
      <?php
    include('../includes/ConnectDB.php');
    $select="SELECT * from promotions";
    $run=mysqli_query($connect,$select);
    $count=mysqli_num_rows($run);

    if ($count>0) {
     
        echo "<tr>
            <td>Code</td>
            <td>Name</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Amount</td>
            <td>action</td>
        </tr>";
        for ($i=0; $i <$count ; $i++) { 
            $data=mysqli_fetch_array($run);
            $code=$data['Promotion_Code'];
            $name=$data['Promotion_Name'];
            $startDate=$data['PromotionStartDate'];
            $endDate=$data['PromotionEndDate'];
            $amount=$data['PromotionAmount'];
            
            echo "<tr>
            
            <td>$code</td>
            <td>$name</td>
            <td>$startDate</td>
            <td>$endDate</td>
            <td>$amount %</td>
            <td><a href='Promotions_Update.php?sid=$code' class='btn btn-success'>Update</a>|<a href='PromotionDelete.php?pid=$code' class='btn btn-danger'>Delete</a></td>
            </tr>";


        }
      
    }else{
        echo "<h1>Not Found data!</h1>";
    }
?>
      </table>

</div>

</div>

<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>
<script src="../js/FormValidate.js"></script>