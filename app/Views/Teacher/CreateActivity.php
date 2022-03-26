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
                <div class="col-md-5">
                    <button class="btn btn-primary font-weight-medium mb-2" id="back">GO BACK</button>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">STEP 1</h4>
                            <div class="form-group row">
                                <div class="col-md-6 mb-2">
                                    <label>Activity name</label>
                                     <input type="text" class="form-control form-control-lg inputs" id="activity_name" placeholder="Activity name">
                                 </div>
                                 <div class="col-md-6 mb-2">
                                 <label>Description</label>
                                     <textarea class="form-control form-control-lg inputs" cols="5" rows="5" id="description" placeholder="Description"></textarea>
                                 </div>
                                 <div class="col-md-6 mb-2">
                                 <label>Start date</label>
                                     <input type="date" class="form-control form-control-lg inputs" id="start_date" placeholder="Start date">
                                 </div>
                                 <div class="col-md-6 mb-2">
                                    <label>End date</label>
                                    <input type="date" class="form-control form-control-lg inputs" id="end_date" placeholder="Start date">
                                 </div>
                                 <div class="col-md-12 mb-2">
                                    <label>Students</label>
                                    <select class="form-control form-control-lg inputs" id ="students" multiple>
                                        <option value="">Select students</option>
                                    </select>
                                 </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                            <div class="card-body">
                            <h4 class="card-title">STEP 2</h4>
                             <div class="row" id="question_items">
                                <div class="col-lg-12 grid-margin stretch-card" id="question_1">
                                    <div class="card">
                                        <div class="card-body">
                                          <h4 class="card-title" style="font-size: 13px;">QUESTION 1</h4>
                                          <div class="form-group row">
                                          <div class="col-md-6 mb-2">
                                                <label>Question</label>
                                                <input type="text" class="form-control form-control-lg" id="question_name_1">
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Answer type</label>
                                                <select class="form-control form-control-lg" id="answer_type_1">
                                                    <option value="">Select Options</option>
                                                   
                                                </select>
                                            </div>
                                          </div>

                                          <div class="form-group row" id="choices_1">

                                          </div>
                                          <button class="btn btn-danger btn-sm" data-question="1" data-choices="1" id="remove_choices_1" style="float: right;display: none;margin-left: 2px;">REMOVE CHOICES</button>
                                          <button class="btn btn-primary btn-sm" data-question="1" data-choices="1" id="add_choices_1" style="float: right;display: none">ADD CHOICES</button>
                                          
                                          <button class="btn btn-danger btn-sm" data-question="1" data-options="1" id="remove_option_1" style="float: right;display: none;margin-left: 2px;">REMOVE OPTION</button>
                                          <button class="btn btn-primary btn-sm" data-question="1" data-options="1" id="add_option_1" style="float: right;display: none">ADD OPTION</button>
                                           
                                          <input type="hidden" value="1" id="1_choices_count">
                                          <input type="hidden" value="1" id="1_option_count">
                                        </div>
                                    </div>
                                </div>
                             </div>
                             
                              <button class="btn btn-danger" style="float: right;margin-left: 2px;" id="RemoveQuestion">REMOVE</button>
                              <button class="btn btn-primary" style="float: right;" id="AddQuestion">ADD QUESTION</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" style="float: right;margin-left:2px" id="SaveActivity">SAVE</button>
                <button class="btn btn-primary" style="float: right;" id="PreviewForm">PREVIEW</button>
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

<!-- LARGE MODAL -->
<div id="PreviewModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">PREVIEW </h6>
            <button type="button" class="close" data-dismiss="modal" onclick="CloseModal('PreviewModal')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 id="activity_name_text"></h4>
            <small id="activity_desc_text"></small>
            <br><br>
           <div class="form-group row" id="form-items"></div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" onclick="CloseModal('PreviewModal')" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
