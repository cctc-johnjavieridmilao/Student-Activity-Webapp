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
    <?= $this->include('User/sidebar') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h4 class="card-title">TABLE</h4> -->
                  <!-- <p class="card-description">
                    Add class <code>.table</code>
                  </p> -->

                  <div class="table-responsive">

                        <table class="table table-striped table-bordered" id="activity_table">
                            <thead>
                                <tr>
                                    <th>ACTIVITY NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>START DATE</th>
                                    <th>END DATE</th>
                                    <th>CREATED BY</th>
                                    <th>CREATED AT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody></tbody>

                        </table>
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

var activity_table = $('#activity_table').DataTable();

function GetActivityLists() {
    $.get('<?= base_url('Home/getMyActivity') ?>',(result) => {

      activity_table.clear().draw();

        result.forEach((row) => {
            var tr = $(`
              <tr>
                  <td>${row.ActivityName}</td>
                  <td>${row.Description.length > 25 ? row.Description.substring(0,25) + '...' : row.Description}</td>
                  <td>${row.StartDate}</td>
                  <td>${row.EndDate}</td>
                  <td>${row.teacher}</td>
                  <td>${row.Created_at}</td>
                  <td align="center">
                     <button class="btn btn-primary" onclick="AnswerActivity(${row.RecID})">ANSWER</button>
                  </td>
                  
              </tr>
            `);
            activity_table.row.add(tr);
        });
        activity_table.draw();
      },'json');
}

function AnswerActivity(id) {
   window.location.href = '<?= base_url('Home/AnswerActivityView') ?>/'+id;
}

$(function() {
    GetActivityLists();
})

</script>