<div class="row" id="load_announcement" style="margin-top: 30px">
            
</div>

<script>

function GetAnnouncement() {
      $.get('<?= base_url('Admin/GetAnnouncement') ?>',(result) => {

          result.forEach((row) => {

              $('#load_announcement').append(`

              <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title" style="float: left;">${row.subject}</h4>
                  <h4 class="card-title" style="float: right;">${row.created_at}</h4><br><br>
                  <h5>${row.description}</h5>
                </div>
              </div>
            </div>
                  
              `);
              
          });


        },'json');
  }


   $(function() {

      GetAnnouncement();

        
    });

</script>