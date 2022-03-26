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
           <div class="brand-logo">
                <center><img src="<?=base_url('public/assets/img/logos.png') ?>" alt="logo"></center>
              </div>
          </div>
          <div class="col-lg-12 mx-auto mt-3">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4 id="title">ENROLLMENT GUIDE</h4>

              <div id="load_pdf">
                  <!-- <embed src="<?=base_url('public/pdf/Student-Manual-Final-Copy.pdf') ?>" style="width: 100%;" height="500" type="application/pdf"> -->
                  <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=https://student-activity-app.online/public/pdf/Student-Manual-Final-Copy.pdf" style="width: 100%;" height="500">
              </div>
            
          </div>
          <div class="col-lg-12 mx-auto mt-3">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4 id="title">ISU MAP</h4>
             
              <div id="load_isu_map">
              <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=https://student-activity-app.online/public/pdf/isu-map.pdf" style="width: 100%;" height="500">
              </div>
            </div>
          </div>

          <div class="col-lg-12 mx-auto mt-3">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4 id="title">PROFILE OF PROFESSORS</h4>
             
              <div id="load_isu_map">
              <embed src="https://drive.google.com/viewerng/viewer?embedded=true&url=https://student-activity-app.online/public/pdf/Doc1.pdf" style="width: 100%;" height="500">
              </div>
            </div>
          </div>

          <div class="col-lg-12 mx-auto mt-3">
             <a class="btn btn-block btn-warning font-weight-medium" style="width: 100%;" id="sign_in" href="<?= base_url('Home/LoginView') ?>">SIGN IN</a>
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
   
 })
  
</script>