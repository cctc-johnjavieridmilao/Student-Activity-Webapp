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
          <div class="col-md-5">
            <button class="btn btn-primary font-weight-medium mb-2" id="create_dept">CREATE DEPARTMENT</button>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h4 class="card-title">Basic Table</h4> -->
  
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dept_table">
                      <thead>
                        <tr>
                          <th>DeptID</th>
                          <th>DeptName</th>
                          <th>CREATE_AT</th>
                          <th>ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
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

<div id="CreateDeptModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">CREATE DEPARTMENT</h6>
            <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('CreateDeptModal')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg cuserinput" id="DeptName" placeholder="Department">
                </div>  
          </form>
          </div><!-- modal-body -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" id="add_department">Save</button>
            <button type="button" data-dismiss="modal" onclick="CloseModal('CreateDeptModal')" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="UpdateDeptModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">UPDATE DEPARTMENT</h6>
            <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('UpdateDeptModal')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form class="pt-3">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg cuserinput" id="UDeptName" placeholder="Department">
                </div>  
          </form>
          </div><!-- modal-body -->
          <div class="modal-footer">
             <input type="hidden" id="dept_id">
             <button type="button" class="btn btn-primary" id="update_department">SaveChanges</button>
            <button type="button" data-dismiss="modal" onclick="CloseModal('UpdateDeptModal')" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

<script>

var dept_table = $('#dept_table').DataTable();

function UpdatedData(id,deptname) {
  
  $('#UDeptName').val(deptname);
  $('#dept_id').val(id);

  $('#UpdateDeptModal').modal('show');
}
 
 function GetDepartment() {
      $.get('<?= base_url('Admin/GetDepartment') ?>',(result) => {

        dept_table.clear().draw();

          result.forEach((row) => {
              var tr = $(`
                <tr>
                    <td>${row.DeptID}</td>
                    <td>${row.DeptName}</td>
                    <td>${row.Created_at}</td>
                    <td align="center" width="12%">
                      <button class="btn btn-outline-primary btn-sm" onclick="UpdatedData(${row.DeptID},'${row.DeptName}')"><span class="fas fa-pencil-alt"></span></button>
                      <button class="btn btn-outline-danger btn-sm" onclick="DeleteData(${row.DeptID})"><span class="fas fa-trash"></span></button>
                    </td>
                   
                </tr>
              `);
              dept_table.row.add(tr);
          });

          dept_table.draw();
        },'json');
  }

  function CloseModal(elem) {
    $('#'+elem).modal('hide');
  }

  function DeleteData(id) {

    if(confirm('Are you sure you want to delete this?') == false) {
      return false;
    }

     $.ajax({
          type: 'POST',
          url: '<?=base_url('Admin/DeleteDepartment') ?>',
          data: {id: id},
          dataType: 'json',
          success: function(result) {
            if(result.msg == 'success') {
                Swal.fire('Successfully Delete!','','success');
                GetDepartment();

            } else {
                console.log(result);
            }

          }
      })

  }

$(function() {
  GetDepartment();

  $('#create_dept').click(function() {
     $('#CreateDeptModal').modal('show');
  });

  $('#add_department').click(function() {

    if($('#DeptName').val() == '') {
      Swal.fire('Department is required!','','error');
      return false;
    }

    $.ajax({
            type: 'POST',
            url: '<?=base_url('Admin/SaveDepartment') ?>',
            data: {
              DeptName: $('#DeptName').val(),
            },
            dataType: 'json',
            success: function(result) {
              if(result.msg == 'success') {
                  Swal.fire('Successfully Created!','','success');

              } else {
                  console.log(result);
              }

              GetDepartment();
              CloseModal('CreateDeptModal')

              //$('#approved').removeAttr('disabled').html('Approved');
            }
        })

  });

  $('#update_department').click(function() {

     var data = {
        dept_id: $('#dept_id').val(),
        DeptName: $('#UDeptName').val()
     };

     $.ajax({
            type: 'POST',
            url: '<?=base_url('Admin/UpdateDepartment') ?>',
            data: data,
            dataType: 'json',
            success: function(result) {
              if(result.msg == 'success') {
                  Swal.fire('Successfully Updated!','','success');

              } else {
                  console.log(result);
              }

              GetDepartment();
              CloseModal('UpdateDeptModal')

            }
        })
  });

});

</script>
