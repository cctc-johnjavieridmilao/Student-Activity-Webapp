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
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <center><img src="<?=base_url('public/assets/img/logos.png') ?>" alt="logo"></center>
              </div>
              <h4 id="title">STUDENT ASSISTANT</h4>
              <h6 class="fw-light">Sign in to continue.</h6>
              <form class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg userinput" id="u_username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg userinput" id="u_pass" placeholder="Password">
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-warning font-weight-medium" style="width: 100%;"  id="sign_in" href="javascript:void(0)">SIGN-IN</a>
                </div>
                <div class="mt-3">
                <a href="<?= base_url('Home/RegisterView') ?>" style="width: 100%;background-color: #005f33 !important" class="btn btn-block btn-success font-weight-medium">CREATE ACCOUNT</a>
                </div>
                <!-- <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="<?= base_url('Home/RegisterView') ?>" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
    

  <?= $this->include('layout/js_plugins') ?>

  <input type="hidden" id="lat">
  <input type="hidden" id="lang">
  
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

        $('#sign_in').click(function() {
            if($('.userinput').val() == '') {
            Swal.fire('Please fill out all fields!','','warning');
            return false;
        }

        $('#sign_in').attr('disabled','disabled').html('Please wait...');

            $.ajax({
                type: 'POST',
                url: '<?=base_url('Home/Login') ?>',
                data: {
                    u_username: $('#u_username').val(),
                    u_pass: $('#u_pass').val(),
                    lat: $('#lat').val(),
                    lang: $('#lang').val()
                },
                dataType: 'json',
                success: function(result) {
                    if(result.msg == 'success') {
                        $('.userinput').val('');
                        Swal.fire('Welcome ' + result.fname,'','success');

                        setTimeout(() => {
                            if(result.user_type == 'student') {
                                window.location = '<?= base_url('Home/MyCalendar') ?>'
                            } 
                            else if(result.user_type == 'teacher') {
                                window.location = '<?= base_url('TeacherController/MyCalendar') ?>'
                            }
                            else {
                                window.location = '<?= base_url('Admin/Dashboard') ?>'
                            }
                        },2000);
                        
                    } else {
                        Swal.fire(result.msg,'','warning');
                    }

                    $('#sign_in').removeAttr('disabled').html('Sign In');
                }
            })
        });
    });
</script>