<script>

    var count_question = 1;

    function CloseModal(elem) {
      $('#'+elem).modal('hide');
    }

    function getAnswerType(elem, question = 1, choices = 1, option = 1) {
        $('#'+elem).html('<option value="">Select Option</option>');
        $.get('<?=base_url('TeacherController/GetAnswerType') ?>', function(res) {
            res.forEach(function(row) {
                $('#'+elem).append(`<option value="${row.RecID}-${question}-${choices}-${option}">${row.Name}</option>`);
            });
        },'json');
    }

    function getStudents(elem) {
        $('#'+elem).html('<option value="">Select Option</option>');
        $.get('<?=base_url('TeacherController/getStudents') ?>', function(res) {
            res.forEach(function(row) {
                $('#'+elem).append(`<option value="${row.RecID}">${row.StudentID} - ${row.firtname} ${row.middlename} ${row.lastname}</option>`);
            });
        },'json');
    }

    function AddQuestion() {
        count_question++;
        
        $('#question_items').append(`
            <div class="col-lg-12 grid-margin stretch-card" id="question_${count_question}">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="font-size: 13px;">QUESTION ${count_question}</h4>
                        <div class="form-group row">
                        <div class="col-md-6 mb-2">
                            <label>Question</label>
                            <input type="text" class="form-control form-control-lg" id="question_name_${count_question}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label>Answer type</label>
                            <select class="form-control form-control-lg" id="answer_type_${count_question}">
                                <option value="">Select Options</option>
                                
                            </select>
                        </div>
                        </div>

                        <div class="form-group row" id="choices_${count_question}">

                        </div>
                        <button class="btn btn-danger btn-sm" data-question="${count_question}" data-choices="1" id="remove_choices_${count_question}" style="float: right;display: none;margin-left: 2px;">REMOVE CHOICES</button>
                        <button class="btn btn-primary btn-sm" data-question="${count_question}" data-choices="1" id="add_choices_${count_question}" style="float: right;display: none">ADD CHOICES</button>
                        
                        <button class="btn btn-danger btn-sm" data-question="${count_question}" data-options="1" id="remove_option_${count_question}" style="float: right;display: none;margin-left: 2px;">REMOVE OPTION</button>
                        <button class="btn btn-primary btn-sm" data-question="${count_question}" data-options="1" id="add_option_${count_question}" style="float: right;display: none">ADD OPTION</button>
                        <input type="hidden" value="1" id="${count_question}_choices_count">
                        <input type="hidden" value="1" id="${count_question}_option_count">
                    </div>
                </div>
            </div>
        `).promise().done(function() {

            getAnswerType('answer_type_'+count_question, count_question);

            $('#answer_type_'+count_question).change(ShowChoices);

            $('#add_choices_'+count_question).click(AddChoices);
            $('#remove_choices_'+count_question).click(RemoveChoices);

            $('#add_option_'+count_question).click(AddOptions);
            $('#remove_option_'+count_question).click(RemoveOption);
        
        });
    }

    function RemoveQuestion() {
        if(count_question <= 1) {
            count_question = 1;
            return false;
        }

        $('#question_items').find('#question_'+count_question).remove();
        count_question--;

    }

    function renderChoices(type,question,choices,option) {
        $('#choices_'+question).empty();
   
        if(type == 1) {
            $('#choices_'+question).append(`
                <div class="col-md-11 mb-2 ${question}_choices_div_${choices}">
                    <label>Choices ${choices}</label>
                    <input type="text" class="form-control form-control-lg choices-${question}" id="choicesinputs_${question}_${choices}">
                </div>
               
            `);
            $('#add_choices_'+question).show();
            $('#remove_choices_'+question).show();
            $('#add_option_'+question).hide();
            $('#remove_option_'+question).hide();
        }

        else if(type == 2) {
            $('#choices_'+question).append(`
                <div class="col-md-11 mb-2 ${question}_option_div_${option}">
                    <label>Option ${option}</label>
                    <input type="text" class="form-control form-control-lg option-${question}" id="option_${question}_${option}">
                </div>
               
            `);
            $('#add_option_'+question).show();
            $('#remove_option_'+question).show();
            $('#add_choices_'+question).hide();
            $('#remove_choices_'+question).hide();
        }

        else if(type == 3) {
            $('#choices_'+question).append(`
                <div class="col-md-12 mb-2">
                    <label>Paragraph</label>
                    <textarea cols="5" rows="5" class="form-control form-control-lg" id="paragrap_${question}"></textarea>
                </div>
            `);
            $('#add_option_'+question).hide();
            $('#add_choices_'+question).hide();
        }
    }

    function ShowChoices() {
        var val = $(this).val().split('-');

        renderChoices(val[0],val[1],val[2],val[3]);
    }

    
    function AddChoices() {

        var choices = $(this).data('choices');

        var question = $(this).data('question');

        choices++;

        $('#question_items').find('#add_choices_'+question).data('choices',choices);
        $('#question_items').find('#remove_choices_'+question).data('choices',choices);
        $('#question_items').find('#'+question+'_choices_count').val(choices);

        $('#choices_'+question).append(`
            <div class="col-md-11 mb-2 ${question}_choices_div_${choices}">
                <label>Choices ${choices}</label>
                <input type="text" class="form-control form-control-lg choices-${question}" id="choicesinputs_${question}_${choices}">
            </div>
            
        `);
    }
    

    function RemoveChoices() {

        var choices = $(this).data('choices');
        var question = $(this).data('question');

        if(choices <= 1) {
            choices = 1;
            return false;
        }

        $('#choices_'+question).find('.'+question+'_choices_div_'+choices).remove();
        choices--;

        $('#question_items').find('#add_choices_'+question).data('choices',choices);
        $('#question_items').find('#remove_choices_'+question).data('choices',choices);
        $('#question_items').find('#'+question+'_choices_count').val(choices);

    }


    function AddOptions() {
       var option = parseInt($(this).data('options'));

       var question = $(this).data('question');

       option++;

       $('#question_items').find('#add_option_'+question).data('options',option);
       $('#question_items').find('#remove_option_'+question).data('options',option);
       $('#question_items').find('#'+question+'_option_count').val(option);

        $('#choices_'+question).append(`
            <div class="col-md-11 mb-2 ${question}_option_div_${option}">
            <label>Option ${option}</label>
            <input type="text" class="form-control form-control-lg option-${question}" id="option_${question}_${option}">
            </div>
            
        `);

    }

    function RemoveOption() {

        var option = parseInt($(this).data('options'));

        var question = $(this).data('question');

        if(option <= 1) {
            option = 1;
            return false;
        }

        $('#choices_'+question).find('.'+question+'_option_div_'+option).remove();
        option--;

       $('#question_items').find('#add_option_'+question).data('options',option);
       $('#question_items').find('#remove_option_'+question).data('options',option);
       $('#question_items').find('#'+question+'_option_count').val(option);

   }

   function SaveActivity() {
     var question_array = [];


      if($('.inputs').val() == '') {
        Swal.fire('Please fill out all fields!','','warning');
        return false;
      }


     for(var i = 1; i <= count_question; i++) {
         var choices = [];
         var option = [];

         if($('#question_items').find('#question_name_'+i).val() != '' || $('#question_items').find('#answer_type_'+i).val() != '') {

                for(var ii = 1; ii <= parseInt($('#question_items').find('#'+i+'_choices_count').val()); ii++) {
                    if($('#choices_'+i).find('#choicesinputs_'+i+'_'+ii+'').val() != null) {
                        choices.push($('#choices_'+i).find('#choicesinputs_'+i+'_'+ii+'').val());
                    }
                    
                }

                for(var iii = 1; iii <= parseInt($('#question_items').find('#'+i+'_option_count').val()); iii++) {
                    if($('#choices_'+i).find('#option_'+i+'_'+iii+'').val() != null) {
                        option.push($('#choices_'+i).find('#option_'+i+'_'+iii+'').val());
                    }
                }

                question_array.push({
                    question: $('#question_items').find('#question_name_'+i).val(),
                    answerType: $('#question_items').find('#answer_type_'+i).val().split('-')[0],
                    choices: choices,
                    option: option,
                    paragraph: $('#question_items').find('#paragrap_'+i).val()
                });

            }

     }

     $('#SaveActivity').attr('disabled','disabled').html('Please wait...');

            $.ajax({
                type: 'POST',
                url: '<?=base_url('TeacherController/SaveActivity') ?>',
                data: {
                    activity_name: $('#activity_name').val(),
                    description: $('#description').val(),
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    students: $('#students').val().join(','),
                    questions: JSON.stringify(question_array)
                },
                dataType: 'json',
                success: function(result) {

                    if(result.msg == 'success') {
                        Swal.fire('Successfully Created!','','success');
                        setTimeout(() => {
                            window.location = '<?= base_url('TeacherController/ActivityLists') ?>' 
                        },1500);
                    }
                    
                    $('#SaveActivity').removeAttr('disabled').html('SAVE');
                }
        })

   }

   function Preview() {
       var question_array = [];

        for(var i = 1; i <= count_question; i++) {
            var choices = [];
            var option = [];

            if($('#question_items').find('#question_name_'+i).val() != '' || $('#question_items').find('#answer_type_'+i).val() != '') {

                for(var ii = 1; ii <= parseInt($('#question_items').find('#'+i+'_choices_count').val()); ii++) {
                    if($('#choices_'+i).find('#choicesinputs_'+i+'_'+ii+'').val() != null) {
                        choices.push($('#choices_'+i).find('#choicesinputs_'+i+'_'+ii+'').val());
                    }
                    
                }

                for(var iii = 1; iii <= parseInt($('#question_items').find('#'+i+'_option_count').val()); iii++) {
                    if($('#choices_'+i).find('#option_'+i+'_'+iii+'').val() != null) {
                        option.push($('#choices_'+i).find('#option_'+i+'_'+iii+'').val());
                    }
                }

                question_array.push({
                    question: $('#question_items').find('#question_name_'+i).val(),
                    answerType: $('#question_items').find('#answer_type_'+i).val().split('-')[0],
                    choices: choices,
                    option: option,
                    paragraph: $('#question_items').find('#paragrap_'+i).val()
                });
                
            }

        }

        var items = JSON.parse(JSON.stringify(question_array));

        if(question_array.length == 0) {
            Swal.fire('Nothing to preview!','','warning');
            return false;
        }
        
        $('#form-items').empty();
        items.forEach(function(row, index) {
            var i = index + 1;
            var html = `<div class="card mb-2"><div class="card-body"><h4 class="card-title" style="font-size: 13px;">${i}. ${row.question}</h4><div class="form-group row"><div class="col-md-12 mb-2">`;
            
            if(row.answerType == 2) {
                html += `<select class="form-control form-control-lg" id="options_${i}">`;

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
                    <textarea cols="5" rows="5" class="form-control form-control-lg" id="paragrap_${i}">${row.paragraph}</textarea>
                 </div>
                `;
            }

            html += `</div></div></div>`;

            $('#form-items').append(html);
        });

        $('#activity_name_text').text($('#activity_name').val());
        $('#activity_desc_text').text($('#description').val());

        $('#PreviewModal').modal('show');
   }

    $(function() {

        const options = {
            removeItems: true,
            removeItemButton: true,
        };

        getAnswerType('answer_type_'+count_question, 1);
        getStudents('students');

        setTimeout(() => {
            new Choices('#students', options);
        },500)
       
        $('#answer_type_'+count_question).change(ShowChoices);

        $('#add_choices_'+count_question).click(AddChoices);
        $('#remove_choices_'+count_question).click(RemoveChoices);

        $('#add_option_'+count_question).click(AddOptions);
        $('#remove_option_'+count_question).click(RemoveOption);

        $('#AddQuestion').click(AddQuestion);
        $('#RemoveQuestion').click(RemoveQuestion);

        $('#SaveActivity').click(SaveActivity);

        $('#PreviewForm').click(Preview);
        
        $('#back').click(function() {
             window.location.href = '<?=base_url('TeacherController/ActivityLists') ?>';
         })
    })

</script>