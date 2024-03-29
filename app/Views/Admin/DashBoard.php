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

<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?= $this->include('Components/Navbar') ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <?= $this->include('Admin/sidebar') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row" style="margin-top: 30px;">

                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Total Users</h4>
                      <div class="d-flex justify-content-between">
                        <p class="text-muted dashboardTxt" id="total_users">3</p>
                    
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Total Activities</h4>                      
                      <div class="d-flex justify-content-between">
                        <p class="text-muted dashboardTxt" id="total_activity">3</p>
    
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Total Students</h4>
                      <div class="d-flex justify-content-between">
                        <p class="text-muted dashboardTxt" id="total_student">4</p>
 
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Total Teachers</h4>
                      <div class="d-flex justify-content-between">
                        <p class="text-muted dashboardTxt" id="total_teachers">4</p>
 
                      </div>
                    </div>
                  </div>
                </div>
               
            </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span> -->
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->

  <?= $this->include('layout/js_plugins') ?>
</body>
</html>

<script>
 
 $(function() {

  $.get('<?= base_url('Admin/getDashboard') ?>',(result) => {
      
    $('#total_users').text(result[0].count_user);
    $('#total_activity').text(result[0].count_activity);
    $('#total_student').text(result[0].count_student);
    $('#total_teachers').text(result[0].count_teacher);
    
    },'json');

});
</script>
