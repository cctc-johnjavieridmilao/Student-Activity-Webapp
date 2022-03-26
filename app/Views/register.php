<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?= $this->include('layout/css_plugins') ?>
</head>
<body>
<style>
 .content-wrapper {
  background-color: #005f33 !important;
 }
 #title {
   font-size: 20px;
   font-weight: bold;
   color: #005f33;
 }
 #logo_img {
  mix-blend-mode: multiply;
  height: 90px;
 }
</style>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-8 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <!-- <img src="../../images/logo.svg" alt="logo"> -->
              </div>
              <h4 id="title">REGISTER ACCOUNT</h4>
              <!-- <h6 class="fw-light">Sign up to continue.</h6> -->

              <div class="row">

                <div class="col-md-4 mb-2">
                  <input type="text" class="form-control form-control-lg userinput" id="fname" placeholder="Firstname">
                </div>

                <div class="col-md-4 mb-2">
                   <input type="text" class="form-control form-control-lg userinput" id="mname" placeholder="Middlename">
                </div>

                <div class="col-md-4 mb-2">
                  <input type="text" class="form-control form-control-lg userinput" id="lname" placeholder="Lastname">
                </div>

                <div class="col-md-6 mb-2">
                  <input type="email" class="form-control form-control-lg userinput" id="email" placeholder="Email">
                </div>

                <div class="col-md-6 mb-2">
                <input type="number" class="form-control form-control-lg userinput" value="63" id="phone_number" placeholder="Phone Number">
                </div>

                <div class="col-md-4 mb-2">
                  <input type="text" class="form-control form-control-lg userinput" id="username" placeholder="Username">
                </div>

                <div class="col-md-4 mb-2">
                  <input type="text" class="form-control form-control-lg userinput" id="studentid" placeholder="Student ID">
                </div>

                <div class="col-md-4 mb-2">
                   <select class="form-control form-control-lg userinput" id="department">
                      <option value="">Select Department</option>
                   </select>
                </div>

                <div class="col-md-6 mb-2">
                  <input type="password" class="form-control form-control-lg userinput" id="password" placeholder="Password">
                </div>

                <div class="col-md-6 mb-2">
                  <input type="password" class="form-control form-control-lg userinput" id="cpassword" placeholder="Confirm password">
                </div>

              </div>
              
                <div class="mt-3">
                  <a class="btn btn-block btn-warning font-weight-medium" style="width: 100%;" id="CreateAccount" href="javascript:void(0)">SIGN-UP</a>
                </div>
                <div class="mt-3">
                   <a href="<?= base_url('Home/LoginView') ?>" style="width: 100%;background-color: #005f33 !important" class="btn btn-block btn-warning font-weight-medium">GO BACK</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <input type="hidden" id="lat">
  <input type="hidden" id="lang">
    

  <?= $this->include('layout/js_plugins') ?>
</body>
</html>

<script>

  function showPosition(position) {

      $('#lat').val(position.coords.latitude);
      $('#lang').val(position.coords.longitude);

  }

  $(function() {


    if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      alert('Geolocation is not supported by this browser.');
    }

    $.get('<?= base_url('Admin/GetDepartment') ?>',(result) => {
        result.forEach((row) => {
          $('#department').append(`<option value="${row.DeptID}">${row.DeptName}</option>`);
        });
   },'json');

    $('#CreateAccount').click(function() {

      var reg_exp_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if($('.userinput').val() == '') {
            Swal.fire('Please fill out all fields!','','warning');
            return false;
      }

      if(reg_exp_email.test($('#email').val()) == false) {
           Swal.fire('Please enter valid email!','','warning');
            return false;
      }

      if($('#password').val() != $('#cpassword').val()) {
            Swal.fire('Password and Confirm Password do not match!','','warning');
            return false;
        }

        $('#CreateAccount').attr('disabled','disabled').html('Please wait...');

        $.ajax({
            type: 'POST',
            url: '<?=base_url('Home/RegisterAccount') ?>',
            data: {
                fname: $('#fname').val(),
                mname: $('#mname').val(),
                lname: $('#lname').val(),
                username: $('#username').val(),
                email: $('#email').val(),
                phone_number: $('#phone_number').val(),
                password: $('#password').val(),
                lat: $('#lat').val(),
                lang: $('#lang').val(),
                department: $('#department').val(),
                studentid: $('#studentid').val()
            },
            dataType: 'json',
            success: function(result) {
               if(result.msg == 'success') {

                   $('.form-control').val('');
                   Swal.fire('Account Successfully Created','','success');

                   setTimeout(() => window.location = '<?= base_url('Home/VerificationCode') ?>',1500);
                   
               } else {
                   console.log(result);
               }

               $('#CreateAccount').removeAttr('disabled').html('Create Account');
            }
        })

    });
  });
</script>