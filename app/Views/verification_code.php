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
              <!-- <div class="brand-logo">
                <center><img src="<?=base_url('public/assets/img/logos.png') ?>" alt="logo"></center>
              </div> -->
              <h4 id="title">ACCOUNT VERIFICATION</h4>
              <!-- <h6 class="fw-light">Sign in to continue.</h6> -->
              <form class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="code" placeholder="Enter Verification Code">
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-warning font-weight-medium" style="width: 100%;"  id="verify" href="javascript:void(0)">Verify</a>
                </div>
                <div class="mt-3">
                  <a class="btn btn-block btn-primary font-weight-medium" style="width: 100%;"  id="resend" href="javascript:void(0)">Resend Code</a>
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

$(function() {

$('#verify').click(function() {

     if($('#code').val() == '') {
          Swal.fire('Code is required!','','warning');
          return false;
     }

     $('#verify').attr('disabled','disabled').html('Please wait...');

     $.ajax({
      type: 'POST',
      url: '<?=base_url('Home/VerifyCode') ?>',
      data: {
          code: $('#code').val()
      },
      dataType: 'json',
      success: function(result) {
         if(result.msg == 'success') {

             Swal.fire('Account Successfully Verified!','','success');

             setTimeout(() => window.location = '<?= base_url('/') ?>',1500);
             
         } else {
             Swal.fire(result.msg,'','error');
         }

         $('#verify').removeAttr('disabled').html('Verifiy');
      }
  })

});


$('#resend').click(function() {

 $('#resend').attr('disabled','disabled').html('Please wait...');

  $.ajax({
      type: 'POST',
      url: '<?=base_url('Home/ResendCode') ?>',
      data: {code: ''},
      dataType: 'json',
      success: function(result) {
          if(result.msg == 'success') {

              Swal.fire('Verification Code Successfully Send!','','success');
              
          } else {
              Swal.fire(result.msg,'','error');
          }

          $('#resend').removeAttr('disabled').html('Resend Code');
      }
  })

});

});

</script>