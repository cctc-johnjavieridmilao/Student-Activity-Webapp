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
            <button class="btn btn-primary font-weight-medium mb-2" id="create_announcement">CREATE ANNOUNCEMENT</button>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <!-- <h4 class="card-title">Basic Table</h4> -->
  
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="annoucnement_table">
                      <thead>
                        <tr>
                          <th>RecID</th>
                          <th>Subject</th>
                          <th>Created At</th>
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


  <div id="CreateAnnouncementModal" class="modal">
    <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
        <h6 class="modal-title">CREATE ANNOUNCEMENT</h6>
        <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('CreateAnnouncementModal')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-12">
                    <label>Subject</label>
                    <input type="text" id="subject" class="form-control">
                    <br>
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea id="description" name="editor1"></textarea>
                </div>
            </div>
            
        </div><!-- modal-body -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="add_announce">Save</button>
        <button type="button" data-dismiss="modal" onclick="CloseModal('CreateAnnouncementModal')" class="btn btn-outline-light">Close</button>
        </div>
    </div>
    </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="UpdateAnnouncementModal" class="modal">
    <div class="modal-dialog" role="document">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
        <h6 class="modal-title">UPDATE ANNOUNCEMENT</h6>
        <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('UpdateAnnouncementModal')" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-12">
                    <label>Subject</label>
                    <input type="text" id="usubject" class="form-control">
                    <br>
                </div>
                <div class="col-md-12">
                    <label>Description</label>
                    <textarea id="udescription" name="ueditor1"></textarea>
                </div>
            </div>
            
        </div><!-- modal-body -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="update_announce">SaveChanges</button>
            <input type="hidden" id="ann_id">
        <button type="button" data-dismiss="modal" onclick="CloseModal('UpdateAnnouncementModal')" class="btn btn-outline-light">Close</button>
        </div>
    </div>
    </div><!-- modal-dialog -->
    </div><!-- modal -->

  <?= $this->include('layout/js_plugins') ?>

  <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
</body>
</html>

<script>

var editor1 = CKEDITOR.replace( 'editor1' );
var ueditor1 = CKEDITOR.replace( 'ueditor1' );

var annoucnement_table = $('#annoucnement_table').DataTable();

 function CloseModal(elem) {
    $('#'+elem).modal('hide');
  }

  function UpdatedData(id) {
      
      $.post('<?= base_url('Admin/GetAnnouncementByID') ?>', {id: id}, function(response) {
         var data = response[0];

         $('#usubject').val(data.subject);
         ueditor1.setData(data.description);

      },' json');

      $('#ann_id').val(id);

      $('#UpdateAnnouncementModal').modal('show');
  }



  function GetAnnouncement() {
      $.get('<?= base_url('Admin/GetAnnouncement') ?>',(result) => {

        annoucnement_table.clear().draw();

          result.forEach((row) => {
              var tr = $(`
                <tr>
                    <td>${row.RecID}</td>
                    <td>${row.subject}</td>
                    <td>${row.created_at}</td>
                    <td align="center" width="12%">
                      <button class="btn btn-outline-primary btn-sm" onclick="UpdatedData(${row.RecID})"><span class="fas fa-pencil-alt"></span></button>
                      <button class="btn btn-outline-danger btn-sm" onclick="DeleteData(${row.RecID})"><span class="fas fa-trash"></span></button>
                    </td>
                   
                </tr>
              `);
              annoucnement_table.row.add(tr);
          });

          annoucnement_table.draw();
        },'json');
  }

  function DeleteData(id) {
    
    if(confirm('Are you sure you want to delete this?') == false) {
      return false;
    }

     $.ajax({
          type: 'POST',
          url: '<?=base_url('Admin/DeleteAnnouncement') ?>',
          data: {id: id},
          dataType: 'json',
          success: function(result) {
            if(result.msg == 'success') {
                Swal.fire('Successfully Delete!','','success');
                GetAnnouncement();

            } else {
                console.log(result);
            }

          }
      })

}

 $(function() {

    GetAnnouncement();

    $('#create_announcement').click(function() {
        $('#CreateAnnouncementModal').modal('show');
    });

    $('#add_announce').click(function() {

         var data = {
            subject: $('#subject').val(),
            description: editor1.getData()
         };

        if(data.subject == '') {
            Swal.fire('Subject is required!','','error');
            return false;
        }

        if(data.description == '') {
            Swal.fire('Description is required!','','error');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: '<?=base_url('Admin/SaveAnnouncement') ?>',
            data: data,
            dataType: 'json',
            success: function(result) {
              if(result.msg == 'success') {
                  Swal.fire('Successfully Created!','','success');
                  CloseModal('CreateAnnouncementModal');
                  GetAnnouncement();

              } else {
                  console.log(result);
              }

              //$('#approved').removeAttr('disabled').html('Approved');
            }
        })

    });

    $('#update_announce').click(function() {

        var data = {
            id: $('#ann_id').val(),
            subject: $('#usubject').val(),
            description: ueditor1.getData()
         };

         $.ajax({
            type: 'POST',
            url: '<?=base_url('Admin/UpdatedAnnouncement') ?>',
            data: data,
            dataType: 'json',
            success: function(result) {
              if(result.msg == 'success') {
                  Swal.fire('Successfully Updated!','','success');
                  CloseModal('UpdateAnnouncementModal');
                  GetAnnouncement();

              } else {
                  console.log(result);
              }

            }
        })

    });

 });

</script>

