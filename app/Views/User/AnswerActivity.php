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
                  <h4 class="card-title" id="activity_name"></h4>
                  <p class="card-description" id="activity_desc">
                   
                  </p>

                  <div class="form-group row" id="form-items"></div><!-- modal-body -->
                  
                  <button class="btn btn-primary" style="float: right;margin-left:2px" id="SaveAnswer">SAVE</button>
                  <button class="btn btn-primary" style="float: right;" id="back">GO BACK</button>
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
   var id = '<?= $id ?>';
   var count = 0;

   $(function() {

        $.ajax({
            type: 'POST',
            url: '<?=base_url('Home/getActivityQuestion') ?>',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function(result) {
                var rows = result[0];
                var question = JSON.parse(rows.Questions);

                $('#form-items').empty();
                question.forEach(function(row, index) {
                    var i = index + 1;
                    count = i;

                    var html = `<div class="card mb-2"><div class="card-body"><h4 class="card-title" style="font-size: 13px;">${i}. ${row.question}</h4><div class="form-group row">
                    <div class="col-md-12 mb-2"><input type="hidden" value="${row.question}" id="question_name_${i}"><input type="hidden" value="${i}" id="question_id_${i}">`;
                    
                    if(row.answerType == 2) {
                        html += `<select class="form-control form-control-lg" id="question_${i}"><option value="">Select Options</option> `;

                        if(row.option.length > 0) {
                            row.option.forEach(function(roww, indexx) {
                                var ii = indexx + 1;
                                html += `
                                    <option value="${roww}">${roww}</option> 
                                `;
                            });
                        }
                        html += `</select></div>`;
                    }

                    if(row.answerType == 3) {
                        html += `
                        <div class="col-md-12 mb-2">
                            <textarea cols="5" rows="5" class="form-control form-control-lg" id="question_${i}">${row.paragraph}</textarea>
                        </div>
                        `;
                    }

                    html += `</div></div></div>`;

                    $('#form-items').append(html);
                });
                
               $('#activity_name').text(rows.ActivityName);
               $('#activity_desc').text(rows.Description);
            }
        });

        $('#SaveAnswer').click(function() {

            var answers = [];

            for(var i = 1; i <= count; i++) {

                if($('#form-items').find('#question_'+i).val() == '') {
                    Swal.fire('Please fil out all fields!','','warning');
                    return false;
                }

                answers.push({
                    ActivityID: id,
                    question_name: $('#form-items').find('#question_name_'+i).val(),
                    question_id: $('#form-items').find('#question_id_'+i).val(),
                    answer: $('#form-items').find('#question_'+i).val()
                });

            }

            $('#SaveAnswer').attr('disabled','disabled').html('Please wait...');

                $.ajax({
                    type: 'POST',
                    url: '<?=base_url('Home/AnswerMyActivity') ?>',
                    data: {
                        ActivityID: id,
                        answers: JSON.stringify(answers)
                    },
                    dataType: 'json',
                    success: function(result) {

                        if(result.msg == 'success') {
                            Swal.fire('Successfully Answered!','','success');
                            setTimeout(() => {
                                window.location = '<?= base_url('Home/MyActivity') ?>' 
                            },1500);
                        }
                        
                        $('#SaveAnswer').removeAttr('disabled').html('SAVE');
                    }
            })
           
        });

        $('#back').click(function() {
            window.location = '<?= base_url('Home/MyActivity') ?>' ;
        })

   });


</script>