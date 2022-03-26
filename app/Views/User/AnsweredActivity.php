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
                                <th>TEACHER NAME</th>
                                <th>SCORE</th>
                                <th>STATUS</th>
                                <th>DATE ANSWERED</th>
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

<div id="VerifyModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VERIFY</h6>
            <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('VerifyModal')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="table-responsive">
            <table class="table table-striped table-bordered" id="verify_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>QUESTION</th>
                                <th>ANSWER</th>
                                <th>RESULT</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

            </table>

            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
             <button type="button" data-dismiss="modal" onclick="CloseModal('VerifyModal')" class="btn btn-outline-light">Close</button>

            
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
<script>

var activity_table = $('#activity_table').DataTable();
var verify_table = $('#verify_table').DataTable();

function GetDatas() {
    $.get('<?= base_url('Home/getMyAnsweredActivity') ?>',(result) => {

      activity_table.clear().draw();

        result.forEach((row) => {
            var tr = $(`
              <tr>
                  <td>${row.ActivityName}</td>
                  <td>${row.Description.length > 25 ? row.Description.substring(0,25) + '...' : row.Description}</td>
                  <td>${row.StartDate}</td>
                  <td>${row.EndDate}</td>
                  <td>${row.teacher_fullname}</td>
                  <td>${row.Status == 'Validated' ? row.count_check + '/' + row.count_question  : ''}</td>
                  <td>${row.Status}</td>
                  <td>${row.DateAnswered}</td>
                  <td>
                    <button class="btn btn-primary" ${row.Status == 'Validated' ? '' : 'disabled'} onclick="ViewResult(${row.ActivityID},${row.StudentUserid})">View result</button>
                  </td>
              </tr>
            `);
            activity_table.row.add(tr);
        });
        activity_table.draw();
      },'json');
}

function CloseModal(elem) {
 $('#'+elem).modal('hide');
}

function ViewResult(activity, studentid) {

  verify_table.clear().draw();

    $.ajax({
        type: 'POST',
        url: '<?=base_url('TeacherController/getStudentActivityResult') ?>',
        data: {
            activity: activity,
            studentid: studentid
        },
        dataType: 'json',
        success: function(result) {
            

            result.forEach((row) => {
                var tr = $(`
                <tr>
                    <td>${row.QuestionID}</td>
                    <td>${row.QuestionName}</td>
                    <td>${row.Answer}</td>
                    <td>
                       ${row.IsCheck == 1 ? '<span class="fas fa-check"></span>' : '<span class="fas fa-times"></span'}
                    </td>
                   
                </tr>
                `);
                verify_table.row.add(tr);
            });
            verify_table.draw();
        }
    });

    $('#VerifyModal').modal('show');

}

$(function() {
  GetDatas();
})
  
</script>