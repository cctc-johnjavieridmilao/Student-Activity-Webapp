
<style>
    .img_profile {
        width: 150px;
        height: 150px;
        border-radius: 25%;
    }
</style>

<div class="row" style="margin-top: 30px">
                    <div class="col-lg-4">
                      <div class="border-bottom text-center pb-4">

                      <?php if(!empty(session('profile'))) :?>
                        <img src="<?= base_url('public/uploads') ?>/<?= session('profile')?>" class="img_profile" id="img_profile" alt="" class="img-lg rounded-circle mb-3">
                        <?php else : ?>
                            <img src="<?=base_url('public/assets/img/default_image.png') ?>" class="img_profile" id="img_profile" alt="profile" class="img-lg rounded-circle mb-3">
                        <?php endif; ?>
                          <br><br>
                        <button class="btn btn-success" id="upload_profile">UPLOAD PROFILE</button>

                        <input type="file" style="display: none;" id="file">
                        <div class="mt-3">
                          <h3 id="fullname"></h3>
                          <div class="d-flex align-items-center justify-content-center">
                            <h5 class="mb-0 me-2 text-muted" id="dept"></h5>
                            <div class="br-wrapper br-theme-css-stars"><select id="profile-rating" name="rating" autocomplete="off" style="display: none;">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                            </select><div class="br-widget"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="2" data-rating-text="2" class=""></a><a href="#" data-rating-value="3" data-rating-text="3" class=""></a><a href="#" data-rating-value="4" data-rating-text="4" class=""></a><a href="#" data-rating-value="5" data-rating-text="5" class=""></a></div></div>
                          </div>
                        </div>
                        <p class="w-75 mx-auto mb-3">COLLEGE OF COMPUTING STUDIES, INFORMATION AND COMMUNICATIONS TECHNOLOGY</p>
              
                      </div>
                    </div>
                    <div class="col-lg-8">

                      <div class="mt-4 py-2 border-bottom">
                        <ul class="nav profile-navbar">
                          <li class="nav-item">
                            <a class="nav-link" href="#">
                              <i class="ti-user"></i>
                              Information
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="profile-feed">
                        <div class="d-flex align-items-start profile-feed-item">
                          <div class="ms-4">
                            <h6>Firstname</h6>
                            <p id="fname">
                              
                            </p>

                          </div>
                          <div class="ms-4">
                            <h6>MiddleName</h6>
                            <p id="mname">
                              
                            </p>

                          </div>
                          <div class="ms-4">
                            <h6>Lastname</h6>
                            <p id="lname">
                              
                            </p>

                          </div>
                        </div>

                        <div class="d-flex align-items-start profile-feed-item">
                          <div class="ms-4">
                            <h6>Email</h6>
                            <p id="email">
                             
                            </p>

                          </div>

                        </div>

                        <div class="d-flex align-items-start profile-feed-item">
                          <div class="ms-4">
                            <h6>Phone Number</h6>
                            <p id="cpnumber">
                             
                            </p>

                          </div>

                        </div>
   
                      </div>
                    </div>
                  </div>


<script>
  $(function() {

      var u_id = '<?=session('u_id') ?>';

      
        $.get('<?=base_url('TeacherController/GetProfileData') ?>').then(function(result) {
            var row = result[0];

            $('#cpnumber').text(row.phone_number);
            $('#email').text(row.email);
            $('#fname').text(row.firtname);
            $('#lname').text(row.lastname);
            $('#mname').text(row.middlename);
            $('#fullname').text(row.firtname + ' ' + row.middlename + ' ' + row.lastname);
            $('#dept').text(row.DeptName)

        });

        $('#upload_profile').click(function() {
            $('#file').click();
        });

        $('#file').change(function() {

            var fordData = new FormData();

            fordData.append('file', $('#file').prop('files')[0]);

                $.ajax({
                type: 'POST',
                url: '<?= base_url('Home/UploadProfile') ?>',
                data: fordData,
                processData: false,
                contentType: false,
                success: function(response) {
                   
                      if(response.msg == 'success') {
                           Swal.fire('Profile Successfully Updated!','','success');
                           $('#file').val('');
                           setTimeout(() => {
                            $('#img_profile').attr('src', '<?=base_url('public/uploads') ?>' + '/' + response.image)
                           },500);
                      }
                    
                   }
                })

        });
   });
</script>