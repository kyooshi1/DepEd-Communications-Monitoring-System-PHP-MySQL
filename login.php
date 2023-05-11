<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
  ob_start();
  // if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  // }
  ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>
<?php include 'header.php' ?>

<!-- Favicon icon -->
<link rel="icon" href="assets/images/Dep.ico" type="image/x-icon">
<!-- fontawesome icon -->
<link rel="stylesheet" href="assets/fonts/fontawesome/css/fontawesome-all.min.css">
<!-- animation css -->
<link rel="stylesheet" href="assets/plugins/animation/css/animate.min.css">
<!-- vendor css -->
<link rel="stylesheet" href="assets/css/style.css">

<body>
<div class="auth-wrapper">
        <div class="auth-content">
            <div class="auth-bg">
                <span class="r"></span>
                <span class="r s"></span>
                <span class="r s"></span>
                <span class="r"></span>
            </div>
            <div class="card">
                <form action="" id="login-form">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i class="feather icon-unlock auth-icon"></i>
                        </div>
                        <h3 class="mb-4">Login</h3>
                        <div class="input-group mb-3">
                            <input type="email" class="form-control"name="email" placeholder="Email" value="">
                        </div>
                        <span class="help-block"></span>
                        <div class="input-group mb-4">
                            <input type="password" class="form-control" name="password" placeholder="password">
                        </div>
                        <div class="form-group mb-1">
                          <label for="">Choose Department</label>
                          <select name="login" id="" class="custom-select custom-select-sm">
                          <option value="0">Employee</option>
                          <option value="1">Power User</option>
                          <option value="2">Admin</option>
                          <option value="3">SDO-SDS/ASDS</option>
                          <option value="4">SDO-Finance Accounting</option>
                          <option value="5">SDO-Finance Budget</option>
                          <option value="6">SDO-AS-Administrative Services</option>
                          <option value="7">SDO-AS-Records</option>
                          <option value="8">SDO-AS-Supplies/option>
                          <option value="9">SDO-AS-Cashier</option>
                          <option value="10">SDO-AS-HRMO</option>
                          <option value="11">SDO-ICT</option>
                          <option value="12">SDO-Legal</option>
                          <option value="13">SDO-SGOD</option>
                          <option value="14">SDO-CID</option>
                          
                          </select>
                        </div>
                        <span class="help-block"></span>
                        <div class="form-group text-left">
                            <div class="checkbox checkbox-fill d-inline">
                                <input type="checkbox" id="remember" checked="">
                                <label for="remember" class="cr"> Save Details</label>
                            </div>
                        </div>
                        <button class="btn btn-primary shadow-2 mb-4">Sign In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- /.login-box -->
<script>
  $(document).ready(function(){
    $('#login-form').submit(function(e){
    e.preventDefault()
    start_load()
    if($(this).find('.alert-danger').length > 0 )
      $(this).find('.alert-danger').remove();
    $.ajax({
      url:'ajax.php?action=login',
      method:'POST',
      data:$(this).serialize(),
      error:err=>{
        console.log(err)
        end_load();

      },
      success:function(resp){
        if(resp == 1){
          location.href ='index.php?page=home';
        }else{
          $('#login-form').prepend('<div class="alert alert-danger">Username, Password or Department Selected may be incorrect.</div>')
          end_load();
        }
      }
    })
  })
  })
</script>
<?php include 'footer.php' ?>


    <!-- Required Js -->
    <script src="assets/js/vendor-all.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>
