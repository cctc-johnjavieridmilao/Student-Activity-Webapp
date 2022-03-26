
<div class="row" style="margin-top: 30px">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Account Information</h4>
                  <form class="pt-3">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg userinput" id="f_name" placeholder="First name">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg userinput" id="l_name" placeholder="Last name">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg userinput" id="m_name" placeholder="Middle name">
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-lg userinput" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-lg userinput" id="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="number" class="form-control form-control-lg userinput" id="phone_number" placeholder="Phone number">
                    </div>
                    <div class="mt-3">
                      <a class="btn btn-block btn-primary font-weight-medium" id="save_account" href="javascript:void(0)">Save changes</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Change password</h4>

                  <form class="pt-3">
                    <div class="form-group">
                      <input type="password" class="form-control form-control-lg passinput" id="current_pass" placeholder="Current password">
                    </div>
                    <div class="form-group">
                    <input type="password" class="form-control form-control-lg passinput" id="new_password" placeholder="New password">
                    </div>
                    <div class="form-group">
                    <input type="password" class="form-control form-control-lg passinput" id="confirm_pass" placeholder="Confirm password">
                    </div>
                    <div class="mt-3">
                      <a class="btn btn-block btn-primary font-weight-medium" id="save_pass" href="javascript:void(0)">Save changes</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          </div>

 <script>
     $(function() {
         
            $.get('<?=base_url('Home/GetProfile') ?>', function(response) {
                $('#f_name').val(response[0].firtname);
                $('#l_name').val(response[0].lastname);
                $('#m_name').val(response[0].middlename);
                $('#email').val(response[0].email);
                $('#username').val(response[0].username);
                $('#phone_number').val(response[0].phone_number);
            }, 'json');


            $('#save_pass').click(function() {

            if($('.userinput').val() == '') {
                    swal.fire('Please fill out all fields!', '', 'error');
                    return false
                }

                if($('#new_password').val() != $('#confirm_pass').val()) {
                    swal.fire('New password and Confirm password not match!', '', 'error');
                    return false
                }

                $.post('<?= base_url('Home/UpdatePassword') ?>', {
                    current_pass: $('#current_pass').val(),
                    new_pass: $('#new_password').val(),
                    confirm_pass: $('#confirm_pass').val(),
                }, function(response) {
                    if(response.msg == 'success') {
                        swal.fire('Successfully Updated!', '', 'success');
                    } else {
                        swal.fire(response.msg, '', 'error');
                    }
                    $('.passinput').val('');
                }, 'json');
            
            });

            $('#save_account').click(function() {
                $.post('<?=base_url('Home/UpdateProfile') ?>', {
                    firstname: $('#f_name').val(),
                    lastname: $('#l_name').val(),
                    middlename: $('#m_name').val(),
                    email: $('#email').val(),
                    username: $('#username').val(),
                    phone_number: $('#phone_number').val(),
                }, function(response) {
                    if(response.msg == 'success') {
                        swal.fire('Successfully Updated!', '', 'success');
                    } else {
                        swal.fire(response.msg, '', 'error');
                    }
                }, 'json');
            });
     })
 </script>