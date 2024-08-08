
<?php
    include('../includes/header.php');
    include('../includes/navbar.php'); 
    include '../includes/ConnectDB.php';
    include '../Classes/Staff_Class.php';

    if (isset($_POST['btnRegister'])) {

		//---inserting post value to variable---//
		$name=$_POST['txtAname'];
		$password=$_POST['txtpassword'];
		$email=$_POST['txtemail'];
		$phone=$_POST['txtphone'];
        $role=$_POST['selectRole'];

		//---Calling object for storing data in database---//
		$createUser=new Staffs($connect);
		$createUser->Register($name,$email,$password,$phone,$role,$_FILES['img']);//--inserting user value---//
		//$createUser->Register($name,$email,$password,$phone,$role,$_FILES['img']);
	}
?>
<style>
    .is-invalid {
    border-color: #dc3545 !important; /* Red border color */
}
</style>

<div class="container mt-2">
    <form action="" method="POST" enctype="multipart/form-data" id="aRegisterform" class="needs-validation" novalidate>
        <h1 class="text-center">User Register Form</h1>

        <div class="form-group">
            <label for="name">User Name</label>
            <input type="text" name="txtAname" class="form-control" placeholder="Enter staff Full name" id="name" required>
            <div class="invalid-feedback">Please Enter Name!</div>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="txtpassword" class="form-control" placeholder="Enter Staff Password" id="password" required>
            <div class="invalid-feedback">Please Enter Password!</div>
            <div class="password-invalid text-danger" style="display: none;">Password should contain at least 8 character with uppercase,lowercase and special character</div>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="txtemail" class="form-control" placeholder="Enter Staff Email" id="email" required>
            <div class="invalid-feedback">Please Enter a Valid Email!</div>
        </div>

        <div class="form-group">
            <label for="phoneNo">Phone No</label>
            <input type="text" name="txtphone" class="form-control" placeholder="Enter Staff Phone Number" id="phoneNo" required>
            <div class="invalid-feedback">Please Enter Phone Number!</div>
        </div>

        <div class="form-group">
            <label for="img">Staff Image</label>
            <input type="file" name="img" class="form-control-file">
        </div>

        <div class="form-group">
            <label for="selectRole">Staff Role</label>
            <select name="selectRole" class="form-control" required>
            <?php 

                echo "<option value=''>Choose Staff Role</option>";
                    $select="SELECT * from staff_role";
                    $run=mysqli_query($connect,$select);
                    $count=mysqli_num_rows($run);
                    for ($i=0; $i <$count ; $i++) { 
                        $data=mysqli_fetch_array($run);
                        $RID=$data['Role_id'];
                        $RN=$data['Role'];
                        echo "<option value='$RID'>$RN</option>";
                    }
                ?>
            </select>
            <div class="invalid-feedback">Please Select a Role!</div>
        </div>

        <div class="form-group">
            <input type="submit" name="btnRegister" value="Register" class="btn btn-success">
            <br>
        </div>
    </form>

    <?php
        include('../includes/scripts.php');
        include('../includes/footer.php');
    ?>

    <script>

document.addEventListener("DOMContentLoaded", function () {
    let form = document.querySelector('#aRegisterform');
    let password = document.querySelector('#password');

    password.addEventListener('input', () => {
        let passwordValue = password.value;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        let invalid = document.querySelector('.password-invalid');
        if (passwordValue.trim() !== '' && !passwordRegex.test(passwordValue)) {
            invalid.style.display = 'block';
        } else {
            invalid.style.display = 'none';
        }
    });

    form.addEventListener('submit', (e) => {
        let passwordValue = password.value;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        let invalid = document.querySelector('.password-invalid');
        if (passwordValue.trim() !== '' && !passwordRegex.test(passwordValue)) {
            e.preventDefault();
            invalid.style.display = 'block';
            // Pmessage.style.display='block';
        } else {
            invalid.style.display = 'none';
        }

        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }

        form.classList.add('was-validated');
    });
});


    </script>
</div>
