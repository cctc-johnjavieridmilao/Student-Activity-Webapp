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
    <?= $this->include('Teacher/sidebar') ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                   <h4 class="card-title" id="activity_name"></h4> 
                    <p class="card-description" id="activity_desc">
                      
                    </p> 

                  <div class="table-responsive">

                        <table class="table table-striped table-bordered" id="activity_table">
                        <thead>
                            <tr>
                                <th>STUDENT ID</th>
                                <th>STUDENT NAME</th>
                                <th>DEPARTMENT</th>
                                <th>STATUS</th>
                                <th>SCORE</th>
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
                                <th>CHECK</th>
                                <th>WRONG</th>
                            </tr>
                        </thead>
                        <tbody></tbody>

            </table>

            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
             <!-- <button type="button" data-dismiss="modal" onclick="CloseModal('VerifyModal')" class="btn btn-outline-light">Close</button> -->
             <button type="button" class="btn btn-success" id="btn_done">Done</button>
             <input type="hidden" id="activityid">
             <input type="hidden" id="studentid">
            
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
<script>

var activity_table = $('#activity_table').DataTable();
var verify_table = $('#verify_table').DataTable();
var id = '<?=$id ?>';

function GetDatas() {

  activity_table.clear().draw();

  $.ajax({
        type: 'POST',
        url: '<?=base_url('TeacherController/getStudentActivities') ?>',
        data: {
          id: id,
        },
        dataType: 'json',
        success: function(result) {

            result.forEach((row) => {
                var tr = $(`
                  <tr>
                      <td>${row.StudentID}</td>
                      <td>${row.fullname}</td>
                      <td>${row.DeptName}</td>
                      <td>${row.Status}</td>
                      <td>${row.Status == 'Validated' ? row.count_check + '/' + row.count_question : ''}</td>
                      <td>
                        <button class="btn btn-primary" ${row.Status == 'Answered' ? '' : 'disabled'} onclick="Validate(${row.ActivityID},${row.StudentUserid})">Validate</button>
                      </td>
                  </tr>
                `);
                activity_table.row.add(tr);
            });
            activity_table.draw();
  
        }
    });
}


function Validate(activity, studentid) {

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
                        <button class="btn btn-primary" onclick="Check(${row.RecID})" id="check_${row.RecID}" ${row.IsCheck == 1 ? 'disabled' : ''}>CHECK ${row.IsCheck == 1 ? '<span class="fas fa-check"></span>' : ''}</button>
                    </td>
                    <td>
                        <button class="btn btn-primary" onclick="Wrong(${row.RecID})" id="wrong_${row.RecID}" ${row.IsWrong == 1 ? 'disabled' : ''}>WRONG ${row.IsWrong == 1 ? '<span class="fas fa-times"></span>' : ''}</button>
                    </td>
                </tr>
                `);
                verify_table.row.add(tr);
            });
            verify_table.draw();
        }
    });

    $('#activityid').val(activity);
    $('#studentid').val(studentid);
    $('#VerifyModal').modal('show');
    
}

function Check(id) {
    $.ajax({
        type: 'POST',
        url: '<?=base_url('TeacherController/SetIsCheck') ?>',
        data: {
            id: id,
        },
        dataType: 'json',
        success: function(result) {

            if(result.msg == 'success') {

                $('#check_'+id).attr('disabled','disabled').html('CHECK <span class="fas fa-check"></span>');
                $('#wrong_'+id).removeAttr('disabled').html('WRONG');

            }
            
        }
    });
    
}

function Wrong(id) {

    $.ajax({
        type: 'POST',
        url: '<?=base_url('TeacherController/SetIsWrong') ?>',
        data: {
            id: id,
        },
        dataType: 'json',
        success: function(result) {

            if(result.msg == 'success') {

                $('#wrong_'+id).attr('disabled','disabled').html('WRONG <span class="fas fa-times"></span>');
                $('#check_'+id).removeAttr('disabled').html('CHECK');

            }
            
        }
    });
  
}


function CloseModal(elem) {
 $('#'+elem).modal('hide');
}

  $(function() {

    GetDatas();

    $('#btn_done').click(function() {

        $('#btn_done').attr('disabled','disabled').html('Please wait...');

        $.ajax({
            type: 'POST',
            url: '<?=base_url('TeacherController/UpdateStudentActivity') ?>',
            data: {
                activityid: $('#activityid').val(),
                studentid: $('#studentid').val()
            },
            dataType: 'json',
            success: function(result) {

                if(result.msg == 'success') {
                    Swal.fire('Successfully Validated!','','success');
                    GetDatas();
                }
                
                $('#btn_done').removeAttr('disabled').html('Done');
            }
        });

    });

    $.ajax({
            type: 'POST',
            url: '<?=base_url('TeacherController/getActivityName') ?>',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(result) {
                var row = result[0];
                
                $('#activity_name').text(row.ActivityName);
                $('#activity_desc').text(row.Description);
            }
        });

  });

</script>