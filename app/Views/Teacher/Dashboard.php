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
          <div class="row" style="margin-top: 30px;">

          <div class="col-lg-12">
              <button class="btn btn-primary" id="create_task">CREATE</button>
          </div>
          
            <div class="col-lg-12 grid-margin stretch-card mt-2">
              <div class="card">
                <div class="card-body">

                

                <div id='calendar'></div>

                  <!-- <h4 class="card-title">TABLE</h4> -->
                  <!-- <p class="card-description">
                    Add class <code>.table</code>
                  </p> -->

                  <!-- <div class="row">
                     
                  <div class="col-md-4 col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Total Activity</h4>
                        <div class="d-flex justify-content-between">
                          <p class="text-muted dashboardTxt" id="all_activity">0</p>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-4 col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Total Pendig Activity</h4>
                        <div class="d-flex justify-content-between">
                          <p class="text-muted dashboardTxt" id="pending_activity">0</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4 col-sm-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Total Answered Activity</h4>
                        <div class="d-flex justify-content-between">
                          <p class="text-muted dashboardTxt" id="anwsered_activity">0</p>
                        </div>
                      </div>
                    </div>
                  </div>
                   </div> -->
                  
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


  <div id="TaskModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">CREATE TASK/EVENT</h6>
            <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('TaskModal')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">
                 <div class="col-md-12">
                     <label>Type</label>
                     <select class="form-control" id="task_type">
                         <option value="">Select Option</option>
                         <option value="task">Task</option>
                         <option value="event">Event</option>
                     </select>
                 </div>
                 <div class="col-md-12">
                     <label>Title</label>
                    <input type="text" id="title" class="form-control">
                 </div>
                 <div class="col-md-12">
                     <label>Color</label>
                    <input type="color" id="task_color" class="" style="width: 100%">
                 </div>
                 <div class="col-md-12">
                     <label>Start Date</label>
                    <input type="date" id="date_start" class="form-control">
                 </div>
                 <div class="col-md-12">
                     <label>End Date</label>
                    <input type="date" id="end_start" class="form-control">
                 </div>

                 <div class="col-md-12">
                     <label>Description</label>
                     <input type="text" id="description" class="form-control">
                 </div>
                 
            </div>
         
          </div><!-- modal-body -->
          <div class="modal-footer">
             <button type="button" class="btn btn-primary" id="add_task">Save</button>
            <button type="button" data-dismiss="modal" onclick="CloseModal('TaskModal')" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->


    <div id="TaskView" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VIEW TASK/EVENT</h6>
            <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('TaskView')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">
                 <div class="col-md-12">
                     <label>Type</label>
                     <input type="text" id="vtask_type" class="form-control" readonly>
                 </div>
                 <div class="col-md-12">
                     <label>Title</label>
                    <input type="text" id="vtitle" class="form-control" readonly>
                 </div>
                 <div class="col-md-12">
                     <label>Color</label>
                    <input type="color" id="vtask_color" class="" style="width: 100%" readonly>
                 </div>
                 <div class="col-md-12">
                     <label>Start Date</label>
                    <input type="date" id="vdate_start" class="form-control" readonly> 
                 </div>
                 <div class="col-md-12">
                     <label>End Date</label>
                    <input type="date" id="vend_start" class="form-control" readonly>
                 </div>

                 <div class="col-md-12">
                     <label>Description</label>
                     <input type="text" id="vdescription" class="form-control" readonly>
                 </div>
                 
            </div>
         
          </div><!-- modal-body -->
          <div class="modal-footer">
             <input type="hidden" id="vtask_id">
             <button type="button" class="btn btn-primary" id="edit_task">Edit</button>
             <button type="button" class="btn btn-danger" id="delete_task">Delete</button>
            <button type="button" data-dismiss="modal" onclick="CloseModal('TaskView')" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->


    <div id="EditTaskModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">EDIT TASK/EVENT</h6>
            <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('EditTaskModal')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row">
                  <div class="col-md-12">
                     <label>Type</label>
                     <select class="form-control" id="etask_type">
                         <option value="">Select Option</option>
                         <option value="task">Task</option>
                         <option value="event">Event</option>
                     </select>
                 </div>
                 <div class="col-md-12">
                     <label>Title</label>
                    <input type="text" id="etitle" class="form-control">
                 </div>
                 <div class="col-md-12">
                     <label>Color</label>
                    <input type="color" id="etask_color" class="" style="width: 100%">
                 </div>
                 <div class="col-md-12">
                     <label>Start Date</label>
                    <input type="date" id="edate_start" class="form-control"> 
                 </div>
                 <div class="col-md-12">
                     <label>End Date</label>
                    <input type="date" id="eend_start" class="form-control">
                 </div>

                 <div class="col-md-12">
                     <label>Description</label>
                     <input type="text" id="edescription" class="form-control">
                 </div>
                 
            </div>
         
          </div><!-- modal-body -->
          <div class="modal-footer">
             <input type="hidden" id="etask_id">
             <button type="button" class="btn btn-primary" id="save_task_changes">SaveChanges</button>
            <button type="button" data-dismiss="modal" onclick="CloseModal('EditTaskModal')" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    
  <?= $this->include('layout/js_plugins') ?>
</body>
</html>

<script>

  
  function CloseModal(elem) {

    $('#'+elem).modal('hide');

  }

  
  
  function getCalendar() {

    //eventsArry = [];

    var calendarEl = document.getElementById('calendar');

     $.get('<?= base_url('Home/GetTask') ?>',(result) => {

      var eventsArry = [];

      eventsArry = [];
         
         result.forEach(function(row) {
            eventsArry.push({
                id: row.RecID,
                title: row.title,
                start: new Date(row.start_date),
                end: new Date(row.end_date),
                color: row.color,
            });
         });

         console.log(eventsArry)

         var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: eventsArry,
            selectable: true,
		        selectHelper: true,
            timeZone: "local",
            eventClick: function(event) {
               var e = event.event;
               var id = e.id;

               $.post('<?=base_url('Home/GetTaskByID') ?>',{id: id}, function(response) {
                  var data = response[0];

                  $('#vtask_type').val(data.type);
                  $('#vtitle').val(data.title);
                  $('#vtask_color').val(data.color);
                  $('#vdate_start').val(data.start_date);
                  $('#vend_start').val(data.end_date);
                  $('#vdescription').val(data.description);
               },'json');

               $('#vtask_id').val(id);

               $('#TaskView').modal('show');
            }
            
          });

          calendar.render();
      
      },'json');
      
  }

  $(function() {

    getCalendar();
    
    $('#create_task').click(function() {
        $('#TaskModal').modal('show');
    });

    $('#add_task').click(function() {

      var data = {
        task_type: $('#task_type').val(),
        title: $('#title').val(),
        task_color: $('#task_color').val(),
        date_start: $('#date_start').val(),
        end_start: $('#end_start').val(),
        description: $('#description').val(),
      };

      if(data.task_type == '' || data.title == '' || data.task_color == '' || data.date_start == '' || data.end_start == '') {
         Swal.fire('Please fill out all fields!','','error');
         return false;
      }

      $('#add_task').attr('disabled','disabled').html('Please wait...');

      $.ajax({
            type: 'POST',
            url: '<?=base_url('Home/CreateTask') ?>',
            data: data,
            dataType: 'json',
            success: function(result) {
              if(result.msg == 'success') {
                  Swal.fire('Successfully Created!','','success');
                  CloseModal('TaskModal');
                  getCalendar();
                  $('#add_task').removeAttr('disabled').html('Save');

              } else {
                  console.log(result);
              }
            }
        })
     
    });

    $('#edit_task').click(function() {

      var id = $('#vtask_id').val();

      $.post('<?=base_url('Home/GetTaskByID') ?>',{id: id}, function(response) {
          var data = response[0];

          $('#etask_type').val(data.type);
          $('#etitle').val(data.title);
          $('#etask_color').val(data.color);
          $('#edate_start').val(data.start_date);
          $('#eend_start').val(data.end_date);
          $('#edescription').val(data.description);
       },'json');

        $('#etask_id').val(id);

        CloseModal('TaskView');

        $('#EditTaskModal').modal('show');

    });

    $('#save_task_changes').click(function() {

      var id = $('#etask_id').val();

      var data = {
        id: id,
        task_type: $('#etask_type').val(),
        title: $('#etitle').val(),
        task_color: $('#etask_color').val(),
        date_start: $('#edate_start').val(),
        end_start: $('#eend_start').val(),
        description: $('#edescription').val(),
      };

      $.ajax({
            type: 'POST',
            url: '<?=base_url('Home/UpdateTask') ?>',
            data: data,
            dataType: 'json',
            success: function(result) {
              if(result.msg == 'success') {
                  Swal.fire('Successfully Updated!','','success');
                  CloseModal('EditTaskModal');
                  getCalendar();

              } else {
                  console.log(result);
              }
            }
        })
      
    });

    $('#delete_task').click(function() {
       var id = $('#vtask_id').val();

      if(confirm('Are you sure you want to delete this?') == false) {
        return false;
      }

      $.ajax({
            type: 'POST',
            url: '<?=base_url('Home/DeleteTask') ?>',
            data: {id: id},
            dataType: 'json',
            success: function(result) {
              if(result.msg == 'success') {
                  Swal.fire('Successfully Deleted!','','success');
                  CloseModal('TaskView');
                  getCalendar();

              } else {
                  console.log(result);
              }
            }
        })
    });

    // $.get('<?= base_url('Home/getDashboard') ?>',(result) => {
         
    //   $('#all_activity').text(result[0].count_all);
    //   $('#pending_activity').text(result[0].count_pending);
    //   $('#anwsered_activity').text(result[0].count_asnwered);
      
    //   },'json');

  });

</script>